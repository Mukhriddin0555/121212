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
        if(strlen($text) >= 3){
            $search =  '%'.$text.'%'; //str_replace("*", "%", $search1);
            $get = HowToModel::where('zavod_sn', 'LIKE', "$search");
            $count = $get->get();
            if($count){
                $data1 = HowToModel::where('zavod_sn', 'LIKE', "$search")->get();
            $data = (string)view('telegramsupport.howtomodel',['models' => $data1]);
            $telegram->sendMessage($chat_id, $data);
            }else{
                $data = 'В базе данных со значением'.$text.' нечего не найдено';
                $telegram->sendMessage($chat_id, $data);
            }
            
        }else{
            $data = 'Вы должны отправить не менне 3 символа';
            $telegram->sendMessage($chat_id, $data);
        }
        
        //Log::debug($chat_id);
    }
}
