<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelReferencia extends Model
{
    use HasFactory;

    protected $table = 'tel_referencia'; // Nombre de la tabla en la base de datos.
  
    public function referencia() {
      return $this->belongsTo(Referencia::class, 'id_ref');
    }
}
