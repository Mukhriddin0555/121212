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

    protected $fillable = array('crm_id', 'data', 'sap_kod', 'how', 'warehouse_id', 'status_id', 'order');

    public function sklad(){
        return $this->belongsTo(warehouse::class, 'warehouse_id', 'id');
    }
    public function sapkod(){
        return $this->belongsTo(sparepart::class, 'sparepart_id', 'id');
    }
    public function status(){
        return $this->belongsTo(status::class);
    }
    

}
