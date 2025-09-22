<?php

// app/Models/Vehicle.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
use App\Models\Repair;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'coches';
    public $timestamps = false;

    protected $fillable = ['id_usuario', 'marca', 'modelo', 'anio', 'matricula'];

    public function reparaciones()
    {
        return $this->hasMany(Repair::class, 'id_coche'); // Relación correcta
    }

    public function facturas()
    {
        return $this->hasMany(Invoice::class, 'id_coche');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }
}


