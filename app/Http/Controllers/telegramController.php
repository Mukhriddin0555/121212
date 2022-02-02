<?php

namespace App\Http\Controllers;

use App\Helpers\Telegram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class telegramController extends Controller
{
    
    
    public function howToModel(Request $request, Telegram $telegram)
    {
        $chat_id = $request['message']['chat']['id'];
        Log::debug($chat_id);
    }
}
