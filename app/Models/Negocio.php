<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;

    public function telefonos() {
      return $this->hasMany(TelNegocio::class, 'id_negocio');
    }

    public function cliente() {
      return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
