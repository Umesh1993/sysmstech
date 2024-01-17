<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categories;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product';

    public function category(){
        return $this->hasOne(Categories::class,'id','category_id');
    }
}
