<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use DB;

use App\UserAdmin as UserAdmin;
use App\User;
use App\Role;
use App\UserRole;

use App\Notifications\VerifyCode;
use Illuminate\Support\Facades\Notification;

use Carbon\Carbon;
 
use Session;

class UserManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
   

    public function index() 
    {
        $Muser = Auth::User();
        if (!$Muser->hasRole('Admin')) return redirect('Portfolio'); 
        $users=UserAdmin::get();
        return view('userManagement',
        [  
          'users'=>$users  
        ]);
  
    }

    public function create(Request $request) 
    {
        $data=$request->all();
        $now=date('Y-m-d H:i:s',strtotime(Carbon::now()));
        $user = UserAdmin::create($data);
        
        $user->country=$data['country'];
        $user->status=$data['status'];
        $user->portfolio=$data['portfolio'];
        $user->created_at=$now;
        $user->password=bcrypt($data['password']);
        $user->save();
        $role=Role::where('name',$data['role'])->first();
        $role_data=[
          'role_id'=>$role->id,
          'user_id'=>$user->id,
          'client_name'=>$user->name
        ];

        $user_role=UserRole::create($role_data);
        $user_role->created_at=$now;
        $user_role->save();

        if ($request['logo'] && $request['logo']!="" ) {
            $image=$request->file('logo');
            $input['imagename']=$user->client_id.'.png';
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $input['imagename']);
        } 
        return redirect('userManagement');
    }

    public function update(Request $request) 
    {
        $data=$request->all();
        $now=date('Y-m-d H:i:s',strtotime(Carbon::now()));
        $user = UserAdmin::where('id',$request->id)->first();
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->client_id=$data['client_id'];
        $user->country=$data['country'];
        $user->status=$data['status'];
        $user->portfolio=$data['portfolio'];
        $user->updated_at=$now;
        $user->save();
        $role=Role::where('name',$data['role'])->first();
        $user_role=$user->user_role();
        $user_role->role_id=$role->id;
        $user_role->client_name=$user->name;
        $user_role->updated_at=$now;
        $user_role->save();
        return redirect('userManagement');
    }
    public function updatepassword(Request $request) 
    {
        $data=$request->all();
        $now=date('Y-m-d H:i:s',strtotime(Carbon::now()));
        $user = UserAdmin::where('id',$request->id)->first();
        $user->password=bcrypt($data['password']);
        $user->updated_at=$now;
        $user->save();
        return redirect('userManagement');
    }
    public function updatelogo(Request $request) 
    {
        $data=$request->all();
        $now=date('Y-m-d H:i:s',strtotime(Carbon::now()));
        $user = UserAdmin::where('id',$request->id)->first();
        if ($request['logo'] && $request['logo']!="" ) {
            $image=$request->file('logo');
            $input['imagename']=$user->client_id.'.png';
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $input['imagename']);
        } 
        $user->updated_at=$now;
        $user->save();
        return redirect('userManagement');
    }
    public function remove(Request $request) 
    {
        $data=$request->all();
        $user = UserAdmin::where('id',$request->id)->first();
        $user_role=$user->user_role();
        $user_role->delete();
        $user->delete();
        return redirect('userManagement');
    }
    public function login(Request $request) 
    {
        $data=$request->all();
        $Muser = User::where('id',$request->id)->first();
        // Auth::logout();
        // Auth::login($user); 
        // return redirect('userManagement');
        
        Session()->put('userdata', $Muser);
        session()->put('email', $Muser->email);
        session()->put('client_id', $Muser->client_id);
        Session()->put('country', $Muser->country);
        Session()->put('user_role', 'Admin_user_manage');

        $user=Session('userdata');
        
        return redirect('Reports');
    }
    

    public function BacktoAdminPanel(Request $request){
        
        session()->put('client_id', 0);
        return redirect('Portfolio');

    }
     

    
}
