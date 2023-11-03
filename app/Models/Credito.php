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
      'tasa_interes_credito' => 'required|decimal:0,4|between:0,100',
      'monto_neto_credito' => 'required|decimal:0,2',
      'n_cuotas_credito' => 'required|integer|min:2|max:100',
      'frecuencia_credito' => 'required',
      'tipo_credito' => 'required',
      'id_cliente' => 'required',
      'bienes' => 'required',
      'referencias' => 'required',
      'fech_primer_cuota' => 'required|date|after:today',
    ];

    public static $messages = [
      'desembolso_credito.required' => 'El desembolso del crédito es requerido',
      'tasa_interes_credito.required' => 'La tasa de interés del crédito es requerida',
      'tasa_interes_credito.decimal' => 'La tasa de interés del crédito debe ser decimal (0,4)',
      'tasa_interes_credito.between' => 'La tasa de interés del crédito debe estar entre 0 y 100',
      'monto_neto_credito.required' => 'El monto del crédito es requerido',
      'n_cuotas_credito.required' => 'El número de cuotas del crédito es requerido',
      'n_cuotas_credito.integer' => 'El número de cuotas del crédito debe ser entero',
      'n_cuotas_credito.min' => 'El número de cuotas del crédito debe ser mayor a 1',
      'n_cuotas_credito.max' => 'El número de cuotas del crédito debe ser menor a 100',
      'frecuencia_credito.required' => 'La frecuencia del crédito es requerida',
      'tipo_credito.required' => 'El tipo de crédito es requerido',
      'id_cliente.required' => 'El cliente es requerido',
      'bienes.required' => 'Los bienes son requeridos',
      'referencias.required' => 'Las referencias son requeridas',
      'fech_primer_cuota.required' => 'La fecha de la primera cuota es requerida',
      'fech_primer_cuota.date' => 'La fecha de la primera cuota debe ser una fecha',
      'fech_primer_cuota.after' => 'La fecha de la primera cuota debe ser posterior a la fecha actual',
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
