<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudVehiculo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'marca', 'modelo', 'anio', 'placa', 'estado'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
