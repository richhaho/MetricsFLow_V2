@extends('template.template')

@section('content-header')
<link rel="stylesheet" href="/plugins/material/material-charts.css"> 
<link rel="stylesheet" href="{{URL::to('/css/report.css')}}">
<style>                      
            .datagraph{
                float: left;
                width: 100%;
                padding-top: 50px;
            }
            .datagraph i{
                float: left;
                width: 100%;
                font-size: 28px;
                padding: 10px 0px;
            }
            .socialdata{
                float: left;
                width: 100%;
                border-radius: 5px;
                text-align: left;
                padding: 0px;                
                box-shadow: 0px 2px 8px #bababa;
            }
            .socialdata .pagedata{
                background-color: #1E7DBF;
                color: #FFF;
                padding: 5px 10px;
                border-radius: 5px 5px 0px 0px;
                height: 50px;
            }
            .socialdata .warrantypagedata{
                background-color: #00B463;
                color: #FFF;
                padding: 5px 10px;
                border-radius: 5px 5px 0px 0px;
                height: 50px;
            }
            .socialdata .usercount{
                float: left;
                width: 100%;
                padding: 5px 10px;
            }
            .socialdata .usercount p{
                margin-bottom: 0px;
            } 
            .datagraph .datadivpart1{
                padding-right: 0px;
            }
            .datagraph .datadivpart2{
                padding-left: 0px;
            }

            @media (min-width: 768px) and (max-width: 990px) {
                .datagraph .datadivpart2 {                   
                    padding-top: 30px;
                }
            }
            @media (min-width: 990px) and (max-width: 1024px) {
                .socialdata .pagedata,
                .socialdata .usercount
                {                   
                    font-size: 12px;
                }
            }
            @media (max-width: 480px) {
                .datagraph .datadivpart1 .datacommondiv,
                .datagraph .datadivpart2 .datacommondiv{
                    padding-top: 30px;
                }
                .datagraph .datadivpart1{
                    padding-right: 15px;
                }
                .datagraph .datadivpart2
                {
                    padding-left: 15px;
                }
            }

            @media (min-width: 551px) and (max-width: 767px) {
                .datagraph .datadivpart1,
                .datagraph .datadivpart2
                {
                    width: 50%;
                    float: left;
                }  
                .datagraph .datadivpart1 .datacommondiv,
                .datagraph .datadivpart2 .datacommondiv{
                    padding-top: 30px;
                }
            }
        </style>
<section class="content-header">

  <div id="breadcrumbs">
      <h4 class="bold"><i class="fa fa-chevron-left" aria-hidden="true"></i><a href="/Reports">Reports</a> <i class="fa fa-chevron-left" aria-hidden="true"></i> Conversion Details <i class="fa fa-chevron-left" aria-hidden="true"></i> Warranty Page</h4>
    </div>
 
</section>
@endsection

@section('content')
 
