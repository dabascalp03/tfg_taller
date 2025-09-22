<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category', 'image'];

    public function options()
    {
        return $this->belongsToMany(ServiceOption::class, 'service_option_service', 'service_id', 'service_option_id');
    }
}

