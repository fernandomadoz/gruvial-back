<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Remito_de_facturaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);

    }
}
