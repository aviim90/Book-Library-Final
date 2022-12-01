<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable=['name', 'description', 'ISBN','pages','category_id' ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopefilterByCategory($query, $categoryId){
        if($categoryId){
            return $query->where('category_id', $categoryId);
        }
        else{
            return $query;
        }

    }

    public function scopefindByName($query, $name){
        if($name){
            return $query->where('name','like', "%$name%");
        }
        else{
            return $query;
        }

    }

}
