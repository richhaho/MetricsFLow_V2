<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use App\Leads as Leads;
use App\TotalConvertReporting as TotalConvertReporting;

use App\ConversionBySite as ConversionBySite;
use App\ABMaggregate as AccountBasedMarketing;
use App\ABMCVDetails as ABMCVDetails;
use App\VisitorBreakdown as VisitorBreakdown;

use App\UniqueIdReporting as UniqueIdReporting;
use App\ContentActivitiesReporting as ContentActivitiesReporting;
use App\ConversionReporting as ConversionReporting;

use App\ConversionForms as ConversionForms;
use App\ConversionPages as ConversionPages;

use App\up as up;
use App\up_esr as up_esr;

use PDF;
use Storage;
use Response;



class ReportController extends Controller
{
    public function index()
    {
        $client_id=Session('client_id');
        if (!$client_id) return redirect('Portfolio');
        $user=Session('userdata');
        return view('reports', [
            'client_id'=>$client_id,
            'portfolio_id'=>$user->portfolio,

        ]);
    }

    public function detail()
    {
        $client_id=Session('client_id');
        if (!$client_id) return redirect('Portfolio');
        return view('reports_detail', [
            'client_id'=>$client_id,
        ]);
    }

    public function ReportsPDF(){
        $client_id=Session('client_id');
        $user=Session('userdata');
        
        $days=[10,20,30,60,90,1000];
        $fromDate = date("Y-m-d");
        
        for ($i=0;$i<6;$i++){
            ///////////// For conversion overview

            $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days[$i].' days'));
            $conversionOverview[$days[$i]]=TotalConvertReporting::where([['client_id',$client_id],['SystemTime','>',$toDate]])->sum('freq');
            
            ///////////// For Vistor Breakdown
            $day=$days[$i];if ($i==5) $day=0;
            $visitors=VisitorBreakdown::where('client_id',$client_id)->where('Days',$day)->first();
            if ($visitors){
                $visitors_breakdown['TotalUniqueIDs'][$days[$i]] = $visitors->TotalUniqueusers;
                $visitors_breakdown['UniqueIDsBlockingCookies'][$days[$i]] = $visitors->UniqueIDBlockCookies;
                $visitors_breakdown['DeleteCookies'][$days[$i]] = $visitors->UniqueIDDeleteCookies;
                $visitors_breakdown['AveragePagesConsumed'][$days[$i]] = $visitors->avgses;
                $visitors_breakdown['TotalContentActivities'][$days[$i]] = $visitors->TotalContentActivities;
                $visitors_breakdown['UniqueContentActivities'][$days[$i]] = $visitors->UniqueContentActivities;
                $visitors_breakdown['TotalUniqueConversions'][$days[$i]] = $visitors->UniqueConverions;
                $visitors_breakdown['Return60'][$days[$i]] = $visitors->return60;
                $visitors_breakdown['Return30'][$days[$i]] = $visitors->return30;
            }else{
                $visitors_breakdown['TotalUniqueIDs'][$days[$i]] = 0;
                $visitors_breakdown['UniqueIDsBlockingCookies'][$days[$i]] = 0;
                $visitors_breakdown['DeleteCookies'][$days[$i]] =0;
                $visitors_breakdown['AveragePagesConsumed'][$days[$i]] = 0;
                $visitors_breakdown['TotalContentActivities'][$days[$i]] =0;
                $visitors_breakdown['UniqueContentActivities'][$days[$i]] = 0;
                $visitors_breakdown['TotalUniqueConversions'][$days[$i]] =0;
                $visitors_breakdown['Return60'][$days[$i]] = 0;
                $visitors_breakdown['Return30'][$days[$i]] = 0;
            }

