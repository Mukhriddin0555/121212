<?php

namespace App\Http\Controllers;

use App\Models\resseptionOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class resseptionController extends Controller
{
    public function counterwait()
    {   
        $user = Auth::User()->id;
        $data = DB::table('resseption_orders')
        ->where('user_id', $user)
        ->where('status_id', 1)
        ->count();
        return $data;
    }
    public function counterdostavlen()
    {   
        $user = Auth::User()->id;
        $data = DB::table('resseption_orders')
        ->where('user_id', $user)
        ->where('status_id', 2)
        ->count();
        return $data;
    }
    public function resseptionenter()
    {   
        $data2 = $this->counterwait();
        $data3 = $this->counterdostavlen();

        return view('resseption', ['data2' => $data2, 'data3' => $data3]);
    }
    
    public function ressepshnOrders($status, $column, $sort)
    {   
        $user = Auth::User()->id;
        $data = DB::table('resseption_orders')
        ->leftJoin('spareparts', 'resseption_orders.sap_kod', '=', 'spareparts.sap_kod')        
        ->join('statuses', 'resseption_orders.status_id', '=', 'statuses.id')
        ->select('resseption_orders.*', 'spareparts.name as sapname','statuses.name as statusname')
        ->where('user_id', $user)
        ->where('status_id', $status)
        ->orderBy($column, $sort)
        ->get();
        $data2 = $this->counterwait();
        $data3 = $this->counterdostavlen();


        return view('resseption.orders', ['data' => $data, 'data2' => $data2, 'data3' => $data3]);
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
        return redirect('resseption');
    }
}
