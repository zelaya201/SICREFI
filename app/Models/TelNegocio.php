<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelNegocio extends Model
{
    use HasFactory;

    protected $table = 'tel_negocio'; // Nombre de la tabla en la base de datos.
    protected $primaryKey = 'id_tel_negocio'; // Nombre de la llave primaria en la tabla.

    public function negocio() {
      return $this->belongsTo(Negocio::class, 'id_negocio');
    }
}
