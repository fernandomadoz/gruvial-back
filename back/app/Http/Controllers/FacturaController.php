<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Remito_de_factura;

use App\Http\Resources\FacturaResource;
use App\Http\Requests\UpdateFacturaRequest;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function listarFacturasPorTrabajo(Request $request)
    {
        $request->validate([
            "trabajo_encabezado_id" => "required"
        ]);
        $trabajo_encabezado_id = $request->trabajo_encabezado_id;
        return FacturaResource::collection(
                            Factura::with(['tipo_de_factura'])
                            ->with(['razon_social'])
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
          "razon_social_id" => "required",
          "tipo_de_factura_id" => "required",
          "fecha_de_factura" => "required|date_format:Y-m-d",
          "nro_de_factura" => "required",
          "descripcion" => "required",
          "importe" => "required",
        ]);

        $Factura = new Factura;
        $Factura->trabajo_encabezado_id = $request->trabajo_encabezado_id;
        $Factura->razon_social_id = $request->razon_social_id;
        $Factura->fecha_de_factura = $request->fecha_de_factura;
        $Factura->importe = $request->importe;
        $Factura->descripcion = $request->descripcion;
        $Factura->nro_de_factura = $request->nro_de_factura;
        $Factura->tipo_de_factura_id = $request->tipo_de_factura_id;
        $Factura->save();


        foreach ($request->remitos as $trabajo_linea_id) {
            
            $Remito_de_factura = new Remito_de_factura;
            $Remito_de_factura->factura_id = $Factura->id;
            $Remito_de_factura->trabajo_linea_id = $trabajo_linea_id;
            $Remito_de_factura->save();
        }



        $result = [
            'mensaje' => 'Factura Registrada',
            'Factura' => new FacturaResource($Factura)
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
          "razon_social_id" => "required",
          "tipo_de_factura_id" => "required",
          "fecha_de_factura" => "required|date_format:Y-m-d",
          "nro_de_factura" => "required",
          "descripcion" => "required",
          "importe" => "required",
        ]);



        $Factura = Factura::find($id);
        $Factura->trabajo_encabezado_id = $request->trabajo_encabezado_id;
        $Factura->razon_social_id = $request->razon_social_id;
        $Factura->fecha_de_factura = $request->fecha_de_factura;
        $Factura->importe = $request->importe;
        $Factura->descripcion = $request->descripcion;
        $Factura->nro_de_factura = $request->nro_de_factura;
        $Factura->tipo_de_factura_id = $request->tipo_de_factura_id;
        $Factura->save();


        Remito_de_factura::where('factura_id', $Factura->id)->delete();
        foreach ($request->remitos as $trabajo_linea_id) {
            
            $Remito_de_factura = new Remito_de_factura;
            $Remito_de_factura->factura_id = $Factura->id;
            $Remito_de_factura->trabajo_linea_id = $trabajo_linea_id;
            $Remito_de_factura->save();
        }


        $result = [
            'mensaje' => 'Factura Actualizada',
            'Factura' => new FacturaResource($Factura)
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
        
        Factura::where('id', $id)->delete();

        $result = [
            'mensaje' => 'Factura Eliminada'
        ];

        return $result;
    }
}
