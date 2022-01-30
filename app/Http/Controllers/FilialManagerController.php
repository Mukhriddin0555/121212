<?php

namespace App\Http\Controllers;

use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FilialManagerController extends Controller
{
    public function waitorders($column, $sort)
    {           
        $user = Auth::User()->id;
        $warehouse = DB::table('warehouses')->where('branchmanager_id','=', $user )->get();
        $sklad = $warehouse[0]->id;
        $data = DB::table('waitings')
        ->leftJoin('spareparts', 'waitings.sap_kod', '=', 'spareparts.sap_kod')        
        ->join('statuses', 'waitings.status_id', '=', 'statuses.id')
        ->select('waitings.*', 'spareparts.name as sapname','statuses.name as statusname')
        ->where('warehouse_id', $sklad)
        ->orderBy($column, $sort)
        ->get();
        return view('filialupr.waits', ['data' => $data]);
        //dd($data);
    }
    public function resseptionorders($column, $sort)
    {   
        $user = Auth::User()->id;
        $warehouse = DB::table('warehouses')->where('branchmanager_id','=', $user )->get();
        $sklad = $warehouse[0]->id;
        $data = DB::table('resseption_orders')
        ->leftJoin('spareparts', 'resseption_orders.sap_kod', '=', 'spareparts.sap_kod')        
        ->join('statuses', 'resseption_orders.status_id', '=', 'statuses.id')
        ->select('resseption_orders.*', 'spareparts.name as sapname','statuses.name as statusname')
        ->where('warehouse_id', $sklad)
        ->orderBy($column, $sort)
        ->get();
        return view('filialupr.orders', ['data' => $data]);
        //dd($data);
    }
}
