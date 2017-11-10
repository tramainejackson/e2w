<?php

namespace App\Http\Controllers;

use App\DistributionList;
use Illuminate\Http\Request;

class DistributionListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
		$particant = App\TripLocation();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distribution_List  $distribution_List
     * @return \Illuminate\Http\Response
     */
    public function show(Distribution_List $distribution_List)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distribution_List  $distribution_List
     * @return \Illuminate\Http\Response
     */
    public function edit(Distribution_List $distribution_List)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distribution_List  $distribution_List
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distribution_List $distribution_List)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distribution_List  $distribution_List
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distribution_List $distribution_List)
    {
        //
    }
}
