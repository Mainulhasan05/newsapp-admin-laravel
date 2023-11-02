<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'description',
        // 'image',
        // 'views',
        // 'og_image',
        // 'og_title',
        // 'og_description',
        'slug',
    ];
}
