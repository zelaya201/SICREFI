<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $table = 'credito';

    protected $primaryKey = 'id_credito';

    protected $fillable = [
      'monto_credito',
      'desembolso_credito',
      'fecha_emision_credito',
      'fecha_vencimiento_credito',
      'tasa_interes_credito',
      'monto_neto_credito',
      'monto_cuota_credito',
      'n_cuotas_credito',
      'frecuencia_credito',
      'tipo_credito',
      'estado_credito',
      'id_cliente',
      'id_coop'
    ];

    public function cliente() {
      return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function cooperativa() {
      return $this->belongsTo(Cooperativa::class, 'id_coop');
    }
}
