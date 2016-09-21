@extends('template.template')

@section('content-header')
<link rel="stylesheet" href="{{URL::to('/css/dashboard.css')}}">
<style type="text/css">
   .bar_avg_visitor{
      height: 40px;
       
      padding: 0;
      margin-top: 10px;margin-bottom: 10px;
   }
   .align{
   	display: flex;
   	flex-direction: column;
   }
   .top_content_header{
   	  height: 60px;overflow: hidden;
   }
   .top_content_header a{
   	line-height: 40px;
   }
</style>
	<section class="content-header">
		<div id="breadcrumbs">
			<h4 class="bold"><i class="fa fa-chevron-left" aria-hidden="true"></i><a href="/Channels">All Channels</a></h4>
		</div>
		<div id="client_logo">
			<img src="img/{{Session('client_id')}}.png" alt="client_logo">
		</div>

	</section>

@endsection
@section('content')
<div class="main-content">
	<div class="row">
		<section id="Trends">
			<div class="col-md-11 col-lg-12 col-xs-12">
				
					<h1 class="bold">{{$DomainName}}</h1>
					<div class="col-md-10 col-sm-12 col-xs-12">
							<h3 class="bold">Lead Funnel</h3>	
					</div>	
					<div class="col-md-2 col-sm-12 col-xs-12">
						<select class="form-control tableselect" onchange="leadFunnel(this.value)">
							<option value="7">Last 7 Days</option>
							<option value="14">Last 14 Days</option>
							<option value="21">Last 21 Days</option>
							<option value="30" selected="">Last 30 Days</option>
						</select>
				    </div>
				
			</div>
			<div class="row">
				<div class="col-md-11 col-xs-12 col-1g-10">
					<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="alert-modal">
								<div class="modal">
									<div class="modal-dialog alertbox">
									    <div class="modal-content">
									        <div class="modal-header light-blue">
									        	<div class="col-lg-12 col-md-12 col-sm-12">
									        		<div class="col-md-8 col-sm-12 col-xs-12">
									        			<div id="lead_funnel_barchart1" class="modal-body"> 
										                    <!-- <div class="col-md-12 col-sm-12 col-xs-12  bar_avg_visitor"> 
										                        <div class="float-right" style="width:100%;height:100%;background-color: #fc5d56;"></div>
										                    </div>
										                    <div class="col-md-12 col-sm-12 col-xs-12 bar_avg_visitor"> 
										                        <div  class="float-right" style="width:80%;height:100%;background-color: #327aba;"></div>
										                    </div>
										                    <div class="col-md-12 col-sm-12 col-xs-12 bar_avg_visitor"> 
										                        <div  class="float-right" style="width:70%;height:100%;background-color: #e70047;"></div>
										                    </div>
										                    <div class="col-md-12 col-sm-12 col-xs-12 bar_avg_visitor"> 
										                        <div  class="float-right" style="width:50%;height:100%;background-color: #31ca6a;"></div>
										                    </div> -->
										                </div>
									        		</div>
									        		<div class="col-md-4 col-sm-12 col-xs-12 align">
									        			<div id="lead_funnel_barchart1_data" class="modal-body">
										        			<?php /* <p><h4>{{$countPages}} {{$DomainName}} Page</h4></p>
										        			<p><h4>{{$LandingPages}} Landing Pages</h4></p>
										        			<p><h4>{{$RequestPages}} Request a Quote</h4></p>
										        			<p><h4>{{$ConfirmationPages}} Confirmation Page</h4></p> */ ?>
									        			</div>
									        		</div>
									        	</div>
									        	<div class="col-lg-12 col-md-12 col-sm-12">
									        		<div class="col-xs-1"> 
									        		 	<h1 class="bold float-right" style="margin-top: 0px" id="LF_trending"><?php //{{round($lead_conversion/$conversions*100)}}%?></h1>
									        		</div>
									        		<div class="col-xs-6"> 
									        		 	<p class="bold">TRENDING UP</p>
									        		 	<p>Lead Conversions: <span id="LF_leadConversions"></span><?php //{{$lead_conversion}} ?></p>
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

		<!-- Trends -->
		<section id="Trends">
			<div class="row">
				<div class="col-md-11 col-lg-12 col-xs-12">
					<div class="col-md-10 col-sm-12 col-xs-12">
								<h3 class="bold">Top Content</h3>	
						</div>	
						<div class="col-md-2 col-sm-12 col-xs-12">
							<select class="form-control tableselect" onchange="topContent(this.value)">
								<option value="7">Last 7 Days</option>
								<option value="14">Last 14 Days</option>
								<option value="21">Last 21 Days</option>
								<option value="30" selected="">Last 30 Days</option>
							</select>
					    </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-11 col-xs-12 col-1g-12">
					<div class="col-lg-12 col-md-12 col-sm-12">
						 @foreach ($top_contents as $key => $top_content)  
						<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
							<div class="alert-modal">
								<div class="modal">
									<div class="modal-dialog alertbox">
									    <div class="modal-content">
									        <div class="modal-header light-blue top_content_header">         
									            <h4 class="modal-title"><a id="TC_ContentHref{{$key+1}}" href="{{URL::to('ContentDetail')}}?PageName={{$top_content->PageName}}"><span id="TC_ContentTitle{{$key+1}}">{{$top_content->PageName}}</span></a></h4>
									        </div>
									        <div class="modal-body">
									        	<div class="row ">
										            <div class="col-md-12">
										            	<div class="alert-label">
										            		<div class="box-body">
											            		<div class="thumbnail_image">         
											                   		<a href="/content">
											                      		<div id="screenshot" style="overflow: hidden; border: 1px solid black">                           
											                          		<!-- <iframe sandbox="allow-pointer-lock" scrolling="no" src='http://m5.ca/' style="border:none;"></iframe>  -->
											                          		<!-- <iframe id="TC_ContentUrl{{$key+1}}" src="{{$top_content->PageURL}}" name= "tabsa" width="95%" height="200px" frameborder="0" allowtransparency="true"></iframe> -->                      
											                         		
											                       		</div>
											                   		</a>
											                	</div>
										                	</div>
													    </div>
													    <div class="col-md-12 col-sm-6 col-xs-12">
											            	 <div class="col-lg-3" style="padding: 0px;">
											            	 	<h1  style="margin: 0px;"><strong id="TC_ContentPer{{$key+1}}">{{number_format($top_content->avgscore,1)}}</strong></h1>

											            	 </div>								            			
											            	 <div class="col-lg-9">
											            	 	<p>Prospects Generated: <span id="TC_ProspectsGenerated{{$key+1}}">{{$top_content->sum}}</span> </p>
											            	 	<p>Posted: <span id="TC_Posted{{$key+1}}"><b>{{date("M d, Y",strtotime($top_content->Date))}}</b></span> </p>

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
			</div>
		</section>
		
		<section id="PathsConversions">
			<div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
						<h3 class="bold">Top Paths to Conversion</h3>					
						<!-- <div id="filters" class="float-right top30 col-md-offset-6">
								<select class="form-control">
									<option>Last 7 Days</option>
									<option>Last 14 Days</option>
									<option>Last 21 Days</option>
									<option>Last 30 Days</option>
								</select>
						</div> -->
			</div>

			<div class="row">
				<div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
					<div class="alert-modal">
						<div class="modal">
							<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
								<div class="modal-dialog">
								    <div class="modal-content">
								        <div class="modal-header light-blue">
								        	<div class="pathChart_group">
									        	<div id="pathChart">
									        		<div class="pathpart">
									        			<div class="facebook"><center><i class="fa fa-facebook fa-3x" aria-hidden="true"></i></center></div>
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
	</div>
