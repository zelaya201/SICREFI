<?php

namespace App\Models;

use App\Http\Controllers\NegocioController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';

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
