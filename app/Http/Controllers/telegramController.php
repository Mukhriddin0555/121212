<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Helpers\Telegram;
use App\Models\HowToModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class telegramController extends Controller
{
    
    
    public function howToModel(Request $request, Telegram $telegram)
    {
        $chat_id = $request['message']['chat']['id'];
        $text = $request['message']['text'];
        $from_id = $request['message']['from']['id'];
        $first_name = $request['message']['from']['first_name'];
        $last_name = $request['message']['from']['last_name'];
        $username = $request['message']['from']['username'];

        $data = Counter::where('from_id', '=', $from_id)->count();
        if($data == 0)
        {
            $data = new Counter();
            $data->from_id = $from_id;
            $data->first_name = $first_name;
            $data->last_name = $last_name;
            $data->username = $username;
            $data->increment = 0;
            $data->save();
            
        }
        $query = DB::table('counters')->where('from_id', '=', $from_id)->increment('increment');  

        if(strlen($text) >= 4){
            $search =  '%'.$text.'%'; //str_replace("*", "%", $search1);
            $data1 = HowToModel::where('zavod_sn', 'LIKE', "$search")->get();
            if(empty($data1[0])){
                $data = 'В базе данных не найдено совподений с <'.$text.'>. проверьте и попробуйте заново';
                $telegram->sendMessage($chat_id, $data);
            }else{                
                $data = (string)view('telegramsupport.howtomodel',['models' => $data1]);
                $telegram->sendMessage($chat_id, $data);
            }
            
        }else{
            $data = 'Вы должны отправить не менне 4 символа';
            $telegram->sendMessage($chat_id, $data);
        }
        
        //Log::debug($chat_id);
    }
}
