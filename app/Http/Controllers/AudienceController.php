<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use App\Leads as Leads;
use App\AudienceSystem as AudienceSystem;
use App\up as up;

use PDF;
use Storage;
use Response;



class AudienceController extends Controller
{
    public function index()
    {
        $client_id=Session('client_id');if (!$client_id) return redirect('Portfolio');
        $user=Session('userdata');
        $languages=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Language as label'))->where('client_id', $client_id)->groupBy('Language')->orderBy('users','desc')->take(5)->get();
        $browsers=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Browser as label'))->where('client_id', $client_id)->groupBy('Browser')->orderBy('users','desc')->take(5)->get();
        $oss=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, OS as label'))->where('client_id', $client_id)->groupBy('OS')->orderBy('users','desc')->take(5)->get();
        $countrys=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Country as label'))->where('client_id', $client_id)->groupBy('Country')->orderBy('users','desc')->take(5)->get();
        $channels=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Channel as label'))->where('client_id', $client_id)->groupBy('Channel')->orderBy('users','desc')->take(5)->get();
        
        // $languages=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Language'))->where('client_id', $client_id)->groupBy('Language')->get();
        // $sum_lang=$languages->sum('users');

        // $browsers=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Browser'))->where('client_id', $client_id)->groupBy('Browser')->get();
        // $sum_brow=$browsers->sum('users');

        // $oss=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, OS'))->where('client_id', $client_id)->groupBy('OS')->get();
        // $sum_os=$oss->sum('users');

        // $countrys=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Country'))->where('client_id', $client_id)->groupBy('Country')->get();
        // $sum_country=$countrys->sum('users');



        return view('Audience', [
            'client_id'=>$client_id,
            'AudiencePage'=>'current',
            'languages'=>$languages,
            'browsers'=>$browsers,
            'oss'=>$oss,
            'countrys'=>$countrys,
            'channels'=>$channels,

            // 'languages'=>$languages,
            // 'sum_lang'=>$sum_lang,
            // 'browsers'=>$browsers,
            // 'sum_brow'=>$sum_brow,
            // 'oss'=>$oss,
            // 'sum_os'=>$sum_os,
            // 'countrys'=>$countrys,
            // 'sum_country'=>$sum_country,
        ]);
    }
    public function detail(Request $request)
    {
        $client_id=Session('client_id');if (!$client_id) return redirect('Portfolio');
        $page=$request->page;

        switch ($page){
        case 'language':    
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Language as label'))->where('client_id', $client_id)->groupBy('Language')->get();
            $sum=$items->sum('users');
            break;
        case 'browser':
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Browser as label'))->where('client_id', $client_id)->groupBy('Browser')->get();
            $sum=$items->sum('users');
            break;
        case 'os':
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, OS as label'))->where('client_id', $client_id)->groupBy('OS')->get();
            $sum=$items->sum('users');
            break;
        case 'country':
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Country as label'))->where('client_id', $client_id)->groupBy('Country')->get();
            $sum=$items->sum('users');
            break;
        case 'channel':
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Channel as label'))->where('client_id', $client_id)->groupBy('Channel')->get();
            $sum=$items->sum('users');
            break;
        }
        $pageLabel=[
            'language'=>'Language',
            'browser'=>'Browser',
            'os'=>'Operating System',
            'country'=>'Country',
            'channel'=>'Channel',
        ];

        return view('AudienceDetail', [
            'client_id'=>$client_id,
            'items'=>$items,
            'sum'=>$sum,
            'page'=>$page,
            'pageLabel'=>$pageLabel,]);
            
    }
    public function pagesDetail(Request $request)
    {
        $client_id=$request->client_id;
        $page=$request->page;

        switch ($page){
        case 'language':    
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Language as label'))->where('client_id', $client_id)->groupBy('Language')->get();
            $sum=$items->sum('users');
            break;
        case 'browser':
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Browser as label'))->where('client_id', $client_id)->groupBy('Browser')->get();
            $sum=$items->sum('users');
            break;
        case 'os':
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, OS as label'))->where('client_id', $client_id)->groupBy('OS')->get();
            $sum=$items->sum('users');
            break;
        case 'country':
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Country as label'))->where('client_id', $client_id)->groupBy('Country')->get();
            $sum=$items->sum('users');
            break;
        case 'channel':
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Channel as label'))->where('client_id', $client_id)->groupBy('Channel')->get();
            $sum=$items->sum('users');
            break;
        }
        $data['items']=$items;
        $data['sum']=$sum;
        return response()->json($data);
    }
    public function graphData(Request $request)
    {
        $client_id=$request->client_id;
        $page=$request->page;
        $period=$request->period;
        $group_period=['day'=>'SystemDate','month'=>'SystemMonth','year'=>'SystemYear'];
        $type_period=['day'=>'Y-m-d','month'=>'Y-m','year'=>'Y'];
        $due_max=['day'=>12,'month'=>12,'year'=>6];
        $date_axie=array();
        for ($d=$due_max[$period];$d>=0;$d--){
            $dt=date($type_period[$period],strtotime("-".$d." ".$period));
            $date_axie[]=$dt;
        }
        $filter_date=$group_period[$period];
        $from=date('Y-m-d H:i:00',strtotime("-".$due_max[$period]." ".$period));
 
        switch ($page){
        case 'language':    
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users,Language as label'))->where('client_id', $client_id)->groupBy('Language')->orderBy('users','desc')->take(6)->get();
            $field="Language";
            break;
        case 'browser':
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users,Browser as label'))->where('client_id', $client_id)->groupBy('Browser')->orderBy('users','desc')->take(6)->get();
            $field="Browser";
            break;
        case 'os':
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users,OS as label'))->where('client_id', $client_id)->groupBy('OS')->orderBy('users','desc')->take(6)->get();
            $field="OS";
            break;
        case 'country':
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users,Country as label'))->where('client_id', $client_id)->groupBy('Country')->orderBy('users','desc')->take(6)->get();
            $field="Country";
            break;
        case 'channel':
            $items=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users,Channel as label'))->where('client_id', $client_id)->groupBy('Channel')->orderBy('users','desc')->take(6)->get();
            $field="Channel";
            break;
        }
        $columns=array();$columns[]="Date";$columns[]="all";
        foreach ($items as $item){ $columns[]=$item->label;}
         
        $item_group=array();
        $item_counts=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, SystemTime as datetime, '.$filter_date.' as xdate, "all" as label'))->where([['client_id', $client_id],['SystemTime','>=',$from]])->groupBy($filter_date)->get();
        $item_group[]=$item_counts;
        foreach ($items as $item){
            $item_counts=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, SystemTime as datetime, '.$filter_date.' as xdate, '.$field.' as label'))->where([['client_id', $client_id],[$field,$item->label],['SystemTime','>=',$from]])->groupBy($filter_date)->get();
            $item_group[]=$item_counts;
        }
            
        $data=array();
        for ($i=0;$i<=$due_max[$period];$i++){
            $data_row=array();
            $data_row['Date']=$date_axie[$i];
            foreach ($item_group as $groups){
                $value=0;$key='';
                foreach ($groups as $group){
                    $key=$group->label;
                    if ($group->xdate==$date_axie[$i]){
                        $value=$group->users;break;
                    }
                }
                $data_row[$key]=$value;
            }
            $data[]=$data_row;

        }
        $result['columns']=$columns;
        $result['values']=$data;

        return response()->json($result);
    }

