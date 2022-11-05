<?php

namespace App\Http\Controllers;

use App\Models\Tipo_de_factura;
use App\Http\Resources\Tipo_de_facturaResource;
use App\Http\Requests\UpdateTipo_de_facturaRequest;

class Tipo_de_facturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tipo_de_facturaResource::collection(Tipo_de_factura::get())->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipo_de_facturaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipo_de_facturaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipo_de_factura  $tipo_de_factura
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo_de_factura $tipo_de_factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipo_de_facturaRequest  $request
     * @param  \App\Models\Tipo_de_factura  $tipo_de_factura
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipo_de_facturaRequest $request, Tipo_de_factura $tipo_de_factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipo_de_factura  $tipo_de_factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo_de_factura $tipo_de_factura)
    {
        //
    }
}
