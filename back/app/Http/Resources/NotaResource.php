<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotaResource extends JsonResource
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
            'nota' => $this->nota,
            'created_at' => date( "d/m/Y", strtotime($this->created_at))
        ];
    }
}
