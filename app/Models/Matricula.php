<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = ['id_usuario', 'tipo_matricula', 'numero_matricula'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
