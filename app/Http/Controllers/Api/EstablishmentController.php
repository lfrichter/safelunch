<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstablishmentRequest;
use App\Http\Resources\EstablishmentResource;
use App\Models\Establishment;
use App\Models\User;
use App\Notifications\EstablishmentDeleteRequested;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstablishmentController extends Controller
{
    public function search(Request $request)
    {
        $search = isset($request->search) ? $request->search : '';

        if (empty($search)) {
            return response()->json(['id' => '', 'authority_id' => '', 'name' => '', 'business_name' => '', 'business_type' => '', 'full_address' => '', 'postcode' => '', 'rating_value' => '']);
        }

        $search_query = preg_replace('/\s+/', '%', $search);
        $search_query = "%{$search_query}%";

        $establishments = DB::table('establishments')
                            ->select(
                                        'authorities.id',
                                        'establishments.authority_id',
                                        'authorities.name',
                                        'establishments.business_name',
                                        'establishments.business_type',
                                        DB::raw('IF(establishments.address_line_2 != "",CONCAT(establishments.address_line_1,", ",establishments.address_line_2), establishments.address_line_1) as full_address'),
                                        'establishments.postcode',
                                        'establishments.rating_value'
                                )
                            ->join('authorities', 'establishments.authority_id', '=', 'authorities.id')
                            ->whereRaw("establishments.rating_value regexp '^[0-9]'")
                            ->where(function ($query) use ($search_query) {
                                $query->orWhereRaw("CONCAT(name, ' ', region_name) LIKE ?", [$search_query]);
                                $query->orWhereRaw("CONCAT(region_name, ' ',name) LIKE ?", [$search_query]);
                            })
                            ->get();

        return response()->json($establishments->toArray());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $authority_id)
    {
        $establishments_query = Establishment::whereAuthority_id($authority_id)->get();

        $establishments = EstablishmentResource::collection($establishments_query);

        return response()->json(compact('establishments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EstablishmentRequest $request)
    {
        $establishment = Establishment::whereId($request->id)->withTrashed()->first();

        if ($establishment && $establishment->trashed()) {
            $establishment->restore();
            $establishment->fill($request->all());
            $establishment->save();
        } else {
            $establishment = Establishment::create($request->all());
        }

        return response()->json([
            'message' => 'Establishment successful created.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $establishment_query = Establishment::findOrFail($id);

        $establishment = new EstablishmentResource($establishment_query);

        return response()->json(compact('establishment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EstablishmentRequest $request)
    {
        $establishment = Establishment::whereId($request->id)->withTrashed()->first();

        if ($establishment && $establishment->trashed()) {
            $establishment->restore();
        } else {
            $establishment = Establishment::findOrFail($request->id);
        }

        $establishment->fill($request->all());
        $establishment->update();

        return response()->json(['message' => 'Establishment successful updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $establishment = Establishment::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return response()->json(['message' => 'Establishment does not exist.']);
        }

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $establishment->delete();

            return response()->json(['message' => 'Establishment successful deleted.']);
        } elseif ($user->hasRole('developer')) {
            $admin = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->first();

            $admin->notify(new EstablishmentDeleteRequested($establishment, $user));

            return response()->json(['message' => 'Your notification for delete was sent to Administrator.']);
        }
    }
}
