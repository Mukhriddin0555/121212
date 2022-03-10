<?php

namespace App\Imports;

use App\Models\waiting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

use function PHPUnit\Framework\isNull;

class me2nImport implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $rows)
    {
        
        if($rows[0] != null && $rows[1] != null && $rows[2] != null && $rows[3] != null ){
            $num = 0;
            
                $num++;
                $order = DB::table('waitings')
                ->where('status_id', 1)
                ->where('crm_id', $rows[0])
                ->where('sap_kod', $rows[1])
                ->where('how', $rows[2])
                ->first();

                
                
                if($order && $order->how <= $rows[2]){
                    
                    $order = DB::table('waitings')
                    ->where('status_id', 1)
                    ->where('crm_id', $rows[0])
                    ->where('sap_kod', $rows[1])
                    ->where('how', $rows[2])
                    ->update(["status_id" => 3]);
                    
                }
                
                if($rows[0] == 'rsp'){
                    $warehouse = DB::table('waitings')
                    ->join('warehouses', 'waitings.warehouse_id', '=', 'warehouses.id')
                    ->select('waitings.id', 'warehouses.Kod', 'waitings.sap_kod', 'waitings.status_id', 'waitings.how' )
                    ->where('waitings.status_id', 1)
                    ->where('warehouses.Kod', $rows[3])
                    ->where('sap_kod', $rows[1])
                    ->get();
                    
                    
                    if(!empty($warehouse)){
                        
                        $count = $rows[2];
                        
                        foreach ($warehouse as $house){
                            if($count >= $house->how){
                                $wait = waiting::find($house->id);
                                $wait->status_id = 3;
                                $wait->save();
                                $count -= $wait->how;
                            }
                        }
                    }
    
                }
                
                
            
            
        }
    }
}
