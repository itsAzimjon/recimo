<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name', 
        'photo',
        'role_id',
        'area_id',
        'address',
        'passport',
        'inn',
        'prize',
        'active',
        'commission',
        'phone_number',
        'password',
        'remember_token',
    ];

    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function bases(){
        return $this->hasMany(Base::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    
    public function contact_us(){
        return $this->hasMany(Order::class);
    }

    public function wallet(){
        return $this->hasOne(Wallet::class);
    }
    
    public function types(){
        return $this->belongsToMany(Type::class);
    }

    public function area(){
        return $this->belongsTo(Area::class);
    }    
}
