<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\waiting;
use App\Models\transfer;
use App\Models\MailArtel;
use Illuminate\Http\Request;
use App\Models\resseptionOrders;
use Illuminate\Support\Facades\Auth;

class counterController extends Controller
{
    public function counterProdaja(){
        $sklad_id = User::find(Auth::User()->id)->sklad->id;
        $wait = resseptionOrders::where('warehouse_id', $sklad_id)->where('status_id', 1)->count();
        return $wait;}
    public function counterProdajadostavlen(){
            $sklad_id = User::find(Auth::User()->id)->sklad->id;
            $wait = resseptionOrders::where('warehouse_id', $sklad_id)->where('status_id', 2)->count();
            return $wait;
        }
    
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
    public function profileuser(){
        $user = User::find(Auth::User()->id);
        
        return $user;}
    static function countmetod(){
        return [
            'countvputi' => self::counterVputi(), 
            'countwait' => self::counterWait(), 
            'countdostavlen' => self::counterDostavlen(), 
            'countprodaja' => self::counterProdaja(),
            'countmessages' => self::counternewmessages(),
            'countfromtransfer' => self::counterfromtransfer(),
            'counttotransfer' => self::countertotransfer(),
            'countprodajadostavlen' => self::counterProdajadostavlen(),
            'profile' => self::profileuser(),
        ];}
}
