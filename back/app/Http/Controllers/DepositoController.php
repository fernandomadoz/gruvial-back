<?php

namespace App\Http\Controllers;

use App\Models\Deposito;
use App\Http\Resources\DepositoResource;
use App\Http\Requests\StoreDepositoRequest;
use App\Http\Requests\UpdateDepositoRequest;

class DepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DepositoResource::collection(Deposito::get())->toJson(JSON_PRETTY_PRINT);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepositoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepositoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function show(Deposito $deposito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepositoRequest  $request
     * @param  \App\Models\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepositoRequest $request, Deposito $deposito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposito  $deposito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposito $deposito)
    {
        //
    }
}