            ////////////// Channel Overview
                $UniqueIds['A'][$days[$i]]=UniqueIdReporting::where('client_id',$client_id)-> where('Days', $day) ->where('flag', 'A') ->first();
                $UniqueIds['O'][$days[$i]]=UniqueIdReporting::where('client_id',$client_id)-> where('Days', $day) ->where('flag', 'O') ->first();
                $UniqueIds['PPC'][$days[$i]]=UniqueIdReporting::where('client_id',$client_id)-> where('Days', $day) ->where('flag', 'PPC') ->first();
                $UniqueIds['SE'][$days[$i]]=UniqueIdReporting::where('client_id',$client_id)-> where('Days', $day) ->where('flag', 'SE') ->first();
                $UniqueIds['EM'][$days[$i]]=UniqueIdReporting::where('client_id',$client_id)-> where('Days', $day) ->where('flag', 'EM') ->first();
                $UniqueIds['S'][$days[$i]]=UniqueIdReporting::where('client_id',$client_id)-> where('Days', $day) ->where('flag', 'S') ->first();



                $ContentActivitie['A'][$days[$i]]=ContentActivitiesReporting::where('client_id',$client_id)-> where('Days', $day)->where('flag', 'A')->first();
                $ContentActivitie['O'][$days[$i]]=ContentActivitiesReporting::where('client_id',$client_id)-> where('Days', $day)->where('flag', 'O')->first();
                $ContentActivitie['PPC'][$days[$i]]=ContentActivitiesReporting::where('client_id',$client_id)-> where('Days', $day)->where('flag', 'PPC')->first();
                $ContentActivitie['SE'][$days[$i]]=ContentActivitiesReporting::where('client_id',$client_id)-> where('Days', $day)->where('flag', 'SE')->first();
                $ContentActivitie['EM'][$days[$i]]=ContentActivitiesReporting::where('client_id',$client_id)-> where('Days', $day)->where('flag', 'EM')->first();
                $ContentActivitie['S'][$days[$i]]=ContentActivitiesReporting::where('client_id',$client_id)-> where('Days', $day)->where('flag', 'S')->first();


