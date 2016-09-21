<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// Route::get('/', function () {
//     return view('login');
// });
Route::get('/', 'LoginController@showLoginForm');
Route::post('/login', 'LoginController@login');
Route::get('/login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');

Route::group(['middleware' => 'usersession'], function () { 
	Route::get('/dashboard', 'HomeController@show');
	// Route::get('/leads', function () {
	//     return view('leads');
	// });

	// Route::get('/LeadID', function () {
	//     return view('LeadID');

	// });
	Route::get('/LeadID', 'LeadController@index');
    Route::get('/leads', 'LeadController@getLeadsData');
    Route::get('/Content', 'ContentController@ShowContents');
    Route::get('/ContentDetail', 'ContentController@index');
    Route::get('/Channels', 'ChannelController@ShowChannels');
    Route::get('/ChannelDetail', 'ChannelController@index');
    Route::get('/Campaigns', 'CampaignController@index');

	Route::get('/Reports', 'ReportController@index');
	Route::get('/ReportsDetail', 'ReportController@detail');

});





Route::get('/dashboard/nodePath', 'HomeController@show_nodePath');
Route::get('/dashboard/actionItem', 'HomeController@show_actionItem');
Route::get('/dashboard/error404detected', 'HomeController@show_error404detected');
Route::get('/dashboard/activeLeads_count', 'HomeController@show_active_leads_count');
Route::get('/dashboard/activeLeads', 'HomeController@show_active_leads');
Route::get('/dashboard/leadProgression', 'HomeController@lead_progression');
Route::get('/dashboard/leadsSegmenting', 'HomeController@leadsSegmenting');


Route::get('Lead/getLeadData', 'LeadController@getLeadData');
Route::get('Lead/getLeadID', 'LeadController@getLeadID');

Route::get('Lead/leadsFunnel', 'LeadController@leadsFunnel');
Route::get('Lead/leadsBreakdown', 'LeadController@leadsBreakdown');
Route::get('Lead/channelsDrivingConversion', 'LeadController@channelsDrivingConversion');
Route::get('Lead/contentDrivingConversion', 'LeadController@contentDrivingConversion');

Route::get('Channel/topChannels', 'ChannelController@topChannels');
Route::get('Channel/allChannels', 'ChannelController@allChannels');
Route::get('Channel/leadFunnel', 'ChannelController@leadFunnel');
Route::get('Channel/topContent', 'ChannelController@topContent');
Route::get('Channel/viewMoreChannels', 'ChannelController@viewMoreChannels');

Route::get('Content/performance', 'ContentController@performance');
Route::get('Content/engagement', 'ContentController@engagement');
Route::get('Content/topEntryPoints', 'ContentController@topEntryPoints');
Route::get('Content/topPerformingContent', 'ContentController@topPerformingContent');

Route::get('Reports/ConversionOverview', 'ReportController@getTotalConvertReporting');
Route::get('Reports/ConversionBySite', 'ReportController@getConversionBySite');
Route::get('Reports/VisitorsBreakdown', 'ReportController@getVisitorsBreakdown');
Route::get('Reports/ChannelOverview', 'ReportController@getChannelOverview');
Route::get('Reports/ConversionDetails', 'ReportController@getConversionDetails');
Route::get('Reports/AccountBasedMarketing', 'ReportController@getAccountBasedMarketing');



// Route::get('/dashboard', function () {
//      return view('dashboard');
// });




