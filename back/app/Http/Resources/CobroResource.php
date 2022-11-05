<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CobroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $detalle_select = $this->tipo_de_cobro->tipo_de_cobro;
        $detalle_select .= ' ('.date( "Y-m-d", strtotime($this->fecha_de_cobro)).') ';
        $detalle_select .= ' $'.$this->importe;

        return [
            'id' => $this->id,
            'detalle_select' => $detalle_select,
            'fecha_de_cobro' => date( "d/m/Y", strtotime($this->fecha_de_cobro)),
            'fecha_de_cobro_f' => date( "Y-m-d", strtotime($this->fecha_de_cobro)),
            'persona_que_cobro' => new PersonaResource($this->persona_que_cobro),
            'firma_de_origen_id' => new FirmaResource($this->firma_de_origen_id),
            'cuenta_de_destino' => new CuentaResource($this->cuenta_de_destino),
            'fecha_de_entrega_a_cuenta_destino' => date( "d/m/Y", strtotime($this->fecha_de_entrega_a_cuenta_destino)),
            'fecha_de_entrega_a_cuenta_destino_f' => date( "Y-m-d", strtotime($this->fecha_de_entrega_a_cuenta_destino)),
            'persona_que_recibe_en_cuenta_destino' => new PersonaResource($this->persona_que_recibe_en_cuenta_destino),
            'tipo_de_cobro' => new Tipo_de_cobroResource($this->tipo_de_cobro),
            'importe' => $this->importe,
            'deposito_de_cobro' => new DepositoResource($this->deposito_de_cobro),
            'cheque' => new ChequeResource($this->cheque),
            'deposito_de_destino' => new DepositoResource($this->deposito_de_destino),
            'observaciones' => $this->observaciones,
            'facturas' => $this->factura_de_cobro,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
