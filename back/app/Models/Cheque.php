<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    use HasFactory;


    public function banco()
    {
        return $this->belongsTo('App\Models\Banco');
    }

    public function cuenta_emisora()
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_emisora_id');
    }

    public function persona_que_cobro()
    {
        return $this->belongsTo('App\Models\Persona', 'persona_que_cobro_id');
    }

    public function causa_de_baja_de_cheque()
    {
        return $this->belongsTo('App\Models\Causa_de_baja_de_cheque');
    }

    public function cuenta_destino()
    {
        return $this->belongsTo('App\Models\Cuenta', 'cuenta_destino_id');
    }

    public function persona_que_recibe_en_cuenta_destino()
    {
        return $this->belongsTo('App\Models\Persona', 'persona_que_recibe_en_cuenta_destino_id');
    }

}
