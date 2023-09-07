<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelNegocio extends Model
{
    use HasFactory;

    public function negocio() {
      return $this->belongsTo(Negocio::class, 'id_negocio');
    }
}
