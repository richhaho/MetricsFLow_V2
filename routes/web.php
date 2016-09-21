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
Route::get('password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@reset');
Route::match(['get', 'post'], 'register', function(){
    return redirect('/verify');
    //return redirect('/Portfolio');
});

Auth::routes();

Route::get('/', function () {
     return redirect('/verify');
     //return redirect('/Portfolio');
 });
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');



Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'role:Admin|Dev|Client|Trial'], function (){
        Route::get('/userManagement', 'UserManagementController@index')->name('userManagement');;
        Route::post('/userManagement/update', 'UserManagementController@update')->name('usermanagement.update');;
        Route::post('/userManagement/updatepassword', 'UserManagementController@updatepassword')->name('usermanagement.updatepassword');;
        Route::post('/userManagement/updatelogo', 'UserManagementController@updatelogo')->name('usermanagement.updatelogo');;
        Route::post('/userManagement/remove', 'UserManagementController@remove')->name('usermanagement.remove');;
        Route::post('/userManagement/create', 'UserManagementController@create')->name('usermanagement.create');;
        Route::post('/userManagement/login', 'UserManagementController@login')->name('usermanagement.login');;

        Route::get('/Portfolio', 'PortfolioController@index')->name('Portfolio');
        Route::get('/verify', 'PortfolioController@verify');
        Route::post('/submitverify', 'PortfolioController@submitverify');
        
        Route::get('/adminReports', 'PortfolioController@adminReports');
        Route::get('/adminLeads', 'PortfolioController@adminLeads');
        Route::get('/adminContents', 'PortfolioController@adminContents');
        Route::get('/adminChannels', 'PortfolioController@adminChannels');
        Route::get('/adminCampaigns', 'PortfolioController@adminCampaigns');
        Route::get('/adminAudience', 'PortfolioController@adminAudience');

        Route::get('/SelectPortfolio', 'PortfolioController@SelectPortfolio');
        Route::get('/SelectUser', 'PortfolioController@SelectUser');
        Route::get('/BacktoPortfolio', 'PortfolioController@BacktoPortfolio');
        Route::post('/confirmProfile','ProfileController@confirm');

        Route::get('/confirmProfile',function(){
            return view ('confirm') -> with('client_id', Session('client_id'));
        });

        Route::group(['middleware' => 'confirm'], function (){
            Route::get('/toProfile', 'ProfileController@index');

        });

        Route::post('/profile_update', 'ProfileController@profile_update')->name('profile.update');

        Route::get('/Reports', 'ReportController@index');
        Route::get('/ReportsDetail', 'ReportController@detail');
        Route::get('/Reports_warranty', 'ReportController@warranty');

        Route::get('/ReportsPDF', 'ReportController@ReportsPDF');

        Route::get('Reports/ConversionOverview', 'ReportController@getTotalConvertReporting');
        Route::get('Reports/ConversionBySite', 'ReportController@getConversionBySite');
        Route::get('Reports/AccountBasedMarketing', 'ReportController@getAccountBasedMarketing');
        Route::get('Reports/ABMCVDetails', 'ReportController@getABMCVDetails');
        Route::get('Reports/VisitorsBreakdown', 'ReportController@getVisitorsBreakdown');
        Route::get('Reports/ChannelOverview', 'ReportController@getChannelOverview');
        Route::get('Reports/ConversionDetails', 'ReportController@getConversionDetails');

        Route::get('Tags', 'TagController@index')->name('tag');

    });

    Route::group(['middleware' => 'role:Admin|Dev|Client'], function (){

        Route::get('/LeadID', 'LeadController@index');
        Route::get('/LeadID_clickmap', 'LeadController@clickmap');

        Route::get('/leads', 'LeadController@getLeadsData');
        Route::get('/Audience', 'AudienceController@index');
        Route::get('/AudienceDetail', 'AudienceController@detail');
        Route::get('/Audience/pagesDetail', 'AudienceController@pagesDetail');
        Route::get('/Audience/graphData', 'AudienceController@graphData');

        Route::get('/Audience/Language', 'AudienceController@Language');
        Route::get('/Audience/Browser', 'AudienceController@Browser');
        Route::get('/Audience/OS', 'AudienceController@OS');
        Route::get('/Audience/Country', 'AudienceController@Country');

        Route::get('/Content', 'ContentController@ShowContents');
        Route::get('/ContentDetail', 'ContentController@index');
        Route::get('/Channels', 'ChannelController@ShowChannels');
        Route::get('/ChannelDetail', 'ChannelController@index');
        Route::get('/Campaigns', 'CampaignController@index');
        Route::get('/ReportsPDF', 'ReportController@ReportsPDF');
        
        Route::get('/ConversionDetails', 'ReportController@conversiondetails');
        //Route::post('/WarrantyPage','ReportController@WarrantyDetails');
        Route::get('/WarrantyPage','ReportController@WarrantyDetails');
        Route::get('RestAPI/test/{e_id}', 'RestAPIController@index');

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
        Route::get('/Lead/getLeadIDProg', 'LeadController@getLeadIdProg');
        Route::get('Lead/leadsBreakdown', 'LeadController@leadsBreakdown');
        Route::get('Lead/channelsDrivingConversion', 'LeadController@channelsDrivingConversion');
        Route::get('Lead/contentDrivingConversion', 'LeadController@contentDrivingConversion');
        Route::get('Lead/leadProgression', 'HomeController@lead_progression');

        Route::get('Channel/topChannels', 'ChannelController@topChannels');
        Route::get('Channel/allChannels', 'ChannelController@allChannels');
        Route::get('Channel/leadFunnel', 'ChannelController@leadFunnel');
        Route::get('Channel/topContent', 'ChannelController@topContent');
        Route::get('Channel/viewMoreChannels', 'ChannelController@viewMoreChannels');

        Route::get('Content/performance', 'ContentController@performance');
        Route::get('Content/engagement', 'ContentController@engagement');
        Route::get('Content/topEntryPoints', 'ContentController@topEntryPoints');
        Route::get('Content/clickMap', 'ContentController@clickMap');
        Route::get('Content/clickMap_lead', 'ContentController@clickMap_lead');
        Route::get('Content/topPerformingContent', 'ContentController@topPerformingContent');

        Route::get('Tags', 'TagController@index')->name('tag');


    });

//    Route::get('/dashboard', 'HomeController@show');



});





