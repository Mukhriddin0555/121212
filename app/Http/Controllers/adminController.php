<?php

namespace App\Http\Controllers;

use App\Models\ress;
use App\Models\role;
use App\Models\User;
use App\Models\answer;
use App\Models\status;
use App\Models\answaer;
use App\Models\sparepart;
use App\Models\warehouse;
use App\Imports\SpareImport;
use Illuminate\Http\Request;
use App\Exports\SparePartExport;
use App\Imports\SparePartImport;
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
    public function allUsers($column, $sort)
    {
        //$users = User::all();
        $users = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->orderBy($column, $sort)
        ->select('users.*', 'roles.role')
        ->get();
        return view('user.allUser', ['data' => $users]);
        //dd($users);
    }
    public function oneUser($id)
    {
        //$user = User::all()->where($id)->get();
        $users = User::all();
        

        $user = $users->find($id);
        //кайси регионларга караши
        //$role = $this->findRole($id);
        
        return view('user.oneUser', ['data' => $user]);
        //dd($role);
    }
    public function deleteOneUser($id)
    {
        $user = User::findorfail($id);
        $user->delete();
        return redirect()->route('allUsers', ['surname', 'asc']);
    }
    public function newUser()
    {        
        $role = role::all();
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
            'role_id' => ['required'],
            'password' => ['required'],
        ]);
        $user->surname = $req->surname;
        $user->lastname = $req->lastname;
        $user->number = $req->number;
        $user->order = $req->order;
        $user->role_id = $req->role_id;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        return redirect()->route('allUsers', ['surname', 'asc']);
        //dd($req);
    }

    //-------------------------обработка филиалов
    public function allBranchs($column, $sort)
    {
        //$branch = warehouse::all();
        
        $branch = DB::table('warehouses')
        ->leftJoin('users as zavsklad', 'warehouses.user_id', '=', 'zavsklad.id')
        ->leftJoin('users as manager', 'warehouses.manager_id', '=', 'manager.id')
        ->leftJoin('users as filialmanager', 'warehouses.branchmanager_id', '=', 'filialmanager.id')
        ->select(
            'warehouses.*', 
            'zavsklad.surname as zavskladsurname',
            'zavsklad.lastname as zavskladlastname', 
            'manager.surname as managersurname',
            'manager.lastname as managerlastname',
            'filialmanager.surname as filialmanagersurname',
            'filialmanager.lastname as filialmanagerlastname'
            )
        ->orderBy($column, $sort)
        ->get();
        return view('branch.allBranchs', ['data' => $branch]);
        //->join('roles', 'users.role_id', '=', 'roles.id')
        //->orderBy($column, $sort)->get();
        //$ss = Request::path();
        //dd($ss);
    }
    public function oneBranch($id)
    {
        $branch = warehouse::findorfail($id);
        $connected = DB::table('resses')
        ->join('users', 'resses.user_id', '=', 'users.id')
        ->select('users.surname', 'users.lastname','resses.*')
        ->where('warehouse_id', $id)
        ->get();  
        $ressepshn = DB::table('roles')
        ->join('users', 'roles.id', '=', 'users.role_id')
        ->where('role', 'resseption')
        ->get(); 
        return view('branch.oneBranch', ['data' => $branch, 'data1' => $connected,'data2' => $ressepshn]);
        //dd($connected);
    }
    public function deleteOneBranch($id)
    {
        $branch = warehouse::findorfail($id);
        $connected = DB::table('resses')->where('warehouse_id', $id)->get();
        foreach ($connected as $value) {
            $delete = $value->id;
            $res = ress::findorfail($delete);
            $res->delete();
          }
        $branch->delete();
        return redirect()->route('allBranchs', ['Kod', 'asc']);
        //dd($connected);
    }
    public function newBranch()
    {
        $manager = DB::table('roles')
        ->join('users', 'roles.id', '=', 'users.role_id')
        ->where('role', 'manager')
        ->get();
        $zavsklad = DB::table('roles')
        ->join('users', 'roles.id', '=', 'users.role_id')
        ->where('role', 'zavsklad')
        ->get();
        $branchmanager = DB::table('roles')
        ->join('users', 'roles.id', '=', 'users.role_id')
        ->where('role', 'branchmanager')
        ->get();

        return view('branch.newBranch', ['data1' => $manager, 'data2' => $zavsklad, 'data3' => $branchmanager]);
        //dd($zavsklad);
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
        return redirect()->route('allBranchs', ['Kod', 'asc']);
    }
    public function editOneBranch($id)
    {
        //гет
        $branch = warehouse::findorfail($id);
        $manager = DB::table('roles')
        ->join('users', 'roles.id', '=', 'users.role_id')
        ->where('role', 'manager')
        ->get();
        $zavsklad = DB::table('roles')
        ->join('users', 'roles.id', '=', 'users.role_id')
        ->where('role', 'zavsklad')
        ->get();
        $branchmanager = DB::table('roles')
        ->join('users', 'roles.id', '=', 'users.role_id')
        ->where('role', 'branchmanager')
        ->get();

        return view('branch.editOneBranch', ['data1' => $manager, 'data2' => $zavsklad, 'data3' => $branch, 'data4' => $branchmanager]);
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
        $ressepshn = new ress();
        $ressepshn->warehouse_id = $id;
        $ressepshn->user_id = $req->user_id;
        $ressepshn->save();
        return redirect()->route('oneBranch', $id);
    }

    public function deleteUserBranch($id)
    {
        $ressepshn = ress::findorfail($id);
        $onebranch = $ressepshn->warehouse_id;
        $ressepshn->delete();
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
        $status = status::findorfail($id);
        $status->delete();
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
        $status = answaer::findorfail($id);
        $status->delete();
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
        $spare = sparepart::where('sap_kod', $sap);
        $spare->delete();
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
            $file = $req->file('import');
            $result = Excel::import(new SpareImport, $file);
            return redirect()->route('sparePart');
        }
        return redirect()->route('sparePart');
    }

}
