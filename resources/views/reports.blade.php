@extends('template.template')

@section('content-header')
    <link rel="stylesheet" href="/plugins/material/material-charts.css">
    <link rel="stylesheet" href="{{URL::to('/css/report.css')}}">
    <style type="text/css">
        .title_back_grey{
            background-color:#327aba;
            color:white;
        }
        .bar_avg_visitor{
            height: 10px;border:1px solid black;
            background-color: #7c9ebb;
            box-shadow: 1px 1px grey;
            padding: 0;
            margin-top: 15px;
            margin-bottom: 10px;
            -webkit-box-shadow: 0px 3px 16px 0px rgba(0,192,239,0.7);
            -moz-box-shadow: 0px 3px 16px 0px rgba(0,192,239,0.7);
            box-shadow: 0px 3px 16px 0px rgba(0,192,239,0.7);
        }
        .lines{
            margin-top: 22px;
            /*height: 50px;*/
        }
        svg{
            background-color: white !important
        }
        .bar-chart{
            width: 100% !important;
        }
        canvas{width: 100% !important;}
        .padding-ver-chart{
            padding: 8px 5px 8px 5px;

        }
        .fl {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display:    flex;
            flex-direction: row;
            overflow: hidden;
            /*justify-content: space-between;*/
            padding:5px;
        }
        .fl .col {
            flex: 1;
            margin:5px;
        }

        .fl .col:nth-child(1) {

            order: 0;
            /*flex-shrink: 1.5;*/
        }
        .fl .col:nth-child(2) {

            order: 1;
            flex-grow: 1.5;
        }

    </style>
    <section class="content-header">
        <div id="breadcrumbs">
            <h4 class="bold">Reports<br></h4>
        </div>
        <div class="col-lg-2 col-mg-2 col-sm-4 col-xs-6">
            <select class="form-control" style="border:none; width: 150px" onchange="ConversionOverview(this.value);">
                <option value="0">Overall</option>
                <option value="10">Last 10 Days</option>
                <option value="20">Last 20 Days</option>
                <option value="30" selected="selected">Last 30 Days</option>
                <option value="60">Last 60 Days</option>
                <option value="90">Last 90 Days</option>
                
                
            </select>
        </div>
    </section>
@endsection