    public function Language(Request $request)
    {
        $client_id=$request->client_id;
        $languages=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Language'))->where('client_id', $client_id)->groupBy('Language')->get();
        $sum_lang=$languages->sum('users');
        $data['languages']=$languages;
        $data['sum']=$sum_lang;
        return response()->json($data);

    }
    public function Browser(Request $request)
    {
        $client_id=$request->client_id;
        $browsers=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Browser'))->where('client_id', $client_id)->groupBy('Browser')->get();
        $sum_brow=$browsers->sum('users');
        $data['browsers']=$browsers;
        $data['sum']=$sum_brow;
        return response()->json($data);
        
    }
    public function OS(Request $request)
    {
        $client_id=$request->client_id;
        $oss=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, OS'))->where('client_id', $client_id)->groupBy('OS')->get();
        $sum_os=$oss->sum('users');
        $data['oss']=$oss;
        $data['sum']=$sum_os;
        return response()->json($data);
    }
    public function Country(Request $request)
    {
        $client_id=$request->client_id;
        $countrys=AudienceSystem::select(DB::raw('count(DISTINCT e_id) as users, Country'))->where('client_id', $client_id)->groupBy('Country')->get();
        $sum_country=$countrys->sum('users');
        $data['countrys']=$countrys;
        $data['sum']=$sum_country;
        return response()->json($data);
    }

}
