<?php

namespace App\Models;

use App\Models\answaer;
use App\Models\sparepart;
use App\Models\warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transfer extends Model
{
    public $with = ['sparepart', 'fromTransfer', 'toTransfer', 'allanswaer'];

    use HasFactory;

    public function fromTransfer(){
        return $this->hasOne(warehouse::class, 'id', 'from_user_id');
    }
    public function toTransfer(){
        return $this->hasOne(warehouse::class, 'id', 'to_user_id');
    }
    public function sparepart(){
        return $this->hasOne(sparepart::class, 'id', 'sparepart_id');
    }
    public function allanswaer(){
        return $this->hasOne(answaer::class, 'id', 'answer_id');
    }
}