</div>
<script type="text/javascript" src="{{URL::to('/plugins/chartjs/d3.min.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jcanvas/20.1.4/jcanvas.js"></script>
<script src="{{URL::to('/js/dashboard_pathchart.js')}}"></script>

<script type="text/javascript">
	$.get("/dashboard/nodePath",{"client_id":"{{$client_id}}"}).done(function( data ) {
		var pathdata=JSON.parse(data);
		var element="#pathChart";
		pathChart_plot(pathdata,element);
		 
	});

	function leadFunnel(days = 30)
	{ 
		$.get("{{URL::to('/Channel/leadFunnel')}}",{"clientID":"{{Session::get('userdata')->client_id}}",days:days,"domainName":"{{$DomainName}}"}).done(function( data ) {

			var lead_funnel_barchart1 = ''; 
			var lead_funnel_barchart1_data = '';
			$.each(data.leadFunnelBarChart, function( index, value ) {

			 	lead_funnel_barchart1 += '<div class="col-md-12 col-sm-12 col-xs-12  bar_avg_visitor">' 
		        +      '<div class="float-right" style="width:'+value.SessionPer+'%;height:100%;background-color: '+value.SessionColor+';"></div>'
		        + '</div>';

	        	lead_funnel_barchart1_data += '<div class="col-md-12 col-sm-12 col-xs-12  bar_avg_visitor">'
	        	+	'<div class="float-right" style="width:100%;height:100%;padding-top:8px;"><b>'+value.TotalSession+' '+value.SessionTitle+'</b></div>'
	        	+'</div>';
	        	
			});
			$('#lead_funnel_barchart1').html(lead_funnel_barchart1);
			$('#lead_funnel_barchart1_data').html(lead_funnel_barchart1_data);
			$('#LF_trending').html(data.trending+'%');
			$('#LF_leadConversions').html(data.leadConversions);
		    
		});
	}

	function topContent(days = 30)
	{

		$.get("{{URL::to('/Channel/topContent')}}",{"clientID":"{{Session::get('userdata')->client_id}}",days:days}).done(function( data ) {

			$.each(data.contentData, function( index, value ) {
				
				$('#TC_ContentTitle'+(index+1)).html(value.ContentTitle);
				$('#TC_ContentPer'+(index+1)).html(value.ContentPer);
				$('#TC_ProspectsGenerated'+(index+1)).html(value.ProspectsGenerated);
				$('#TC_Posted'+(index+1)).html(value.Posted);
				$('#TC_ContentUrl'+(index+1)).attr("src", value.ContentUrl);
				$('#TC_ContentHref'+(index+1)).attr("href", '{{URL::to("ContentDetail")}}?PageName='+value.ContentTitle);
				
			});
		});

	}

	$( document ).ready(function() {

	  leadFunnel();

	});
</script>


@endsection




