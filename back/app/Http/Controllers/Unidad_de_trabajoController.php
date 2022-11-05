<?php

namespace App\Http\Controllers;

use App\Models\Unidad_de_trabajo;
use App\Http\Resources\Unidad_de_trabajoResource;
use App\Http\Requests\StoreUnidad_de_trabajoRequest;
use App\Http\Requests\UpdateUnidad_de_trabajoRequest;

class Unidad_de_trabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Unidad_de_trabajoResource::collection(Unidad_de_trabajo::get())->toJson(JSON_PRETTY_PRINT);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUnidad_de_trabajoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnidad_de_trabajoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unidad_de_trabajo  $unidad_de_trabajo
     * @return \Illuminate\Http\Response
     */
    public function show(Unidad_de_trabajo $unidad_de_trabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnidad_de_trabajoRequest  $request
     * @param  \App\Models\Unidad_de_trabajo  $unidad_de_trabajo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnidad_de_trabajoRequest $request, Unidad_de_trabajo $unidad_de_trabajo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unidad_de_trabajo  $unidad_de_trabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidad_de_trabajo $unidad_de_trabajo)
    {
        //
    }
}
