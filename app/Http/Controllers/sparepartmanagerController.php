<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class sparepartmanagerController extends Controller
{
    //запросы на трансфер
    public function allTransfers()
    {   
        $data = 1234;
        return view('transfer.alltransfer', ['data' => $data]);
    }
    //история трансферов
    public function transfered()
    {   
        $data = 1234;
        return view('transfer.alltransferhistory', ['data' => $data]);
        
    }
    //запрос на пересорт
    public function changetonewcode()
    {   
        $data = 1234;
        return view('transfer.allnewcode', ['data' => $data]);
        
    }
    //история пересортов
    public function changedall()
    {   
        $data = 1234;
        return view('transfer.allnewcodehistory', ['data' => $data]);
        
    }

    //отпавленные трансферы которые в пути
    public function onmayway()
    {   
        $data = 1234;
        return view('transfer.transferonmayway', ['data' => $data]);
    }
    //пост запрос на трансфер
    public function transfersucsess(Request $req)
    {   
        $data = 1234;
        return redirect()->route('allTransfers', ['crm_id', 'asc']);
    }
    //пост запрос на пересорт
    public function changesucsess(Request $req)
    {   
        $data = 1234;
        return redirect()->route('allTransfers', ['crm_id', 'asc']);
    }
}
