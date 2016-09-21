<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use App\Leads as Leads;
use App\LeadIdProg as LeadIdProg;
use App\VisitorBreakdown as VB;
use App\LeadProgression as LeadProgression;
use App\ContentConversion as ContentConversion;
use App\up as up;
use Carbon\Carbon;
use App\TopContents as TopContents;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $client_id=Session('client_id');
        if (!$client_id) return redirect('Portfolio');
        $e_id=$request->e_id;
        $lastseen = $request->lastseen;

        return view('LeadID', [
            'client_id'=>$client_id,
            'e_id' => $e_id,
            'lastseen' => $lastseen
        ]);
    }
    public function clickmap(Request $request)
    {
        $client_id=Session('client_id');
        if (!$client_id) return redirect('Portfolio');
        $leadID=$request->leadID;
        $PageURL=$request->PageURL;
        $PostDate=$request->Date;
        $date = Carbon::now();
        $date->subDays(30);
        //$current_contents=TopContents::where('PageName', $PageName)->where('PageURL', $PageURL)->orderBy('Date','DESC')->take(1)->get();
        $turl = 'https://'. $PageURL;
        if ($PostDate == 'repage')
        {
            $PostDate = $current_contents[0] -> Date;
        }
        return view('LeadID_clickmap', [
            'client_id'=>$client_id,
            'leadID' => $leadID,
            'PageURL' => $PageURL,
            'PostDate' => $PostDate,
            'turl' => $turl,
        ]);
    }

    public function getLeadID(Request $request){

        $client_id = Input::get('clientID');
        $days = Input::get('days');
        $e_id=Input::get('e_id');
        $leadinfo = Leads::where('e_id', $e_id) -> where('last_seen', $days)-> take(1) ->get();
        return response()->json($leadinfo);
    }

    public function getLeadData(Request $request)
    {
        $client_id = Input::get('clientID');
        $e_id=Input::get('e_id');
        $a = "input_eid=". $e_id ;

//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_URL,"http://staging2.metricsflow.com:8080/lead");
//        curl_setopt($curl, CURLOPT_POST, 1);
//        curl_setopt($curl, CURLOPT_POSTFIELDS,
//            $a);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//
//        $resp = curl_exec($curl);
//
//        curl_close ($curl);
//        $resp = json_decode($resp);
        $a = 'Path_To_Conversion_DEDUPED_';
        $e = $e_id.'%';
        $data = up::where('client_id',$client_id) -> where('e_id_SESSION_WISE', 'like', $e) -> orderBy('Total_Pages_till_Path_To_Conversion_DEDUPED', 'DESC')-> where('Channel_New', '!=' , 'NULL')-> take(5)-> get(['Channel_New','conversion_page_e_id_SESSION_WISE',$a.'01',$a.'02',$a.'03',$a.'04',$a.'05',$a.'06',$a.'07',$a.'08',$a.'08',$a.'10']);
        return response() -> json($data);
    }

    public function getLeadsData()
    {
        $client_id=Session('client_id');
        if (!$client_id) return redirect('Portfolio');
        $leads_10 = Leads::where('client_id', $client_id)->distinct('e_id')->groupBy('e_id')->orderBy('last_seen', 'DESC')->take(100)->get();

            foreach ($leads_10 as $lead) {
                $recentLeads['LeadList'][] = array(
                    'UserID' => $lead->e_id,
                    'LastSeen' => $lead->last_seen,
                    'Channel' => $lead->channel,
                    'LatestContent' => $lead->title,
                    'URL' => $lead->url,
                    'Stage' => $lead->stage
                );
            }
            if (!isset($recentLeads)) $recentLeads['LeadList']=[];


        return view('leads', [
            'client_id'=>$client_id,
            'recentLeads' => $recentLeads
        ]);
    }

    public function leadsFunnel()
    {
        $client_id = Input::get('clientID');
        $days = Input::get('days');

        $lf = VB::where('client_id', $client_id) -> where('Days',$days) -> get();


        $data['barChart1'][] = array(
                                    'SessionTitle' => 'Total Users',
                                    'TotalSession' => $lf[0] -> TotalUniqueusers,
                                    'SessionPer' => 100,
                                    'SessionColor' => '#fc5d56'
                                );
        $data['barChart1'][] = array(
                                    'SessionTitle' => 'Engaged Users',
                                    'TotalSession' => $lf[0] -> return60,
                                    'SessionPer' => (($lf[0] -> return60 * 100) / $lf[0] -> TotalUniqueusers),
                                    'SessionColor' => '#327aba'
                                );
        $data['barChart1'][] = array(
                                    'SessionTitle' => 'Converted Users',
                                    'TotalSession' => $lf[0] -> UniqueConverions,
                                    'SessionPer' => (($lf[0] -> UniqueConverions * 100) / $lf[0] -> TotalUniqueusers),
                                    'SessionColor' => '#31ca6a'
                                );

        return response()->json($data);
    }

    public function getLeadIdProg(Request $request){
        $client_id = Input::get('clientID');
        $e_id=Input::get('e_id');
        $top = Input::get('days1');
        $ls =Input::get('days');

        $top_Awareness = LeadIdProg::selectRaw('PageName,Date,PageURL, Stage')->where([['Stage','aware'],['e_id',$e_id]])->orderBy('Date','DESC')->take($top)->get();
        $data['AwarenessData']=[];


        foreach ($top_Awareness as $key => $content){

            $data['AwarenessData'][] = array(
                'PageName' =>  $content->PageName,
                'Date' => $content->Date,
                'PageURL' =>  $content->PageURL,
                'Stage' =>  $content->Stage
            );
        }


        $top_Engagement = LeadIdProg::selectRaw('PageName,Date,PageURL, Stage')->where([['Stage','engaged'],['e_id',$e_id]])->orderBy('Date','DESC')->take($top)->get();
        $data['EngagementData']=[];

        foreach ($top_Engagement as $key => $content){

            $data['EngagementData'][] = array(
                'PageName' =>  $content->PageName,
                'Date' => $content->Date,
                'PageURL' =>  $content->PageURL,
                'Stage' =>  $content->Stage
            );
        }


        $top_Consideration = LeadIdProg::selectRaw('PageName,Date,PageURL, Stage')->where([['Stage','considering'],['e_id',$e_id]])->orderBy('Date','DESC')->take($top)->get();
        $data['ConsiderationData']=[];

        foreach ($top_Consideration as $key => $content){

            $data['ConsiderationData'][] = array(
                'PageName' =>  $content->PageName,
                'Date' => $content->Date,
                'PageURL' =>  $content->PageURL,
                'Stage' =>  $content->Stage
            );
        }

        $top_Conversion = LeadIdProg::selectRaw('PageName,Date,PageURL, Stage')->where([['Stage','converted'],['e_id',$e_id]])->orderBy('Date','DESC')->take($top)->get();
        $data['ConversionData']=[];

        foreach ($top_Conversion as $key => $content){

            $data['ConversionData'][] = array(
                'PageName' =>  $content->PageName,
                'Date' => $content->Date,
                'PageURL' =>  $content->PageURL,
                'Stage' =>  $content->Stage
            );
        }

        return response()->json($data);

    }

    public function leadsBreakdown()
    {
        $client_id = Input::get('clientID');
        $days = Input::get('days');
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));
        
        $Date = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));
        $x = 0; 


        $barchart2 = Leads::select(DB::raw('count(e_id) as count, count(DISTINCT e_id) as visitors'),'Date')->where([['client_id', $client_id]])
        ->whereBetween('Date', array($toDate, $fromDate))
        ->groupBy('Date')
        ->get();

        $leads = array();$visitors  = array();
        foreach ($barchart2 as $key => $value) {
            $leads[$value->Date] = $value->count;
            $visitors[$value->Date] = $value->visitors;
        }
        
        while (strtotime($Date) <= strtotime($fromDate)) {
          
                $addStr = '';
                if($x == 0 || $x == $days)
                    $addStr = substr(date("M",strtotime($Date)), 0, 1);

                $data['totalVisitsUniqueLeads'][] = array(
                                                        'y' => $addStr.date("d",strtotime($Date)),
                                                        'a' => array_key_exists($Date, $leads)?$leads[$Date]:0, //$barchart->count,
                                                        'b' => array_key_exists($Date, $visitors)?$visitors[$Date]:0 //$barchart->visitors
                                                    );
                $Date = date ("Y-m-d", strtotime("+1 day", strtotime($Date)));

                $x++;
        }

     
        $OS_windows_counts = Leads::select(DB::raw('count(DISTINCT e_id) as ct'))->where([['client_id', $client_id],['OS_name','Windows']])
        ->where('Date','>', $toDate)
        ->first();
        $OS_windows_count=$OS_windows_counts->ct;

        $OS_mac_counts = Leads::select(DB::raw('count(DISTINCT e_id) as ct'))->where([['client_id', $client_id],['OS_name','Mac']])
        ->where('Date','>', $toDate)
        ->first();
        $OS_mac_count=$OS_mac_counts->ct;

        $OS_ios_counts = Leads::select(DB::raw('count(DISTINCT e_id) as ct'))->where([['client_id', $client_id],['OS_name','iOS']])
        ->where('Date','>', $toDate)
        ->first();
        $OS_ios_count=$OS_ios_counts->ct;

        $OS_android_counts = Leads::select(DB::raw('count(DISTINCT e_id) as ct'))->where([['client_id', $client_id],['OS_name','Android']])
        ->where('Date','>', $toDate)
        ->first();
        $OS_android_count=$OS_android_counts->ct;

        $data['osUsage'][] = array(
                                    'value' => $OS_windows_count,
                                    'color' => '#3c8dbc',
                                    'highlight' => '#3c8dbc',
                                    'label' => 'Windows OS'
                                );

        $data['osUsage'][] = array(
                                    'value' => $OS_mac_count,
                                    'color' => '#dd4b39',
                                    'highlight' => '#dd4b39',
                                    'label' => 'Mac OSX'
                                );

        $data['osUsage'][] = array(
                                    'value' => $OS_ios_count,
                                    'color' => '#00a65a',
                                    'highlight' => '#00a65a',
                                    'label' => 'iOS'
                                );

        $data['osUsage'][] = array(
                                    'value' => $OS_android_count,
                                    'color' => '#f39c12',
                                    'highlight' => '#f39c12',
                                    'label' => 'Anroid OS'
                                );
        
       
        return response()->json($data);
    }

    public function channelsDrivingConversion()
    {
        $client_id = Input::get('clientID');
        $days = Input::get('days');
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));

        $channels_data = LeadChannel::where('client_id', $client_id)
                ->orderBy('conversionrate','DESC')->take(3)->get();

        
        
        $data['channelData1'] = array(
                                    'ChannelName' => $channels_data[0]->domainname,
                                    'ChannelText' => 'Change in Users',
                                    'IsChannelUp' => true,
                                    'ChannelPer' => $channels_data[0]->conversionrate.'%',
                                    'ConversionRate' => $channels_data[0]->conversionrate.'%',
                                    'ProspectsGenerated' => $channels_data[0]->ProspectsGenerated,
                                    'LeadConversions' => $channels_data[0]->Conversions
                                );

        $data['channelData2'] = array(
                                    'ChannelName' => $channels_data[1]->domainname,
                                    'ChannelText' => 'Change in Users',
                                    'IsChannelUp' => true,
                                    'ChannelPer' => $channels_data[1]->conversionrate.'%',
                                    'ConversionRate' => $channels_data[1]->conversionrate.'%',
                                    'ProspectsGenerated' => $channels_data[1]->ProspectsGenerated,
                                    'LeadConversions' => $channels_data[1]->Conversions
                                );

        $data['channelData3'] = array(
                                    'ChannelName' => $channels_data[2]->domainname,
                                    'ChannelText' => 'Change in Users',
                                    'IsChannelUp' => true,
                                    'ChannelPer' => $channels_data[2]->conversionrate.'%',
                                    'ConversionRate' => $channels_data[2]->conversionrate.'%',
                                    'ProspectsGenerated' => $channels_data[2]->ProspectsGenerated,
                                    'LeadConversions' => $channels_data[2]->Conversions
                                );

        return response()->json($data);
    }

    public function contentDrivingConversion()
    {
        $client_id = Input::get('clientID');
        $days = Input::get('days');
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));

        $conversion = ContentConversion::select(DB::raw('count(DISTINCT PageName) as Prospects,sum(Value) as score, PageName,PageURL, Date'))->where([['client_id', $client_id],['conversion','1']])
        ->whereBetween('Date', array($toDate, $fromDate))
        ->groupBy('PageName')->orderBy('score', 'DESC')->take(3)->get();

        $data = array();

        if(count($conversion) > 0){

            $data['contentData1'] = array(
                                        'ContentTitle' => substr($conversion[0]->PageName, 0, 20).'...',
                                        'ContentUrl' => $conversion[0]->PageURL,
                                        'ContentPer' => $conversion[0]->score,
                                        'ProspectsGenerated' => $conversion[0]->Prospects,
                                        'Posted' => date("M d, Y",strtotime($conversion[0]->Date))
                                    );
        }
        if(count($conversion) > 1){
            $data['contentData2'] = array(
                                        'ContentTitle' => substr($conversion[1]->PageName, 0, 20).'...',
                                        'ContentUrl' => $conversion[1]->PageURL,
                                        'ContentPer' => $conversion[1]->score,
                                        'ProspectsGenerated' => $conversion[1]->Prospects,
                                        'Posted' => date("M d, Y",strtotime($conversion[1]->Date))
                                    );
        }
        if(count($conversion) > 2){
            $data['contentData3'] = array(
                                        'ContentTitle' => substr($conversion[2]->PageName, 0, 20).'...',
                                        'ContentUrl' => $conversion[2]->PageURL,
                                        'ContentPer' => $conversion[2]->score,
                                        'ProspectsGenerated' => $conversion[2]->Prospects,
                                        'Posted' => date("M d, Y",strtotime($conversion[2]->Date))
                                    );
        }
        return response()->json($data);
    }

    public function lead_progression(Request $request)
    {
        $client_id=$request->client_id;

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
}
