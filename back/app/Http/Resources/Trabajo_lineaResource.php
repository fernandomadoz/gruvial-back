<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Trabajo_lineaResource extends JsonResource
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
            'trabajo_encabezado' => new Trabajo_encabezadoResource($this->trabajo_encabezado),
            'maquina' => new MaquinaResource($this->maquina),
            'lugar_de_trabajo' => $this->lugar_de_trabajo,
            'fecha_inicio' => date( "d/m/Y", strtotime($this->fecha_inicio)),
            'fecha_inicio_f' => date( "Y-m-d", strtotime($this->fecha_inicio)),
            'fecha_fin' => date( "d/m/Y", strtotime($this->fecha_fin)),
            'fecha_fin_f' => date( "Y-m-d", strtotime($this->fecha_fin)),
            'tipo_de_trabajo' => new Tipo_de_trabajoResource($this->tipo_de_trabajo),
            'unidad_de_trabajo' => new Unidad_de_trabajoResource($this->unidad_de_trabajo),
            'cantidad_unidades_trabajo' => $this->cantidad_unidades_trabajo,
            'importe' => $this->importe,
            'nro_de_remito' => $this->nro_de_remito,
            'persona_que_autoriza' => $this->persona_que_autoriza,
            'persona_que_supervisa' => $this->persona_que_supervisa,
            'observaciones' => $this->observaciones,
            'trabajo_realizado' => $this->trabajo_realizado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->user),

        ];
    }
}
