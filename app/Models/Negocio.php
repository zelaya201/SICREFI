<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    use HasFactory;

    protected $table = 'negocio'; // Nombre de la tabla en la base de datos.

    protected $primaryKey = 'id_negocio'; // Nombre de la llave primaria en la tabla.

    protected $fillable = [
      'id_cliente',
      'nom_negocio',
      'tiempo_negocio',
      'dir_negocio',
      'buena_venta_negocio',
      'mala_venta_negocio',
      'ganancia_diaria_negocio',
      'inversion_diaria_negocio',
      'gasto_emp_negocio',
      'gasto_alquiler_negocio',
      'gasto_impuesto_negocio',
      'gasto_otro_negocio',
      'gasto_credito_negocio',
      'id_cliente'
    ];

    public function telefonos() {
      return $this->hasMany(TelNegocio::class, 'id_negocio');
    }

    public function cliente() {
      return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
