<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conyuge extends Model
{
  use HasFactory;

  protected $table = 'conyuge';

  protected $primaryKey = 'id_conyuge';

  protected $fillable = [
    'primer_nom_conyuge',
    'segundo_nom_conyuge',
    'tercer_nom_conyuge',
    'primer_ape_conyuge',
    'segundo_ape_conyuge',
    'dir_conyuge',
    'ocupacion_conyuge',
    'id_cliente',
  ];

  public static $rules = [
    'primer_nom_conyuge' => 'required',
    'primer_ape_conyuge' => 'required',
    'dir_conyuge' => 'required',
    'ocupacion_conyuge' => 'required',
  ];

  public static $messages = [
    'primer_nom_conyuge.required' => 'El primer nombre del conyuge es requerido',
    'primer_ape_conyuge.required' => 'El primer apellido del conyuge es requerido',
    'dir_conyuge.required' => 'La dirección del conyuge es requerida',
    'ocupacion_conyuge.required' => 'La ocupación del conyuge es requerida',
  ];

    public function cliente()
    {
      return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
