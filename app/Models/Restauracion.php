<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restauracion extends Model
{
    use HasFactory;

    protected $table = 'restauraciones';

    protected $fillable = [
        'id_cliente', 'titulo', 'descripcion', 'imagen_antes', 'imagen_despues', 'estado'
    ];
    
    public function cliente() {
        return $this->belongsTo(User::class, 'id_cliente');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    
}

