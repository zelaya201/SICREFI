<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';

    protected $primaryKey = 'id_usuario';

    protected $fillable = [
      'id_rol',
      'nom_usuario',
      'ape_usuario',
      'email_usuario',
      'nick_usuario',
    ];

    public static $rules = [
      'nom_usuario' => 'required',
      'ape_usuario' => 'required',
      'nick_usuario' => 'required|unique:usuario',
      'email_usuario' => 'required|email|unique:usuario',
      'id_rol' => 'required|exists:rol,id_rol',
    ];

    public static $messages = [
      'nom_usuario.required' => 'El nombre es requerido',
      'ape_usuario.required' => 'El apellido es requerido',
      'nick_usuario.required' => 'El usuario es requerido',
      'email_usuario.required' => 'El email es requerido',
      'id_rol.required' => 'El rol es requerido',
      'nick_usuario.unique' => 'El usuario ya existe',
      'email_usuario.unique' => 'El email ya existe',
      'id_rol.exists' => 'Seleccione un rol',
    ];

    public function rol() {
      return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function bitacoras() {
      return $this->hasMany(Bitacora::class, 'id_usuario');
    }
}
