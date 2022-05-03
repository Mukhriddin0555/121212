<?php

namespace App\Http\Controllers;

use App\Models\ress;
use App\Models\role;
use App\Models\User;
use App\Models\status;
use App\Models\answaer;
use App\Models\sparepart;
use App\Models\warehouse;
use App\Imports\me2n_Import;
use App\Imports\SpareImport;
use Illuminate\Http\Request;
use App\Exports\SparePartExport;
use App\Imports\HowToModelImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class adminController extends Controller
{
    //найти роль пользователя
    protected function findRole($id)
    {
        $user = User::findorfail($id);
        $roleid = $user->role_id;
        $role = role::findorfail($roleid);
        $rolename = $role->role;
        if($role == 'manager'){
            $branch = warehouse::where('manager_id', $id)->get();
            return $branch;
        }else{
            $branch = warehouse::where('user_id', $id)->get();
            return $branch;
        }
    }
    //Обработка пользователей
    /**
     * @param $column 'surname'
     * @param $sort 'asc'
     * @return User model
     */
    public function allUsers($column = 'surname', $sort = 'asc')
    {
        $users = User::with('role')->orderBy($column, $sort)->get();
        return view('user.allUser', ['data' => $users]);
        //dd($users);
              
    }
    public function oneUser($id)
    {
        $users = User::find($id);
        return view('user.oneUser', ['data' => $users]);

    }
    public function deleteOneUser($id)
    {
        User::findorfail($id)->delete();
        return redirect()->route('allUsers', ['surname', 'asc']);
    }
    public function newUser()
    {        
        $role = role::where('role', '!=', 'admin')->get();
        
        return view('user.newUser', ['data' => $role]);
    }
    public function addNewUser(Request $req)
    {
        //пост surname,lastname,number,order,role_id,email,hash password,
        $req->validate([
            'surname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'number' => ['required'],
            'order' => ['required'],
            'role_id' => ['required'],
            'password' => ['required'],
        ]);
        $user = new User();
        $user->surname = $req->surname;
        $user->lastname = $req->lastname;
        $user->number = $req->number;
        $user->order = $req->order;
        $user->role_id = $req->role_id;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        return redirect()->route('allUsers', ['surname', 'asc']);
        
    }
    public function editOneUser($id)
    {
        $user = User::findorfail($id);
        $role = role::all();
        return view('user.editOneUser', ['data' => $user, 'role' => $role]);

    }

    public function updateOneUser(Request $req, $id)
    {
        //пост surname,lastname,number,order,role_id,email,hash password,
        $user = User::findorfail($id);
        $req->validate([
            'surname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'number' => ['required'],
            'order' => ['required'],
        ]);
        $user->surname = $req->surname;
        $user->lastname = $req->lastname;
        $user->number = $req->number;
        $user->order = $req->order;
        $user->email = $req->email;
        $user->save();
        return redirect()->route('allUsers', ['surname', 'asc']);
        //dd($req);
    }

    //-------------------------обработка филиалов

    /**
     * @param $column default kod
     * @param $sort default asc
     * @return view('branch.allBranchs', ['data' => $branch])
     */
    public function allBranchs($column = 'kod', $sort = 'asc')
    {
        $branch = warehouse::with('user')->with('managername')->with('branchmanager')->orderBy($column, $sort)->get();
        return view('branch.allBranchs', ['data' => $branch]);
        
    }
    public function oneBranch($id)
    {   
        $branch = warehouse::findorfail($id);
        $connected = ress::where('warehouse_id', $id)->with('connecteduser')->get(); 
        $ressepshn = role::where('role', 'resseption')->with('resseption')->first()->resseption;
        
        return view('branch.oneBranch', ['data' => $branch, 'data1' => $connected,'data2' => $ressepshn]);
        
        
    }
    public function deleteOneBranch($id)
    {
        warehouse::findorfail($id)->delete();
        if(ress::where('warehouse_id', $id)->count() > 0){
            foreach (ress::where('warehouse_id', $id)->get() as $value) {
                User::where('id', ress::find($value->id)->user_id)->update(['active' => 0]);
                ress::find($value->id)->delete();
              }
        }
        return redirect()->route('allBranchs', ['Kod', 'asc']);
    }
    public function newBranch()
    {
        $manager = role::where('role', 'manager')->with('userall')->first();
        $zavsklad = role::where('role', 'zavsklad')->with('userall')->first();
        $branchmanager = role::where('role', 'branchfilmanager')->with('userall')->first();

        return view('branch.newBranch', ['data1' => $manager, 'data2' => $zavsklad, 'data3' => $branchmanager]);
    }
    public function addNewBranch(Request $req)
    {
        //пост запрос Kod,name,user_id,manager_id,adress,location
        $req->validate([
            'Kod' => ['required'],
            'name' => ['required'],
            'user_id' => ['required'],
            'manager_id' => ['required'],
            'adress' => ['required'],
            'location' => ['required'],
        ]);
        $branch = new warehouse();
        $branch->Kod = $req->Kod;
        $branch->name = $req->name;
        $branch->user_id = $req->user_id;
        $branch->manager_id = $req->manager_id;
        $branch->branchmanager_id = $req->upr_id;
        $branch->adress = $req->adress;
        $branch->location = $req->location;
        $branch->save();
        User::where('id', $req->upr_id)->update(['active' => 1]);
        User::where('id', $req->user_id)->update(['active' => 1]);

        return redirect()->route('allBranchs', ['Kod', 'asc']);
    }
    public function editOneBranch($id)
    {
        $branch = warehouse::where('id', $id)->with('user')->with('managername')->with('branchmanager')->first();
        $manager = role::where('role', 'manager')->with('userall')->first();
        $zavsklad = role::where('role', 'zavsklad')->with('userall')->first();
        $branchmanager = role::where('role', 'branchfilmanager')->with('userall')->first();
        return view('branch.editOneBranch', ['manager' => $manager, 'data2' => $zavsklad, 'data3' => $branch, 'data4' => $branchmanager]);
    }
    public function updateOneBranch(Request $req, $id)
    {
        //пост
        $branch = warehouse::findorfail($id);
        $req->validate([
            'Kod' => ['required'],
            'name' => ['required'],
            'user_id' => ['required'],
            'manager_id' => ['required'],
            'adress' => ['required'],
            'location' => ['required'],
        ]);
        if($branch->user_id != $req->user_id){
            User::where('id', $branch->user_id)->update(['active' => 0]);
            User::where('id', $req->user_id)->update(['active' => 1]);
        }
        if($branch->branchmanager_id != $req->upr_id){
            User::where('id', $branch->branchmanager_id)->update(['active' => 0]);
            User::where('id', $req->upr_id)->update(['active' => 1]);
        }
        $branch->Kod = $req->Kod;
        $branch->name = $req->name;
        $branch->user_id = $req->user_id;
        $branch->manager_id = $req->manager_id;
        $branch->branchmanager_id = $req->upr_id;
        $branch->adress = $req->adress;
        $branch->location = $req->location;
        $branch->save();
        return redirect()->route('allBranchs', ['Kod', 'asc']);
    }
    public function addNewUserBranch(Request $req, $id)
    {
        $req->validate([            
            'user_id' => ['unique:resses'],
        ]);
        User::where('id', $req->user_id)->update(['active' => 1]);

        $ressepshn = new ress();
        $ressepshn->warehouse_id = $id;
        $ressepshn->user_id = $req->user_id;
        $ressepshn->save();

        return redirect()->route('oneBranch', $id);
        
    }

    public function deleteUserBranch($id)
    {   
        User::where('id', ress::find($id)->user_id)->update(['active' => 0]);
        $onebranch = ress::findorfail($id)->warehouse_id;
        ress::findorfail($id)->delete();

        return redirect()->route('oneBranch', $onebranch);
        
    }
    //обработка статусов и ответов смотреть добавить удалить
    public function allStatus()
    {
        $status1 = DB::table('statuses')
        ->where('id', '<=', 2)
        ->get();
        $status2 = DB::table('statuses')
        ->where('id', '>=', 3)
        ->get();
        return view('status.allStatus', ['data1' => $status1, 'data2' => $status2]);

    }
    public function deleteStatus($id)
    {
        status::findorfail($id)->delete();
        return redirect()->route('allStatus');
    }
    public function addStatus(Request $req)
    {
        $status = new status();
        $status->name = $req->name;
        $status->save();
        return redirect()->route('allStatus');
    }
    public function allCallBack()
    {
        $status1 = DB::table('answaers')
        ->where('id', '<=', 3)
        ->get();
        $status2 = DB::table('answaers')
        ->where('id', '>=', 4)
        ->get();
        return view('status.callBack', ['data1' => $status1, 'data2' => $status2]);
    }
    public function deleteCallBack($id)
    {
        answaer::findorfail($id)->delete();
        return redirect()->route('allCallBack');
    }
    public function addCallBack(Request $req)
    {
        $status = new answaer();
        $status->name = $req->name;
        $status->save();
        return redirect()->route('allCallBack');
    }

    //обработка списка запчастей импорт/экспорт добавление по одной запчасти удаление/поиск по запчасти
    
    public function sparePart()
    {
        return view('sparepart.spare');
    }

    public function sparePartSearch(Request $req)
    {
        if(!empty($req->sap) && empty($req->name)){
            $search1 = $req->sap;
            $column = 'sap_kod';
            $search =  str_replace("*", "%", $search1);
            $data = sparepart::where($column, 'LIKE', "$search")->get();
            return view('sparepart.search', ['data' => $data, 'data1' => $search1]);
            //dd($data);
            
        }
        if(empty($req->sap) && !empty($req->name)){
            $search1 = $req->name;
            $column = 'name';
            $search =  str_replace("*", "%", $search1);
            $data = sparepart::where($column, 'LIKE', "$search")->get();
            return view('sparepart.search', ['data' => $data, 'data2' => $search1]);
            //dd($data);
            
        }
        if(!empty($req->sap) && !empty($req->name)){
            $searchsap1 = $req->sap;
            $searchname1 = $req->name;
            $searchsap =  str_replace("*", "%", $searchsap1);
            $searchname =  str_replace("*", "%", $searchname1);
            $data = sparepart::where('sap_kod', 'LIKE', "$searchsap")
            ->where('name', 'LIKE', "$searchname")
            ->get();
            return view('sparepart.search', ['data' => $data, 'data1' => $searchsap1, 'data2' => $searchname1]);
            //dd($data);
        }
        
    }

    public function deleteSparePart($sap)
    {
        sparepart::where('sap_kod', $sap)->delete();
        return redirect()->route('sparePart');
    }

    public function allExport()
    {
        return Excel::download(new SparePartExport, 'saplist.xlsx');
    }

    public function addsparePart(Request $req)
    {
        
        if(!empty($req->sap && $req->name)){
            $spare = new sparepart();
            $spare->sap_kod = $req->sap;
            $spare->name = $req->name;
            $spare->save();
        }
        if($req->hasFile('import'))
        {
            $result = Excel::import(new SpareImport, $req->file('import'));
            return redirect()->route('sparePart');
        }
        return redirect()->route('sparePart');
    }

    public function modelImport(Request $req) 
    {
        $result = Excel::import(new HowToModelImport, $req->file('modelimport'));
        return redirect()->route('sparePart');
    }
    public function importMe2n(Request $req) 
    {
        $new_status = Excel::import(new me2n_Import, $req->file('me2nimport'));
        return redirect()->route('sparePart')->with('succecc', 'успешно обновлено');
    }

}
