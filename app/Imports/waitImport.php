<?php

namespace App\Imports;

use App\Models\waiting;
use App\Models\sparepart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class waitImport implements ToModel
{
    public function findDate($crmid)
    {
        $year = 20 . substr($crmid, 4, 2);
        $month = substr($crmid, 2, 2);
        $day = substr($crmid, 0, 2);
        return $year . '-' . $month . '-' . $day;

    }
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {   
        if($row[0] != null && $row[1] != null && $row[2] != null && $row[3] != null){
            if($row[0] != 'id'){
                $user = Auth::User()->id;
                $sklad_id = DB::table('warehouses')
                ->where('user_id', $user)
                ->first();
                $sparepart_id = sparepart::firstOrCreate(['sap_kod' => $row[1]],['name' => 'Не найден']);
                $wait = new waiting();
                if(strlen($row[0]) == 12){
                $date = $this->findDate($row[0]);
                $crm_id = strval($row[0]);
                $wait->crm_id = $crm_id;
                $wait->data = $date;
                $wait->sparepart_id = $sparepart_id->id;
                $wait->how = $row[2];
                $wait->warehouse_id = $sklad_id->id;
                $wait->status_id = 1;           
                $wait->order = $row[3];
                $wait->save();
                //dd($wait);
                }
                if(strlen($row[0]) == 11){
                $crm_id = 0 . $row[0];
                $date = $this->findDate($crm_id);
                $wait->crm_id = $crm_id;
                $wait->data = $date;
                $wait->sparepart_id = $sparepart_id->id;
                $wait->how = $row[2];
                $wait->warehouse_id = $sklad_id->id;
                $wait->status_id = 1;           
                $wait->order = $row[3];
                $wait->save();
                }
            
                

            }
            
        }
        //dd($row[0]);
    }
}
