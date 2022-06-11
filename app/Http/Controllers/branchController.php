<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\waiting;
use App\Models\transfer;
use App\Models\MailArtel;
use App\Models\sparepart;
use App\Models\warehouse;
use App\Exports\WaitExport;
use App\Imports\waitImport;
use Illuminate\Http\Request;
use App\Models\SpareTransfer;
use App\Models\resseptionOrders;
use App\Exports\SpareTransferExel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\counterController;

class branchController extends Controller
{
    protected function skladid(){
        return User::find(Auth::User()->id)->sklad->id;
    }
    protected function skladkod(){
        return User::find(Auth::User()->id)->sklad->Kod;
    }
    public function zavsklad(){
        return view('zavsklad', ['count' => counterController::countmetod()]);
    }
    public function wherewait($status_id, $column = 'crm_id'){
        return waiting::where('warehouse_id', $this->skladid())
        ->where('status_id', $status_id)->where('active', 1)
        ->with('sapkod')->get()->sortBy($column);
    }
    public function allWait($column)
    {   
        return view('zavsklad.allwait', ['allwait' => $this->wherewait(1, $column), 'count' => counterController::countmetod()]);
    }
    public function vputi($column)
    {   
        return view('zavsklad.vputi', ['allwait' => $this->wherewait(3, $column), 'count' => counterController::countmetod()]);
    }
    public function dostavlen($column)
    {        
        return view('zavsklad.dostavlen', ['allwait' => $this->wherewait(2, $column), 'count' => counterController::countmetod()]);
    }
    public function oneWait($id)
    {
        $onewait = waiting::where('id', $id)->with('sklad')->with('sapkod')->with('status')->first();
        return view('zavsklad.onewait', ['data' => $onewait, 'count' => counterController::countmetod()]);
    }
    public function deleteOneWait($id, $routename)
    {        
        waiting::where('id',$id)->update(['active' => 0]);return back();
    }
    public function deliveredOneWait($id, $routename)
    {        
        waiting::where('id', $id)->update(['status_id' => 2]);return back();
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
            Excel::import(new waitImport, $req->file('waitimport'));return back();
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
        $wait = new waiting();
        $wait->crm_id = $req->crm_id;
        $wait->sparepart_id = $sparepart_id->id;
        $wait->how = $req->how;
        $wait->warehouse_id = $this->skladid();
        $wait->status_id = 1;
        $wait->data = $date;
        if(empty($req->order))$wait->order = "нет";
        if(isset($req->order))$wait->order = $req->order;
        if($this->validateDate($date))$wait->save();
        else return back()->with('errordateid', 'Поле Id введен не правильно');
        return back()->with('success', 'Введеный запись успешно добавлен');
    }
    public function editOneWait($id)
    {   //бу функцияни обработка килиш кере  
        return view('zavsklad.editonewait', ['wait' => waiting::find($id), 'count' => counterController::countmetod()]);
    }
    public function updateOneWait(Request $req, $id)
    {   
        waiting::where('id', $id)->update(['text' => $req->text]);
        return back();
    }
    //--------------------------------------------------------------------
    //обработка ожидании запчастей на продажу
    protected function joinAllWaitSales($status, $column){
        $wait = resseptionOrders::where('warehouse_id', $this->skladid())
        ->where('status_id', $status)
        ->join('statuses', 'statuses.id','=', 'status_id')
        ->join('spareparts', 'spareparts.id','=' ,'sparepart_id')
        ->orderBy($column)
        ->select(
                'resseption_orders.status_id',
                'resseption_orders.id',
                'resseption_orders.crm_id', 
                'spareparts.sap_kod as sapkod', 
                'spareparts.name as sapname', 
                'resseption_orders.how',
                'resseption_orders.order',)
        ->get();

        return $wait;
    }
    public function allWaitOrder($status = 1, $column = 'crm_id')
    {   
        $wait = $this->joinAllWaitSales($status, $column);
        $count = counterController::countmetod();
        $status1 = ($status == 1) ? "Ожидание" : "Доставлен";
        return view('zavsklad.saleswait', ['data' => $wait, 'count' => $count, 'status' => $status1, 'status2' => $status]);
        //dd($wait);
    }
    public function oneWaitOrder(Request $req, $id)
    {     
        resseptionOrders::where('id', $id)->update(['order' => $req->order]);
        return back();
    }
    public function deleteOneWaitOrder($id)
    {     
        resseptionOrders::find($id)->delete();
        return back();
    }
    public function deliveredOneWaitOrder($id)
    {     
        resseptionOrders::where('id', $id)->update(['status_id' => 2]);
        return back();
    }

