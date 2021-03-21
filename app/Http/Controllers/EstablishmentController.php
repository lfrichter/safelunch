<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = '';
        $establishments = [];

        return view('frontend.index', compact('establishments', 'search'));
    }

    public function search(Request $request)
    {
        $search = isset($request->search) ? $request->search : '';
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

        return view('frontend.index', compact('establishments', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
    }
}
