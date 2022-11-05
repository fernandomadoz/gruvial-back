<?php

namespace App\Http\Controllers;


use App\Models\Trabajo_linea;
use App\Http\Resources\Trabajo_lineaResource;
use Illuminate\Http\Request;

class Trabajo_lineaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function listarTrabajosLineasPorTrabajo(Request $request)
    {
        $request->validate([
            "trabajo_encabezado_id" => "required"
        ]);

        $trabajo_encabezado_id = $request->trabajo_encabezado_id;
        return Trabajo_lineaResource::collection(
                            Trabajo_linea::with(['trabajo_encabezado'])
                            ->with(['maquina'])
                            ->with(['tipo_de_trabajo'])
                            ->with(['unidad_de_trabajo'])
                            ->with(['user']
                        )
                    ->where('trabajo_encabezado_id', $trabajo_encabezado_id)
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
          "maquina_id" => "required",
          "fecha_inicio" => "required|date_format:Y-m-d",
          "tipo_de_trabajo_id" => "required",
          "user_id" => "required"
        ]);


        $Trabajo_linea = new Trabajo_linea;
        $Trabajo_linea->trabajo_encabezado_id = $request->trabajo_encabezado_id;
        $Trabajo_linea->maquina_id = $request->maquina_id;
        $Trabajo_linea->lugar_de_trabajo = $request->lugar_de_trabajo;
        $Trabajo_linea->fecha_inicio = $request->fecha_inicio;
        $Trabajo_linea->fecha_fin = $request->fecha_fin;
        $Trabajo_linea->tipo_de_trabajo_id = $request->tipo_de_trabajo_id;
        $Trabajo_linea->unidad_de_trabajo_id = $request->unidad_de_trabajo_id;
        $Trabajo_linea->cantidad_unidades_trabajo = $request->cantidad_unidades_trabajo;
        $Trabajo_linea->importe = $request->importe;
        $Trabajo_linea->nro_de_remito = $request->nro_de_remito;
        $Trabajo_linea->persona_que_autoriza = $request->persona_que_autoriza;
        $Trabajo_linea->persona_que_supervisa = $request->persona_que_supervisa;
        $Trabajo_linea->observaciones = $request->observaciones;
        $Trabajo_linea->user_id = $request->user_id;
        $Trabajo_linea->trabajo_realizado = $request->trabajo_realizado;        
        $Trabajo_linea->save();


        $result = [
            'mensaje' => 'Servicio Creado',
            'Trabajo_linea' => new Trabajo_lineaResource($Trabajo_linea)
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
          "maquina_id" => "required",
          "fecha_inicio" => "required|date_format:Y-m-d",
          "tipo_de_trabajo_id" => "required",
          "user_id" => "required"
        ]);


        $Trabajo_linea = Trabajo_linea::find($id);
        $Trabajo_linea->trabajo_encabezado_id = $request->trabajo_encabezado_id;
        $Trabajo_linea->maquina_id = $request->maquina_id;
        $Trabajo_linea->lugar_de_trabajo = $request->lugar_de_trabajo;
        $Trabajo_linea->fecha_inicio = $request->fecha_inicio;
        $Trabajo_linea->fecha_fin = $request->fecha_fin;
        $Trabajo_linea->tipo_de_trabajo_id = $request->tipo_de_trabajo_id;
        $Trabajo_linea->unidad_de_trabajo_id = $request->unidad_de_trabajo_id;
        $Trabajo_linea->cantidad_unidades_trabajo = $request->cantidad_unidades_trabajo;
        $Trabajo_linea->importe = $request->importe;
        $Trabajo_linea->nro_de_remito = $request->nro_de_remito;
        $Trabajo_linea->persona_que_autoriza = $request->persona_que_autoriza;
        $Trabajo_linea->persona_que_supervisa = $request->persona_que_supervisa;
        $Trabajo_linea->observaciones = $request->observaciones;
        $Trabajo_linea->user_id = $request->user_id;
        $Trabajo_linea->trabajo_realizado = $request->trabajo_realizado;        
        $Trabajo_linea->save();




        $result = [
            'mensaje' => 'Servicio Actualizado',
            'Trabajo_linea' => new Trabajo_lineaResource($Trabajo_linea)
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
        
        Trabajo_linea::where('id', $id)->delete();

        $result = [
            'mensaje' => 'Servicio Eliminado'
        ];

        return $result;
    }
}
