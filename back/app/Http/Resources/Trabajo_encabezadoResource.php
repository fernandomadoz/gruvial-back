<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Trabajo_encabezadoResource extends JsonResource
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
            'cliente' => new ClienteResource($this->cliente),
            'firma' => new FirmaResource($this->firma),
            'fecha_inicio' => date( "d/m/Y", strtotime($this->fecha_inicio)),
            'fecha_inicio_f' => date( "Y-m-d", strtotime($this->fecha_inicio)),
            'fecha_fin' => date( "d/m/Y", strtotime($this->fecha_fin)),
            'fecha_de_cancelacion' => date( "d/m/Y", strtotime($this->fecha_de_cancelacion)),
            'user' => new UserResource($this->user),
            'observaciones' => $this->observaciones,
            'observaciones_de_cancelacion' => $this->observaciones_de_cancelacion,

        ];

    }
}
