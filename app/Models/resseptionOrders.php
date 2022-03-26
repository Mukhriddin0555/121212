<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class resseptionOrders extends Model
{
    use HasFactory;

    public function status(){
        return $this->belongsTo(status::class);
    }
    public function sapkod(){
        return $this->belongsTo(sparepart::class, 'sparepart_id', 'id');
    }
    
}
