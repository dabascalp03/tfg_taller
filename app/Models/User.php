<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios'; // Especificamos la tabla correcta

    protected $fillable = [
        'nombre', 'email', 'username', 'password', 'id_rol', 
    ];

    protected $hidden = [
        'password',
    ];

    // Relación con los roles (Un usuario pertenece a un rol)
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_rol');
    }


    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'id_usuario', 'id');
    }

    public function restauracion()
    {
        return $this->belongsTo(Restauracion::class, 'id_usuario');
    }

    public function likes()
{
    return $this->hasMany(Like::class);
}

public function mensajesEnviados()
{
    return $this->hasMany(Mensaje::class, 'emisor_id');
}

public function mensajesRecibidos()
{
    return $this->hasMany(Mensaje::class, 'receptor_id');
}

public function citas()
{
    return $this->hasMany(Cita::class, 'usuario_id');
}
public function diagnosticos()
{
    return $this->hasMany(Diagnostico::class);
}


}

