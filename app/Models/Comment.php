<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasOne(User::class,'id','user_id');
    }
    
    public function reply(){
        return $this->hasMany(Comment::class,'reply_id','id')->where('comment_type','reply');
    }
}
