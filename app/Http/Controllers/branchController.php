<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\status;
use App\Models\waiting;
use App\Models\transfer;
use App\Models\historyWait;
use Illuminate\Http\Request;
use App\Models\resseptionOrders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class branchController extends Controller
{
    //обработка ожидании запчастей
    public function allWait($column, $sort)
    {        
       $user = Auth::User()->id;
        $sklad_id = DB::table('warehouses')
        ->where('user_id', $user)
        ->get();
        $sklad_id = $sklad_id[0]->id;
        $wait = DB::table('waitings')
        ->leftJoin('spareparts', 'waitings.sap_kod', '=', 'spareparts.sap_kod')
        ->join('statuses', 'waitings.status_id', '=', 'statuses.id')        
        ->where('warehouse_id', $sklad_id)
        ->select('waitings.*', 'spareparts.name as sapname','statuses.name as statusname', 'statuses.id as statusid')
        ->orderBy($column, $sort)
        ->get();
        $status = status::all();
        
        return view('zavsklad.allwait', ['data1' => $wait, 'data2' => $status]);
    }
    public function oneWait($id)
    {        
        $onewait = DB::table('waitings')
        ->leftJoin('spareparts', 'waitings.sap_kod', '=', 'spareparts.sap_kod')
        ->join('statuses', 'waitings.status_id', '=', 'statuses.id')   
        ->join('warehouses', 'waitings.warehouse_id', '=', 'warehouses.id')
        ->select('waitings.*', 'spareparts.name as sapname','statuses.name as statusname', 'warehouses.name as skladname')
        ->where('waitings.id', $id)
        ->get();
        //$onewait = waiting::find($id);
        
        return view('zavsklad.onewait', ['data' => $onewait]);
        //dd($onewait);
    }
    public function deleteOneWait($id)
    {        
        $onewait = waiting::find($id);
        $onewait->delete();

        return redirect()->route('allWait', ['crm_id', 'asc']);
    }
    public function statusOneWait(Request $req, $id)
    {        
        $req->validate([
            'newstatus' => ['required'],
        ]);
        $onewait = waiting::find($id);
        $onewait->status_id = $req->newstatus;
        $onewait->save();
        return redirect()->route('allWait', ['crm_id', 'asc']);
    }
    public function deliveredOneWait($id)
    {        
        $onewait = waiting::find($id);
        $onewait->status_id = 2;
        $onewait->save();
        return redirect()->route('allWait', ['crm_id', 'asc']);
    }
    public function findDate($crmid)
    {
        $year = 20 . substr($crmid, 4, 2);
        $month = substr($crmid, 2, 2);
        $day = substr($crmid, 0, 2);
        return $year . '-' . $month . '-' . $day;

    }
    function validateDate($date, $format = 'Y-m-d')
    {
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
    }
    public function addNewWait(Request $req)
    {   
        $req->validate([
            'crm_id' => ['required'],
            'sap_kod' => ['required'],
            'how' => ['required'],
        ]); 
        $crmid = $req->crm_id;
        $date = $this->findDate($crmid);  
        $user = Auth::User()->id;
        $sklad_id = DB::table('warehouses')
        ->where('user_id', $user)
        ->get();
        $sklad_id = $sklad_id[0]->id;
        $wait = new waiting();
        $wait->crm_id = $req->crm_id;
        $wait->sap_kod = $req->sap_kod;
        $wait->how = $req->how;
        $wait->warehouse_id = $sklad_id;
        $wait->status_id = 1;
        $wait->data = $date;
        if(empty($order)){
            $wait->order = "нет";
        } 
        if(isset($req->order)){
            $wait->order = $req->order;
        }
        if($this->validateDate($date)){
            $wait->save();
        }
        return redirect()->route('allWait', ['crm_id', 'asc']);
        
    }
    public function editOneWait($id)
    {   //бу функцияни обработка килиш кере  
        $wait = waiting::find($id);
        $status = status::all();
        
        return view('zavsklad.editonewait', ['data1' => $wait, 'data2' => $status]);
    }
    public function updateOneWait(Request $req, $id)
    {   //бу функцияни обработка килиш кере
        $wait = waiting::find($id);
        
        $wait->crm_id = $req->crm_id;
        $wait->sap_kod = $req->sap_kod;
        $wait->how = $req->how;
        $wait->order = $req->order;
        $wait->status_id = $req->status;
        $wait->text = $req->text;
        $wait->save();
        return redirect()->route('allWait', ['crm_id', 'asc']);
    }
    //--------------------------------------------------------------------
    //обработка ожидании запчастей на продажу
    public function allWaitOrder($column, $sort)
    {     
        $user = Auth::User()->id;
        $sklad_id = DB::table('warehouses')
        ->where('user_id', $user)
        ->get();
        $sklad_id = $sklad_id[0]->id;
        $wait = DB::table('resseption_orders')
        ->leftJoin('spareparts', 'resseption_orders.sap_kod', '=', 'spareparts.sap_kod')
        ->join('statuses', 'resseption_orders.status_id', '=', 'statuses.id')        
        ->where('warehouse_id', $sklad_id)
        ->select('resseption_orders.*', 'spareparts.name as sapname','statuses.name as statusname')
        ->orderBy($column, $sort)
        ->get();
        
        return view('zavsklad.saleswait', ['data' => $wait]);
    }
    public function oneWaitOrder(Request $req, $id)
    {     
        $wait = resseptionOrders::find($id);
        $wait->order = $req->order;
        $wait->save();
        return redirect()->route('allWaitOrder', ['crm_id', 'asc']);
    }
    public function deleteOneWaitOrder($id)
    {     
        $wait = resseptionOrders::find($id);
        $wait->delete();
        return redirect()->route('allWaitOrder', ['crm_id', 'asc']);
    }
    public function deliveredOneWaitOrder($id)
    {     
        $wait = resseptionOrders::find($id);
        $wait->status_id = 2;
        $wait->save();
        return redirect()->route('allWaitOrder', ['crm_id', 'asc']);
    }

    //--------------------------------------------------------------
    //обработка трансферов
    public function myTransfers($column, $sort)
    {    
        $user = Auth::User()->id;
        $sklad_id = DB::table('warehouses')
        ->where('user_id', $user)
        ->get();
        $sklad_id = $sklad_id[0]->id;

        $transfer = DB::table('transfers')
        ->leftJoin('spareparts', 'transfers.sap_kod', '=', 'spareparts.sap_kod')
        ->join('warehouses as fromwarehouses', 'transfers.from_user_id', '=', 'fromwarehouses.id')  
        ->join('warehouses as towarehouses', 'transfers.to_user_id', '=', 'towarehouses.id')
        ->join('answaers', 'transfers.answer_id', '=', 'answaers.id')
        ->select('transfers.*', 'fromwarehouses.name as fromskladname','towarehouses.name as toskladname','spareparts.name as sapname','answaers.name as toresponse')
        ->where('from_user_id', $sklad_id)
        ->orderBy($column, $sort)
        ->get();

        $dostavlen = 'Получил трансфер';
        $confirm = DB::table('answaers')
        ->where('name', $dostavlen)
        ->get();

        $branch = DB::table('warehouses')
        ->where('id', '!=', $sklad_id)
        ->get();
        
        return view('zavsklad.fromtransfer', ['data1' => $transfer, 'data2' => $confirm, 'data3' => $branch]);
        //dd($confirm);
    }
    public function oneMyTransfer(Request $req, $id)
    {     
        $transfer = transfer::find($id);
        $user = Auth::User()->sklad->id;
        $transferdefine = transfer::find($id)->from_user_id;
        if($user == $transferdefine)
        {
            $transfer->answer_id = $req->answer;
            $transfer->text = "Ожидание трансфера";
            $transfer->save();
            return redirect()->route('myTransfers', ['sap_kod', 'asc']);
        }
        
        return redirect()->route('myTransfers', ['sap_kod', 'asc']);
    }
    public function ourTransfers($column, $sort)
    {     
        $user = Auth::User()->id;
        $sklad_id = DB::table('warehouses')
        ->where('user_id', $user)
        ->get();
        $sklad_id = $sklad_id[0]->id;
        $transfer = DB::table('transfers')
        ->leftJoin('spareparts', 'transfers.sap_kod', '=', 'spareparts.sap_kod')
        ->join('warehouses as fromwarehouses', 'transfers.from_user_id', '=', 'fromwarehouses.id')  
        ->join('warehouses as towarehouses', 'transfers.to_user_id', '=', 'towarehouses.id')
        ->join('answaers', 'transfers.answer_id', '=', 'answaers.id')
        ->select('transfers.*', 'fromwarehouses.name as fromskladname','towarehouses.name as toskladname','spareparts.name as sapname','answaers.name as toresponse')
        ->where('to_user_id', $sklad_id)
        ->orderBy($column, $sort)
        ->get();


        $confirm = DB::table('answaers')->get();

        return view('zavsklad.totransfer', ['data1' => $transfer, 'data2' => $confirm]);
    }
    public function oneOurTransfer(Request $req, $id)
    {     
        $req->validate([
            'answer' => ['required', 'string', 'max:255'],
            'info' => ['required', 'string', 'max:255'],
        ]);
        $transfer = transfer::find($id);
        $transfer->answer_id = $req->answer;
        $transfer->text = $req->info;
        $transfer->save();
        return redirect()->route('ourTransfers', ['sap_kod', 'asc']);
        //dd($transfer);
    }
    public function newtransfer(Request $req)
    {   
        $req->validate([
            'sap_kod' => ['required'],
            'how' => ['required'],
            'text' => ['required'],
            'tosklad' => ['required'],
        ]);  
        $user = Auth::User()->id;
        $sklad_id = DB::table('warehouses')
        ->where('user_id', $user)
        ->get();
        $sklad_id = $sklad_id[0]->id;

        $transfer = new transfer();

        $transfer->sap_kod = $req->sap_kod;
        $transfer->how = $req->how;
        $transfer->text = $req->text;
        $transfer->from_user_id = $sklad_id;
        $transfer->to_user_id = $req->tosklad;
        $transfer->answer_id = 1;
        $transfer->save();

        return redirect()->route('myTransfers', ['sap_kod', 'asc']);
    }

    public function selecteddelivered(Request $req){
        foreach ($req->selected as $item => $value){
            $onewait = waiting::find($value);
            $onewait->status_id = 2;
            $onewait->save();
        }
        
        return redirect()->route('allWait', ['crm_id', 'asc']);
    }
    public function selecteddelete(Request $req){
        
        foreach ($req->selected as $item => $value){
            $onewait = waiting::find($value);
            $history = new historyWait();
            $history->data = $onewait->data;
            $history->crm_id = $onewait->crm_id;
            $history->sap_kod = $onewait->sap_kod;
            $history->how = $onewait->how;
            $history->order = $onewait->order;
            $history->warehouse_id = $onewait->warehouse_id;
            $history->status_id = $onewait->status_id;
            $history->save();
            $onewait->delete();
        }
        return redirect()->route('allWait', ['crm_id', 'asc']);
    }
}
