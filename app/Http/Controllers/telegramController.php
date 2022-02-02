<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use App\Models\HowToModel;
use Illuminate\Http\Request;

class telegramController extends Controller
{
    
    
    public function howToModel(Request $request, Telegram $telegram)
    {
        $chat_id = $request['message']['chat']['id'];
        $text = $request['message']['text'];
        $search =  '%'.$text.'%'; //str_replace("*", "%", $search1);
        $data1 = HowToModel::where('zavod_sn', 'LIKE', "$search")->get();
        $data = (string)view('telegramsupport.howtomodel',['models' => $data1]);
        $telegram->sendMessage($chat_id, $data);
        //Log::debug($chat_id);
    }
}
