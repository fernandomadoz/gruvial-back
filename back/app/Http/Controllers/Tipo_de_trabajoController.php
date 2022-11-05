<?php

namespace App\Http\Controllers;

use App\Models\Tipo_de_trabajo;
use App\Http\Resources\Tipo_de_trabajoResource;
use App\Http\Requests\StoreTipo_de_trabajoRequest;
use App\Http\Requests\UpdateTipo_de_trabajoRequest;

class Tipo_de_trabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tipo_de_trabajoResource::collection(Tipo_de_trabajo::get())->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipo_de_trabajoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipo_de_trabajoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipo_de_trabajo  $tipo_de_trabajo
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo_de_trabajo $tipo_de_trabajo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipo_de_trabajoRequest  $request
     * @param  \App\Models\Tipo_de_trabajo  $tipo_de_trabajo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipo_de_trabajoRequest $request, Tipo_de_trabajo $tipo_de_trabajo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipo_de_trabajo  $tipo_de_trabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo_de_trabajo $tipo_de_trabajo)
    {
        //
    }
}
