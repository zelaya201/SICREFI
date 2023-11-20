<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';

    protected $primaryKey = 'id_usuario';

    public function rol() {
      return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function bitacoras() {
      return $this->hasMany(Bitacora::class, 'id_usuario');
    }
}
