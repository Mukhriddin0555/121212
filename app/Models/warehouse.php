<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouse extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function managername()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function branchmanager()
    {
        return $this->belongsTo(User::class, 'branchmanager_id');
    }
}
