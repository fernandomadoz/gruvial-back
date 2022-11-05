<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Http\Resources\NotaResource;
use App\Http\Requests\UpdateNotaRequest;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function listarNotasPorTrabajo(Request $request)
    {
        $request->validate([
            "trabajo_encabezado_id" => "required"
        ]);
        $trabajo_encabezado_id = $request->trabajo_encabezado_id;
        return NotaResource::collection(
                            Nota::where('trabajo_encabezado_id', $trabajo_encabezado_id)
                            ->orderBy('id', 'desc')
                    ->get()
                )->toJson(JSON_PRETTY_PRINT);
        //return Trabajo_encabezado::with(['cliente', 'firma'])->get();
        
    }


    public function index()
    {
        return FirmaResource::collection(Firma::get())->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          "nota" => "required"
        ]);


        $Nota = new Nota;
        $Nota->trabajo_encabezado_id = $request->trabajo_encabezado_id;
        $Nota->nota = $request->nota;
        $Nota->save();


        $result = [
            'mensaje' => 'Nota Registrada',
            'Nota' => new NotaResource($Nota)
        ];

        return $result;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
          "nota" => "required"
        ]);



        $Nota = Nota::find($id);
        $Nota->trabajo_encabezado_id = $request->trabajo_encabezado_id;
        $Nota->nota = $request->nota;
        $Nota->save();




        $result = [
            'mensaje' => 'Nota Actualizada',
            'Nota' => new NotaResource($Nota)
        ];

        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Nota::where('id', $id)->delete();

        $result = [
            'mensaje' => 'Nota Eliminada'
        ];

        return $result;
    }
}
