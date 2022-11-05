<?php

namespace App\Http\Controllers;

use App\Models\Maquina;
use App\Http\Requests\StoreMaquinaRequest;
use App\Http\Resources\MaquinaResource;
use App\Http\Requests\UpdateMaquinaRequest;

class MaquinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MaquinaResource::collection(Maquina::get())->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMaquinaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaquinaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function show(Maquina $maquina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMaquinaRequest  $request
     * @param  \App\Models\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaquinaRequest $request, Maquina $maquina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maquina  $maquina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maquina $maquina)
    {
        //
    }
}
