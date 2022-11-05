<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacturaResource extends JsonResource
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
            'trabajo_encabezado' => new Trabajo_encabezadoResource($this->trabajo_encabezado),
            'razon_social' => new Razon_socialResource($this->razon_social),
            'tipo_de_factura' => new Tipo_de_facturaResource($this->tipo_de_factura),
            'fecha_de_factura' => date( "d/m/Y", strtotime($this->fecha_de_factura)),
            'fecha_de_factura_f' => date( "Y-m-d", strtotime($this->fecha_de_factura)),
            'remitos' => $this->remito_de_factura,
            'nro_de_factura' => $this->nro_de_factura,
            'descripcion' => $this->descripcion,
            'importe' => $this->importe,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
