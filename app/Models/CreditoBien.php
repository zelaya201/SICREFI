<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditoBien extends Model
{
    use HasFactory;

    public function credito() {
      return $this->belongsTo(Credito::class, 'id_credito');
    }

    public function bien() {
      return $this->belongsTo(Bien::class, 'id_bien');
    }
}
