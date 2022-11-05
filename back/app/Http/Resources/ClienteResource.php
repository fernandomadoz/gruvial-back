<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->es_consumidor_final == 'SI') {
            $detalle_select = $this->nombre_o_razon_social.' '.$this->direccion;
            if ($this->barrio_id > 0) {
                $detalle_select .= ' '.$this->barrio->barrio;
            }
        }
        else {
            $detalle_select = $this->nombre_o_razon_social;
        }
        return [
            'id' => $this->id,
            'detalle_select' => $detalle_select,
            'nombre_o_razon_social' => $this->nombre_o_razon_social,
            'CUIT_o_CUIL' => $this->CUIT_o_CUIL,
            'telefonos' => $this->telefonos,
            'direccion' => $this->direccion,
            'email' => $this->email,
            'web' => $this->web,
            'observaciones' => $this->observaciones,
            'es_consumidor_final' => $this->es_consumidor_final,
            'barrio_id' => new BarrioResource($this->barrio),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at

        ];
    }
}
