<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CuentaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $detalle_select = $this->numero_de_cuenta;
        $detalle_select .= ' ('.$this->banco->nombre_del_banco.') ';
        $detalle_select .= ' '.$this->firma->firma;
        return [
            'id' => $this->id,
            //'cliente' => ClienteResource::collection($this->whenLoaded('nombre_o_razon_social'))
            'detalle_select' => $detalle_select,
            'numero_de_cuenta' => $this->numero_de_cuenta,
            'banco' => new BancoResource($this->banco),
            'firma' => new FirmaResource($this->firma),
            'titular_de_la_cuenta' => $this->titular_de_la_cuenta,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at

        ];
    }
}
