<?php

namespace App\Http\Controllers;

use App\Models\Cobro;
use App\Models\Deposito;
use App\Models\Cheque;
use App\Models\Factura_de_cobro;

use App\Http\Resources\CobroResource;
use App\Http\Requests\StoreCobroRequest;
use App\Http\Requests\UpdateCobroRequest;
use Illuminate\Http\Request;

class CobroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function listarCobrosPorTrabajo(Request $request)
    {
        $request->validate([
            "trabajo_encabezado_id" => "required"
        ]);
        $trabajo_encabezado_id = $request->trabajo_encabezado_id;
        return CobroResource::collection(
                            Cobro::with(['trabajo_encabezado'])
                            ->with(['persona_que_cobro'])
                            ->with(['firma_de_origen'])
                            ->with(['cuenta_de_destino'])
                            ->with(['persona_que_recibe_en_cuenta_destino'])
                            ->with(['tipo_de_cobro'])
                            ->with(['deposito_de_cobro'])
                            ->with(['cheque'])
                            ->with(['deposito_de_destino'])
                    ->where('trabajo_encabezado_id', $trabajo_encabezado_id)
                    ->get()
                )->toJson(JSON_PRETTY_PRINT);
        //return Trabajo_encabezado::with(['cliente', 'firma'])->get();
        
    }

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCobroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          "trabajo_encabezado_id" => "required",
          "fecha_de_cobro" => "required|date_format:Y-m-d",
          "persona_que_cobro_id" => "required",
          "cuenta_de_destino_id" => "required",
          "tipo_de_cobro_id" => "required",
          "importe" => "required"
        ]);

        $mensaje = "Cobro Registrado";

        $Cobro = new Cobro;
        $Cobro->trabajo_encabezado_id = $request->trabajo_encabezado_id;
        $Cobro->fecha_de_cobro = $request->fecha_de_cobro;
        $Cobro->persona_que_cobro_id = $request->persona_que_cobro_id;
        $Cobro->cuenta_de_destino_id = $request->cuenta_de_destino_id;
        $Cobro->tipo_de_cobro_id = $request->tipo_de_cobro_id;
        $Cobro->observaciones = $request->observaciones;
        $Cobro->importe = $request->importe;
        $Cobro->user_id = $request->user_id;

        if ($request->tipo_de_cobro_id == 2) {
            $Deposito = new Deposito;
            $Deposito->monto_de_deposito = $request->importe;
            $Deposito->fecha_de_deposito = $request->deposito_de_cobro['fecha_de_deposito'];
            $Deposito->cuenta_de_destino_id = $request->cuenta_de_destino_id;
            $Deposito->save();
            $mensaje .= " | Deposito: Creado";

            $Cobro->deposito_de_cobro_id = $Deposito->id;

        }

        if ($request->tipo_de_cobro_id == 3) {
            $Cheque = new Cheque;
            $Cheque->importe = $request->importe;
            $Cheque->numero_de_cheque = $request->cheque['numero_de_cheque'];
            $Cheque->banco_id = $request->cheque['banco_id'];
            $Cheque->fecha_de_emision = $request->cheque['fecha_de_emision'];
            $Cheque->fecha_inicio_de_cobro = $request->cheque['fecha_inicio_de_cobro'];
            $Cheque->fecha_de_vencimiento = $request->cheque['fecha_de_vencimiento'];
            $Cheque->fecha_de_cobro = $request->cheque['fecha_de_cobro'];
            $Cheque->persona_que_cobro_id = $request->cheque['persona_que_cobro_id'];
            $Cheque->causa_de_baja_de_cheque_id = $request->cheque['causa_de_baja_de_cheque_id'];
            $Cheque->save();
            $mensaje .= " | Cheque: Creado";

            $Cobro->cheque_id = $Cheque->id;
        }


        // SI EL EFECTIVO O CHEQUE QUE HA SIDO COBRADO FUE DEPOSITADO
        if ($Cobro->tipo_de_cobro_id == 1 OR $Cobro->tipo_de_cobro_id == 3) {
            if ($request->cobro_depositado) {
                $Deposito_Dest = new Deposito;
                $Deposito_Dest->monto_de_deposito = $request->importe;
                $Deposito_Dest->fecha_de_deposito = $request->deposito_de_destino['fecha_de_deposito'];
                $Deposito_Dest->persona_que_deposito_id = $request->deposito_de_destino['persona_que_deposito_id'];
                $Deposito_Dest->cuenta_de_destino_id = $request->cuenta_de_destino_id;
                if ($request->deposito_de_destino['se_deposito_destino'] == 'deposito_destino_cheque') {
                    $Deposito_Dest->cheque_id = $Cheque->id;
                }
                
                $mensaje .= " | Deposito Destino: Creado";

                $Deposito_Dest->save();

                $Cobro->deposito_de_destino_id = $Deposito_Dest->id;

            }
        }

        $Cobro->save();


        //CARGO LAS FACTURAS QUE ESTA PAGANDO EL COBRO
        foreach ($request->facturas as $factura_id) {            
            $Factura_de_cobro = new Factura_de_cobro;
            $Factura_de_cobro->cobro_id = $Cobro->id;
            $Factura_de_cobro->factura_id = $factura_id;
            $Factura_de_cobro->save();
        }

        $result = [
            'mensaje' => 'Cobro Registrado',
            'Cobro' => new CobroResource($Cobro)
        ];

        return $result;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cobro  $cobro
     * @return \Illuminate\Http\Response
     */
    public function show(Cobro $cobro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCobroRequest  $request
     * @param  \App\Models\Cobro  $cobro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
          "trabajo_encabezado_id" => "required",
          "fecha_de_cobro" => "required|date_format:Y-m-d",
          "persona_que_cobro_id" => "required",
          "cuenta_de_destino_id" => "required",
          "tipo_de_cobro_id" => "required",
          "importe" => "required"
        ]);


        $Cobro = Cobro::find($id);

        if ($Cobro->tipo_de_cobro_id == $request->tipo_de_cobro_id) {

            $mensaje = 'Cobro Actualizado';

            $Cobro->trabajo_encabezado_id = $request->trabajo_encabezado_id;
            $Cobro->fecha_de_cobro = $request->fecha_de_cobro;
            $Cobro->persona_que_cobro_id = $request->persona_que_cobro_id;
            $Cobro->cuenta_de_destino_id = $request->cuenta_de_destino_id;
            $Cobro->tipo_de_cobro_id = $request->tipo_de_cobro_id;
            $Cobro->observaciones = $request->observaciones;
            $Cobro->importe = $request->importe;
            $Cobro->user_id = $request->user_id;


            if ($Cobro->tipo_de_cobro_id == 2) {
                $Deposito = Deposito::find($Cobro->deposito_de_cobro_id);
                $Deposito->monto_de_deposito = $request->importe;
                $Deposito->fecha_de_deposito = $request->deposito_de_cobro['fecha_de_deposito'];
                $Deposito->cuenta_de_destino_id = $request->cuenta_de_destino_id;
                $Deposito->save();

                $mensaje .= " | Deposito actualizado";

            }

            if ($Cobro->tipo_de_cobro_id == 3) {
                $Cheque = Cheque::find($Cobro->cheque_id);
                $Cheque->importe = $request->importe;
                $Cheque->numero_de_cheque = $request->cheque['numero_de_cheque'];
                $Cheque->banco_id = $request->cheque['banco_id'];
                $Cheque->fecha_de_emision = $request->cheque['fecha_de_emision'];
                $Cheque->fecha_inicio_de_cobro = $request->cheque['fecha_inicio_de_cobro'];
                $Cheque->fecha_de_vencimiento = $request->cheque['fecha_de_vencimiento'];
                $Cheque->fecha_de_cobro = $request->cheque['fecha_de_cobro'];
                $Cheque->persona_que_cobro_id = $request->cheque['persona_que_cobro_id'];
                $Cheque->causa_de_baja_de_cheque_id = $request->cheque['causa_de_baja_de_cheque_id'];
                $Cheque->save();

                $mensaje .= " | Cheque actualizado";
            }

        }
        else {

            //SI EL TIPO DE COBRO CAMBIO
            //$mensaje = 'No puede actualizarse este cobro, debe eliminarlo y volver a crearlo';
            $mensaje = 'Cobro y tipo de Cobro distinto Actualizado';
            

            //SI EL COBRO ES EFECTIVO
            if ($request->tipo_de_cobro_id == 1) {

                //SI ANTES ERA DEPOSITO BORRO EL DEPOSITO Y SETEO NULL
                if ($Cobro->tipo_de_cobro_id == 2) {
                    $deposito_de_cobro_id = $Cobro->deposito_de_cobro_id;
                    $Cobro->deposito_de_cobro_id = null;
                    Deposito::where('id', $deposito_de_cobro_id)->delete();
                    $mensaje .= " | Deposito: $deposito_de_cobro_id Eliminado";
                }

                //SI ANTES ERA CHEQUE BORRO EL CHEQUE Y SETEO NULL
                if ($Cobro->tipo_de_cobro_id == 3) {
                    $cheque_id = $Cobro->cheque_id;
                    $Cobro->cheque_id = null;
                    Cheque::where('id', $cheque_id)->delete();
                    $mensaje .= " | Cheque: $cheque_id Eliminado";

                }

            }


            //SI EL COBRO ES DEPOSITO
            if ($request->tipo_de_cobro_id == 2) {

                //CREO EL DEPOSITO
                $Deposito = new Deposito;
                $Deposito->monto_de_deposito = $request->importe;
                $Deposito->fecha_de_deposito = $request->deposito_de_cobro['fecha_de_deposito'];
                $Deposito->cuenta_de_destino_id = $request->cuenta_de_destino_id;
                $Deposito->save();
                $mensaje .= " | Deposito: Creado";

                $Cobro->deposito_de_cobro_id = $Deposito->id;

                //SI ANTES ERA CHEQUE BORRO EL CHEQUE Y SETEO NULL
                if ($Cobro->tipo_de_cobro_id == 3) {
                    $cheque_id = $Cobro->cheque_id;
                    $Cobro->cheque_id = null;
                    Cheque::where('id', $cheque_id)->delete();
                    $mensaje .= " | Cheque: $cheque_id Eliminado";
                }

            }

            //SI EL COBRO ES CHEQUE
            if ($request->tipo_de_cobro_id == 3) {

                //CREO EL CHEQUE
                $Cheque = new Cheque;
                $Cheque->importe = $request->importe;
                $Cheque->numero_de_cheque = $request->cheque['numero_de_cheque'];
                $Cheque->banco_id = $request->cheque['banco_id'];
                $Cheque->fecha_de_emision = $request->cheque['fecha_de_emision'];
                $Cheque->fecha_inicio_de_cobro = $request->cheque['fecha_inicio_de_cobro'];
                $Cheque->fecha_de_vencimiento = $request->cheque['fecha_de_vencimiento'];
                $Cheque->fecha_de_cobro = $request->cheque['fecha_de_cobro'];
                $Cheque->persona_que_cobro_id = $request->cheque['persona_que_cobro_id'];
                $Cheque->causa_de_baja_de_cheque_id = $request->cheque['causa_de_baja_de_cheque_id'];
                $Cheque->save();
                $mensaje .= " | Cheque: Creado";

                $Cobro->cheque_id = $Cheque->id;

                //SI ANTES ERA DEPOSITO BORRO EL DEPOSITO Y SETEO NULL
                if ($Cobro->tipo_de_cobro_id == 2) {
                    $deposito_de_cobro_id = $Cobro->deposito_de_cobro_id;
                    $Cobro->deposito_de_cobro_id = null;
                    Deposito::where('id', $deposito_de_cobro_id)->delete();
                    $mensaje .= " | Deposito: $deposito_de_cobro_id Eliminado";
                }

            }


            $Cobro->trabajo_encabezado_id = $request->trabajo_encabezado_id;
            $Cobro->fecha_de_cobro = $request->fecha_de_cobro;
            $Cobro->persona_que_cobro_id = $request->persona_que_cobro_id;
            $Cobro->cuenta_de_destino_id = $request->cuenta_de_destino_id;
            $Cobro->tipo_de_cobro_id = $request->tipo_de_cobro_id;
            $Cobro->observaciones = $request->observaciones;
            $Cobro->importe = $request->importe;
            $Cobro->user_id = $request->user_id;

        }


        // SI EL EFECTIVO O CHEQUE QUE HA SIDO COBRADO FUE DEPOSITADO
        if ($request->tipo_de_cobro_id == 1 OR $request->tipo_de_cobro_id == 3) {
            if ($request->cobro_depositado) {

                //SI YA HABIA UN DEPOSITO DESTINO LO BUSCO SINO LO CREO
                if ($Cobro->deposito_de_destino_id <> '') {
                    $Deposito_Dest = Deposito::find($Cobro->deposito_de_destino_id);
                    $mensaje .= " | Deposito destino actualizado";
                }
                else {
                    $Deposito_Dest = new Deposito;
                    $mensaje .= " | Deposito destino creado";
                }
                $Deposito_Dest->monto_de_deposito = $request->importe;
                $Deposito_Dest->fecha_de_deposito = $request->deposito_de_destino['fecha_de_deposito'];
                $Deposito_Dest->persona_que_deposito_id = $request->deposito_de_destino['persona_que_deposito_id'];
                $Deposito_Dest->cuenta_de_destino_id = $request->cuenta_de_destino_id;
                if ($request->deposito_de_destino['se_deposito_destino'] == 'deposito_destino_cheque') {
                    $Deposito_Dest->cheque_id = $Cheque->id;
                }

                $Deposito_Dest->save();

                //SI NO HABIA UN DEPOSITO DESTINO ACTUALIZO EL ID EN LA TABLA COBRO
                if ($Cobro->deposito_de_destino_id == '') {
                    $Cobro->deposito_de_destino_id = $Deposito_Dest->id;
                }


            }
            else {
                //SI NO SE DEPOSITO EL COBRO PERO HABIA UN COBRO DEPOSITADO LO BORRO Y SETEO NULL EN Cobro->deposito_de_destino_id
                if ($Cobro->deposito_de_destino_id <> '') {
                    $deposito_de_destino_id = $Cobro->deposito_de_destino_id;
                    $Cobro->deposito_de_destino_id = null;
                    Deposito::where('id', $deposito_de_destino_id)->delete();
                    $mensaje .= " | Deposito destino: $deposito_de_destino_id Eliminado";
                }
            }
        }

        $Cobro->save();


        //CARGO LAS FACTURAS QUE ESTA PAGANDO EL COBRO
        Factura_de_cobro::where('cobro_id', $Cobro->id)->delete();
        foreach ($request->facturas as $factura_id) {
            $Factura_de_cobro = new Factura_de_cobro;
            $Factura_de_cobro->cobro_id = $Cobro->id;
            $Factura_de_cobro->factura_id = $factura_id;
            $Factura_de_cobro->save();
        }

        $result = [
            'mensaje' => $mensaje,
            'Cobro' => new CobroResource($Cobro)
        ];

        return $result;



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cobro  $cobro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $Cobro = Cobro::find($id);
        $mensaje = "Cobro Eliminado";


        //SI ANTES ERA DEPOSITO BORRO EL DEPOSITO Y SETEO NULL
        if ($Cobro->tipo_de_cobro_id == 2) {
            $deposito_de_cobro_id = $Cobro->deposito_de_cobro_id;
            $Cobro->deposito_de_cobro_id = null;
            $Cobro->save();
            Deposito::where('id', $deposito_de_cobro_id)->delete();
            $mensaje .= " | Deposito: $deposito_de_cobro_id Eliminado";
        }

        //SI ANTES ERA CHEQUE BORRO EL CHEQUE Y SETEO NULL
        if ($Cobro->tipo_de_cobro_id == 3) {
            $cheque_id = $Cobro->cheque_id;
            $Cobro->cheque_id = null;
            $Cobro->save();
            Cheque::where('id', $cheque_id)->delete();
            $mensaje .= " | Cheque: $cheque_id Eliminado";

        }


        if ($Cobro->deposito_de_destino_id <> '') {
            $deposito_de_destino_id = $Cobro->deposito_de_destino_id;
            $Cobro->deposito_de_destino_id = null;
            $Cobro->save();
            Deposito::where('id', $deposito_de_destino_id)->delete();
            $mensaje .= " | Deposito destino: $deposito_de_destino_id Eliminado";
        }


        Cobro::where('id', $id)->delete();




        $result = [
            'mensaje' => $mensaje
        ];

        return $result;

    }
}
