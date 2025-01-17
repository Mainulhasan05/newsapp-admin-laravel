<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    public function parent_id()
    {
        return $this->belongsTo(Categories::class, 'parent_id');
    }
}