<section>
<div class="row">
  <div class="col-lg-11 col-md-12 col-xs-12 col-sm-12">
    <div class="box-tools pull-right">
      <!-- <button type="button" class="btn btn-sm" style="color: #333; " data-widget="collapse">Request Full Report
      </button> -->

          <select class="form-control" >
              <option>Last 30 Days</option>
              <option>Last 60 Days</option>
              <option>Last 90 Days</option>
              <option>Last 10 Days</option>
              <option>Last 20 Days</option>
          </select>
        
    </div>
    <h3 class="bold">Conversion Details For Warranty Page</h3>
  </div>
  <div class="col-lg-11 col-md-12 col-xs-12 col-sm-12" >
    <div class="alert-modal">
      <div class="modal">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12"  style="padding: 0px !important;">
          <div class="modal-dialog">
              <div class="modal-content">
                  
                  <div class="modal-body row">
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                      <div class="row">
                          
                                <div class="datagraph">
                <div class="col-md-6 col-sm-12 datadivpart1">
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center datacommondiv">
                        <img src="img/facbook.png">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Landing Page 12 big words</div>
                            <div class="usercount">
                                <p><span>564</span> Users Entered</p>
                                <p><span>125</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Blog Post 08</div>
                            <div class="usercount">
                                <p><span>439</span> Users Entered</p>
                                <p><span>78</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">How to Stop Money Laundering</div>
                            <div class="usercount">
                                <p><span>361</span> Users Entered</p>
                                <p><span>181</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Fraud Protection Strategies</div>
                            <div class="usercount">
                                <p><span>180</span> Users Entered</p>
                                <p><span>78</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Anti-Fraud Video</div>
                            <div class="usercount">
                                <p><span>102</span> Users Entered</p>
                                <p><span>67</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="warrantypagedata">Warranty Page</div>
                            <div class="usercount">
                                <p><span>33</span> Users Entered</p>
                                <p><span>12</span> Converted</p>
                            </div>
                        </div>                    
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center datacommondiv">
                        <img src="img/linkedin.png">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Blog Post 08</div>
                            <div class="usercount">
                                <p><span>439</span> Users Entered</p>
                                <p><span>78</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Landing Page 12 big words</div>
                            <div class="usercount">
                                <p><span>361</span> Users Entered</p>
                                <p><span>125</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">How to Stop Money Laundering</div>
                            <div class="usercount">
                                <p><span>236</span> Users Entered</p>
                                <p><span>190</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Fraud Protection Strategies</div>
                            <div class="usercount">
                                <p><span>46</span> Users Entered</p>
                                <p><span>22</span> Bounced</p>
                            </div>
                        </div>                   
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="warrantypagedata">Warranty Page</div>
                            <div class="usercount">
                                <p><span>24</span> Users Entered</p>
                                <p><span>10</span> Converted</p>
                            </div>
                        </div>      
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center datacommondiv">
                        <img src="img/youtube.png">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">How to Stop Money Laundering</div>
                            <div class="usercount">
                                <p><span>354</span> Users Entered</p>
                                <p><span>210</span> Bounced</p>
                            </div>
                        </div> 
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Landing Page 12 big words</div>
                            <div class="usercount">
                                <p><span>144</span> Users Entered</p>
                                <p><span>99</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Blog Post 03</div>
                            <div class="usercount">
                                <p><span>439</span> Users Entered</p>
                                <p><span>78</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="warrantypagedata">Warranty Page</div>
                            <div class="usercount">
                                <p><span>45</span> Users Entered</p>
                                <p><span>9</span> Converted</p>
                            </div>
                        </div>      
                    </div>
                </div> 
                <div class="col-md-6 col-sm-12 datadivpart2">
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center datacommondiv">
                        <img src="img/googleplus.png">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Fraud Protection Strategies</div>
                            <div class="usercount">
                                <p><span>780</span> Users Entered</p>
                                <p><span>278</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Blog Post 02</div>
                            <div class="usercount">
                                <p><span>502</span> Users Entered</p>
                                <p><span>69</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>.
                        <div class="socialdata">
                            <div class="pagedata">Landing Page 12 big words</div>
                            <div class="usercount">
                                <p><span>433</span> Users Entered</p>
                                <p><span>112</span> Bounced</p>
                            </div>
                        </div>

                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">How to Stop Money Laundering</div>
                            <div class="usercount">
                                <p><span>321</span> Users Entered</p>
                                <p><span>54</span> Bounced</p>
                            </div>
                        </div>

                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Fraud Protection Strategies</div>
                            <div class="usercount">
                                <p><span>267</span> Users Entered</p>
                                <p><span>78</span> Bounced</p>
                            </div>
                        </div>

                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Anti-Fraud Video</div>
                            <div class="usercount">
                                <p><span>189</span> Users Entered</p>
                                <p><span>67</span> Bounced</p>
                            </div>
                        </div>

                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Fraud Protection Strategies</div>
                            <div class="usercount">
                                <p><span>122</span> Users Entered</p>
                                <p><span>78</span> Bounced</p>
                            </div>
                        </div>

                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Anti-Fraud Video</div>
                            <div class="usercount">
                                <p><span>44</span> Users Entered</p>
                                <p><span>29</span> Bounced</p>
                            </div>
                        </div>

                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="warrantypagedata">Warranty Page</div>
                            <div class="usercount">
                                <p><span>15</span> Users Entered</p>
                                <p><span>3</span> Converted</p>
                            </div>
                        </div>                    
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center datacommondiv">
                        <img src="img/twitter.png">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Anti-Fraud Video</div>
                            <div class="usercount">
                                <p><span>321</span> Users Entered</p>
                                <p><span>78</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Landing Page 12 big words</div>
                            <div class="usercount">
                                <p><span>243</span> Users Entered</p>
                                <p><span>125</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">How to Stop Money Laundering</div>
                            <div class="usercount">
                                <p><span>118</span> Users Entered</p>
                                <p><span>90</span> Bounced</p>
                            </div>
                        </div>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="pagedata">Fraud Protection Strategies</div>
                            <div class="usercount">
                                <p><span>28</span> Users Entered</p>
                                <p><span>12</span> Bounced</p>
                            </div>
                        </div>                   
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <div class="socialdata">
                            <div class="warrantypagedata">Warranty Page</div>
                            <div class="usercount">
                                <p><span>16</span> Users Entered</p>
                                <p><span>3</span> Converted</p>
                            </div>
                        </div> 
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
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</div>
</section>
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>


@endsection