<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use App\Leads as Leads;
use App\TopContents as TopContents;
use App\ContentTopEntry as ContentTopEntry;
use App\ContentActionItem as ContentActionItem;
use App\ContentsDetail;
use App\ClickMap as ClickMap;
use App\Caware as Caware;
use App\Ccons as Ccons;
use App\Cconv as Cconv;
use App\Ceng as Ceng;
use Carbon\Carbon;

 

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $client_id=Session('client_id');
        if (!$client_id) return redirect('Portfolio');
        $PageName=$request->PageName;
        $PageURL=$request->PageURL;

        $PostDate=$request->Date;

        $date = Carbon::now();
        $date->subDays(30);
        $current_contents=ContentsDetail::where('PageName', $PageName)->where('PageURL', $PageURL)->take(1)->get();
         

//        $topentrys=ContentTopEntry::where('PageName', $PageName)->where('PageURL', $PageURL)->orderBy('Date')->get();
//        $dategroup=ContentTopEntry::where('PageName', $PageName)->where('PageURL', $PageURL)->orderBy('Date')->groupBy('Date')->get();



//        $clicks=ClickMap::where([['PageName', $PageName],['client_id',$client_id]])->take(500)->get();


        $turl = 'https://'. $PageURL;

        if ($PostDate == 'repage')
        {
            $PostDate = $current_contents[0]->Date;
        }

        return view('ContentDetail', [
            'client_id'=>$client_id,
            'PageName' => $PageName,
            'PageURL' => $PageURL,
            'PostDate' => $PostDate,
//            'current_contents'=>$current_contents,
            'turl' => $turl,
            /*'contents_score'=>$contents_score,*/
//            'clicks'=>$clicks,

//            'topentrys'=>$topentrys,
//            'dategroup'=>$dategroup,
        ]);
    }

    

    public function ShowContents()
    {
        $client_id=Session('client_id');
        if (!$client_id) return redirect('Portfolio');
        // $contents = TopContents::where('client_id', $client_id)->orderBy('index', 'DESC')->take(30)->get();
        $contents = ContentsDetail::where('client_id', $client_id)->orderBy('Date', 'DESC')->take(30)->get();

        // $bcontents = TopContents::where('client_id', $client_id)->orderBy('Value','DESC')-> orderBy('Date','DESC') ->take(3)->get();
        // $lcontents = TopContents::where('client_id', $client_id)-> where('PageURL','not like','%localhost%')->orderBy('Value','ASC') -> orderBy('Date','DESC')->take(3)->get();

        $bcontents = TopContents::where('client_id', $client_id)->orderBy('score','DESC')->take(3)->get();
        $lcontents = TopContents::where('client_id', $client_id)-> where('PageURL','not like','%localhost%')->orderBy('score','ASC')->take(3)->get();

        $days='90';
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));
 
        $clicks=ClickMap::where('client_id',$client_id)->where('SystemDate','>',$toDate)->groupBy('parsedPageURL')->orderBy('SystemDate','desc')->get();  

//        $top_contents_Awareness = TopContents::selectRaw('PageName,Date,score,PageURL, Value as sum,round(avg(score),1) as avgscore')->where([['client_id', $client_id],['Stage','Awareness']])->groupBy('PageName')->orderBy('score','DESC')->take(6)->get();
//        $top_contents_Engagement = TopContents::selectRaw('PageName,Date,score,PageURL, Value as sum,round(avg(score),1) as avgscore')->where([['client_id', $client_id],['Stage','Engaged']])->groupBy('PageName')->orderBy('score', 'DESC')->take(6)->get();
//        $top_contents_Consideration = TopContents::selectRaw('PageName,Date,score,PageURL, Value as sum,round(avg(score),1) as avgscore')->where([['client_id', $client_id],['Stage','Consideration']])->groupBy('PageName')->orderBy('score', 'DESC')->take(6)->get();
//        $top_contents_Conversion = TopContents::selectRaw('PageName,Date,score,PageURL, Value as sum,round(avg(score),1) as avgscore')->where([['client_id', $client_id],['Stage','Conversion']])->groupBy('PageName')->orderBy('score', 'DESC')->take(6)->get();
        
        return view('Content', [
            'client_id'=>$client_id,
            'contents' => $contents,
            'bcontents' => $bcontents,
            'lcontents' => $lcontents,
            'clicks' => $clicks,

        ]);
    }

    public function performance(Request $request)
    {
        $clientID = Session('client_id');
        $days = Input::get('days');
        $fromDate = date("Y-m-d");
        $PageName=$request->PageName;
        $PageURL = $request->PageURL;
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));

        $current_contents = ContentTopEntry::select('PageName', 'Date', DB::raw('sum(freq) as freq'))->where([['client_id', $clientID],['PageName', $PageName],['PageURL', $PageURL]])->groupBy(DB::raw('PageName, Date'))->orderBy('Date','DESC')->get();
