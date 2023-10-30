<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'realname',
        'nickname',
        'email',
        'phone',
        'username',
        'password',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_admin',
        'is_approved',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function students(){
        return $this->hasMany(Student::class,'user_id','id');
    }

    public function staff(){
        return $this->hasMany(Staff::class,'user_id','id');
    }

    public function sponsor(){
        return $this->hasMany(Sponsor::class,'user_id','id');
    }

    public function alumni(){
        return $this->hasMany(Alumni::class,'user_id','id');
    }

}
