<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeName extends Model
{
    use HasFactory;
    
    public function posts(){
        return $this->hasMany(Post::class,'clg_id','id');
    } 

}
