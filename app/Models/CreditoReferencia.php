<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditoReferencia extends Model
{
    use HasFactory;

    protected $table = 'credito_referencia';

    public function credito() {
      return $this->belongsTo(Credito::class, 'id_credito');
    }

    public function referencia() {
      return $this->belongsTo(Referencia::class, 'id_ref');
    }
}
