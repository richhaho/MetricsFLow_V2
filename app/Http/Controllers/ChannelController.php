<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use DB;
use App\Leads as Leads;
use App\ContentTopEntry as ContentTopEntry;
use App\TopContents as TopContents;
use Carbon\Carbon;



class ChannelController extends Controller
{
    public function index(Request $request)
    {
        $client_id = Session('client_id');if (!$client_id) return redirect('Portfolio');
        $DomainName = $request->DomainName;
        
        

        $top_contents = TopContents::selectRaw('PageName,Date,score,PageURL, sum(Value) as sum,round(avg(score),1) as avgscore')->where('client_id', $client_id)->groupBy('PageName')->orderBy('sum', 'DESC')->take(3)->get();

        return view('ChannelDetail', [
            'client_id'=>$client_id,
            'DomainName' => $DomainName,
         

            'top_contents' => $top_contents, 
        ]);
    }

    public function ShowChannels()
    {
        $client_id=Session('client_id');if (!$client_id) return redirect('Portfolio');
        $topChannels=ContentTopEntry::selectRaw('domainname,sum(freq) as prospect,count(PageName) as conversion')->groupBy('domainname')->orderBy('prospect', 'DESC')->take(3)->get();
        $prospects=ContentTopEntry::sum('freq');
        $conversions=ContentTopEntry::count('PageName');

        $allChannels=ContentTopEntry::selectRaw('domainname,sum(freq) as prospect,count(PageName) as conversion')->groupBy('domainname')->orderBy('conversion', 'DESC')->take(9)->get();

        return view('channels', [
            'client_id'=>$client_id,
            'topChannels'=>$topChannels,
            'prospects'=>$prospects,
            'conversions'=>$conversions,
            'allChannels'=>$allChannels

        ]);
    }

