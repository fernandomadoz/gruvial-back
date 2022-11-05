<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    use HasFactory;

    public function trabajo_encabezado()
    {
        return $this->belongsTo('App\Models\Trabajo_encabezado');
    }

    public function persona_que_cobro()
    {
        return $this->belongsTo('App\Models\Persona', 'persona_que_cobro_id');
    }

    public function firma_de_origen()
    {
        return $this->belongsTo('App\Models\Firma', 'firma_de_origen_id');
    }

    public function cuenta_de_destino()
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_de_destino_id');
    }

    public function persona_que_recibe_en_cuenta_destino()
    {
        return $this->belongsTo('App\Models\Persona', 'persona_que_recibe_en_cuenta_destino_id');
    }

    public function tipo_de_cobro()
    {
        return $this->belongsTo('App\Models\Tipo_de_cobro');
    }

    public function deposito_de_cobro()
    {
        return $this->belongsTo('App\Models\Deposito', 'deposito_de_cobro_id');
    }

    public function cheque()
    {
        return $this->belongsTo('App\Models\Cheque');
    }

    public function deposito_de_destino()
    {
        return $this->belongsTo('App\Models\Deposito', 'deposito_de_destino_id');
    }

    public function factura_de_cobro()
    {
        return $this->hasMany(Factura_de_cobro::class);
    }

}
