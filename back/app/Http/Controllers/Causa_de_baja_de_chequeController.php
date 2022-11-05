<?php

namespace App\Http\Controllers;

use App\Models\Causa_de_baja_de_cheque;
use App\Http\Resources\Causa_de_baja_de_chequeResource;
use App\Http\Requests\StoreCausa_de_baja_de_chequeRequest;
use App\Http\Requests\UpdateCausa_de_baja_de_chequeRequest;

class Causa_de_baja_de_chequeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Causa_de_baja_de_chequeResource::collection(Causa_de_baja_de_cheque::get())->toJson(JSON_PRETTY_PRINT);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCausa_de_baja_de_chequeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCausa_de_baja_de_chequeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Causa_de_baja_de_cheque  $causa_de_baja_de_cheque
     * @return \Illuminate\Http\Response
     */
    public function show(Causa_de_baja_de_cheque $causa_de_baja_de_cheque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCausa_de_baja_de_chequeRequest  $request
     * @param  \App\Models\Causa_de_baja_de_cheque  $causa_de_baja_de_cheque
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCausa_de_baja_de_chequeRequest $request, Causa_de_baja_de_cheque $causa_de_baja_de_cheque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Causa_de_baja_de_cheque  $causa_de_baja_de_cheque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Causa_de_baja_de_cheque $causa_de_baja_de_cheque)
    {
        //
    }
}
