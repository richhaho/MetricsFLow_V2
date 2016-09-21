@extends('template.template')

@section('content-header')
<section class="content-header">
	<div id="breadcrumbs">
		 <h4 class="bold"><i class="fa fa-chevron-left" aria-hidden="true"></i> <br>
			</h4>
	</div>
	<div id="client_logo">
		<img src="img/{{Session('client_id')}}.png" alt="client_logo">
	</div>
</section>
<style type="text/css">
	.wd{
		word-wrap: break-word;
	}
	 .box-header{height: 48px; overflow: hidden;color: black; }
	 .green{color: #59f441}
	 .blue_color{color: #2297e5}
	 .red0{color: #fc5d56}
	 .red1{color: #e70047}
	 .title_back_grey{
	 	background-color:#f5f7ff; 
	 }
</style>

@endsection
@section('content')
<section id="TOPCampaigns">
	<div class="row">
		<div class="col-md-11 col-sm-12 col-xs-12">
			<div class="col-md-10 col-sm-12 col-xs-12">
				<h3 class="bold">Top Campaigns</h3>
			</div>
			<div class="col-md-2 col-sm-12 col-xs-12">
				<select class="form-control tableselect" onchange="topCampaigns(this.value);">
		                <option value="30">Last 30 days</option>
		              	<option value="60">Last 60 days</option>
		              	<option value="90">Last 90 days</option>
			        </select>
		     </div>     
		</div>
		<div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
			@foreach ($topCampaigns as $topCampaign)
			<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="alert-modal">
					<div class="modal">
						<div class="modal-dialog alertbox">
						    <div class="modal-content">
						        <div class="modal-header title_back_grey">         
						            <h4 class="modal-title">Campaign {{$topCampaign->client_id}}</h4>
						        </div>
						        <div class="modal-body">
						        	<div class="row left">
							            <div class="col-md-12 alert-content">
							            	<div class="alert-label">
							            		 
								            	<div class="text-align box-data">
								            		<div class="padding15 display green">
								            			<h1>{{number_format($topCampaign->avgscore,1)}}</h1>
								            		</div>								 
								            	</div>
										    </div>
										    <div class="col-md-12 col-sm-6 col-xs-12">
								            	<div>
								            		<h5>Content Interactions: {{$topCampaign->sum}}</h5>
								            	</div>
								            	<div>
								            		<h5>Content Engagement: 730</h5>
								            	</div>
								            	<div>
								            		<h5>Called to action: 230</h5>

								            	</div>								
								            	<div>
								            		<h5>Lead Conversions: {{$topCampaign->leadconversion}}</h5>
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
			@endforeach
			
		</div>
	</div>
</section>

<section id="allchannels">
	<div class="row">
		<div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-10 col-sm-12 col-xs-12">
				<h3 class="bold">All Campaigns</h3>  
			</div>
			<div class="col-lg-2 col-sm-12 col-xs-12">
	            <form action="#" method="get" class="sidebar-form">
			        <div class="input-group">
			          <input name="search" id="cnlSearch" class="form-control" placeholder="Search Campaigns" type="text" style="background-color:transparent;">
			              <span class="input-group-btn">
			                <button type="button" onclick="allCampaigns()" name="search" id="search-btn" class="btn btn-flat" style="background-color:transparent;"><i class="fa fa-search" ></i>
			                </button>
			              </span>
			        </div>
			      </form>
	        </div>  
		</div>
		<div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
			@foreach ($allCampaigns as $allCampaign)
			<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="alert-modal">
					<div class="modal">
						<div class="modal-dialog alertbox">
						    <div class="modal-content">
						        <div class="modal-header title_back_grey">         
						            <h4 class="modal-title">Campaign {{$allCampaign->client_id}}</h4>
						        </div>
						        <div class="modal-body">
						        	<div class="row left">
							            <div class="col-md-12 alert-content">
							            	<div class="alert-label">
							            		 
								            	<div class="text-align box-data">
								            		<div class="padding15 display green">
								            			<h1>{{number_format($allCampaign->avgscore,1)}}</h1>
								            		</div>								 
								            	</div>
										    </div>
										    <div class="col-md-12 col-sm-6 col-xs-12">
								            	<div>
								            		<h5>Content Interactions: {{$allCampaign->sum}}</h5>
								            	</div>
								            	<div>
								            		<h5>Content Engagement: 730</h5>
								            	</div>
								            	<div>
								            		<h5>Called to action: 230</h5>

								            	</div>								
								            	<div>
								            		<h5>Lead Conversions: {{$allCampaign->leadconversion}}</h5>
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
			@endforeach
		</div>
		
	</div>
</section>

@endsection