//        $topentrys = ContentTopEntry::select('*', DB::raw('count(domainname) as topentry'))->where('PageName', $PageName)->groupBy('domainname')->groupBy(DB::raw('YEAR(Date)'))->groupBy(DB::raw('MONTH(Date)'))->orderBy(DB::raw('count(domainname)'))->get();
//        $contents_score = TopContents::where('PageName', $PageName)->sum('score');

        $contents = array();
        foreach ($current_contents as $key => $value) {
            $contents[$value->Date] = $value->freq;
            $page = $PageName ;
//            $page = substr($value->PageName,-20);
        }
        $max = 0;


        $x = 0;
//        $ProspectsGenerated = 0;
        while (strtotime($toDate) <= strtotime($fromDate)) {

                $content_value = array_key_exists($toDate, $contents)?$contents[$toDate]:0;

                $jqChartdata1[] = array(date('M d',strtotime($toDate)),$content_value);
                /*$jqChartdata2[] = array(date('Md',strtotime($toDate)),10+$x);*/
            if ($content_value > $max)
            {
                $max = $content_value;
            }
//                $ProspectsGenerated = $ProspectsGenerated + $content_value;

                $toDate = date ("Y-m-d", strtotime("+1 day", strtotime($toDate)));

                $x++;
        }

        $data['jqChart'][] = array(
                                    'type' => 'area',
                                    'title' => 'Engagements', //$page
                                    'fillStyle' => '#2d69a0',
                                    'data' => $jqChartdata1
                                );

        $data['jqChart'][] = array(
                                    'type' => 'line',
                                    'title' => 'Engagements', //$page
//                                    'fillStyle' => '#2d69a0',
                                    'data' => $jqChartdata1
                                );



        $max = ceil($max /10) * 10;

        $data['max'] = $max ;
      

//        $data['Trending'] = number_format($contents_score,2);
//        $data['ProspectsGenerated'] = number_format($ProspectsGenerated,2);

        return response()->json($data);
    }

    public function engagement(Request $request)
    {
        $client_id = Session('client_id');
        $days = Input::get('days');
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));
        $PageName=$request->PageName;
        $PageURL = $request -> PageURL;

        $content_Awareness = ContentsDetail::where([['client_id', $client_id],['Stage','Awareness'],['PageName', $PageName],['PageURL', $PageURL]])->sum('Engage');
        $content_Engagement = ContentsDetail::where([['client_id', $client_id],['Stage','Engaged'],['PageName', $PageName],['PageURL', $PageURL]])->sum('Engage');
        $content_Consideration = ContentsDetail::where([['client_id', $client_id],['Stage','Consideration'],['PageName', $PageName],['PageURL', $PageURL]])->sum('Engage');
        $content_Conversion = ContentsDetail::where([['client_id', $client_id],['Stage','Conversion'],['PageName', $PageName],['PageURL', $PageURL]])->sum('Engage');


        $data['AwarenessValue'] = $content_Awareness;
//        $data['AwarenessFlag'] = 'up';
        $data['EngagementValue'] = $content_Engagement;
