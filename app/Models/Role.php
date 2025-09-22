<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Nombre correcto de la tabla en la base de datos

    protected $fillable = ['nombre'];

    // Relación con los usuarios (Un rol tiene muchos usuarios)
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_rol');
    }
    
}

