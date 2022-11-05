<?php

namespace App\Http\Controllers;

use App\Models\Tipo_de_cobro;
use App\Http\Resources\Tipo_de_cobroResource;
use App\Http\Requests\StoreTipo_de_cobroRequest;
use App\Http\Requests\UpdateTipo_de_cobroRequest;

class Tipo_de_cobroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tipo_de_cobroResource::collection(Tipo_de_cobro::get())->toJson(JSON_PRETTY_PRINT);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipo_de_cobroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipo_de_cobroRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipo_de_cobro  $tipo_de_cobro
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo_de_cobro $tipo_de_cobro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipo_de_cobroRequest  $request
     * @param  \App\Models\Tipo_de_cobro  $tipo_de_cobro
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipo_de_cobroRequest $request, Tipo_de_cobro $tipo_de_cobro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipo_de_cobro  $tipo_de_cobro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo_de_cobro $tipo_de_cobro)
    {
        //
    }
}
