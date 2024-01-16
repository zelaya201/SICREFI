<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleAcceso extends Model
{
    use HasFactory;

    protected $table = 'detalle_acceso';

    protected $primaryKey = 'id_detalle_acceso';

    public function opcion() {
      return $this->belongsTo(OpcionAcceso::class, 'id_opcion_acceso');
    }
}
