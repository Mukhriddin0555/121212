<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;

    public function resseption(){
        return $this->hasMany(User::class);
    }
    public function userall(){
        return $this->hasMany(User::class);
    }
}
