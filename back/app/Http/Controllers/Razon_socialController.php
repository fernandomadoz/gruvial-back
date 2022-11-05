<?php

namespace App\Http\Controllers;

use App\Models\Razon_social;
use App\Http\Resources\Razon_socialResource;
use App\Http\Requests\UpdateRazon_socialRequest;

class Razon_socialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Razon_socialResource::collection(Razon_social::get())->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRazon_socialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRazon_socialRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Razon_social  $razon_social
     * @return \Illuminate\Http\Response
     */
    public function show(Razon_social $razon_social)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRazon_socialRequest  $request
     * @param  \App\Models\Razon_social  $razon_social
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRazon_socialRequest $request, Razon_social $razon_social)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Razon_social  $razon_social
     * @return \Illuminate\Http\Response
     */
    public function destroy(Razon_social $razon_social)
    {
        //
    }
}
