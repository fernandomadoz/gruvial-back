<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Http\Resources\CompraResource;
use App\Http\Requests\UpdateCompraRequest;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function listarComprasPorTrabajo(Request $request)
    {
        $request->validate([
            "trabajo_encabezado_id" => "required"
        ]);
        $trabajo_encabezado_id = $request->trabajo_encabezado_id;
        return CompraResource::collection(
                            Compra::with(['tipo_de_factura'])
                            ->with(['cuenta_de_origen'])
                            ->with(['plan_de_cuenta'])
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
          "tipo_de_factura_id" => "required",
          "fecha_de_compra" => "required|date_format:Y-m-d",
          "importe_de_compra" => "required",
          "importe_cancelado" => "required",
          "descripcion_de_gasto" => "required",
          "plan_de_cuenta_id" => "required",
          "cuenta_de_origen_id" => "required",
        ]);


        $Compra = new Compra;
        $Compra->trabajo_encabezado_id = $request->trabajo_encabezado_id;
        $Compra->lugar_de_compra = $request->lugar_de_compra;
        $Compra->fecha_de_compra = $request->fecha_de_compra;
        $Compra->importe_de_compra = $request->importe_de_compra;
        $Compra->importe_cancelado = $request->importe_cancelado;
        $Compra->descripcion_de_gasto = $request->descripcion_de_gasto;
        $Compra->nro_de_factura = $request->nro_de_factura;
        $Compra->tipo_de_factura_id = $request->tipo_de_factura_id;
        $Compra->plan_de_cuenta_id = $request->plan_de_cuenta_id;
        $Compra->cuenta_de_origen_id = $request->cuenta_de_origen_id;
        $Compra->save();


        $result = [
            'mensaje' => 'Compra Registrada',
            'Compra' => new CompraResource($Compra)
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
          "plan_de_cuenta_id" => "required",
          "fecha_de_compra" => "required|date_format:Y-m-d",
          "importe_de_compra" => "required",
          "importe_cancelado" => "required",
          "descripcion_de_gasto" => "required",
          "plan_de_cuenta_id" => "required",
          "cuenta_de_origen_id" => "required",
        ]);



        $Compra = Compra::find($id);
        $Compra->trabajo_encabezado_id = $request->trabajo_encabezado_id;
        $Compra->lugar_de_compra = $request->lugar_de_compra;
        $Compra->fecha_de_compra = $request->fecha_de_compra;
        $Compra->importe_de_compra = $request->importe_de_compra;
        $Compra->importe_cancelado = $request->importe_cancelado;
        $Compra->descripcion_de_gasto = $request->descripcion_de_gasto;
        $Compra->nro_de_factura = $request->nro_de_factura;
        $Compra->tipo_de_factura_id = $request->tipo_de_factura_id;
        $Compra->plan_de_cuenta_id = $request->plan_de_cuenta_id;
        $Compra->cuenta_de_origen_id = $request->cuenta_de_origen_id;
        $Compra->save();




        $result = [
            'mensaje' => 'Compra Actualizada',
            'Compra' => new CompraResource($Compra)
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
        
        Compra::where('id', $id)->delete();

        $result = [
            'mensaje' => 'Compra Eliminada'
        ];

        return $result;
    }
}
