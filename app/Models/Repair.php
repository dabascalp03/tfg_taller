<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
use Carbon\Carbon;

class Repair extends Model
{
    use HasFactory;

    protected $table = 'reparaciones'; // Nombre correcto de la tabla en la BBDD

    protected $fillable = [
        'id_coche',
        'id_mecanico',
        'descripcion',
        'fecha',
        'estado'
    ];

    // Relación con el modelo Vehicle
    public function vehicle()
{
    return $this->belongsTo(Vehicle::class, 'id_coche'); // Clave foránea correcta
}
public function coche()
{
    return $this->belongsTo(Vehicle::class, 'id_coche', 'id'); 
}


public $timestamps = false; // Desactiva timestamps

    public function getFechaFormateadaAttribute()
{
    return Carbon::parse($this->fecha)
        ->locale('es')
        ->translatedFormat('l d \d\e F \d\e Y'); 
}
protected $appends = ['fecha_formateada'];



public function user()
{
    return $this->belongsTo(User::class);
}

}


