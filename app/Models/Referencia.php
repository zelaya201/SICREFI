<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    use HasFactory;

    protected $table = 'referencia';
    protected $primaryKey = 'id_ref';

    protected $fillable = [
      'id_cliente',
      'primer_nom_ref',
      'segundo_nom_ref',
      'tercer_nom_ref',
      'primer_ape_ref',
      'segundo_ape_ref',
      'dir_ref',
      'ocupacion_ref',
      'parentesco_ref',
      'estado_ref'
    ];

    public function cliente() {
      return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function telefonos() {
      return $this->hasMany(TelReferencia::class, 'id_ref');
    }
}
