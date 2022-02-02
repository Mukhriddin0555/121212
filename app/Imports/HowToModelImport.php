<?php

namespace App\Imports;

use App\Models\HowToModel;
use Maatwebsite\Excel\Concerns\ToModel;

class HowToModelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0] != null && $row[1] != null && $row[2] != null && $row[3] != null ){
            $a = new HowToModel();
            $a->zavod_sn = $row[0];
            $a->material = $row[1];
            $a->description = $row[2];
            $a->color = $row[3];
            $a->save();
        }
    }
}
