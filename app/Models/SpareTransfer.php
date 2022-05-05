<?php

namespace App\Models;

use App\Models\sparepart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpareTransfer extends Model
{
    use HasFactory;

    public function sparepartname(){
        return $this->hasOne(sparepart::class, 'id', 'sparepart_id');
    }
}
