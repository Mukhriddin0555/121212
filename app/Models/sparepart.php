<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sparepart extends Model
{
    use HasFactory;

    protected $fillable = array('sap_kod', 'name');
    public $timestamps = false;
}
