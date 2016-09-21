<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use DB;
use Illuminate\Support\Facades\Hash;

use App\UserAdmin as UserAdmin;
 
use Carbon\Carbon;
use Session;
use \Crypt;
use Storage;
class ProfileController extends Controller
{
    
    public function index() 
    {
        $user=Auth::user();
        return view('profile',
            [  
              'user'=>$user ,
              'client_id'=>$user->client_id
            ]);
    }

    public function profile_update(Request $request){
        $id=$request['id'];
        $user= Auth::user();
        $now=date('Y-m-d H:i',strtotime(\Carbon\Carbon::now()));
        if ($request['new_password']){
            if ($request['new_password']==$request['new_password_confirmation']){
                if (strlen($request['new_password'])>=8){
                    $user->password= bcrypt($request['new_password']);
                    $user->updated_at=$now;
                }else{
                    Session::flash('message', 'Password length must be more than 8 letters.');
                    return redirect('toProfile');
                }
            }else{
                Session::flash('message', 'Confirmation Password is incorrect. Please input same password on Confirm Password.');
                return redirect('toProfile');
            }
        }

        $user->email=$request['email'];
        $user->name=$request['username'];
        $user->save();
        
        if ($request['logo'] && $request['logo']!="" ) {
            $image=$request->file('logo');
             
            // $xfilename=$user->client_id.'.png';
            // $xpath='img/';
            // $f->storeAs($xpath,$xfilename);
            // Storage::put($xpath.$xfilename);

            $input['imagename']=$user->client_id.'.png';
            $destinationPath = public_path('/img');
            $image->move($destinationPath, $input['imagename']);
             

        }
        session()->put('Reauth', True);
        Session::flash('message', 'User Profile has been updated succesfully. ');
        return redirect('toProfile');
    }

    public function confirm(Request $request){

        if (Hash::check($request -> password,  Auth::user() ->getAuthPassword()))
        {
            session()->put('Reauth', True);
            session()->put('Retry', 0);
            Session::flash('message', 'Please Make Changes');
            return redirect ('/toProfile');
        }
        else
        {
            if (Session('Retry'))
            {
                if (Session('Retry') == 2)
                {
                    return redirect('/logout');
                }
                session()->put('Retry', Session('Retry') + 1);
                Session::flash('message', 'Incorrect Password. Please try again.');
                return redirect('/confirmProfile');
            }
            Session::flash('message', 'Incorrect Password. Please try again.');
            session()->put('Retry', 1);
            return redirect('/confirmProfile');

        }


    }

    
}
