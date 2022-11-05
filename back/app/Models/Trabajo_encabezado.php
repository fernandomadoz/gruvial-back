<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo_encabezado extends Model
{
    use HasFactory;

    protected $guarded = ['id'];    

    public function firma()
    {
        return $this->belongsTo('App\Models\Firma');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function factura()
    {
        return $this->hasMany(Factura::class);
    }

    protected $table = 'trabajos_encabezados';


}
