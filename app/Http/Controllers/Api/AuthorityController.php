<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorityRequest;
use App\Http\Resources\AuthorityResource;
use App\Models\Authority;
use App\Models\User;
use App\Notifications\AuthorityDeleteRequested;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class AuthorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authorities_query = Authority::all();

        $authorities = AuthorityResource::collection($authorities_query);

        return response()->json(compact('authorities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorityRequest $request)
    {
        $authority = Authority::whereId($request->id)->withTrashed()->first();

        if ($authority && $authority->trashed()) {
            $authority->restore();
            $authority->fill($request->all());
            $authority->save();
        } else {
            $authority = Authority::create($request->all());
        }

        return response()->json([
            'message' => 'Authority successful created.',
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
        $authority_query = Authority::findOrFail($id);

        $authority = new AuthorityResource($authority_query);

        return response()->json(compact('authority'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorityRequest $request)
    {
        $authority = Authority::whereId($request->id)->withTrashed()->first();

        if ($authority && $authority->trashed()) {
            $authority->restore();
        } else {
            $authority = Authority::findOrFail($request->id);
        }

        $authority->fill($request->all());
        $authority->update();

        return response()->json(['message' => 'Authority successful updated.']);
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
            $authority = Authority::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return response()->json(['message' => 'Authority does not exist.']);
        }

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $authority->delete();

            return response()->json(['message' => 'Authority successful deleted.']);
        } elseif ($user->hasRole('developer')) {
            $admin = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->first();

            $admin->notify(new AuthorityDeleteRequested($authority, $user));

            return response()->json(['message' => 'Your notification for delete was sent to Administrator.']);
        }
    }
}