@section('content')

    <section class="col-lg-12 connectedSortable ui-sortable" style="padding: 0px;" >
        <div class="col-md-12 col-xs-12 col-sm-12" >
            <div class="box-tools pull-right">
                <a href="/ReportsDetail" class="btn btn-sm" style="color: #333; background-color: #e6e9f0 !important; font-size: 14px "  >View Reports
                </a>
                <a href="/ReportsPDF"  class="btn btn-sm btn-print" style="color: #333; background-color: #e6e9f0 !important; font-size: 14px "  >Download Reports
                </a>
                 
            </div>
            <h3 class="bold">Conversion Overview</h3>
        </div>
        <div class="col-md-12 col-xs-12 col-sm-12" >
            <div class="alert-modal">
                <div class="modal">
                    <div class="col-md-12 col-xs-12 col-sm-12"  style="padding: 0px !important;">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-body group-bar-chart">
                                    <div>
                                        <i><span style="color:#272a52 !important;font-size: 48px;font-weight: 600" class="totalconversin">  </span><span style="color:#272a52 !important;font-size: 20px;font-weight: 600"> &nbsp;  Total Conversions</span></i >
                                    </div>
                                    <div id="bar-chart" class="bar-chart">


                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </div>
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </section>


    <section id="TOPchannels">
        <div class="fl" >
            <div class="col">
                {{--<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">--}}
                    <div class="alert-modal">
                        <div class="modal">
                            <div class="modal-dialog alertbox">
                                <div class="modal-content" id="md1">
                                    <div class="modal-header title_back_grey">
                                        <h4 class="modal-title">Conversion by Site</h4>
                                    </div>
                                    <div class="modal-body ">
                                        <div class="row">
                                            <div class="chart-responsive cbs">
                                                <canvas id="donut-chart1" ></canvas>
                                            </div>
                                            <!-- <div id="donut-chart1"></div> -->
                                        </div>
                                        <div class="bysite" >

                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                {{--</div>--}}
            </div>


                <div class="col">
                    <div class="alert-modal">
                        <div class="modal">
                            <div class="modal-dialog alertbox" >
                                <div class="modal-content" id="md2">
                                    <div class="modal-header title_back_grey">
                                        <h4 class="modal-title">Visitor Breakdown</h4>
                                    </div>
                                    <div class="modal-body row" >
                                        <div class="col-md-12 col-sm-12 col-xs-12 lines">
                                            <div class="col-md-5">
                                                <h4>Total Unique ID's</h4>
                                            </div>
                                            <div class="col-md-5 bar_avg_visitor TotalUniqueIDs1" >
                                                <div style="width:70%;height:100%;background-color: #1668b9;"></div>
                                            </div>
                                            <div class="col-md-2 TotalUniqueIDs2"></div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 lines">
                                            <div class="col-md-5">
                                                <h4>Unique ID's Blocking Cookies</h4>
                                            </div>
                                            <div class="col-md-5 bar_avg_visitor UniqueIDsBlocking1" >
                                                <div style="width:40%;height:50%;background-color: #1668b9;"></div>
                                            </div>
                                            <div class="col-md-2 UniqueIDsBlocking2">
                                                <h4></h4>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12 lines">
                                            <div class="col-md-5">
                                                <h4>Unique ID's Deleting Cookies</h4>
                                            </div>
                                            <div class="col-md-5 bar_avg_visitor DeleteCookies1" >
                                                <div style="width:40%;height:100%;background-color: #1668b9;"></div>
                                            </div>
                                            <div class="col-md-2 DeleteCookies2">
                                                <h4></h4>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12 lines">
                                            <div class="col-md-5">
                                                <h4>Total Unique Conversions </h4>
                                            </div>
                                            <div class="col-md-5 bar_avg_visitor TotalUniqueConversions1" >
                                                <div style="width:50%;height:100%;background-color: #1668b9;"></div>
                                            </div>
                                            <div class="col-md-2 TotalUniqueConversions2">
                                                <h4></h4>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12 lines">
                                            <div class="col-md-5">
                                                <h4>Total Content Activities</h4>
                                            </div>
                                            <div class="col-md-5 bar_avg_visitor TotalContent1" >
                                                <div style="width:50%;height:100%;background-color: #1668b9;"></div>
                                            </div>
                                            <div class="col-md-2 TotalContent2">
                                                <h4></h4>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12 lines">
                                            <div class="col-md-5">
                                                <h4>Unique Content Pieces</h4>
                                            </div>
                                            <div class="col-md-5 bar_avg_visitor UniqueContent1" >
                                                <div style="width:50%;height:100%;background-color: #1668b9;"></div>
                                            </div>
                                            <div class="col-md-2 UniqueContent2">
                                                <h4></h4>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 lines">
                                            <div class="col-md-5">
                                                <h4>Returning Users 60 Mins</h4>
                                            </div>
                                            <div class="col-md-5 bar_avg_visitor return601" >
                                                <div style="width:5%;height:100%;background-color: #1668b9;"></div>
                                            </div>
                                            <div class="col-md-2 return602" >
                                                <h4></h4>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12 lines">
                                            <div class="col-md-5">
                                                <h4>Returning Users 30 Mins</h4>
                                            </div>
                                            <div class="col-md-5 bar_avg_visitor return301" >
                                                <div style="width:5%;height:100%;background-color: #1668b9;"></div>
                                            </div>
                                            <div class="col-md-2 return302" >
                                                <h4></h4>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12 lines">
                                            <div class="col-md-5">
                                                <h4>Average Pages Consumed</h4>
                                            </div>
                                            <div class="col-md-5 bar_avg_visitor AveragePages1" >
                                                <div style="width:5%;height:100%;background-color: #1668b9;"></div>
                                            </div>
                                            <div class="col-md-2 AveragePages2" >
                                                <h4></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
            </div>
    </section>

    <section id="ActionItems" class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                <h3 class="bold">Account Based Marketing</h3> <!-- class="bold" -->
            </div>
        </div>
    </section>
    <section class="col-lg-12 col-sm-12 col-md-12 col-xs-12 connectedSortable ui-sortable" style="padding: 0px;">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="alert-modal">
                <div class="modal">
                    <div class="modal-dialog alertbox">
                        <div class="modal-content" id="AccountNameShow">
                            <div class="modal-header blue">
                                <h4 class="modal-title text-align">Companies Visiting</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row left">
                                    <div class="col-md-12 alert-content">
                                        <div class="alert-label">

                                            <div class="text-align box-data">
                                                <br><br><br>
                                                <div class="display abm1" >
                                                  
                                                </div>
                                                <br>

                                                <div class="padding15 display">
                                                    <h1 id="LS_MarketingQualified"></h1>
                                                    <p>click here</p>
                                                </div>
 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="alert-modal">
                <div class="modal">
                    <div class="modal-dialog alertbox">
                        <div class="modal-content">
                            <div class="modal-header blue">
                                <h4 class="modal-title text-align">Content Consumed</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row left">
                                    <div class="col-md-12 alert-content">
                                        <div class="alert-label">

                                            <div class="text-align box-data">
                                                <br><br>
                                                <div class="display abm2">
                                                    
                                                </div>
                                                <br><br>
                                                <div class="padding15 display">
                                                    <h1 id="LS_TopFunnel"></h1>
                                                </div>
                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="alert-modal">
                <div class="modal">
                    <div class="modal-dialog alertbox">
                        <div class="modal-content">
                            <div class="modal-header blue">
                                <h4 class="modal-title text-align">Conversions</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row left">
                                    <div class="col-md-12 alert-content">
                                        <div class="alert-label">

                                            <div class="text-align box-data">
                                                <br><br><br>
                                                <div class="display abm3">
                                                     
                                                </div>
                                                <br><br>
                                                <div class="padding15 display">
                                                    <h1 id="LS_ReturningCustomers"></h1>
                                                </div>
                                                 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </section>
    <section class="col-lg-12 col-sm-12 col-md-12 col-xs-12 connectedSortable ui-sortable" style="padding: 0px;min-height: 0px !important">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="AccountName">
            <div class="alert-modal">
                <div class="modal">
                    <div class="modal-dialog alertbox">
                        <div class="modal-content">

                            <div class="modal-body">
                                <div class="table-box" >
                                    <table id="table_id1" class="table table-hover">
                                        <thead>
                                        <tr id="tablehead" style="background-color: #2E6FAB !important;color:#fff; font-size: 14px;">
                                            <th>Account Name</th>
                                            <th class="text-center">Content Activities</th>
                                            <th class="text-center">Conversion Frequency</th>
                                            <th class="text-center">Unique Conversions</th>
                                        </tr>
                                        </thead>
                                        <tbody class="abm_cvdetail">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div></div>
    </section>

    <section id="ChannelOverview">
        <div class="row">

            <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="bold">Channel Overview</h3>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="alert-modal">
                    <div class="modal">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header light-blue">
                                        <div class="nav-tabs-custom" >
                                            <ul class="nav nav-tabs ">
                                                <li class="active tab01"><a href="#tab_w1" data-toggle="tab"><h4>Unique IDs</h4></a></li>
                                                <li class="tab02"><a href="#tab_w2" data-toggle="tab"><h4>Content Activity</h4></a></li>
                                                <li class="tab03"><a href="#tab_w3" data-toggle="tab"><h4>Conversion</h4></a></li>
                                            </ul>
                                            <div class="tab-content light-blue">
                                                <div class="tab-pane active" id="tab_w1">
                                                    <div class="row" style="padding: 40px 0px 40px 0px">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Search Engines</h4>
                                                            </div>
                                                            <div class="col-sm-9 SearchEngines1">
                                                                <div style="width: 50%;height: 40px;background-color: #272a52;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4></h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Organic</h4>
                                                            </div>
                                                            <div class="col-sm-9 Organic1">
                                                                <div style="width: 45%;height: 40px;background-color: #1668b9;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4></h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Social Media</h4>
                                                            </div>
                                                            <div class="col-sm-9 SocialMedia1">
                                                                <div style="width: 10%;height: 40px;background-color: #31ca6a;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4> </h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Affiliate</h4>
                                                            </div>
                                                            <div class="col-sm-9 Affillate1">
                                                                <div style="width: 20%;height: 40px;background-color: #fedd5a;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4></h4></span>
                                                            </div>
                                                        </div>
                                                        {{--<a href="#OnClickPPC">--}}
                                                            <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart" id="WillHideAndShow">
                                                                <div class="col-sm-3">
                                                                    <h4>PPC</h4>
                                                                </div>
                                                                <div class="col-sm-9 Ppc1">
                                                                    <div style="width: 5%;height: 40px;background-color: #fc5d56;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                    <span><h4></h4></span>
                                                                </div>
                                                            </div>
                                                        {{--</a>--}}
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Email</h4>
                                                            </div>
                                                            <div class="col-sm-9 Em1">
                                                                <div style="width: 1%;height: 40px;background-color: #df6380;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4> </h4></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="tab-pane" id="tab_w2">
                                                    <div class="row" style="padding: 40px 0px 40px 0px">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Search Engines</h4>
                                                            </div>
                                                            <div class="col-sm-9 SearchEngines2">
                                                                <div style="width: 70%;height: 40px;background-color: #272a52;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4> </h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Organic</h4>
                                                            </div>
                                                            <div class="col-sm-9 Organic2">
                                                                <div style="width: 65%;height: 40px;background-color: #1668b9;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4></h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Social Media</h4>
                                                            </div>
                                                            <div class="col-sm-9 SocialMedia2">
                                                                <div style="width: 20%;height: 40px;background-color: #31ca6a;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4></h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Affiliate</h4>
                                                            </div>
                                                            <div class="col-sm-9 Affillate2">
                                                                <div style="width: 30%;height: 40px;background-color: #fedd5a;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4></h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart" >
                                                            <div class="col-sm-3">
                                                                <h4>PPC</h4>
                                                            </div>
                                                            <div class="col-sm-9 Ppc2">
                                                                <div style="width: 9%;height: 40px;background-color: #fc5d56;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4></h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Email</h4>
                                                            </div>
                                                            <div class="col-sm-9 Em2">
                                                                <div style="width: 1%;height: 40px;background-color: #df6380;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4> </h4></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="tab_w3">
                                                    <div class="row" style="padding: 40px 0px 40px 0px">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Search Engines</h4>
                                                            </div>
                                                            <div class="col-sm-9 SearchEngines3">
                                                                <div style="width: 10%;height: 40px;background-color: #272a52;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4> </h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Organic</h4>
                                                            </div>
                                                            <div class="col-sm-9 Organic3">
                                                                <div style="width: 15%;height: 40px;background-color: #1668b9;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4></h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Social Media</h4>
                                                            </div>
                                                            <div class="col-sm-9 SocialMedia3">
                                                                <div style="width: 1%;height: 40px;background-color: #31ca6a;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4> </h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Affiliate</h4>
                                                            </div>
                                                            <div class="col-sm-9 Affillate3">
                                                                <div style="width: 4%;height: 40px;background-color: #fedd5a;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4></h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>PPC</h4>
                                                            </div>
                                                            <div class="col-sm-9 Ppc3">
                                                                <div style="width: 1%;height: 40px;background-color: #fc5d56;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4></h4></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12 col-xs-12 padding-ver-chart">
                                                            <div class="col-sm-3">
                                                                <h4>Email</h4>
                                                            </div>
                                                            <div class="col-sm-9 Em3">
                                                                <div style="width: 1%;height: 40px;background-color: #df6380;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
                                                                <span><h4></h4></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="ChannelOverview">
        <div class="row" id="keyword_performance">

            <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12" >
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="bold" id="OnClickPPC" >Keyword Performance</h3>
                </div>
            </div>
            <div class="col-lg-11 col-sm-12 col-md-12 col-xs-12">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="alert-modal">
                        <div class="modal">
                            <div class="modal-dialog alertbox">
                                <div class="modal-content">
                                    <div class="modal-header blue">
                                        <h4 class="modal-title text-left">Top 10 Keywords</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row left">
                                            <div class="col-md-12 alert-content">
                                                <div class="alert-label">

                                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">

                                                        <div class="text-align box-data">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="padding: 10px;">
                                                                <h4 class="bold">Content Activities</h4>
                                                            </div>
                                                            <div class="display" style="padding: 10px;">
                                                                 
                                                                <span class="fa fa-3x" style="color: #333;font-weight: bold;"> <img src="img/image (1-222--).png" /> 895</span></i>
                                                            </div>
                                                        </div>

                                                        <div class="text-align box-data">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="padding: 10px;">
                                                                <h4 class="bold">Unique Prospects</h4>
                                                            </div>
                                                            <div class="display" style="padding: 10px;">
                                                                <i class="fa fa-group fa-3x" style="color: #2E6FAB;" aria-hidden="true">  <span style="color: #333;font-weight: bold;"> 640</span></i>
                                                            </div>
                                                        </div>

                                                        <div class="text-align box-data">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="padding: 10px;">
                                                                <h4 class="bold">Conversions</h4>
                                                            </div>
                                                            <div class="display" style="padding: 10px;">
                                                                <i class="fa fa-heart fa-3x" style="color: red;" aria-hidden="true">  <span style="color: #333;font-weight: bold;"> 0</span></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                                        <h4 class="bold" style="padding: 10px 0 10px 0;">Keywords</h4>
                                                        <h5 class="bold">Business Furniture</h5>
                                                        <h5 class="bold">Executive Office Desk</h5>
                                                        <h5 class="bold">Bush Office Furniture</h5>
                                                        <h5 class="bold">Bush Furniture Desk</h5>
                                                        <h5 class="bold">Traning Tables</h5>
                                                        <h5 class="bold">Business Furniture Online Store</h5>
                                                        <h5 class="bold">Office Furniture Online Store</h5>
                                                        <h5 class="bold">Office Furniture Online Shopping</h5>
                                                        <h5 class="bold">Office Furniture Online Purchase</h5>
                                                        <h5 class="bold">60W Hutch</h5>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="alert-modal">
                        <div class="modal">
                            <div class="modal-dialog alertbox">
                                <div class="modal-content">
                                    <div class="modal-header blue">
                                        <h4 class="modal-title text-left">Top 10 Display Adwords</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row left">
                                            <div class="col-md-12 alert-content">
                                                <div class="alert-label">

                                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">

                                                        <div class="text-align box-data">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="padding: 10px;">
                                                                <h4 class="bold">Content Activities</h4>
                                                            </div>
                                                            <div class="display" style="padding: 10px;">
                                                                 <span class="fa fa-3x" style="color: #333;font-weight: bold;"> <img src="img/image (1-222--).png" /> 181</span> 
                                                            </div>
                                                        </div>

                                                        <div class="text-align box-data">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12" style="padding: 10px;">
                                                                <h4 class="bold">Unique Prospects</h4>
                                                            </div>
                                                            <div class="display" style="padding: 10px;">
                                                                <i class="fa fa-group fa-3x" style="color: #2E6FAB;" aria-hidden="true">  <span style="color: #333;font-weight: bold;"> 119</span></i>
                                                            </div>
                                                        </div>

                                                        <div class="text-align box-data">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12"  style="padding: 10px;">
                                                                <h4 class="bold">Conversions</h4>
                                                            </div>
                                                            <div class="display" style="padding: 10px;">
                                                                <i class="fa fa-heart fa-3x" style="color: red;" aria-hidden="true">  <span style="color: #333;font-weight: bold;"> 0</span></i>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                                        <h4 class="bold" style="padding: 10px 0 10px 0;">Keywords</h4>
                                                        <h5 class="bold">Desk for Office Furniture</h5>
                                                        <h5 class="bold">Huge Overstock Sele</h5>
                                                        <h5 class="bold">Reason to Buy</h5>
                                                        <h5 class="bold">Bush Home and Business Desk</h5>
                                                        <h5 class="bold">Office Desk Chair</h5>
                                                        <h5 class="bold">Executive Office Furniture</h5>
                                                        <h5 class="bold">Conference Room Furniture</h5>
                                                        <h5 class="bold">Board Room Furniture</h5>
                                                        <h5 class="bold">Standing Desk</h5>
                                                        <h5 class="bold">Eames Chair</h5>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
            </div>
        </div>
    </section>




    <script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- <script src="/plugins/flot/jquery.flot.min.js"></script>
    <script src="/plugins/flot/jquery.flot.resize.min.js"></script> -->

    <!-- <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script> -->
    <script src="/plugins/chartjs/Chart.min.js"></script>
    <script src="/plugins/material/material-charts.js"></script>
  
    <script src="/js/donut_report.js"></script>
    <script src="{{URL::to('/plugins/chartjs/areachart/jquery.jqChart.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        
        $(document).ready(function(){
            $("#AccountName").hide()
            $("#keyword_performance").hide()
            $("#WillHideAndShow").click(function(){
                $("#keyword_performance").toggle();
            });
            $("#AccountNameShow").click(function(){
                $("#AccountName").toggle();
            });

            ConversionOverview();


        });
        var total_converion=0;
        function ConversionOverview(days = 30){
            $.get("{{URL::to('/Reports/ConversionOverview')}}",{"clientID":"{{$client_id}}",days:days}).done(function( data ) {


                var datas=[];
                total_converion = 0;  // Reset Conversions on day change instead of adding everything

                for (i=0;i<data.length;i++){
                    var dt=[data[i].SystemTime, data[i].freq]; // data[i].SystemTime.substring(5).replace('-', '/')
                    datas.push(dt);
                    total_converion+=data[i].freq;
                }
                //
                // const datain=[{data: datas, fillStyle: "#2d69a0", type: "column", title: "Conversions"},
                //     {data: datas, fillStyle: "#2d69a0", type: "line", title: "Conversions"}];

                $('.totalconversin').text(total_converion);

                $('#bar-chart').jqChart({
                    /*title: { text: 'Column Chart Colors' },*/
                    animation: { duration: 1 },
                    shadows: {
                        enabled: true
                    },
                    border: { visible: false },
                    legend: {visible: false},
                    series:  [
                        {
                            type: 'linear',
                            title: 'Conversions',
                            fillStyles: ['#327aba'],
                            data: datas
                        }
                    ]
                });
            });
            ConversionbySite(days);
        }
        function ConversionbySite(days = 30){
            $.get("{{URL::to('/Reports/ConversionBySite')}}",{"clientID":"{{$client_id}}","portfolioID":"{{$portfolio_id}}",days:days}).done(function( data ) {
                $('.bysite').empty();

                var total_freq=0;
                var donut=[];
                var colors=["#31ca6a","#327aba","#fc5d56","#e70047"];

                 


                for (var i=1;i<=data.length;i++){
                    $('.bysite').append('<div class="row"><div class ="float col-xs-2"><i class="fa fa-stop fa-2x labeltext" style="color:'+colors[i-1]+'; margin-top: 10px; "></i></div><div class="labeltext col-xs-10 bysite0'+i+'"></div></div>');
                }


                var donut_data=[];
                var donut_label=[];
                var donut_color=[];

                for (var i=1;i<=data.length;i++){
                    total_freq+=data[i-1].freq;
                    $('.bysite0'+i).empty();
                    var each_donut={label: " " , value: data[i-1].freq, color: colors[i-1], highlight: colors[i-1]};
                    donut.push(each_donut);
                    
                    donut_data.push(data[i-1].freq);
                    donut_label.push(data[i-1].Site);
                    donut_color.push(colors[i-1]);

                }

                for (var i=1;i<=data.length;i++){

                    $('.bysite0'+i).append('<h4>'+Math.round(data[i-1].freq/total_freq*100)+'% - '+data[i-1].Site+'</h4>');
                }

                var pieChartCanvas = $("#donut-chart1").get(0).getContext("2d");

                

                var PieData = donut;

                var config = {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: donut_data,
                            backgroundColor: donut_color,
                             
                        }],

                        labels: donut_label

                         
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false,
                            position: 'top',
                        },
                        title: {
                            display: false,
                            text: ''
                        },
                        animation: {
                            animateScale: false,
                            animateRotate: false
                        }
                    }
                };
                var myDoughnut = new Chart(pieChartCanvas,config);
                // var pieOptions = {
                //     segmentShowStroke: true,
                //     segmentStrokeColor: "#fff",
                //     segmentStrokeWidth: 1,
                //     percentageInnerCutout: 50, // This is 0 for Pie charts
                //     animationSteps: 100,
                //     animationEasing: "easeOutBounce",
                //     animateRotate: true,
                //     animateScale: false,
                //     responsive: true,
                //     maintainAspectRatio: true,

                // };
                // pieChart.Doughnut(PieData, pieOptions);
            });
            VisitorsBreakdown(days);
        }

        function VisitorsBreakdown(days = 30){
            $.get("{{URL::to('/Reports/VisitorsBreakdown')}}",{"clientID":"{{$client_id}}",days:days}).done(function( data ) {

                $('.TotalUniqueIDs1').empty(); $('.TotalUniqueIDs2').empty();
                $('.TotalUniqueIDs1').append('<div style="width:100%;height:100%;background-color: #1668b9;"></div>');
                $('.TotalUniqueIDs2').append('<h4>'+data.TotalUniqueIDs+'</h4>');

                $('.UniqueIDsBlocking1').empty(); $('.UniqueIDsBlocking2').empty();
                $('.UniqueIDsBlocking1').append('<div style="width:'+Math.round(data.UniqueIDsBlockingCookies/data.TotalUniqueIDs*100)+'%;height:100%;background-color: #1668b9;"></div>');
                $('.UniqueIDsBlocking2').append('<h4>'+data.UniqueIDsBlockingCookies+'</h4>');

                $('.DeleteCookies1').empty(); $('.DeleteCookies2').empty();
                $('.DeleteCookies1').append('<div style="width:'+Math.round(data.DeleteCookies/data.TotalUniqueIDs*100)+'%;height:100%;background-color: #1668b9;"></div>');
                $('.DeleteCookies2').append('<h4>'+data.DeleteCookies+'</h4>');

                $('.TotalUniqueConversions1').empty(); $('.TotalUniqueConversions2').empty();
                $('.TotalUniqueConversions1').append('<div style="width:100%;height:100%;background-color: #1668b9;"></div>');
                $('.TotalUniqueConversions2').append('<h4>'+data.TotalUniqueConversions+'</h4>');

                $('.TotalContent1').empty(); $('.TotalContent2').empty();
                $('.TotalContent1').append('<div style="width:100%;height:100%;background-color: #1668b9;"></div>');
                $('.TotalContent2').append('<h4>'+data.TotalContentActivities+'</h4>');

                $('.UniqueContent1').empty(); $('.UniqueContent2').empty();
                $('.UniqueContent1').append('<div style="width:'+Math.round(data.UniqueContentActivities/data.TotalContentActivities*100)+'%;height:100%;background-color: #1668b9;"></div>');
                $('.UniqueContent2').append('<h4>'+data.UniqueContentActivities+'</h4>');

                $('.return601').empty(); $('.return602').empty();
                $('.return601').append('<div style="width:'+Math.round(data.Return60/data.TotalUniqueIDs*100)+'%;height:100%;background-color: #1668b9;"></div>');
                $('.return602').append('<h4>'+data.Return60+'</h4>');

                $('.return301').empty(); $('.return302').empty();
                $('.return301').append('<div style="width:'+Math.round(data.Return30/data.TotalUniqueIDs*100)+'%;height:100%;background-color: #1668b9;"></div>');
                $('.return302').append('<h4>'+data.Return30+'</h4>');

                $('.AveragePages1').empty(); $('.AveragePages2').empty();
                $('.AveragePages1').append('<div style="width:100%;height:100%;background-color: #1668b9;"></div>');
                $('.AveragePages2').append('<h4>'+Math.round(data.AveragePagesConsumed*10)/10+'</h4>');



            });
            ChannelOverview(days);
        }

        var box = $('#md2');
        $('#md1').css({height: box.height()});

        function ChannelOverview(days = 30){
            $.get("{{URL::to('/Reports/ChannelOverview')}}",{"clientID":"{{$client_id}}",days:days}).done(function( data ) {

                var total1 = 0, total2 =0 , total3 =0;
                var A = 0, PPC = 0, SE = 0,EM = 0, S = 0, O = 0;

                function coc(a) {

                    if (a == 0)
                    {
                        for (i=0; i<data.UniqueIds.length; i++) {

                            total1 += data.UniqueIds[i].count;
                            switch (data.UniqueIds[i].flag){
                                case 'A':
                                    A = data.UniqueIds[i].count;
                                    break;
                                case 'O':
                                    O = data.UniqueIds[i].count;
                                    break;
                                case 'PPC':
                                    PPC = data.UniqueIds[i].count;
                                    break;
                                case 'SE':
                                    SE = data.UniqueIds[i].count;
                                    break;
                                case 'EM':
                                    EM = data.UniqueIds[i].count;
                                    break;
                                case 'S':
                                    S = data.UniqueIds[i].count;
                                    break;
                            }
                        }
                    }
                    else if (a == 1)
                    {
                        A = 0, PPC = 0, SE = 0,EM = 0, S = 0, O = 0;
                        for (i=0; i<data.ContentActivitie.length; i++) {

                            total2 += data.ContentActivitie[i].count;
                            switch (data.ContentActivitie[i].flag){
                                case 'A':
                                    A = data.ContentActivitie[i].count;
                                    break;
                                case 'O':
                                    O = data.ContentActivitie[i].count;
                                    break;
                                case 'PPC':
                                    PPC = data.ContentActivitie[i].count;
                                    break;
                                case 'SE':
                                    SE = data.ContentActivitie[i].count;
                                    break;
                                case 'EM':
                                    EM = data.ContentActivitie[i].count;
                                    break;
                                case 'S':
                                    S = data.ContentActivitie[i].count;
                                    break;
                            }
                        }

                    }
                    else if (a == 2)
                    {
                        A = 0, PPC = 0, SE = 0,EM = 0, S = 0, O = 0;
                        for (i=0; i<data.Conversion.length; i++) {

                            total3 += data.Conversion[i].count;
                            switch (data.Conversion[i].flag){
                                case 'A':
                                    A = data.Conversion[i].count;
                                    break;
                                case 'O':
                                    O = data.Conversion[i].count;
                                    break;
                                case 'PPC':
                                    PPC = data.Conversion[i].count;
                                    break;
                                case 'SE':
                                    SE = data.Conversion[i].count;
                                    break;
                                case 'EM':
                                    EM = data.Conversion[i].count;
                                    break;
                                case 'S':
                                    S = data.Conversion[i].count;
                                    break;
                            }
                        }

                    }

                }


                coc(0);

                var se1=`<div style="width: `+Math.round(SE/total1*100)+`%;height: 40px;background-color: #272a52;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+SE+`</h4></span>`;
                $('.SearchEngines1').empty();
                $('.SearchEngines1').append(se1);

                var or1=`<div style="width: `+Math.round(O/total1*100)+`%;height: 40px;background-color: #1668b9;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+O+`</h4></span>`;
                $('.Organic1').empty();
                $('.Organic1').append(or1);

                var sm1=`<div style="width: `+Math.round(S/total1*100)+`%;height: 40px;background-color: #31ca6a;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+S+`</h4></span>`;
                $('.SocialMedia1').empty();
                $('.SocialMedia1').append(sm1);

                var af1=`<div style="width: `+Math.round(A/total1*100)+`%;height: 40px;background-color: #fedd5a;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+A+`</h4></span>`;

                $('.Affillate1').empty();
                $('.Affillate1').append(af1);


                var ppc1=`<div style="width: `+Math.round(PPC/total1*100)+`%;height: 40px;background-color: #fc5d56;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+PPC+`</h4></span>`;
                $('.Ppc1').empty();
                $('.Ppc1').append(ppc1);

                var em1=`<div style="width: `+Math.round(EM/total1*100)+`%;height: 40px;background-color: #df6380;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+EM+`</h4></span>`;
                $('.Em1').empty();
                $('.Em1').append(em1);

                coc(1);

                var se2=`<div style="width: `+Math.round(SE/total2*100)+`%;height: 40px;background-color: #272a52;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+SE+`</h4></span>`;
                $('.SearchEngines2').empty();
                $('.SearchEngines2').append(se2);

                var or2=`<div style="width: `+Math.round(O/total2*100)+`%;height: 40px;background-color: #1668b9;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+O+`</h4></span>`;
                $('.Organic2').empty();
                $('.Organic2').append(or2);

                var sm2=`<div style="width: `+Math.round(S/total2*100)+`%;height: 40px;background-color: #31ca6a;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+S+`</h4></span>`;
                $('.SocialMedia2').empty();
                $('.SocialMedia2').append(sm2);

                var af2=`<div style="width: `+Math.round(A/total2*100)+`%;height: 40px;background-color: #fedd5a;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+A+`</h4></span>`;

                $('.Affillate2').empty();
                $('.Affillate2').append(af2);

                var ppc2=`<div style="width: `+Math.round(PPC/total2*100)+`%;height: 40px;background-color: #fc5d56;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+PPC+`</h4></span>`;
                $('.Ppc2').empty();
                $('.Ppc2').append(ppc2);

                var em2=`<div style="width: `+Math.round(EM/total2*100)+`%;height: 40px;background-color: #df6380;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+EM+`</h4></span>`;
                $('.Em2').empty();
                $('.Em2').append(em2);


                coc(2);

                var se3=`<div style="width: `+Math.round(SE/total3*100)+`%;height: 40px;background-color: #272a52;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+SE+`</h4></span>`;
                $('.SearchEngines3').empty();
                $('.SearchEngines3').append(se3);

                var or3=`<div style="width: `+Math.round(O/total3*100)+`%;height: 40px;background-color: #1668b9;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+O+`</h4></span>`;
                $('.Organic3').empty();
                $('.Organic3').append(or3);

                var sm3=`<div style="width: `+Math.round(S/total3*100)+`%;height: 40px;background-color: #31ca6a;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+S+`</h4></span>`;
                $('.SocialMedia3').empty();
                $('.SocialMedia3').append(sm3);

                var af3=`<div style="width: `+Math.round(A/total3*100)+`%;height: 40px;background-color: #fedd5a;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+A+`</h4></span>`;

                $('.Affillate3').empty();
                $('.Affillate3').append(af3);


                var ppc3=`<div style="width: `+Math.round(PPC/total3*100)+`%;height: 40px;background-color: #fc5d56;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+PPC+`</h4></span>`;
                $('.Ppc3').empty();
                $('.Ppc3').append(ppc3);

                var em3=`<div style="width: `+Math.round(EM/total3*100)+`%;height: 40px;background-color: #df6380;float: left; margin: 3px 20px 0px 0px; box-shadow: 2px 2px 10px 0px rgba(0,0,0,0.7);"></div>
    <span><h4> `+EM+`</h4></span>`;
                $('.Em3').empty();
                $('.Em3').append(em3);


            });

        }

        function AccountBasedMarketing(){

            $.get("{{URL::to('/Reports/AccountBasedMarketing')}}",{"clientID":"{{$client_id}}"}).done(function( data ) {
                
                $('.abm1').append('<i class="fa fa-building-o fa-4x" aria-hidden="true" style="color: gray"><span style="color: #333">'+' '+ data[0].TotalCompaniesVisiting+'</span></i>');
                $('.abm2').append('<span class="fa-4x" style="color: #333"><img src="img/image (1-222--).png" />' +data[0].TotalContents+'</span>');
                $('.abm3').append('<i class="fa fa-heart fa-4x red-trend" aria-hidden="true"><span style="color: #333">'+data[0].Conversions+'</span></i>');

            });

        }

        function ABMCVDetails(){
            $.get("{{URL::to('/Reports/ABMCVDetails')}}",{"clientID":"{{$client_id}}"}).done(function( data ) {
               
                $('.abm_cvdetail').empty();

                tbody='';
                for (i=0;i<data.length;i++){
                    var tr='<tr><td>'+data[i].domain+'</td><td>'+data[i].content+'</td><td>'+data[i].cfreq+'</td><td>'+data[i].conversions+'</td></tr>';
                    tbody+=tr;
                }
                $('.abm_cvdetail').append(tbody);

                $('#table_id1').DataTable({ "order": [2, 'desc']});

            });

        }

      
        AccountBasedMarketing();
        ABMCVDetails();

    </script>
    <script type="text/javascript">
        $( window ).resize(function() {
            var width1=$('.group-bar-chart').css('width');
            var width2=width1.substr(0,width1.length-2);
            var width=parseInt(width2)-25;
             
            $('.bar-chart').css('width',width+'px');
        });
    </script>

@endsection
