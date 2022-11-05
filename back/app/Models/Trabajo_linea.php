<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo_linea extends Model
{
    use HasFactory;

    public function trabajo_encabezado()
    {
        return $this->belongsTo('App\Models\Trabajo_encabezado');
    }

    public function maquina()
    {
        return $this->belongsTo('App\Models\Maquina');
    }

    public function tipo_de_trabajo()
    {
        return $this->belongsTo('App\Models\Tipo_de_trabajo');
    }

    public function unidad_de_trabajo()
    {
        return $this->belongsTo('App\Models\Unidad_de_trabajo');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    protected $table = 'trabajos_lineas';

}
