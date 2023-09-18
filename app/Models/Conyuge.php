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
  ];

    public function cliente()
    {
      return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
