<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    protected $table = 'ofertas';
    protected $fillable = ['titulo', 'descripcion', 'imagen', 'fecha_expedicion'];
    protected $casts = [
        'fecha_expedicion' => 'date',
    ];
    public $timestamps = false;
}
