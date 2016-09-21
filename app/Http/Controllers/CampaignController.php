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
use Carbon\Carbon;


class CampaignController extends Controller
{
    public function index()
    {
        $client_id=Session('client_id');if (!$client_id) return redirect('Portfolio');
        $topCampaigns=TopContents::selectRaw('client_id,Date,score,PageURL, sum(Value) as sum,round(avg(score),1) as avgscore, count(PageName) as leadconversion')->where('client_id',$client_id)->groupBy('client_id')->orderBy('avgscore', 'DESC')->take(3)->get();
        $allCampaigns=TopContents::selectRaw('client_id,Date,score,PageURL, sum(Value) as sum,round(avg(score),1) as avgscore, count(PageName) as leadconversion')->where('client_id',$client_id)->groupBy('client_id')->orderBy('sum', 'DESC')->get();

        return view('Campaigns', [
            'client_id'=>$client_id,
            'topCampaigns'=>$topCampaigns,
            'allCampaigns'=>$allCampaigns,
            
        ]);
    }

    public function topCampaigns()
    {
        $clientID = Input::get('clientID');
        $days = Input::get('days');
        $fromDate = date("Y-m-d");
        $toDate = date('Y-m-d', strtotime($fromDate. ' - '.$days.' days'));

        $topCampaigns=TopContents::selectRaw('client_id,Date,score,PageURL, sum(Value) as sum,round(avg(score),1) as avgscore, count(PageName) as leadconversion')
        ->whereBetween('Date', array($toDate, $fromDate))
        ->where('client_id',$client_id)
        ->groupBy('client_id')->orderBy('avgscore', 'DESC')->take(3)->get();

        foreach ($topCampaigns as $topCampaign){

            $data['campaignData'][] = array(
                                    'CampaignName' => $topCampaign->client_id,
                                    'CampaigValue' => number_format($topCampaign->avgscore,1),
                                    'ContentInteractions' => $topCampaign->sum,
                                    'ContentEngagement' => '',
                                    'Calledtoaction' => '',
                                    'LeadConversions' => $topCampaign->leadconversion
                                );
        }

        return response()->json($data);
    }
////////////////////////////////////////////////////////////////////////////////
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
}