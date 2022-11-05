<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    public function firma()
    {
        return $this->belongsTo('App\Models\Firma');
    }

    public function banco()
    {
        return $this->belongsTo('App\Models\Banco');
    }
}
