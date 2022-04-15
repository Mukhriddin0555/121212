<?php

namespace App\Http\Controllers;

use App\Exports\WaitExport;
use App\Imports\waitImport;
use DateTime;
use App\Models\waiting;
use App\Models\transfer;
use App\Models\MailArtel;
use Illuminate\Http\Request;
use App\Models\resseptionOrders;
use App\Models\sparepart;
use App\Models\SpareTransfer;
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
    public function counternewmessages(){
        $user_id = Auth::User()->id;
        $messages = MailArtel::where('user_id', $user_id)->where('active', 1)->count();
        return $messages;}
    public function counterfromtransfer(){
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        $transfersfrom = transfer::where('from_user_id', $sklad_id)->where('answer_id', 7)->count();
        return $transfersfrom;}
    public function countertotransfer(){
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        $transfersto = transfer::where('to_user_id', $sklad_id)->where('answer_id', 1)->count();
        return $transfersto;}
    public function countmetod(){
        return [
            'countvputi' => $this->counterVputi(), 
            'countwait' => $this->counterWait(), 
            'countdostavlen' => $this->counterDostavlen(), 
            'countprodaja' => $this->counterProdaja(),
            'countmessages' => $this->counternewmessages(),
            'countfromtransfer' => $this->counterfromtransfer(),
            'counttotransfer' => $this->countertotransfer(),
        ];}
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
        $wait->crm_id = strval($req->crm_id);
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
        $wait = resseptionOrders::where('warehouse_id', $sklad_id)->where('status_id', 1)->with('status')->with('sapkod')->orderByDesc('crm_id')->get();
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
    public function myTransfers($column = 'created_at')
    {    
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        $transfer = transfer::where('from_user_id', $sklad_id)->orderBy($column)->get();
        $branchs = warehouse::where('id', '!=', $sklad_id)->get();
        $count = $this->countmetod();
        return view('zavsklad.fromtransfer', ['data1' => $transfer, 'branchs' => $branchs, 'count' => $count]);
    }
    public function oneMyTransfer($id)
    {     
        $transfer = transfer::find($id);
        $user = Auth::User()->sklad->id;
        $transferdefine = transfer::find($id)->from_user_id;
        if($user == $transferdefine)
        {
            $transfer->answer_id = 2;
            $transfer->text = "Ожидание трансфера";
            $transfer->save();
            return redirect()->route('myTransfers', ['updated_at']);
        }
        
        return redirect()->route('myTransfers', ['updated_at']);
    }
    public function oneMyTransferDelete($id)
    {     
        $transfer = transfer::find($id);
        $user = Auth::User()->sklad->id;
        $transferdefine = transfer::find($id)->from_user_id;
        if($user == $transferdefine && $transfer->answer_id != 2 && $transfer->answer_id != 7 && $transfer->answer_id != 8)
        {
            $transfer->delete();
            return redirect()->route('myTransfers', ['updated_at'])->with('deleted', 'Успешно удален');
        }
        
        return redirect()->route('myTransfers', ['updated_at'])->with('noDelete', 'Данный запись удалить невозможно');
    }
    public function ourTransfers($column)
    {     
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        $transfer = transfer::where('to_user_id', $sklad_id)->orderBy($column)->get();
        $count = $this->countmetod();

        $confirm = DB::table('answaers')->get();

        return view('zavsklad.totransfer', ['data1' => $transfer, 'data2' => $confirm, 'count' => $count]);
    }
    public function oneOurTransfer(Request $req, $id)
    {     
        $req->validate(['answer' => ['required', 'string', 'max:255'],'info' => ['required', 'string', 'max:255'],]);
        $transfer = transfer::find($id);
        $transfer->answer_id = $req->answer;
        $transfer->text = $req->info;
        $transfer->save();
        if($transfer->answer_id == 7){
            $user_id = warehouse::where('id', $transfer->from_user_id)->with('user')->first()->user->id;
            $mail = new MailArtel();
            $mail->user_id = $user_id;
            $mail->from_user_id = Auth::user()->id;
            $mail->topic = "Подтверждение отправки";
            $mail->transfer_id = $transfer->id;
            $mail->text = $transfer->text;
            $mail->save();
            warehouse::find($transfer->to_user_id)->increment('orderinc');
            $spare_transfer = new SpareTransfer();
            $spare_transfer->user_id = $transfer->to_user_id;
            $spare_transfer->to_user_id = $transfer->from_user_id;
            $spare_transfer->how = $transfer->how;
            $spare_transfer->order_number = warehouse::find($transfer->to_user_id)->orderinc;
            $spare_transfer->save();
        }
        return redirect()->route('ourTransfers', ['updated_at']);
    }
    //создание новой заявки на трансфер и сообшение для юсера
    public function newtransfer(Request $req)
    {   
        $req->validate([
            'sparepart_id' => ['required'],
            'how' => ['required'],
            'text' => ['required'],
            'tosklad' => ['required'],
        ]);  
        $sparepart = sparepart::firstOrCreate(['sap_kod' => $req->sparepart_id],['name' => 'Не найден']);
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        //$user = User::find(Auth::User()->id);
        $transfer = new transfer();

        $transfer->sparepart_id = $sparepart->id;
        $transfer->how = $req->how;
        $transfer->text = $req->text;
        $transfer->from_user_id = $sklad_id;
        $transfer->to_user_id = $req->tosklad;
        $transfer->answer_id = 1;
        $transfer->save();
        //$warehouse = warehouse::find($sklad_id);
        if(transfer::find($transfer->id)){
            $user_id = warehouse::where('id', $transfer->to_user_id)->with('user')->first()->user->id;
            $mail = new MailArtel();
            $mail->user_id = $user_id;
            $mail->from_user_id = Auth::User()->id;
            $mail->topic = "Запрос на трансфер";
            $mail->transfer_id = $transfer->id;
            $mail->text = $transfer->text;
            $mail->save();
            //"Здраствуйте. Прошу вас отправить с ближайщим рейсом $sparepart->sap_kod $sparepart->name $req->how шт на филиал $warehouse->Kod - $warehouse->name . с уважением $user->surname $user->lastname"
        }
        return redirect()->route('myTransfers', ['updated_at']);
    }
    //мульти изменения статуса ожидания на доставлен 
    public function selecteddelivered(Request $req, $routename = 'allWait'){
        foreach ($req->selected as $item => $value){
            waiting::where('id', $value)->update(['status_id' => 2]);
        }
        return redirect()->route($routename, ['crm_id']);
    }
    //мульти удаление записей ожидании
    public function selecteddelete(Request $req, $routename = 'allWait'){
        foreach ($req->selected as $item => $value){
            $onewait = waiting::where('id',$value)->update(['active' => 0]);
        }
        return redirect()->route($routename, ['crm_id']);
    }
    //экспорт списка ожидании на экзель
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
    //поиск по id в таблице ожидании
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
    public function allmail($column = 'active'){
        $user_id = Auth::User()->id;
        $count = $this->countmetod();
        $messages = DB::table('mail_artels')
        ->join('users', 'mail_artels.from_user_id', '=', 'users.id')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->where('mail_artels.user_id', $user_id)
        ->orderBy($column)
        ->select('mail_artels.created_at', 'mail_artels.topic', 'mail_artels.active', 'mail_artels.id', 'roles.role', 'users.surname', 'users.lastname')
        ->get();
        
        return view('zavsklad.allmail', ['count' => $count, 'messages' => $messages]);
        //dd($messages);
    }
    public function onemail($id){
        $user_id = Auth::User()->id;
        $count = $this->countmetod();
        $message = MailArtel::find($id);
        if($user_id == $message->user_id){
            $message->active = 2;
            $message->save();
            return view('zavsklad.readonemail', ['count' => $count, 'message' => $message]);
        }else{return redirect()->route('FilialBranchMailAll');}
    }
    public function deletemail($id){
        $user_id = Auth::User()->id;
        $message = MailArtel::find($id);
        if($user_id == $message->user_id){
            $message->delete();
            return redirect()->route('FilialBranchMailAll')->with('deletedmessage', 'Сообшение успешно удалено');
        }else{return redirect()->route('FilialBranchMailAll')->with('erroredmessage', 'Сообшение не удалено');}
    }
    public function newmail(){
        $count = $this->countmetod();
        $user_id = Auth::User()->id;
        $users = User::where('id', '!=', $user_id)->with('role')->get()->sortBy('surname');
        return view('zavsklad.newmail', ['count' => $count, 'users' => $users]);
    }
    public function addnewmail(Request $request){
        $request->validate([
            'user_id' => ['required'],
            'topic' => ['required'],
            'text' => ['required'],
        ]); 
        $user_id = Auth::User()->id;
        $newmessage = new MailArtel();
        $newmessage->user_id = $request->user_id;
        $newmessage->from_user_id = $user_id;
        $newmessage->topic = $request->topic;
        $newmessage->text = $request->text;
        $newmessage->save();
        return redirect()->route('FilialBranchMailAll')->with('sucsessmessage', 'Сообшение успешно оптравлено');
    }
    public function deletemailmulti(Request $req){
        foreach ($req->selected as $item => $value){
            MailArtel::find($value)->delete();
        }
        return redirect()->route('FilialBranchMailAll')->with('deletedmessage', 'Сообшении успешно удалены');
    }
}