    //--------------------------------------------------------------
    //обработка трансферов
    public function myTransfers($column = 'created_at')
    {    
        return view('zavsklad.fromtransfer', [
            'data1' => transfer::where('from_user_id', $this->skladid())->orderBy($column)->get(), 
            'branchs' => warehouse::where('id', '!=', $this->skladid())->get(), 
            'count' => counterController::countmetod()]);
    }
    public function historyTransfers($column = 'created_at')
    {    
        return view('zavsklad.history', [
            'data1' => transfer::where('from_user_id', $this->skladid())->orderBy($column)->get(), 
            'branchs' => warehouse::where('id', '!=', $this->skladid())->get(), 
            'count' => counterController::countmetod()]);
    }
    public function oneMyTransfer($id)
    {     
        $transfer = transfer::find($id);
        if(Auth::User()->sklad->id == $transfer->from_user_id)
        {
            $transfer->answer_id = 2;
            $transfer->text = "Ожидание трансфера";
            $transfer->save();
        }
        return back();
    }
    public function oneMyTransferDelete($id)
    {     
        $transfer = transfer::find($id);
        $transferdefine = transfer::find($id)->from_user_id;
        if($this->skladid() == $transferdefine && $transfer->answer_id != 2 && $transfer->answer_id != 7 && $transfer->answer_id != 8)
        {
            $transfer->delete();
            return back()->with('deleted', 'Успешно удален');
        }else{return back()->with('noDelete', 'Данный запись удалить невозможно');}
    }
    public function ourTransfers($column)
    {     
       return view('zavsklad.totransfer', [
            'data1' => transfer::where('to_user_id', $this->skladid())->orderBy($column)->get(), 
            'data2' => DB::table('answaers')->get(), 
            'count' => counterController::countmetod()]);
    }
    public function oneOurTransfer(Request $req, $id)
    {     
        $req->validate([
            'answer' => ['required', 'string', 'max:255'],
            'info' => ['required', 'string', 'max:255'],]);
        $transfer = transfer::find($id);
        $transfer->answer_id = $req->answer;
        $transfer->text = $req->info;
        $transfer->save();
        if($transfer->answer_id == 7){
            $count = warehouse::find($transfer->to_user_id)->increment('orderinc');
            $count = warehouse::find($transfer->to_user_id);
            $spare_transfer = new SpareTransfer();
            $spare_transfer->user_id = $transfer->to_user_id;
            $spare_transfer->to_user_id = $transfer->from_user_id;
            $spare_transfer->how = $transfer->how;
            $spare_transfer->order_number = warehouse::find($transfer->to_user_id)->orderinc;
            $spare_transfer->transfer_id = $transfer->id;
            $spare_transfer->sparepart_id = $transfer->sparepart_id;
            $spare_transfer->count = $count->orderinc;
            $spare_transfer->save();
        }
        if($transfer->answer_id == 8){
            //текшириш кере трансферга очилганми йоми
            $user_id = warehouse::where('id', $transfer->from_user_id)->with('user')->first()->user->id;
            $mail = new MailArtel();
            $mail->user_id = $user_id;
            $mail->from_user_id = Auth::user()->id;
            $mail->topic = "Подтверждение отправки";
            $mail->transfer_id = $transfer->id;
            $mail->text = $transfer->text;
            $mail->form = 1;
            $mail->save();
            $waited = waiting::where('crm_id', $transfer->crm_id)->first();
            if($waited){$waited->status_id = 3; $waited->save();}
        }
        return back();
    }
    //создание новой заявки на трансфер и сообшение для юсера
    public function newtransfer(Request $req)
    {   
        $req->validate([
            'sparepart_id' => ['required'],
            'how' => ['required'],
            'crm_id' => ['required'],
            'tosklad' => ['required'],
        ]);  
        $sparepart = sparepart::firstOrCreate(['sap_kod' => $req->sparepart_id],['name' => 'Не найден']);
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        //$user = User::find(Auth::User()->id);
        $transfer = new transfer();
        $transfer->sparepart_id = $sparepart->id;
        $transfer->how = $req->how;
        $transfer->crm_id = $req->crm_id;
        $transfer->text = 'ID: ' . $req->crm_id . ' учун';
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
            $mail->form = 2;
            $mail->save();
            //"Здраствуйте. Прошу вас отправить с ближайщим рейсом $sparepart->sap_kod $sparepart->name $req->how шт на филиал $warehouse->Kod - $warehouse->name . с уважением $user->surname $user->lastname"
        }return back();
    }
    //мульти изменения статуса ожидания на доставлен 
    public function selecteddelivered(Request $req, $routename = 'allWait'){
        foreach ($req->selected as $item => $value){
            waiting::where('id', $value)->update(['status_id' => 2]);
        }return back();
    }
    //мульти удаление записей ожидании
    public function selecteddelete(Request $req, $routename = 'allWait'){
        foreach ($req->selected as $value){
            waiting::where('id',$value)->update(['active' => 0]);
        }return back();
    }
    //экспорт списка ожидании на экзель
    public function allWaitExport(){
        return Excel::download(new WaitExport, date("Y-m-d") . "-" . $this->skladkod() . '.xlsx');
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
            return view('zavsklad', ['data1' => $data1, 'count' => counterController::countmetod()]);
            
        }else{return back()->with('errorid', 'В базе данных не найдено совпадений по записи:' . $search1);}
    }
    public function allmailincoming($column = 'active'){
        $user_id = Auth::User()->id;
        $count = counterController::countmetod();
        $messages = DB::table('mail_artels')
        ->join('users', 'mail_artels.from_user_id', '=', 'users.id')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->where('mail_artels.user_id', $user_id)
        ->where('mail_artels.isdeleteuser1', 0)
        ->orderBy($column)
        ->select('mail_artels.created_at', 'mail_artels.topic', 'mail_artels.active', 'mail_artels.id', 'roles.role', 'users.surname', 'users.lastname')
        ->get();
        
        return view('zavsklad.allmailincoming', ['count' => $count, 'messages' => $messages]);
        //dd($messages);
    }
    public function allmailoutgoing($column = 'active'){
        $user_id = Auth::User()->id;
        $count = counterController::countmetod();
        $messages = DB::table('mail_artels')
        ->join('users', 'mail_artels.user_id', '=', 'users.id')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->where('mail_artels.from_user_id', $user_id)
        ->where('mail_artels.isdeleteuser2', 0)
        ->orderBy($column)
        ->select('mail_artels.created_at', 'mail_artels.topic', 'mail_artels.active', 'mail_artels.id', 'roles.role', 'users.surname', 'users.lastname')
        ->get();
        
        return view('zavsklad.allmailoutgoing', ['count' => $count, 'messages' => $messages]);
        //dd($messages);
    }
    public function onemailuser1($id){
        $message = MailArtel::find($id);
        if(Auth::User()->id == $message->user_id){
            $message->active = 2;
            $message->save();
            $id = $message->transfer_id;
            if($id > 0){
                $transfer = transfer::find($id);
                return view('zavsklad.readonemail'.$message->form, [
                    'count' => counterController::countmetod(), 
                    'message' => $message, 
                    'transfer' => $transfer, 
                    'user' => User::find($message->from_user_id)]);
            }else{
                return view('zavsklad.readonemail'.$message->form, ['count' => counterController::countmetod(), 'message' => $message]);
            }
            
        }else{return back();}
    }
    public function onemailuser2($id){
        $message = MailArtel::find($id);
        if(Auth::User()->id == $message->from_user_id){
            return view('zavsklad.readonemail', ['count' => counterController::countmetod(), 'message' => $message]);
        }else{return back();}
    }
    public function deletemailuser1($id){
        $message = MailArtel::find($id);
        if(Auth::User()->id == $message->user_id){
            if($message->isdeleteuser2 == 1){$message->delete();}else{$message->isdeleteuser1 = 1; $message->active = 0;$message->save();}
            return back()->with('deletedmessage', 'Сообшение успешно удалено');
        }else{return back()->with('erroredmessage', 'Сообшение не удалено');}
    }
    public function deletemailuser2($id){
        $message = MailArtel::find($id);
        if(Auth::User()->id == $message->from_user_id){
            if($message->isdeleteuser1 == 1){$message->delete();}else{$message->isdeleteuser2 = 1; $message->active = 0; $message->save();}
            return back()->with('deletedmessage', 'Сообшение успешно удалено');
        }else{return back()->with('erroredmessage', 'Сообшение не удалено');}
    }
    public function newmail(){
        $users = User::where('id', '!=', Auth::User()->id)->with('role')->orderBy('surname')->get();
        return view('zavsklad.newmail', ['count' => counterController::countmetod(), 'users' => $users]);
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
        return back()->with('sucsessmessage', 'Сообшение успешно оптравлено');
    }
    public function deletemailmultiuser1(Request $req){
        $user_id = Auth::User()->id;
        
        foreach ($req->selected as $value){
            
            $message = MailArtel::find($value);
            if($user_id == $message->user_id){
                if($message->isdeleteuser2 == 1){$message->delete();}else{$message->isdeleteuser1 = 1; $message->active = 0; $message->save();}
            }
            
        }
        return back()->with('deletedmessage', 'Сообшении успешно удалены');
    }
    public function deletemailmultiuser2(Request $req){
        foreach ($req->selected as $value){
            $message = MailArtel::find($value);
            if(Auth::User()->id == $message->from_user_id){
                if($message->isdeleteuser1 == 1){$message->delete();}else{$message->isdeleteuser2 = 1;  $message->active = 0;$message->save();}
            }

        }
        return back()->with('deletedmessage', 'Сообшении успешно удалены');
    }
    public function toexceltransfer($id){
        {return Excel::download(new SpareTransferExel($id), 'transfer.xlsx');}
    }
}
