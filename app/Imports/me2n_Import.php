<?php

namespace App\Imports;

use App\Models\waiting;
use App\Models\sparepart;
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
                $sparepart_id = sparepart::firstOrCreate(['sap_kod' => $rows[1]],['name' => 'Не найден']);
                $sap_id = $sparepart_id->id;
                
                $me2n = DB::table('me2n_imports')
                ->where('sap', $rows[1])
                ->where('postupleniye', $rows[4])
                ->count();
                $order = DB::table('waitings')
                ->where('status_id', 1)
                ->where('crm_id', strval($rows[0]))
                ->where('sparepart_id', $sap_id)
                ->where('active', 1)
                ->first();
    
                    
                    
                if($order && $order->how <= $rows[2]){
                
                $order = DB::table('waitings')
                ->where('status_id', 1)
                ->where('crm_id', $rows[0])
                ->where('sparepart_id', $sap_id)
                ->where('how', $rows[2])
                ->update(["status_id" => 3]);

                $me2ncreate = new me2nImport();
                $me2ncreate->sap = $rows[1];
                $me2ncreate->postupleniye = $rows[4];
                $me2ncreate->prihod = $rows[5];
                $me2ncreate->save();
                
                }
                if($me2n == 0){
                    if($rows[0] == 'rsp'){
                        $waitings = DB::table('waitings')
                        ->join('warehouses', 'waitings.warehouse_id', '=', 'warehouses.id')
                        ->select('waitings.id', 'warehouses.Kod', 'waitings.sparepart_id', 'waitings.status_id', 'waitings.how' )
                        ->where('waitings.status_id', 1)
                        ->where('warehouses.Kod', $rows[3])
                        ->where('sparepart_id', $sap_id)
                        ->get();
                        
                        
                        if(!empty($waitings)){
                            
                            $count = $rows[2];
                            
                            foreach ($waitings as $wait){
                                if($count >= $wait->how){
                                    $waiting = waiting::find($wait->id);
                                    $waiting->status_id = 3;
                                    $waiting->save();
                                    $count -= $waiting->how;

                                    $me2ncreate = new me2nImport();
                                    $me2ncreate->sap = $rows[1];
                                    $me2ncreate->postupleniye = $rows[4];
                                    $me2ncreate->prihod = $rows[5];
                                    $me2ncreate->save();
                                }
                            }
                        }
        
                    }
                    
                }
                    
            }
        }
    }
}
