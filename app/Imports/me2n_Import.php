<?php

namespace App\Imports;

use App\Models\waiting;
use App\Models\me2nImport;
use PhpParser\Node\Expr\New_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isNull;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\me2nImport as ModelsMe2nImport;

class me2n_Import implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(array $rows)
    {
        
        if($rows[0] != null && $rows[1] != null && $rows[2] != null && $rows[3] != null && $rows[4] != null && $rows[5] != null ){
            if($rows[5] == 'net'){
                $me2n = DB::table('me2n_imports')
                ->where('sap', $rows[1])
                ->where('postupleniye', $rows[4])
                ->count();

                if($me2n == 0){
                    
                    $order = DB::table('waitings')
                    ->where('status_id', 1)
                    ->where('crm_id', $rows[0])
                    ->where('sap_kod', $rows[1])
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
                    $me2ncreate = new me2nImport();
                    $me2ncreate->sap = $rows[1];
                    $me2ncreate->postupleniye = $rows[4];
                    $me2ncreate->prihod = $rows[5];
                    $me2ncreate->save();
                }
                    
            }
            if($rows[5] != 'net'){
                $delete = me2nImport::where('sap', $rows[1])
                ->where('postupleniye', $rows[4])->first();
                if($delete != null){
                    $delete->delete();
                }
                
            }
            
                
                
            
            
        }
    }
}
