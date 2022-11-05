<?php

namespace App\Http\Controllers;

use App\Models\Cheque;
use App\Http\Requests\StoreChequeRequest;
use App\Http\Resources\ChequeResource;
use App\Http\Requests\UpdateChequeRequest;

class ChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ChequeResource::collection(Cheque::get())->toJson(JSON_PRETTY_PRINT);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChequeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChequeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cheque  $cheque
     * @return \Illuminate\Http\Response
     */
    public function show(Cheque $cheque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChequeRequest  $request
     * @param  \App\Models\Cheque  $cheque
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChequeRequest $request, Cheque $cheque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cheque  $cheque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cheque $cheque)
    {
        //
    }
}
