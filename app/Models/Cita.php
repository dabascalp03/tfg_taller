<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    // Especificamos la tabla en caso de que sea distinta del nombre del modelo en plural
    protected $table = 'citas';

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'usuario_id',
        'fecha',
        'hora',
        'servicio',
    ];

    /**
     * Relación con el modelo Usuario
     * Cada cita pertenece a un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public $timestamps = false; // Si tu tabla no usa `created_at` y `updated_at`

}
