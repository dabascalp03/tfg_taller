<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'facturas'; // Asegura que Laravel usa la tabla correcta

    protected $fillable = ['id_coche', 'id_reparacion', 'monto', 'fecha'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id_coche');
    }

    public function repair()
    {
        return $this->belongsTo(Repair::class, 'id_reparacion');
    }
    public $timestamps = false; // Esto evita que Laravel intente insertar las fechas

}


