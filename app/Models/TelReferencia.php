<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelReferencia extends Model
{
    use HasFactory;

    protected $table = 'tel_referencia'; // Nombre de la tabla en la base de datos.

  protected $primaryKey = 'id_tel_ref'; // Nombre de la llave primaria en la tabla.

  protected $fillable = [
    'id_tel_ref',
    'tel_ref'
  ];

    public function referencia() {
      return $this->belongsTo(Referencia::class, 'id_ref');
    }
}
