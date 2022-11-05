<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChequeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $detalle_select = 'Nro: '.$this->numero_de_cheque;
        $detalle_select .= ' ('.$this->banco->nombre_del_banco.') ';
        $detalle_select .= ' $'.$this->importe;

        return [
            'id' => $this->id,
            'detalle_select' => $detalle_select,
            'cuenta_emisora' => new CuentaResource($this->cuenta_emisora),
            'numero_de_cheque' => $this->numero_de_cheque,
            'banco' => new BancoResource($this->banco),
            'importe' => $this->importe,
            'fecha_de_emision' => date( "d/m/Y", strtotime($this->fecha_de_emision)),
            'fecha_de_emision_f' => date( "Y-m-d", strtotime($this->fecha_de_emision)),
            'fecha_inicio_de_cobro' => date( "d/m/Y", strtotime($this->fecha_inicio_de_cobro)),
            'fecha_inicio_de_cobro_f' => date( "Y-m-d", strtotime($this->fecha_inicio_de_cobro)),
            'fecha_de_vencimiento' => date( "d/m/Y", strtotime($this->fecha_de_vencimiento)),
            'fecha_de_vencimiento_f' => date( "Y-m-d", strtotime($this->fecha_de_vencimiento)),
            'fecha_de_cobro' => date( "d/m/Y", strtotime($this->fecha_de_cobro)),
            'fecha_de_cobro_f' => date( "Y-m-d", strtotime($this->fecha_de_cobro)),
            'persona_que_cobro' => new PersonaResource($this->persona_que_cobro),
            'observaciones' => $this->observaciones,
            'causa_de_baja_de_cheque' => new Causa_de_baja_de_chequeResource($this->causa_de_baja_de_cheque),
            'cuenta_de_destino' => new CuentaResource($this->cuenta_de_destino),
            'fecha_de_entrega_a_cuenta_destino' => date( "d/m/Y", strtotime($this->fecha_de_entrega_a_cuenta_destino)),
            'fecha_de_entrega_a_cuenta_destino_f' => date( "Y-m-d", strtotime($this->fecha_de_entrega_a_cuenta_destino)),
            'persona_que_recibe_en_cuenta_destino' => new PersonaResource($this->persona_que_recibe_en_cuenta_destino),
            'es_consumidor_final' => $this->es_consumidor_final,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
