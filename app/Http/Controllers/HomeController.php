<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use DB;

use App\ActionItem as ActionItem;
use App\ErrorDetected as ErrorDetected;
use App\ActiveLeads as ActiveLeads;
use App\LeadProgression as LeadProgression;
use App\NodeTransition as NodePath;
use Carbon\Carbon;
use App\LeadSegmenting as LeadSegmenting;

use Session;

class HomeController extends Controller
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
    public function show() 
    {
        $client_id=Session('client_id');if (!$client_id) return redirect('Portfolio');
        //$client_id='013';
        
        
        //$action_item = ActionItem::where('client_id', $client_id)->orderBy('DateDetected', 'DESC')->take(1)->get();
        //$error404detected = ErrorDetected::where('client_id', $client_id)->orderBy('DateConceived', 'DESC')->take(1)->get();

        // $active_leads_count = ActiveLeads::where('client_id', $client_id)->sum('Value');
        // $active_leads = ActiveLeads::where('client_id', $client_id)->orderBy('Value', 'DESC')->take(6)->get();

        // $Awareness = LeadProgression::where('client_id', $client_id)->sum('Awareness');
        // $Engaged = LeadProgression::where('client_id', $client_id)->sum('Engaged');
        // $Considering = LeadProgression::where('client_id', $client_id)->sum('Considering');
        // $Converted = LeadProgression::where('client_id', $client_id)->sum('Converted');
        // $sum_leadprogression=$Awareness+$Engaged+$Considering+$Converted;
        
        // $Awareness_pct=round($Awareness/$sum_leadprogression*100);
        // $Engaged_pct=round($Engaged/$sum_leadprogression*100);
        // $Considering_pct=round($Considering/$sum_leadprogression*100);
        // $Converted_pct=round($Converted/$sum_leadprogression*100);

        return view('dashboard',
            [  
              'client_id'=>$client_id  
            ]);
    }
    public function show_actionItem(Request $request) 
    {
      $client_id=$request->client_id;
      $action_item = ActionItem::where('client_id', $client_id)->orderBy('DateDetected', 'DESC')->first();
      return $action_item;
    }
    public function show_error404detected(Request $request) 
    {
      $client_id=$request->client_id;
      $error404detected = ErrorDetected::where('client_id', $client_id)->orderBy('DateConceived', 'DESC')->first();
      return $error404detected;
    }
    public function show_active_leads_count(Request $request) 
    {
      $client_id=$request->client_id;
      $active_leads_count = ActiveLeads::where('client_id', $client_id)->sum('Value');
      return $active_leads_count;
    }
    public function show_active_leads(Request $request) 
    {
      $client_id=$request->client_id;
      $active_leads = ActiveLeads::where('client_id', $client_id)->orderBy('Value', 'DESC')->take(6)->get();
      return $active_leads;
    }
    public function lead_progression(Request $request) 
    {
      $client_id=$request->client_id;
        // $Awareness = LeadProgression::where('client_id', $client_id)->sum('Awareness');
        // $Engaged = LeadProgression::where('client_id', $client_id)->sum('Engaged');
        // $Considering = LeadProgression::where('client_id', $client_id)->sum('Considering');
        // $Converted = LeadProgression::where('client_id', $client_id)->sum('Converted');
        // $sum_leadprogression=$Awareness+$Engaged+$Considering+$Converted;
        
        // $Awareness_pct=round($Awareness/$sum_leadprogression*100);
        // $Engaged_pct=round($Engaged/$sum_leadprogression*100);
        // $Considering_pct=round($Considering/$sum_leadprogression*100);
        // $Converted_pct=round($Converted/$sum_leadprogression*100);

        $leadProgression = LeadProgression::where('client_id', $client_id)->first();
           
        $Awareness_pct = round($leadProgression->aware_pr,1);
        $Engaged_pct= round($leadProgression->engaged_pr ,1);
        $Considering_pct = round($leadProgression->considering_pr,1);
        $Converted_pct = round($leadProgression->converted_pr,1);

        $progression= [ 
             'Awareness_pct'=>$Awareness_pct,
              'Engaged_pct'=>$Engaged_pct,
              'Considering_pct'=>$Considering_pct,
              'Converted_pct'=>$Converted_pct,
            ];
      return $progression;
    }


    public function show_nodePath(Request $request)
    {
      $client_id=$request->client_id;
      $pth="[";

    for ($i=1;$i<20;$i++){
      $nodePath=NodePath::where([['client_id', $client_id],['Node',''.$i]])->groupBy('e_id')->orderBy('Date', 'DESC')->take(6)->get();
      

      $pth=$pth.'{"path":'.$i.',"contents":[';
      for ($j=0;$j<6;$j++){
        if ($j!=5){
          $pth=$pth.'{"title":'.'"'.$nodePath[$j]->PageName.'","Prospects":'.'"'.$nodePath[$j]->prospect.'","BounceRate":"'.$nodePath[$j]->bounce.'"},';
        }else{
          $pth=$pth.'{"title":'.'"'.$nodePath[$j]->PageName.'","Prospects":'.'"'.$nodePath[$j]->prospect.'","BounceRate":"'.$nodePath[$j]->bounce.'"}]},';
        }

      }
    }
    $i=20;
      $nodePath=NodePath::where([['client_id', $client_id],['Node',''.$i]])->groupBy('e_id')->orderBy('Date', 'DESC')->take(6)->get();
      

      $pth=$pth.'{"path":'.$i.',"contents":[';
      for ($j=0;$j<6;$j++){
        if ($j!=5){
          $pth=$pth.'{"title":'.'"'.$nodePath[$j]->PageName.'","Prospects":'.'"'.$nodePath[$j]->prospect.'","BounceRate":"'.$nodePath[$j]->bounce.'"},';
        }else{
          $pth=$pth.'{"title":'.'"'.$nodePath[$j]->PageName.'","Prospects":'.'"'.$nodePath[$j]->prospect.'","BounceRate":"'.$nodePath[$j]->bounce.'"}]}';
        }

      }

      $pth=$pth.']';

      echo $pth;

    }

    public function leadsSegmenting(Request $request) 
    { 
        $clientID=$request->client_id;

        $leadsSegmenting = LeadSegmenting::selectRaw('sum(marketing_qualified_leads) as marketing_qualified, sum(   top_funnel_leads) as top_funnel, sum(returning_customers) as returning_customers')->where('client_id', $clientID)
        ->first();

        if($leadsSegmenting->marketing_qualified != ''){
            
            $data['MarketingQualified'] = $leadsSegmenting->marketing_qualified;
            $data['TopFunnel'] = $leadsSegmenting->top_funnel;
            $data['ReturningCustomers'] = $leadsSegmenting->returning_customers;
            
        } else {
            $data['MarketingQualified'] = 0;
            $data['TopFunnel'] = 0;
            $data['ReturningCustomers'] = 0;
        }
        return response()->json($data);
    }

    
}