                $Conversion['A'][$days[$i]]=ConversionReporting::where('client_id',$client_id)-> where('Days', $day)->where('flag', 'A')->first();
                $Conversion['O'][$days[$i]]=ConversionReporting::where('client_id',$client_id)-> where('Days', $day)->where('flag', 'O')->first();
                $Conversion['PPC'][$days[$i]]=ConversionReporting::where('client_id',$client_id)-> where('Days', $day)->where('flag', 'PPC')->first();
                $Conversion['SE'][$days[$i]]=ConversionReporting::where('client_id',$client_id)-> where('Days', $day)->where('flag', 'SE')->first();
                $Conversion['EM'][$days[$i]]=ConversionReporting::where('client_id',$client_id)-> where('Days', $day)->where('flag', 'EM')->first();
                $Conversion['S'][$days[$i]]=ConversionReporting::where('client_id',$client_id)-> where('Days', $day)->where('flag', 'S')->first();

            
            }
 
 

            $ABM_detail = AccountBasedMarketing::where('client_id',$client_id)->first();



        //////////////

        $pdf=PDF::loadview('template.pdf_reports',[
            'client_id'=>$client_id,
            'portfolio_id'=>$user->portfolio,
            'days'=>$days,
            'conversionOverview'=>$conversionOverview,
            'visitors_breakdown'=>$visitors_breakdown,
            'ABM_detail'=>$ABM_detail,
            'UniqueIds'=>$UniqueIds,
            'ContentActivitie'=>$ContentActivitie,
            'Conversion'=>$Conversion,
        ])->setPaper('Letter');

        $pdf_file=$pdf->output();
        return $pdf->download('reports.pdf');
        // return Response::make( $pdf_file, 200, [
        //             'Content-Type' => 'application/pdf',
        //             'Content-Disposition' => 'inline; filename="reports.pdf"'
        //         ]);
        return view('reports', [
            'client_id'=>$client_id,
            'portfolio_id'=>$user->portfolio,

        ]);
    }
    public function warranty() //Might wanna delete this too
    {
        $client_id=Session('client_id');
        if (!$client_id) return redirect('Portfolio');

        return view('reports_warranty', [
            'client_id'=>$client_id,

        ]);
    }

    public function conversiondetails(Request $request) // Might Delete this
    {
        $PageName=$request->PageName;
        $client_id=Session('client_id');
        if (!$client_id) return redirect('Portfolio');
        return view('ConversionDetails', [
            'client_id'=>$client_id,
        ]);
    }

    // public function WarrantyDetails(Request $request)
    // {
    //     $input = Input::only('PageURL','PageName');
    //     $PageURL = $input['PageURL'];
    //     $PageName = $input['PageName'];

    //     $URL1 = parse_url($PageURL, PHP_URL_HOST);
    //     $URL2 = parse_url($PageURL, PHP_URL_PATH);

    //     $PageURL = $URL1 . '' . $URL2;
    //     $a = 'Path_To_Conversion_DEDUPED_';

    //     $client_id=Session('client_id');
    //     $data = up::where('client_id',$client_id) -> where('conversion_page_e_id_SESSION_WISE', $PageURL ) -> orderBy('Total_Pages_till_Path_To_Conversion_DEDUPED', 'DESC')-> where('Channel_New', '!=' , 'NULL')-> take(5)-> get(['Channel_New','conversion_page_e_id_SESSION_WISE',$a.'01',$a.'02',$a.'03',$a.'04',$a.'05',$a.'06',$a.'07',$a.'08',$a.'08',$a.'10']);
    //     return view('reports_warrantydetail', [
    //         'client_id'=>$client_id, 'PageName' => $PageName,'PageURL' => $PageURL, 'data' => $data
    //     ]);
    // }
    public function WarrantyDetails(Request $request)
    {
        $input = Input::only('PageURL','PageName','up_esr','channel');
        $PageURL = $input['PageURL'];
        $PageName = $input['PageName'];
        $up_esr = $input['up_esr'];
        


        $URL1 = parse_url($PageURL, PHP_URL_HOST);
        $URL2 = parse_url($PageURL, PHP_URL_PATH);

        $PageURL = $URL1 . '' . $URL2;
        $a = 'Path_To_Conversion_DEDUPED_';

        $client_id=Session('client_id');if (!$client_id) return redirect('Portfolio');
        if (!isset($input['channel'])){;

            if ($up_esr=="0"){
                $data = up::where('client_id',$client_id) -> where('conversion_page_e_id_SESSION_WISE', $PageURL ) -> orderBy('Total_Pages_till_Path_To_Conversion_DEDUPED', 'DESC')-> where('Channel_New', '!=' , 'NULL')-> take(5)-> get(['Channel_New','conversion_page_e_id_SESSION_WISE',$a.'01',$a.'02',$a.'03',$a.'04',$a.'05',$a.'06',$a.'07',$a.'08',$a.'08',$a.'10']);
            }
            if ($up_esr=="1"){
                $data = up_esr::where('client_id',$client_id) -> where('conversion_page_e_id_SESSION_WISE', $PageURL ) -> orderBy('Total_Pages_till_Path_To_Conversion_DEDUPED', 'DESC')-> where('Channel_New', '!=' , 'NULL')-> take(5)-> get(['Channel_New','conversion_page_e_id_SESSION_WISE',$a.'01',$a.'02',$a.'03',$a.'04',$a.'05',$a.'06',$a.'07',$a.'08',$a.'08',$a.'10']);
            }
            if ($up_esr=="2"){
                $data = up_esr::where('client_id',$client_id) -> where('conversion_page_e_id_SESSION_WISE', $PageURL ) -> orderBy('Total_Pages_till_Path_To_Conversion_DEDUPED', 'DESC')-> where('Channel_New', '!=' , 'NULL')-> take(5)-> get(['Channel_New','conversion_page_e_id_SESSION_WISE',$a.'01',$a.'02',$a.'03',$a.'04',$a.'05',$a.'06',$a.'07',$a.'08',$a.'08',$a.'10']);
            }
        }else{
            if ($input['channel']=='all'){
                if ($up_esr=="0"){
                    $data = up::where('client_id',$client_id) -> where('conversion_page_e_id_SESSION_WISE', $PageURL ) -> orderBy('Total_Pages_till_Path_To_Conversion_DEDUPED', 'DESC')-> where('Channel_New', '!=' , 'NULL')-> take(5)-> get(['Channel_New','conversion_page_e_id_SESSION_WISE',$a.'01',$a.'02',$a.'03',$a.'04',$a.'05',$a.'06',$a.'07',$a.'08',$a.'08',$a.'10']);
                }
                if ($up_esr=="1"){
                    $data = up_esr::where('client_id',$client_id) -> where('conversion_page_e_id_SESSION_WISE', $PageURL ) -> orderBy('Total_Pages_till_Path_To_Conversion_DEDUPED', 'DESC')-> where('Channel_New', '!=' , 'NULL')-> take(5)-> get(['Channel_New','conversion_page_e_id_SESSION_WISE',$a.'01',$a.'02',$a.'03',$a.'04',$a.'05',$a.'06',$a.'07',$a.'08',$a.'08',$a.'10']);
                }
                if ($up_esr=="2"){
                    $data = up_esr::where('client_id',$client_id) -> where('conversion_page_e_id_SESSION_WISE', $PageURL ) -> orderBy('Total_Pages_till_Path_To_Conversion_DEDUPED', 'DESC')-> where('Channel_New', '!=' , 'NULL')-> take(5)-> get(['Channel_New','conversion_page_e_id_SESSION_WISE',$a.'01',$a.'02',$a.'03',$a.'04',$a.'05',$a.'06',$a.'07',$a.'08',$a.'08',$a.'10']);
                }
            }else{
                if ($up_esr=="0"){
                    $data = up::where('client_id',$client_id) ->where('Channel',$input['channel']) -> where('conversion_page_e_id_SESSION_WISE', $PageURL ) -> orderBy('Total_Pages_till_Path_To_Conversion_DEDUPED', 'DESC')-> where('Channel_New', '!=' , 'NULL')-> take(5)-> get(['Channel_New','conversion_page_e_id_SESSION_WISE',$a.'01',$a.'02',$a.'03',$a.'04',$a.'05',$a.'06',$a.'07',$a.'08',$a.'08',$a.'10']);
                }
                if ($up_esr=="1"){
                    $data = up_esr::where('client_id',$client_id)->where('Channel',$input['channel']) -> where('conversion_page_e_id_SESSION_WISE', $PageURL ) -> orderBy('Total_Pages_till_Path_To_Conversion_DEDUPED', 'DESC')-> where('Channel_New', '!=' , 'NULL')-> take(5)-> get(['Channel_New','conversion_page_e_id_SESSION_WISE',$a.'01',$a.'02',$a.'03',$a.'04',$a.'05',$a.'06',$a.'07',$a.'08',$a.'08',$a.'10']);
                }
                if ($up_esr=="2"){
                    $data = up_esr::where('client_id',$client_id)->where('Channel',$input['channel']) -> where('conversion_page_e_id_SESSION_WISE', $PageURL ) -> orderBy('Total_Pages_till_Path_To_Conversion_DEDUPED', 'DESC')-> where('Channel_New', '!=' , 'NULL')-> take(5)-> get(['Channel_New','conversion_page_e_id_SESSION_WISE',$a.'01',$a.'02',$a.'03',$a.'04',$a.'05',$a.'06',$a.'07',$a.'08',$a.'08',$a.'10']);
                }
            }
        }
        $channel=up::where('client_id',$client_id) -> where('conversion_page_e_id_SESSION_WISE', $PageURL )-> where('Channel_New', '!=' , 'NULL')->groupBy('Channel')->get()->pluck('Channel','Channel')->prepend('All Channel','all');
        return view('reports_warrantydetail', [
            'client_id'=>$client_id, 'PageName' => $PageName,'PageURL' => $PageURL, 'data' => $data,'up_esr'=>$up_esr,'channel'=>$channel

        ]);
    }

    public function getTotalConvertReporting()
    {
        $client_id = Input::get('clientID');
        $days = Input::get('days');

        if ($days != 0)
        {
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));

        $conversionOverview=TotalConvertReporting::where([['client_id',$client_id],['SystemTime','>',$toDate]])->orderBy('SystemTime')->get();
        return response()->json($conversionOverview);
        }
        else
        {
            $conversionOverview=TotalConvertReporting::where('client_id',$client_id) -> where('Year','!=','NULL')->orderBy('Year','ASC')->get(['client_id','Year AS SystemTime','yfreq AS freq']) ;
            return response()->json($conversionOverview);

        }

    }

    public function getConversionBySite()
    {
        $client_id = Input::get('clientID');
        $days = Input::get('days');
        
        $portfolio_id = Input::get('portfolioID');
        //$days=0;
        $Conversion_Site=ConversionBySite::where('Portfolio',$portfolio_id)->where('Days',$days)->where('Site','!=','N/A')->orderBy('freq','desc')->take(4)->get();

        return response()->json($Conversion_Site);
    }

    public function getVisitorsBreakdown()
    {
        $client_id = Input::get('clientID');
        $days = Input::get('days');
        //$days=0;
        $visitors=VisitorBreakdown::where('client_id',$client_id)->where('Days',$days)->first();
        $data['TotalUniqueIDs'] = $visitors->TotalUniqueusers;
        $data['UniqueIDsBlockingCookies'] = $visitors->UniqueIDBlockCookies;
        $data['DeleteCookies'] = $visitors->UniqueIDDeleteCookies;
        $data['AveragePagesConsumed'] = $visitors->avgses;
        $data['TotalContentActivities'] = $visitors->TotalContentActivities;
        $data['UniqueContentActivities'] = $visitors->UniqueContentActivities;
        $data['TotalUniqueConversions'] = $visitors->UniqueConverions;
        $data['Return60'] = $visitors->return60;
        $data['Return30'] = $visitors->return30;

        return response()->json($data);
    }

    public function getChannelOverview()
    {
        $client_id = Input::get('clientID');
        $days = Input::get('days');
        //$days=0;
        $UniqueIds=UniqueIdReporting::where('client_id',$client_id)-> where('Days', $days) ->get();
        $ContentActivitie=ContentActivitiesReporting::where('client_id',$client_id)-> where('Days', $days)->get();
        $Conversion=ConversionReporting::where('client_id',$client_id)-> where('Days', $days)->get();

        $data['UniqueIds'] = $UniqueIds;
        $data['ContentActivitie'] = $ContentActivitie;
        $data['Conversion'] = $Conversion;

        return response()->json($data);
    }

    public function getConversionDetails(){
        $client_id = Input::get('clientID');

        // $days = Input::get('days');
        // $fromDate = date("Y-m-d");
        // $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));

        $conversion_forms=ConversionForms::where('client_id',$client_id)->orderBy('Conversions','desc')->get();
        $conversion_pages=ConversionPages::where('client_id',$client_id)->orderBy('Value','desc')->get();

        $data['ConversionForms'] = $conversion_forms;
        $data['ConversionPages'] = $conversion_pages;

        return response()->json($data);
    }

    public function getAccountBasedMarketing(){
        $client_id = Input::get('clientID');
        $abm_details = AccountBasedMarketing::where('client_id',$client_id)->get();

        return response()->json($abm_details);

    }

    public function getABMCVDetails(){
        $client_id = Input::get('clientID');
        $abm_cvdetails = ABMCVDetails::where('client_id',$client_id)->where('domain','!=','')->get();

        return response()->json($abm_cvdetails);

    }

}
