<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            //'cliente' => ClienteResource::collection($this->whenLoaded('nombre_o_razon_social'))
            'trabajo_encabezado' => $this->trabajo_encabezado_id,
            'lugar_de_compra' => $this->lugar_de_compra,
            'fecha_de_compra' => date( "d/m/Y", strtotime($this->fecha_de_compra)),
            'fecha_de_compra_f' => date( "Y-m-d", strtotime($this->fecha_de_compra)),
            'importe_de_compra' => $this->importe_de_compra,
            'importe_cancelado' => $this->importe_cancelado,
            'descripcion_de_gasto' => $this->descripcion_de_gasto,
            'nro_de_factura' => $this->nro_de_factura,
            'trabajo_encabezado' => $this->trabajo_encabezado_id,
            'trabajo_encabezado' => $this->trabajo_encabezado_id,
            'lugar_de_compra' => new MaquinaResource($this->maquina),
            'lugar_de_trabajo' => $this->lugar_de_trabajo,
            'fecha_fin' => date( "d/m/Y", strtotime($this->fecha_fin)),
            'fecha_fin_f' => date( "Y-m-d", strtotime($this->fecha_fin)),
            'tipo_de_factura' => new Tipo_de_facturaResource($this->tipo_de_factura),
            'plan_de_cuenta' => new Plan_de_cuentaResource($this->plan_de_cuenta),
            //'cuenta_de_origen' => new cuentaResource($this->cuenta),
            'cuenta_de_origen' => new CuentaResource($this->cuenta_de_origen),
            'observaciones' => $this->observaciones,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->user),

        ];
    }
}
