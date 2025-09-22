<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla (opcional si sigue las convenciones)
    protected $table = 'blog_posts';

    // Los campos que pueden ser asignados masivamente
    protected $fillable = ['title', 'content', 'author_name', 'image_path'];
}
