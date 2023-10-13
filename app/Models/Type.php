<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
        
    protected $fillable = [
        'category_id',
        'name',
        'price'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function bases(){
        return $this->hasMany(Base::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
