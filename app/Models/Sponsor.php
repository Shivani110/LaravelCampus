<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    public function sponsor(){
        return $this->hasMany(User::class,'id','user_id');
    }
}
