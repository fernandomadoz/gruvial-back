<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;

    public function cuenta_de_origen()
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_de_origen_id');
    }

    public function cuenta_de_destino()
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_de_destino_id');
    }

    public function cheque()
    {
        return $this->belongsTo('App\Models\Cheque');
    }

    public function persona_que_deposito()
    {
        return $this->belongsTo('App\Models\Persona', 'persona_que_deposito_id');
    }

    public function empresa_cliente_que_deposito()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_cliente_que_deposito_id');
    }

}
