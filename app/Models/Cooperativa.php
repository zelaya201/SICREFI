<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooperativa extends Model
{
    use HasFactory;

    protected $table = 'cooperativa';

    protected $primaryKey = 'id_coop';

    protected $fillable = [
      'nom_coop',
      'dir_coop',
      'tel_coop',
    ];

    public static $rules = [
      'nom_coop' => 'required|string',
      'dir_coop' => 'required|string|max:100',
      'tel_coop' => 'required|string|max:8',
    ];

    public static $messages = [
      'nom_coop.required' => 'El nombre de la cooperativa es requerido.',
      'nom_coop.string' => 'El nombre de la cooperativa debe ser una cadena de caracteres.',
      'nom_coop.max' => 'El nombre de la cooperativa debe contener como máximo 50 caracteres.',
      'dir_coop.required' => 'La dirección de la cooperativa es requerida.',
      'dir_coop.string' => 'La dirección de la cooperativa debe ser una cadena de caracteres.',
      'dir_coop.max' => 'La dirección de la cooperativa debe contener como máximo 100 caracteres.',
      'tel_coop.required' => 'El teléfono de la cooperativa es requerido.',
      'tel_coop.string' => 'El teléfono de la cooperativa debe ser una cadena de caracteres.',
      'tel_coop.max' => 'El teléfono de la cooperativa debe contener como máximo 10 caracteres.',
    ];

    public function creditos() {
      return $this->hasMany(Credito::class, 'id_coop');
    }
}
