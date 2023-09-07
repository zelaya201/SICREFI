<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    use HasFactory;

    public function cliente() {
      return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function telefonos() {
      return $this->hasMany(TelReferencia::class, 'id_ref');
    }
}
