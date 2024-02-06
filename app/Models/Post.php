<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function sub_category(){
        return $this->belongsTo(Categories::class, 'sub_category_id');
    }
    public function district(){
        return $this->belongsTo(Districts::class, 'district_id');
    }
    public function sub_district(){
        return $this->belongsTo(Subdistricts::class, 'sub_district_id');
    }
}
