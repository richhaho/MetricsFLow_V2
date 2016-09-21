<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use DB;

use App\UserAdmin as UserAdmin;

use App\Notifications\VerifyCode;
use Illuminate\Support\Facades\Notification;

use Carbon\Carbon;
 
use Session;

class PortfolioController extends Controller
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
    public function verify(Request $request) 
    {
      $Muser = Auth::User();
      if (Auth::user()->hasRole('Admin')){
        return redirect('Portfolio');
      }
      
      $code=sha1(time()); $code=substr($code,0,6);
      $Muser->two_factor_reset_code=$code;
      $Muser->save();
       
      $Muser->notify(new VerifyCode($code));
       
      return view('auth.verify');
    }
    public function submitverify(Request $request) 
    {
      $Muser = Auth::User();
      $Muser->last_read_announcements_at=date('Y-m-d H:i:s',strtotime(Carbon::now()));
      $Muser->save();
      $verifycode=$request['verify_code'];
      if ($verifycode==$Muser->two_factor_reset_code){
        return redirect('Portfolio');
      }else{
        Session::flash('message', 'Verification code incorrect.');
        return redirect('verify');
      }
      
    }


    public function index() 
    {
        
        $day90=date('Y-m-d H:i:s',strtotime("-90 day"));
        $Muser = Auth::User();
        if ($Muser->updated_at<$day90 && $Muser->created_at<$day90){return redirect('/logout');}

        $Muser->last_read_announcements_at=date('Y-m-d H:i:s',strtotime(Carbon::now()));
        $Muser->save();       

        if (Auth::user()->hasRole('Admin')){
            $users=UserAdmin::where('client_id','!=', '999')->get();
            Session()->put('user_role', 'Admin');
            return view('adminPanel',//userslist
            [  
              'users'=>$users  
            ]);
        } 

        Session()->put('userdata', $Muser);
        //Session()->put('country', $Muser->country);
        session()->put('email', $Muser->email);
        session()->put('client_id', $Muser->client_id);
        Session()->put('user_role', 'Client');

        $user=Session('userdata');
        
        $portfolio=UserAdmin::where('portfolio', $user->portfolio)->get();

        return view('portfolio',
            [  
              'portfolio'=>$portfolio  
            ]);
    }
    ///////////////////////////////////////////////////////////////////////
    public function adminReports(Request $request) 
    {
      $client_id=$request['client_id']; 
      $Muser=UserAdmin::where('client_id', $client_id)->first();
      session()->put('client_id', $client_id);
      Session()->put('userdata', $Muser);
      session()->put('email', $Muser->email);
      Session()->put('country', $Muser->country);
      return redirect('Reports');
    }
    public function adminLeads(Request $request) 
    {
      $client_id=$request['client_id']; 
      $Muser=UserAdmin::where('client_id', $client_id)->first();
      session()->put('client_id', $client_id);
      Session()->put('userdata', $Muser);
      session()->put('email', $Muser->email);
      Session()->put('country', $Muser->country);
      return redirect('leads');
    }
    public function adminContents(Request $request) 
    {
      $client_id=$request['client_id']; 
      $Muser=UserAdmin::where('client_id', $client_id)->first();
      session()->put('client_id', $client_id);
      Session()->put('userdata', $Muser);
      session()->put('email', $Muser->email);
      Session()->put('country', $Muser->country);
      return redirect('Content');
    }
    public function adminChannels(Request $request) 
    {
      $client_id=$request['client_id']; 
      $Muser=UserAdmin::where('client_id', $client_id)->first();
      session()->put('client_id', $client_id);
      Session()->put('userdata', $Muser);
      session()->put('email', $Muser->email);
      Session()->put('country', $Muser->country);
      return redirect('Channels');
    }
    public function adminCampaigns(Request $request) 
    {
      $client_id=$request['client_id']; 
      $Muser=UserAdmin::where('client_id', $client_id)->first();
      session()->put('client_id', $client_id);
      Session()->put('userdata', $Muser);
      session()->put('email', $Muser->email);
      Session()->put('country', $Muser->country);
      return redirect('Campaigns');
    }

    public function adminAudience(Request $request) 
    {
      $client_id=$request['client_id']; 
      $Muser=UserAdmin::where('client_id', $client_id)->first();
      session()->put('client_id', $client_id);
      Session()->put('userdata', $Muser);
      session()->put('email', $Muser->email);
      Session()->put('country', $Muser->country);
      return redirect('Audience');
    }

    ///////////////////////////////////////////////////////////////////////
    public function SelectUser(Request $request) 
    {
        $user_id=$request['user_id'];
        $Muser = UserAdmin::where('id',$user_id)->first();
        
        Session()->put('userdata', $Muser);
        session()->put('email', $Muser->email);
        session()->put('client_id', $Muser->client_id);
        Session()->put('country', $Muser->country);

        $user=Session('userdata');
        
        $portfolio=UserAdmin::where('portfolio', $user->portfolio)->get();

        return view('portfolio',
            [  
              'portfolio'=>$portfolio  
            ]);
    }
    public function SelectPortfolio(Request $request){
        
        session()->put('client_id', $request['client_id']);
        return redirect('Reports');

    }

    public function BacktoPortfolio(Request $request){
        
        session()->put('client_id', 0);
        return redirect('Portfolio');

    }
     

    
}
