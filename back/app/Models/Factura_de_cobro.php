<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura_de_cobro extends Model
{
    use HasFactory;

    public function cobro()
    {
        return $this->belongsTo('App\Models\Cobro');
    }

    public function factura()
    {
        return $this->belongsTo('App\Models\Factura');
    }

    protected $table = 'facturas_de_cobros';
}
