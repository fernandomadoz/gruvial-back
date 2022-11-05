<?php

namespace App\Http\Controllers;

use App\Models\Trabajo_encabezado;
use App\Models\Cliente;
use App\Models\Trabajo_linea;
use App\Models\Factura;

use App\Http\Resources\Trabajo_encabezadoResource;
use App\Http\Resources\Trabajo_lineaResource;
use Illuminate\Http\Request;

class Trabajo_encabezadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function listarTrabajosPorFirma(Request $request)
    {
        $request->validate([
            "firma_id" => "required"
        ]);
        //$Trabajos_encabezados = Trabajo_encabezado::all();
        //return $Trabajos_encabezados->toJson(JSON_PRETTY_PRINT);
        //dd($request->firma_id);
        $firma_id = $request->firma_id;
        return Trabajo_encabezadoResource::collection(
                    Trabajo_encabezado::with(['cliente'])
                    ->where('firma_id', $firma_id)
                    ->get()
                )->toJson(JSON_PRETTY_PRINT);
        //return Trabajo_encabezado::with(['cliente', 'firma'])->get();
        
    }

    public function remitosPorTrabajo(Request $request)
    {
        $request->validate([
            "trabajo_encabezado_id" => "required"
        ]);

        $trabajo_encabezado_id = $request->trabajo_encabezado_id;
        return Trabajo_linea::select('id', 'nro_de_remito')
                    ->where('trabajo_encabezado_id', $trabajo_encabezado_id)
                    ->whereRaw('nro_de_remito != ""')
                    ->get();
        
    }

    public function facturasPorTrabajo(Request $request)
    {
        $request->validate([
            "trabajo_encabezado_id" => "required"
        ]);

        $trabajo_encabezado_id = $request->trabajo_encabezado_id;
        return Factura::select('id', 'nro_de_factura')
                    ->where('trabajo_encabezado_id', $trabajo_encabezado_id)
                    ->get();
        
    }

    public function index()
    {
        //$Trabajos_encabezados = Trabajo_encabezado::all();
        //return $Trabajos_encabezados->toJson(JSON_PRETTY_PRINT);
        return Trabajo_encabezadoResource::collection(Trabajo_encabezado::with(['cliente'])->get())->toJson(JSON_PRETTY_PRINT);
        //return Trabajo_encabezado::with(['cliente', 'firma'])->get();
        
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
            "firma_id" => "required",
            "cliente" => "required",
            "fecha_inicio" => "required|date_format:Y-m-d",
            "user_id" => "required"
        ]);

        if ($request->cliente['nuevoCliente']) {
            $Cliente = new Cliente;
            $Cliente->nombre_o_razon_social = $request->cliente['nombre_o_razon_social'];
            $Cliente->direccion = $request->cliente['direccion'];
            $Cliente->telefonos = $request->cliente['telefonos'];

            if ($request->cliente['es_consumidor_final']) {
                $Cliente->barrio_id = $request->cliente['barrio_id'];
                $Cliente->es_consumidor_final = 'SI';                
            }
            else {             
                $Cliente->CUIT_o_CUIL = $request->cliente['CUIT_o_CUIL'];
                $Cliente->email = $request->cliente['email'];
                $Cliente->es_consumidor_final = 'NO';
                   
            }

            $Cliente->save();
            $cliente_id = $Cliente->id;
        }
        else {
            $cliente_id = $request->cliente['id'];
        }

        $Trabajo_encabezado = new Trabajo_encabezado;
        $Trabajo_encabezado->cliente_id = $cliente_id;
        $Trabajo_encabezado->firma_id = $request->firma_id;
        $Trabajo_encabezado->fecha_inicio = $request->fecha_inicio;
        $Trabajo_encabezado->observaciones = $request->observaciones;
        $Trabajo_encabezado->user_id = $request->user_id;
        $Trabajo_encabezado->save();


        $result = [
            'mensaje' => 'Trabajo Creado',
            'trabajo_encabezado' => new Trabajo_encabezadoResource($Trabajo_encabezado)
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
        $Trabajo_encabezado = Trabajo_encabezado::find($id);
        return new Trabajo_encabezadoResource($Trabajo_encabezado);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            "firma_id" => "required",
            "cliente" => "required",
            "fecha_inicio" => "required|date_format:Y-m-d",
            "user_id" => "required"
        ]);

        if ($request->cliente['nuevoCliente']) {
            $Cliente = new Cliente;
            $Cliente->nombre_o_razon_social = $request->cliente['nombre_o_razon_social'];
            $Cliente->direccion = $request->cliente['direccion'];
            $Cliente->telefonos = $request->cliente['telefonos'];

            if ($request->cliente['es_consumidor_final']) {
                $Cliente->barrio_id = $request->cliente['barrio_id'];
                $Cliente->es_consumidor_final = 'SI';                
            }
            else {             
                $Cliente->CUIT_o_CUIL = $request->cliente['CUIT_o_CUIL'];
                $Cliente->email = $request->cliente['email'];
                $Cliente->es_consumidor_final = 'NO';
                   
            }

            $Cliente->save();
            $cliente_id = $Cliente->id;
        }
        else {
            $cliente_id = $request->cliente['id'];
        }

        $Trabajo_encabezado = Trabajo_encabezado::find($id);
        $Trabajo_encabezado->cliente_id = $cliente_id;
        $Trabajo_encabezado->firma_id = $request->firma_id;
        $Trabajo_encabezado->fecha_inicio = $request->fecha_inicio;
        $Trabajo_encabezado->observaciones = $request->observaciones;
        $Trabajo_encabezado->user_id = $request->user_id;
        $Trabajo_encabezado->save();

        $result = [
            'mensaje' => 'Datos Actualizados',
            'trabajo_encabezado' => new Trabajo_encabezadoResource($Trabajo_encabezado)
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
        //
    }
}
