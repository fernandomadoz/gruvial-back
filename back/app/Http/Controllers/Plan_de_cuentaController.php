<?php

namespace App\Http\Controllers;

use App\Models\Plan_de_cuenta;
use App\Http\Resources\Plan_de_cuentaResource;
use App\Http\Requests\UpdatePlan_de_cuentaRequest;

class Plan_de_cuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Plan_de_cuentaResource::collection(Plan_de_cuenta::get())->toJson(JSON_PRETTY_PRINT);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlan_de_cuentaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlan_de_cuentaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan_de_cuenta  $plan_de_cuenta
     * @return \Illuminate\Http\Response
     */
    public function show(Plan_de_cuenta $plan_de_cuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlan_de_cuentaRequest  $request
     * @param  \App\Models\Plan_de_cuenta  $plan_de_cuenta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlan_de_cuentaRequest $request, Plan_de_cuenta $plan_de_cuenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan_de_cuenta  $plan_de_cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan_de_cuenta $plan_de_cuenta)
    {
        //
    }
}
