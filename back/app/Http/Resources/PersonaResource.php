<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $detalle_select = $this->nombre.' '.$this->apellido;

        return [
            'id' => $this->id,
            'detalle_select' => $detalle_select,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'nro_de_documento' => $this->nro_de_documento,
            'celular' => $this->celular,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
