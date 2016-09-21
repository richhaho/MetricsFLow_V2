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
use App\LeadSegmenting as LeadSegmenting;
use Session;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        
    }

    public function show() 
    {
        $client_id='013';

        $action_item = ActionItem::where('client_id', $client_id)->orderBy('DateDetected', 'DESC')->take(1)->get();
        $error404detected = ErrorDetected::where('client_id', $client_id)->orderBy('DateConceived', 'DESC')->take(1)->get();

        $active_leads_count = ActiveLeads::where('client_id', $client_id)->sum('Value');
        $active_leads = ActiveLeads::where('client_id', $client_id)->orderBy('Value', 'DESC')->take(6)->get();

        $Awareness = LeadProgression::where('client_id', $client_id)->sum('Awareness');
        $Engaged = LeadProgression::where('client_id', $client_id)->sum('Engaged');
        $Considering = LeadProgression::where('client_id', $client_id)->sum('Considering');
        $Converted = LeadProgression::where('client_id', $client_id)->sum('Converted');
        $sum_leadprogression=$Awareness+$Engaged+$Considering+$Converted;
        
        $Awareness_pct=round($Awareness/$sum_leadprogression*100);
        $Engaged_pct=round($Engaged/$sum_leadprogression*100);
        $Considering_pct=round($Considering/$sum_leadprogression*100);
        $Converted_pct=round($Converted/$sum_leadprogression*100);
        
        return view('dashboard',
            [  
              'client_id'=>$client_id,  
              'action_item'=>$action_item,
              'error404detected'=>$error404detected[0],
              'active_leads_count'=>$active_leads_count,  
              'active_leads'=>$active_leads,

              'Awareness_pct'=>$Awareness_pct,
              'Engaged_pct'=>$Engaged_pct,
              'Considering_pct'=>$Considering_pct,
              'Converted_pct'=>$Converted_pct,
            ]);


    }

    public function newLeadConverted() 
    { 
        $clientID = Input::get('clientID');
        $data['newLeadConverted'] = ActionItem::select('TotalSessions','EngagementLevel','DateDetected','client_id')->where('client_id', $clientID)->orderBy('DateDetected', 'DESC')->first();
        
        $data['newLeadConverted']['DateDetected'] = date("M d, Y",strtotime($data['newLeadConverted']['DateDetected']));
        return response()->json($data);
    }

    public function errorDetectedInCampaign() 
    { 
        $clientID = Input::get('clientID');
        $data['errorDetectedInCampaign'] = ErrorDetected::where('client_id', $clientID)->orderBy('DateConceived', 'DESC')->first();
        
        $data['errorDetectedInCampaign']['DateConceived'] = date("M d, Y",strtotime($data['errorDetectedInCampaign']['DateConceived']));
        return response()->json($data);
    }

    public function activeLeads() 
    { 
        $clientID = Input::get('clientID');

        $data['activeLeadsCnt'] = ActiveLeads::where('client_id', $clientID)->sum('Value');
        $data['activeLeads'] = ActiveLeads::where('client_id', $clientID)->orderBy('Value', 'DESC')->take(6)->get();

        return response()->json($data);
    }
 
    public function leadProgression() 
    { 
        $clientID = Input::get('clientID');
        $days = Input::get('days');
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));
        // $leadProgression = LeadProgression::selectRaw('sum(Awareness) as Awareness, sum(Engaged) as Engaged, sum(Converted) as Converted, sum(Considering) as Considering')->where('client_id', $clientID)
        // ->whereBetween('LastVisitDate', array($toDate, $fromDate))
        // ->first();
        // if($leadProgression->Awareness != ''){
        //     $sumLeadprogression = $leadProgression->Awareness + $leadProgression->Engaged + $leadProgression->Considering + $leadProgression->Converted;
            
        //     $data['leadProgression']['Awareness'] = round($leadProgression->Awareness / $sumLeadprogression * 100);
        //     $data['leadProgression']['Engaged'] = round($leadProgression->Engaged / $sumLeadprogression * 100);
        //     $data['leadProgression']['Considering'] = round($leadProgression->Considering / $sumLeadprogression * 100);
        //     $data['leadProgression']['Converted'] = round($leadProgression->Converted / $sumLeadprogression * 100);
        // } else {
        //     $data['leadProgression']['Awareness'] = 0.00;
        //     $data['leadProgression']['Engaged'] = 0.00;
        //     $data['leadProgression']['Considering'] = 0.00;
        //     $data['leadProgression']['Converted'] = 0.00;
        // }

        $leadProgression = LeadProgression::where('client_id', $clientID)->first();
           
        $data['leadProgression']['Awareness'] = round($leadProgression->aware_pr);
        $data['leadProgression']['Engaged'] = round($leadProgression->engaged_pr );
        $data['leadProgression']['Considering'] = round($leadProgression->considering_pr);
        $data['leadProgression']['Converted'] = round($leadProgression->converted_pr);
        

        return response()->json($data);
    }
 
    public function leadsSegmenting() 
    { 
        $clientID = Input::get('client_id');

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
