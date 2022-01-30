<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class sparepartmanagerController extends Controller
{
    public function allTransfers($column, $sort)
    {   
        $data = 1234;
        return view('transfer.alltransfer', ['data' => $data]);
    }
    public function transfered(Request $req)
    {   
        
        return redirect()->route('allTransfers', ['crm_id', 'asc']);
    }
}
