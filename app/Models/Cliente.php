<?php

namespace App\Models;

use App\Http\Controllers\NegocioController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $primaryKey = 'id_cliente';

    protected $fillable = [
      'dui_cliente',
      'primer_nom_cliente',
      'segundo_nom_cliente',
      'tercer_nom_cliente',
      'primer_ape_cliente',
      'segundo_ape_cliente',
      'fech_nac_cliente',
      'dir_cliente',
      'email_cliente',
      'estado_civil_cliente',
      'tipo_vivienda_cliente',
      'ocupacion_cliente',
      'gasto_aliment_cliente',
      'gasto_agua_cliente',
      'gasto_luz_cliente',
      'gasto_cable_cliente',
      'gasto_vivienda_cliente',
      'gasto_otro_cliente',
      'estado_cliente'
    ];

    public static $rules = [
      'dui_cliente' => 'required|unique:cliente|numeric|digits:9',
      'primer_nom_cliente' => 'required|min:2|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
      'segundo_nom_cliente' => 'nullable|min:2|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
      'tercer_nom_cliente' => 'nullable|min:2|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
      'primer_ape_cliente' => 'required|min:2|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
      'segundo_ape_cliente' => 'nullable|min:2|max:50|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
      'fech_nac_cliente' => 'required|date|before_or_equal: 18 years ago',
      'ocupacion_cliente' => 'required|min:3',
      'tipo_vivienda_cliente' => 'required|min:3',
      'dir_cliente' => 'required',
      'gasto_aliment_cliente' => 'required|numeric|min:0',
      'gasto_agua_cliente' => 'required|numeric|min:0',
      'gasto_luz_cliente' => 'required|numeric|min:0',
      'gasto_cable_cliente' => 'required|numeric|min:0',
      'gasto_vivienda_cliente' => 'required|numeric|min:0',
      'gasto_otro_cliente' => 'required|numeric|min:0',
      'email_cliente' => 'required|unique:cliente|email',
      'estado_civil_cliente' => 'required'
    ];

    public static $messages = [
      'fech_nac_cliente.before_or_equal' => 'El cliente debe ser mayor de edad.',
    ];

    public function creditos(){
      return $this->hasMany(Credito::class, 'id_cliente');
    }

    public function bienes(){
      return $this->hasMany(Bien::class, 'id_cliente');
    }

    public function conyuge() {
      return $this->hasOne(Conyuge::class, 'id_cliente');
    }

    public function negocios() {
      return $this->hasMany(Negocio::class, 'id_cliente');
    }

    public function referencias() {
      return $this->hasMany(Referencia::class, 'id_cliente');
    }

    public function telefonos() {
      return $this->hasMany(TelCliente::class, 'id_cliente');
    }
}
