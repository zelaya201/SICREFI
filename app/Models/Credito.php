<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    public function cliente() {
      return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function cooperativa() {
      return $this->belongsTo(Cooperativa::class, 'id_coop');
    }
}
