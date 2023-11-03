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
