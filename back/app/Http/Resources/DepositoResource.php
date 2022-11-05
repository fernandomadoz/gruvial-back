<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepositoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //$detalle_select = 'Nro: '.$this->cuenta_de_destino->numero_de_cuenta;
        $detalle_select = 'Bco: '.$this->banco_id;
        //$detalle_select .= ' '.$this->user->name.' ';
        $detalle_select .= ' $'.$this->monto_de_deposito;

        return [
            'id' => $this->id,
            'detalle_select' => $detalle_select,
            'fecha_de_deposito' => date( "d/m/Y", strtotime($this->fecha_de_deposito)),
            'fecha_de_deposito_f' => date( "Y-m-d", strtotime($this->fecha_de_deposito)),
            'cuenta_de_origen' => new CuentaResource($this->cuenta_de_origen),
            'cuenta_de_destino' => new CuentaResource($this->cuenta_de_destino),
            'monto_de_deposito' => $this->monto_de_deposito,
            'persona_que_deposito' => new PersonaResource($this->persona_que_deposito),
            'empresa_cliente_que_deposito' => new EmpresaResource($this->empresa_cliente_que_deposito),
            'cheque' => new ChequeResource($this->cheque),
            'observaciones' => $this->observaciones,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
