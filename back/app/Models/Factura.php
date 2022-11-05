<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    public function trabajo_encabezado()
    {
        return $this->belongsTo('App\Models\Trabajo_encabezado');
    }

    public function razon_social()
    {
        return $this->belongsTo('App\Models\Razon_social');
    }

    public function tipo_de_factura()
    {
        return $this->belongsTo('App\Models\Tipo_de_factura');
    }

    public function remito_de_factura()
    {
        return $this->hasMany(Remito_de_factura::class);
    }

}
