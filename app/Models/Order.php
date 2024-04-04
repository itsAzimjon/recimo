<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
        
    protected $fillable = [
        'user_id',
        'category_id',
        'weight',
        'price',
        'area',
        'address',
        'status',
        'edited_by',
        'attachment'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function statuses(){
        return $this->hasMany(Status::class);
    }
}
