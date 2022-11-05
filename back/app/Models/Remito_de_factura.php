<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remito_de_factura extends Model
{
    use HasFactory;

    public function factura()
    {
        return $this->belongsTo('App\Models\Factura');
    }

    public function trabajo_linea()
    {
        return $this->belongsTo('App\Models\Trabajo_linea');
    }

    protected $table = 'remitos_de_facturas';
}