    public function topChannels()
    {
        $clientID = Input::get('clientID');
        $days = Input::get('days');
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));

        $topChannels = ContentTopEntry::selectRaw('domainname,sum(freq) as prospect,count(PageName) as conversion')
        ->whereBetween('Date', array($toDate, $fromDate))
        ->groupBy('domainname')->orderBy('prospect', 'DESC')->take(3)->get();
        $prospects = ContentTopEntry::sum('freq');
        $conversions = ContentTopEntry::count('PageName');

        foreach ($topChannels as $topChannel){

            $data['channelData'][] = array(
                                    'ChannelName' => $topChannel->domainname,
                                    'ChannelText' => 'Change in Users',
                                    'IsChannelUp' => true,
                                    'ChannelPer' => round($topChannel->prospect / $prospects * 100),
                                    'ConversionRate' => round($topChannel->conversion/$conversions*100),
                                    'ProspectsGenerated' => $topChannel->prospect,
                                    'LeadConversions' => $topChannel->conversion
                                );
        }

        return response()->json($data);
    }

    public function allChannels()
    {
        $clientID = Input::get('clientID');
        $cnlSearch = Input::get('cnlSearch');

        $allChannels=ContentTopEntry::selectRaw('domainname,sum(freq) as prospect,count(PageName) as conversion')
        ->where('domainname','like',"%$cnlSearch%")
        ->groupBy('domainname')->orderBy('conversion', 'DESC')->get();
        $prospects = ContentTopEntry::sum('freq');
        $conversions = ContentTopEntry::count('PageName');

        $data = array();
        foreach ($allChannels as $allchannel)
        {
            $data['channelData'][] = array(
                                        'ChannelName' => $allchannel->domainname,
                                        'ChannelText' => 'Change in Users',
                                        'IsChannelUp' => true,
                                        'ChannelPer' => round($allchannel->prospect/$prospects*100),
                                        'ConversionRate' => round($allchannel->conversion/$conversions*100),
                                        'ProspectsGenerated' => $allchannel->prospect,
                                        'LeadConversions' => $allchannel->conversion
                                    );
        }
    
        return response()->json($data);
    }

    public function viewMoreChannels()
    {
        $clientID = Input::get('clientID');

        $offset = Input::get('Start');
        $limit = 9;

        $allChannels=ContentTopEntry::selectRaw('domainname,sum(freq) as prospect,count(PageName) as conversion')
        //->where('domainname','like',"%$cnlSearch%")
        ->groupBy('domainname')->orderBy('conversion', 'DESC')->offset($offset*$limit)->limit($limit)->get();
        $prospects = ContentTopEntry::sum('freq');
        $conversions = ContentTopEntry::count('PageName');

        $data = array();
        foreach ($allChannels as $allchannel)
        {
            $data['channelData'][] = array(
                                        'ChannelName' => $allchannel->domainname,
                                        'ChannelText' => 'Change in Users',
                                        'IsChannelUp' => true,
                                        'ChannelPer' => round($allchannel->prospect/$prospects*100),
                                        'ConversionRate' => round($allchannel->conversion/$conversions*100),
                                        'ProspectsGenerated' => $allchannel->prospect,
                                        'LeadConversions' => $allchannel->conversion
                                    );
        }
    
        return response()->json($data);
    }

    public function leadFunnel()
    {
        $clientID = Input::get('clientID');
        $domainName = Input::get('domainName');
        $days = Input::get('days');
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));

        $leadConversions = Leads::where('domainname',$domainName)
        ->whereBetween('Date', array($toDate, $fromDate))
        ->count('e_id');
        $conversions = Leads::whereBetween('Date', array($toDate, $fromDate))->count('PageName');

        $countPages = ContentTopEntry::where('domainname',$domainName)
        ->whereBetween('Date', array($toDate, $fromDate))
        ->count('PageName');
        $landingPages = ContentTopEntry::where('PageName','like','%Landing%')
        ->whereBetween('Date', array($toDate, $fromDate))
        ->count('PageName');
        $requestPages = ContentTopEntry::where('PageName','like','%Request%')
        ->whereBetween('Date', array($toDate, $fromDate))
        ->count('PageName');
        $confirmationPages = ContentTopEntry::where('PageName','like','%Confirmation%')
        ->whereBetween('Date', array($toDate, $fromDate))
        ->count('PageName');

        $totalPages = $countPages + $landingPages + $requestPages + $confirmationPages;

        $data['leadFunnelBarChart'][] = array(
                                    'SessionTitle' => 'Facebook Page',
                                    'TotalSession' => $countPages,
                                    'SessionPer' => round($countPages / $totalPages * 100),
                                    'SessionColor' => '#fc5d56'
                                );

        $data['leadFunnelBarChart'][] = array(
                                    'SessionTitle' => 'Landing Pages',
                                    'TotalSession' => $landingPages,
                                    'SessionPer' => round($landingPages / $totalPages * 100),
                                    'SessionColor' => '#327aba'
                                );

        $data['leadFunnelBarChart'][] = array(
                                    'SessionTitle' => 'Request a Quote',
                                    'TotalSession' => $requestPages,
                                    'SessionPer' => round($requestPages / $totalPages * 100),
                                    'SessionColor' => '#e70047'
                                );

        $data['leadFunnelBarChart'][] = array(
                                    'SessionTitle' => 'Confirmation Page',
                                    'TotalSession' => $confirmationPages,
                                    'SessionPer' => round($confirmationPages / $totalPages * 100),
                                    'SessionColor' => '#31ca6a'
                                );

        $data['trending'] = round($leadConversions / $conversions * 100);
        $data['leadConversions'] = $leadConversions;

        return response()->json($data);
    }
////////////////////////////////////////////////////////////////////////////////
    public function topContent()
    {
        $clientID = Input::get('clientID');
        $domainName = Input::get('domainName');
        $days = Input::get('days');
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));

        $top_contents = TopContents::selectRaw('PageName,Date,score,PageURL, sum(Value) as sum,round(avg(score),1) as avgscore')->where('client_id', $clientID)
        ->whereBetween('Date', array($toDate, $fromDate))
        ->groupBy('PageName')->orderBy('sum', 'DESC')->take(3)->get();

        $data = array();
        foreach ($top_contents as $top_content) {

            $data['contentData'][] = array(
                                        'ContentTitle' => $top_content->PageName,
                                        'ContentUrl' => $top_content->PageURL,
                                        'ContentPer' => number_format($top_content->avgscore,1),
                                        'ProspectsGenerated' => $top_content->sum,
                                        'Posted' => date("M d, Y",strtotime($top_content->Date))
                                    );
        }

        return response()->json($data);
    }
    
}
