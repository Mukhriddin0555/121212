<?php

namespace App\Http\Controllers;

use App\Models\resseptionOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class resseptionController extends Controller
{
    public function ressepshnOrders($column, $sort)
    {   
        $user = Auth::User()->id;
        $data = DB::table('resseption_orders')
        ->leftJoin('spareparts', 'resseption_orders.sap_kod', '=', 'spareparts.sap_kod')        
        ->join('statuses', 'resseption_orders.status_id', '=', 'statuses.id')
        ->select('resseption_orders.*', 'spareparts.name as sapname','statuses.name as statusname')
        ->where('user_id', $user)
        ->orderBy($column, $sort)
        ->get();
        return view('resseption.orders', ['data' => $data]);
    }

    public function newRessepshnOrders(Request $req)
    {   
        $req->validate([
            'crm_id' => ['required'],
            'sap_kod' => ['required'],
            'how' => ['required'],
        ]);
        //нужно в инпуте crm_id sap_kod how
        $user = Auth::User()->id;
        $ress = DB::table('resses')
        ->where('user_id', $user)
        ->get();
        $ress = $ress[0]->warehouse_id;
        $order = new resseptionOrders();
        $order->crm_id = $req->crm_id;
        $order->sap_kod = $req->sap_kod;
        $order->how = $req->how;
        $order->order = "Еще не заказано";
        $order->warehouse_id = $ress;
        $order->user_id = $user;
        $order->status_id = 1;
        $order->save();
        return redirect()->route('ressepshnOrders', ['crm_id', 'asc']);
    }
}
