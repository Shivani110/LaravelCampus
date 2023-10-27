<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeTemplate extends Model
{
    use HasFactory;

    public function colleges(){
        return $this->hasOne(CollegeName::class,'id','clg_id');
    }

}
