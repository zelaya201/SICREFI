<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

    protected $table = 'bien'; // Nombre de la tabla en la base de datos.

    public function cliente() {
      return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
