<?php

namespace App\Imports;

use App\Models\sparepart;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class SpareImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        if($row[0] != null && $row[1] != null ){
            $a = new sparepart();
            $a->sap_kod = $row[0];
            $a->name = $row[1];
            $a->save();
        }
        //dd($row[0]);
    }
}
