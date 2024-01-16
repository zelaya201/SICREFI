<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionAcceso extends Model
{
    use HasFactory;

    protected $table = 'opcion_acceso';

    protected $primaryKey = 'id_opcion_acceso';

    public function rol() {
      return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function detalles() {
      return $this->hasMany(DetalleAcceso::class, 'id_opcion_acceso');
    }
}
