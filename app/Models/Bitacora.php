<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    protected $table = 'bitacora';

    protected $primary_key = 'id_bitacora';

    protected $fillable = [
      'fecha_operacion_bitacora',
      'tabla_operacion_bitacora',
      'operacion_bitacora',
      'id_usuario'
    ];

    public function usuario() {
      return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
