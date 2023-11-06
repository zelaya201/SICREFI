<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelConyuge extends Model
{
    use HasFactory;

    protected $table = 'tel_conyuge'; // Nombre de la tabla en la base de datos.

    protected $primaryKey = 'id_conyuge';

    public function conyuge() {
      return $this->belongsTo(Conyuge::class, 'id_conyuge');
    }
}
