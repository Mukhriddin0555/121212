<?php

namespace App\Http\Controllers;

use App\Exports\WaitExport;
use App\Imports\waitImport;
use DateTime;
use App\Models\status;
use App\Models\waiting;
use App\Models\transfer;
use App\Models\historyWait;
use App\Models\ress;
use Illuminate\Http\Request;
use App\Models\resseptionOrders;
use App\Models\sparepart;
use App\Models\User;
use App\Models\warehouse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class branchController extends Controller
{
    //обработка ожидании запчастей
    public function counterProdaja(){
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        $wait = resseptionOrders::where('warehouse_id', $sklad_id)->where('status_id', 1)->count();
        return $wait;}
    
    public function counterVputi(){
        
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        $wait = waiting::where('warehouse_id', $sklad_id)->where('status_id', 3)->where('active', 1)->count();
        return $wait;}
    public function counterWait(){
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        $wait = waiting::where('warehouse_id', $sklad_id)->where('status_id', 1)->where('active', 1)->count();
        return $wait;}
    public function counterDostavlen(){
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        $wait = waiting::where('warehouse_id', $sklad_id)->where('status_id', 2)->where('active', 1)->count();
        return $wait;}
    public function countmetod(){
        return ['countvputi' => $this->counterVputi(), 'countwait' => $this->counterWait(), 'countdostavlen' => $this->counterDostavlen(), 'countprodaja' => $this->counterProdaja()];}
    public function zavsklad(){
        $count = $this->countmetod();
        return view('zavsklad', ['count' => $count]);
    }
    public function wherewait($id, $column = 'crm_id'){
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        $wait = waiting::where('warehouse_id', $sklad_id)->where('status_id', $id)->where('active', 1)->with('sapkod')->get()->sortBy($column);
        return $wait;
    }
    public function allWait($column)
    {      
        $count = $this->countmetod();
        $wait = $this->wherewait(1, $column);
        return view('zavsklad.allwait', ['allwait' => $wait, 'count' => $count]);
    }
    public function vputi($column)
    {        
        $count = $this->countmetod();
        $wait = $this->wherewait(3, $column);
        
        return view('zavsklad.vputi', ['allwait' => $wait, 'count' => $count]);
        //dd($wait);
    }
    public function dostavlen($column)
    {        
        $count = $this->countmetod();
        $wait = $this->wherewait(2, $column);
        
        return view('zavsklad.dostavlen', ['allwait' => $wait, 'count' => $count]);
    }
    public function oneWait($id)
    {
        $onewait = waiting::where('id', $id)->with('sklad')->with('sapkod')->with('status')->first();
        $count = $this->countmetod();
        return view('zavsklad.onewait', ['data' => $onewait, 'count' => $count]);
    }
    public function deleteOneWait($id, $routename)
    {        
        waiting::where('id',$id)->update(['active' => 0]);
        return redirect()->route($routename, ['crm_id']);
    }
    public function deliveredOneWait($id, $routename)
    {        
        waiting::where('id', $id)->update(['status_id' => 2]);
        return redirect()->route($routename, ['crm_id']);
    }
    public function findDate($crmid)
    {
        $year = 20 . substr($crmid, 4, 2);
        $month = substr($crmid, 2, 2);
        $day = substr($crmid, 0, 2);
        return $year . '-' . $month . '-' . $day;

    }
    function validateDate($date, $format = 'Y-m-d')
    {$d = DateTime::createFromFormat($format, $date);return $d && $d->format($format) === $date;}
    
    public function addNewWait(Request $req)
    {   
        if($req->hasFile('waitimport'))
        {
            $file = $req->file('waitimport');
            $result = Excel::import(new waitImport, $file);
            return redirect()->route('zavsklad');
        }
        if(!$req->hasFile('waitimport')){
            $req->validate([
                'crm_id' => ['required'],
                'sparepart_id' => ['required'],
                'how' => ['required'],
            ]); 
        }
        $sparepart_id = sparepart::firstOrCreate(['sap_kod' => $req->sparepart_id],['name' => 'Не найден']);
        $date = $this->findDate($req->crm_id);  
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        $wait = new waiting();
        $wait->crm_id = $req->crm_id;
        $wait->sparepart_id = $sparepart_id->id;
        $wait->how = $req->how;
        $wait->warehouse_id = $sklad_id;
        $wait->status_id = 1;
        $wait->data = $date;
        if(empty($order))$wait->order = "нет";
        if(isset($req->order))$wait->order = $req->order;
        if($this->validateDate($date))$wait->save();
        else return redirect()->route('zavsklad')->with('errordateid', 'Поле Id введен не правильно');
       
        return redirect()->route('zavsklad')->with('success', 'Введеный запись успешно добавлен');
        
    }
    public function editOneWait($id)
    {   //бу функцияни обработка килиш кере  
        $wait = waiting::find($id);
        $count = $this->countmetod();
        
        return view('zavsklad.editonewait', ['wait' => $wait, 'count' => $count]);
    }
    public function updateOneWait(Request $req, $id)
    {   
        waiting::where('id', $id)->update(['text' => $req->text]);
        return redirect()->route('allWait', ['crm_id']);
    }
    //--------------------------------------------------------------------
    //обработка ожидании запчастей на продажу
    public function allWaitOrder($column = 'crm_id')
    {   
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        $wait = resseptionOrders::where('warehouse_id', $sklad_id)->with('status')->with('sapkod')->orderByDesc('crm_id')->get();
        $count = $this->countmetod();
        return view('zavsklad.saleswait', ['data' => $wait, 'count' => $count]);
    }
    public function oneWaitOrder(Request $req, $id)
    {     
        resseptionOrders::where('id', $id)->update(['order' => $req->order]);
        return redirect()->route('allWaitOrder', ['status.name']);
    }
    public function deleteOneWaitOrder($id)
    {     
        resseptionOrders::find($id)->delete();
        return redirect()->route('allWaitOrder', ['status.name']);
    }
    public function deliveredOneWaitOrder($id)
    {     
        resseptionOrders::where('id', $id)->update(['status_id' => 2]);
        return redirect()->route('allWaitOrder', ['status.name']);
    }

    //--------------------------------------------------------------
    //обработка трансферов
    public function myTransfers($column, $sort)
    {    
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        
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
        
        $data4 = $this->counterWait();
        $data5 = $this->counterVputi();
        $data6 = $this->counterDostavlen();
        $data7 = $this->counterProdaja();

        return view('zavsklad.fromtransfer', ['data1' => $transfer, 'data2' => $confirm, 'data3' => $branch,
        'data4' => $data4, 'data5' => $data5, 'data6' => $data6, 'data7' => $data7]);
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
        $data4 = $this->counterWait();
        $data5 = $this->counterVputi();
        $data6 = $this->counterDostavlen();
        $data7 = $this->counterProdaja();

        $confirm = DB::table('answaers')->get();

        return view('zavsklad.totransfer', ['data1' => $transfer, 'data2' => $confirm,
        'data4' => $data4, 'data5' => $data5, 'data6' => $data6, 'data7' => $data7]);
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
            'sparepart_id' => ['required'],
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

        $transfer->sparepart_id = $req->sparepart_id;
        $transfer->how = $req->how;
        $transfer->text = $req->text;
        $transfer->from_user_id = $sklad_id;
        $transfer->to_user_id = $req->tosklad;
        $transfer->answer_id = 1;
        $transfer->save();

        return redirect()->route('myTransfers', ['sap_kod', 'asc']);
    }

    public function selecteddelivered(Request $req, $routename = 'allWait'){
        foreach ($req->selected as $item => $value){
            waiting::where('id', $value)->update(['status_id' => 2]);
        }
        
        return redirect()->route($routename, ['crm_id']);
    }
    public function selecteddelete(Request $req, $routename = 'allWait'){
        
        foreach ($req->selected as $item => $value){
            $onewait = waiting::where('id',$value)->update(['active' => 0]);
        }
        return redirect()->route($routename, ['crm_id']);
    }

    public function allWaitExport(){
        $user = Auth::User()->id;
        $sklad_id = DB::table('warehouses')
        ->where('user_id', $user)
        ->get();
        $sklad_id = $sklad_id[0]->Kod;
        $date = date("Y-m-d");
        //dd($sklad_id);
        return Excel::download(new WaitExport, $date . "-" . $sklad_id . '.xlsx');
    }
    public function searchid(Request $req){
        
        $search1 = $req->search;
        $search =  str_replace("*", "%", $search1);
        $data = waiting::where('crm_id', 'LIKE', "$search")->count();
        if($data > 0){
            $data1 = DB::table('waitings')
            ->join('warehouses', 'waitings.warehouse_id', '=', 'warehouses.id')
            ->where('crm_id', 'LIKE', "$search")
            ->select('warehouses.Kod', 'warehouses.name', 'waitings.*')
            ->get();
            $count = $this->countmetod();
            return view('zavsklad', ['data1' => $data1, 'count' => $count]);
            
        }
        if($data == 0){
            return redirect()->route('zavsklad')->with('errorid', 'В базе данных не найдено совпадений по записи:' . $search1);
            
        }
    }
}