//        $data['EngagementFlag'] = 'down';
        $data['ConsiderationValue'] = $content_Consideration;
//        $data['ConsiderationFlag'] = 'down';
        $data['ConvertedValue'] = $content_Conversion;
//        $data['ConvertedFlag'] = 'up';

        return response()->json($data);
    }

    public function topEntryPoints(Request $request)
    {
        $client_id = Session('client_id');
        $months = Input::get('dur');
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$months.'months'));
        $PageName=$request->PageName;
        $PageURL = $request -> PageURL;


        $topentrys = ContentTopEntry::select('*')->where('PageName', $PageName)->where('PageURL', $PageURL)->where('Date','>',$toDate)->orderBy('Date','DESC')->get();

        $list=['Search Engine','Social Media','Referral Links']; // List of channels to look for
        $social = [];
        $referral = [];
        $search = [];
        $email =[];
        $ppc = [];
        $chn=[]; // Unique Channel Names in the db
        $total=[]; // Individual Total Points for pie chart
        $color_arr = array('#3c8dbc','#dd4b39','#00a65a','#f39c12','#272a52');
        $months_name=[];


        function mback($a)
        {
            $r = strtotime($a);
            $date = date('M',$r);
            return $date;

        }


        foreach ($topentrys as $key => $value)
        {
            array_push($chn,$value->chn);
            $m = mback($value->Date);
            array_push($months_name,$m);

            if (array_key_exists($value->chn,$total))
            {
                $total[$value->chn] = $total[$value->chn] + $value->freq;
            }
            else
            {
                $total[$value->chn] = $value->freq;
            }

            if ($value->chn == $list[0])
            {
                if (array_key_exists($m,$search))
                {
                    $search[$m] = $search[$m] + $value->freq;
                }
                else
                {
                    $search[$m] = $value->freq;
                }
            }

            else if ($value->chn == $list[1])
            {
                if (array_key_exists($m,$social))
                {
                    $social[$m] = $social[$m] + $value->freq;
                }
                else{
                    $social[$m] = $value->freq;}
            }

            else if ($value->chn == $list[2])
            {
                if (array_key_exists($m,$referral))
                {
                    $referral[$m] = $referral[$m] + $value->freq;
                }
                else{
                    $referral[$m] = $value->freq;}
            }

        }

        $chn = array_unique($chn);
        $months_name = array_unique($months_name);
        $months_name = array_values($months_name);
        $z = 0;
        foreach ($chn as $value)
        {
            $data['pieChartPoints'][] = array(
                                                'value' => $total[$value],
                                                'color' => $color_arr[$z],
                                                'highlight' => $color_arr[$z],
                                                'label' => $value,
                                            );
            switch ($value){
                case 'Search Engine':
                    $c = array_values($search);
                    break;
                case 'Social Media':
                    $c = array_values($social);
                    break;
                case 'Referral Links':
                    $c = array_values($referral);
                    break;

            }

            $data['barChartPoints'][] = array(
                                                'type' => 'column',
                                                'title' => $value,
                                                'fillStyle' => $color_arr[$z],
                                                'data' => $c
                                            );
            $z++;


        }

        $data['barChartAxes'][] = array(
                                        'type' => 'category',
                                        'location' => 'bottom',
                                        'categories' => $months_name
                                        );
        return response()->json($data);
    }

    public function topPerformingContent(Request $request)
    {
        $client_id = Session('client_id');
        $top = Input::get('days');
        $dt = Input::get('dt');
 
        if ($dt == 1)
        {
            //$top_contents_Awareness = Caware::selectRaw('PageName,Date,score,PageURL, Value as sum,round(score*10,1) as avgscore')->where([['client_id', $client_id],['Stage','Awareness']])->orderBy('Value','DESC')->take($top)->get();
            $top_contents_Awareness = ContentsDetail::selectRaw('PageName,Date,PageURL, Engage as sum')->where([['client_id', $client_id],['Stage','Awareness']])->orderBy('Engage','DESC')->take($top)->get();

            $data['AwarenessData']=[];

            foreach ($top_contents_Awareness as $key => $content){

                $data['AwarenessData'][] = array(
                    'PageName' =>  $content->PageName,
                    'Date' => $content->Date,
                    'PageURL' =>  $content->PageURL,
                    'avgscore' => '', //$content->avgscore,
                    'sum' =>  $content->sum
                );
            }

            return response()->json($data);

        }

        if ($dt == 2)
        {
            //$top_contents_Engagement = Ceng::selectRaw('PageName,Date,score,PageURL, Value as sum,round(score*10,1) as avgscore')->where([['client_id', $client_id],['Stage','Engaged']])->orderBy('Value', 'DESC')->take($top)->get();
            $top_contents_Engagement = ContentsDetail::selectRaw('PageName,Date,PageURL, Engage as sum')->where([['client_id', $client_id],['Stage','Engaged']])->orderBy('Engage','DESC')->take($top)->get();
            $data['EngagementData']=[];

            foreach ($top_contents_Engagement as $key => $content){

                $data['EngagementData'][] = array(
                    'PageName' =>  $content->PageName,
                    'Date' => $content->Date,
                    'PageURL' =>  $content->PageURL,
                    'avgscore' => '',// $content->avgscore,
                    'sum' =>  $content->sum
                );
            }

            return response()->json($data);

        }
        if($dt == 3)
        {
            //$top_contents_Consideration = Ccons::selectRaw('PageName,Date,score,PageURL, Value as sum,round(score*10,1) as avgscore')->where([['client_id', $client_id],['Stage','Consideration']])->orderBy('Value', 'DESC')->take($top)->get();
            $top_contents_Consideration = ContentsDetail::selectRaw('PageName,Date,PageURL, Engage as sum')->where([['client_id', $client_id],['Stage','Consideration']])->orderBy('Engage','DESC')->take($top)->get();
            $data['ConsiderationData']=[];

            foreach ($top_contents_Consideration as $key => $content){

                $data['ConsiderationData'][] = array(
                    'PageName' =>  $content->PageName,
                    'Date' => $content->Date,
                    'PageURL' =>  $content->PageURL,
                    'avgscore' =>  '',//$content->avgscore,
                    'sum' =>  $content->sum
                );
            }

            return response()->json($data);

        }
        if ($dt == 4)
        {
            //$top_contents_Conversion = Cconv::selectRaw('PageName,Date,score,PageURL, Value as sum,round(score*10,1) as avgscore')->where([['client_id', $client_id],['Stage','Conversion']])->orderBy('Value', 'DESC')->take($top)->get();
            $top_contents_Conversion = ContentsDetail::selectRaw('PageName,Date,PageURL, Engage as sum')->where([['client_id', $client_id],['Stage','Conversion']])->orderBy('Engage','DESC')->take($top)->get();
            $data['ConversionData']=[];

            foreach ($top_contents_Conversion as $key => $content){

                $data['ConversionData'][] = array(
                    'PageName' =>  $content->PageName,
                    'Date' => $content->Date,
                    'PageURL' =>  $content->PageURL,
                    'avgscore' => '',// $content->avgscore,
                    'sum' =>  $content->sum
                );
            }

            return response()->json($data);
        }

        if ($dt == 5)
        {
 
        //$top_contents_Awareness = Caware::selectRaw('PageName,Date,score,PageURL, Value as sum,round(score*10,1) as avgscore')->where([['client_id', $client_id],['Stage','Awareness']])->orderBy('Value','DESC')->take($top)->get();
        $top_contents_Awareness = ContentsDetail::selectRaw('PageName,Date,PageURL, Engage as sum')->where([['client_id', $client_id],['Stage','Awareness']])->orderBy('Engage','DESC')->take($top)->get();
 
         $data['AwarenessData']=[];
 

        foreach ($top_contents_Awareness as $key => $content){

            $data['AwarenessData'][] = array(
                                        'PageName' =>  $content->PageName,
                                        'Date' => $content->Date,
                                        'PageURL' =>  $content->PageURL,
                                        'avgscore' => '',// $content->avgscore,
                                        'sum' =>  $content->sum
                                    );
            }


        //$top_contents_Engagement = Ceng::selectRaw('PageName,Date,score,PageURL, Value as sum,round(score*10,1) as avgscore')->where([['client_id', $client_id],['Stage','Engaged']])->orderBy('Value', 'DESC')->take($top)->get();
        $top_contents_Engagement = ContentsDetail::selectRaw('PageName,Date,PageURL, Engage as sum')->where([['client_id', $client_id],['Stage','Engaged']])->orderBy('Engage','DESC')->take($top)->get();  
        $data['EngagementData']=[];
 
        foreach ($top_contents_Engagement as $key => $content){

            $data['EngagementData'][] = array(
                                        'PageName' =>  $content->PageName,
                                        'Date' => $content->Date,
                                        'PageURL' =>  $content->PageURL,
                                        'avgscore' =>  '',//$content->avgscore,
                                        'sum' =>  $content->sum
                                    );
            }


        //$top_contents_Consideration = Ccons::selectRaw('PageName,Date,score,PageURL, Value as sum,round(score*10,1) as avgscore')->where([['client_id', $client_id],['Stage','Consideration']])->orderBy('Value', 'DESC')->take($top)->get();
        $top_contents_Consideration = ContentsDetail::selectRaw('PageName,Date,PageURL, Engage as sum')->where([['client_id', $client_id],['Stage','Consideration']])->orderBy('Engage','DESC')->take($top)->get();     
 
        $data['ConsiderationData']=[];
 
        foreach ($top_contents_Consideration as $key => $content){

            $data['ConsiderationData'][] = array(
                                        'PageName' =>  $content->PageName,
                                        'Date' => $content->Date,
                                        'PageURL' =>  $content->PageURL,
                                        'avgscore' =>  '',//$content->avgscore,
                                        'sum' =>  $content->sum
                                    );
            }

        //$top_contents_Conversion = Cconv::selectRaw('PageName,Date,score,PageURL, Value as sum,round(score*10,1) as avgscore')->where([['client_id', $client_id],['Stage','Conversion']])->orderBy('Value', 'DESC')->take($top)->get();
        $top_contents_Conversion = ContentsDetail::selectRaw('PageName,Date,PageURL, Engage as sum')->where([['client_id', $client_id],['Stage','Conversion']])->orderBy('Engage','DESC')->take($top)->get();     
 
        $data['ConversionData']=[];
 
        foreach ($top_contents_Conversion as $key => $content){

            $data['ConversionData'][] = array(
                                        'PageName' =>  $content->PageName,
                                        'Date' => $content->Date,
                                        'PageURL' =>  $content->PageURL,
                                        'avgscore' => '',// $content->avgscore,
                                        'sum' =>  $content->sum
                                    );
            }

        return response()->json($data);
        }

    }

    public function clickMap(Request $request){
        $client_id=Session('client_id');

        $PageName=$request->PageName;
        $PageURL=$request->PageURL;

        $days = Input::get('days');
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));

        //$clicks=ClickMap::where([['PageName', $PageName],['client_id',$client_id]])->where('SystemDate','>',$toDate)->get(); // ['PageURL', $PageURL],

        $clicks=ClickMap::where([['PageName', $PageName],['client_id',$client_id]])->where('SystemDate','>',$toDate)->get(); // ['PageURL', $PageURL],


        return $clicks;
    }
    public function clickMap_lead(Request $request){
        $client_id=Session('client_id');

        $PageName=$request->PageName;
        $leadID=$request->leadID;

        $days = Input::get('days');
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));
        $clicks=ClickMap::where([['e_id', $leadID],['client_id',$client_id]])->where('SystemDate','>',$toDate)->get(); // ['PageURL', $PageURL],
        return $clicks;
    }
    
}
