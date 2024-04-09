<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'type_id',
        'import',
        'export',
        'card',
        'token',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function types(){
        return $this->hasMany(Type::class);
    }
}
