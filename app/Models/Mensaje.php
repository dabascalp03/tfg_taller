<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    // Definimos los campos que pueden ser asignados masivamente
    protected $fillable = ['emisor_id', 'receptor_id', 'mensaje', 'leido'];

    // Relación con el emisor
    public function emisor()
    {
        return $this->belongsTo(User::class, 'emisor_id', 'id');
    }
    
    public function receptor()
    {
        return $this->belongsTo(User::class, 'receptor_id', 'id');
    }
    
}

