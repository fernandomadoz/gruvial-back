<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Http\Resources\BarrioResource;
use App\Http\Requests\StoreBarrioRequest;
use App\Http\Requests\UpdateBarrioRequest;

class BarrioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BarrioResource::collection(Barrio::get())->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBarrioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarrioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barrio  $barrio
     * @return \Illuminate\Http\Response
     */
    public function show(Barrio $barrio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBarrioRequest  $request
     * @param  \App\Models\Barrio  $barrio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarrioRequest $request, Barrio $barrio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barrio  $barrio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barrio $barrio)
    {
        //
    }
}
