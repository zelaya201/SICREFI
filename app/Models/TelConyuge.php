<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelConyuge extends Model
{
    use HasFactory;

    public function conyuge() {
      return $this->belongsTo(Conyuge::class, 'id_conyuge');
    }
}
