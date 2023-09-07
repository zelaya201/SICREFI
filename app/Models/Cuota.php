<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    use HasFactory;

    public function credito(){
      return $this->belongsTo(Credito::class, 'id_credito');
    }
}
