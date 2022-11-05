<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    public function tipo_de_factura()
    {
        return $this->belongsTo('App\Models\Tipo_de_factura');
    }

    public function plan_de_cuenta()
    {
        return $this->belongsTo('App\Models\Plan_de_cuenta');
    }

    public function cuenta_de_origen()
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_de_origen_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
