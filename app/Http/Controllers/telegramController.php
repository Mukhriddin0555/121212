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
        Log::debug($request->all());
    }
}
