<?php

namespace App\Models;

use App\Models\status;
use App\Models\sparepart;
use App\Models\warehouse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class waiting extends Model
{
    use HasFactory;

    public function sklad(){
        return $this->belongsTo(warehouse::class);
    }
    public function sapkod(){
        return $this->belongsTo(sparepart::class);
    }
    public function status(){
        return $this->belongsTo(status::class);
    }

}
