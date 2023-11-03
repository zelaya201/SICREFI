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
      'n_cuotas_credito',
      'frecuencia_credito',
      'tipo_credito',
      'estado_credito',
      'id_negocio',
      'id_cliente',
      'id_coop'
    ];

    public static $rules = [
      'desembolso_credito' => 'required',
      'tasa_interes_credito' => 'required',
      'monto_neto_credito' => 'required',
      'n_cuotas_credito' => 'required',
      'frecuencia_credito' => 'required',
      'tipo_credito' => 'required',
      'id_negocio' => 'required',
      'id_cliente' => 'required',
      'bienes' => 'required',
      'referencias' => 'required',
      'fech_primer_cuota' => 'required'
    ];

    public static $messages = [
      'desembolso_credito.required' => 'El desembolso del crédito es requerido',
      'tasa_interes_credito.required' => 'La tasa de interés del crédito es requerida',
      'monto_neto_credito.required' => 'El monto del crédito es requerido',
      'n_cuotas_credito.required' => 'El número de cuotas del crédito es requerido',
      'frecuencia_credito.required' => 'La frecuencia del crédito es requerida',
      'tipo_credito.required' => 'El tipo de crédito es requerido',
      'id_negocio.required' => 'El negocio es requerido',
      'id_cliente.required' => 'El cliente es requerido',
      'bienes.required' => 'Los bienes son requeridos',
      'referencias.required' => 'Las referencias son requeridas',
      'fech_primer_cuota.required' => 'La fecha de la primera cuota es requerida'
    ];

    public function cliente() {
      return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function cooperativa() {
      return $this->belongsTo(Cooperativa::class, 'id_coop');
    }

    public function negocio(){
      return $this->belongsTo(Negocio::class, 'id_negocio');
    }
}
