@extends('template.template')

@section('content-header')
<link rel="stylesheet" href="{{URL::to('/css/dashboard.css')}}">
	<section class="content-header">
		<div id="breadcrumbs">
			<h4 class="bold"><i class="fa fa-chevron-left" aria-hidden="true"></i>All Accounts</h4>
		</div>
		<div id="client_logo">
			<img src="img/{{$client_id}}.png" alt="client_logo">
		</div>
	</section>

@endsection
@section('content')
<div class="main-content">
	<div class="row">

		<section id="ActionItems" class="col-md-12 col-lg-12 col-xs-12">
			<div class="row">
				<div class="col-md-12 col-lg-12 col-xs-12">
					<h3 class="bold">Action Items</h3> <!-- class="bold" -->
				</div>
			</div>
		</section>
		
		<section class="col-lg-11 connectedSortable ui-sortable">
	          <div class="box box-solid bg-teal-gradient">
	            <div class="box-header" style="background-color: #2E6FAB;border-radius:5px 5px 0 0;">
	              <i class="fa fa-heart"></i>

	              <h3 class="box-title">New Lead Converted!</h3>

	              <div class="box-tools pull-right">
	                <button type="button" class="btn btn-sm" style="color: #333; " data-widget="collapse">View Lead
	                </button>
	                <button type="button" class="btn btn-sm" data-widget="remove" style="background-color: transparent;"><i class="fa fa-times"></i>
	                </button>
	              </div>
	            </div>
	            <div class="box-body border-radius-none" style="background-color: #FFF;color: #333">
	               	
				       	<div class="row left">
					        <div class="col-md-3 alert-content">
					           	<div class="alert-label actionItem_DateConverted">
					           		
					           	</div>
					        </div>
					        <div class="col-md-3 alert-content">
					           	<div class="alert-label actionItem_Campaign">
					           		
					           	</div>
					        </div>
					        <div class="col-md-3 alert-content">
					           	<div class="alert-label actionItem_Engagement">
					           		
					           	</div>
					        </div>
					        <div class="col-md-3 alert-content">
					           	<div class="alert-label actionItem_TotalSessions">
					           		
					           	</div>
					        </div>
					    </div>
					    		
	            </div>
	            <!-- /.box-body -->
	          </div>
          </section>

          <section class="col-lg-11 connectedSortable ui-sortable">
	     
	          <div class="box box-solid bg-teal-gradient">
	            <div class="box-header" style="background-color: #ED254E;border-radius:5px 5px 0 0;">
	              <i class="fa fa-exclamation-triangle"></i>

	              <h3 class="box-title">404 Error Detected in Campaign <span id="EDC_client_id"></span></h3>

	              <div class="box-tools pull-right">
	                <button type="button" class="btn btn-sm" data-widget="remove" style="background-color: transparent;"><i class="fa fa-times"></i>
	                </button>
	              </div>
	            </div>
	            <div class="box-body border-radius-none" style="background-color: #FFF;color: #333">
	               
				       	<div class="row left">
					        <div class="col-md-4 col-xs-12 col-sm-12 alert-content left">
				            	<div class="alert-label Error_DateDetected">
				            		
				            	</div>
				            </div>
				            <div class="col-md-4 col-xs-12 col-sm-12 alert-content left">
				            	<div class="alert-label Error_Visitors">
				            		
				            	</div>
				            </div>
				            <div class="col-md-4 col-xs-12 col-sm-12 alert-content left">
				            	<div class="alert-label Error_Sessions">
				            		
				            	</div>
				            </div>
				            <div class="col-md-12 col-xs-12 col-sm-12 alert-content left">
				            	<div class="alert-label Error_PageName">
				            		
				            	</div>
				            </div>
					    </div>
					   
	            </div>
	            <!-- /.box-body -->
	          </div>
          </section>


          

		<section class="col-lg-11 connectedSortable ui-sortable" style="padding: 0px;">
			<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="alert-modal">
						<div class="modal">
							<div class="modal-dialog alertbox">
							    <div class="modal-content">
							        <div class="modal-header blue">         
							            <h4 class="modal-title text-align">Marketing Qualified Leads</h4>
							        </div>
							        <div class="modal-body">
							        	<div class="row left">
								            <div class="col-md-12 alert-content">
								            	<div class="alert-label">
								            		<h4 class="bold600">Current Orphans</h4>
								            		<div class="text-align box-data">
								            			<div class="display">
								            				<i class="fa fa-arrow-up fa-4x green-trend" aria-hidden="true"></i>
								            			</div>
								            			<div class="padding15 display">
								            				<h1 id="LS_MarketingQualified"></h1>
								            			</div>
								            			<div class="padtop text-align left25 action-btn">
								            				<button type="button" class="btn btn-default btn-flat">View Recommended Actions</button>
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
							            <h4 class="modal-title text-align">Top of Funnel Leads</h4>
							        </div>
							        <div class="modal-body">
							        	<div class="row left">
								            <div class="col-md-12 alert-content">
								            	<div class="alert-label">
								            		<h4 class="bold600">Current Orphans</h4>
								            		<div class="text-align box-data">
								            			<div class="display">
								            				<i class="fa fa-arrow-down fa-4x red-trend" aria-hidden="true"></i>
								            			</div>
								            			<div class="padding15 display">
								            				<h1 id="LS_TopFunnel"></h1>
								            			</div>
								            			<div class="padtop text-align left25 action-btn">
								            				<button type="button" class="btn btn-default btn-flat">View Recommended Actions</button>
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
							            <h4 class="modal-title text-align">Returning Customers</h4>
							        </div>
							        <div class="modal-body">
							        	<div class="row left">
								            <div class="col-md-12 alert-content">
								            	<div class="alert-label">
								            		<h4 class="bold600">Current Orphans</h4>
								            		<div class="text-align box-data">
								            			<div class="display">
								            				<i class="fa fa-arrow-up fa-4x green-trend" aria-hidden="true"></i>
								            			</div>
								            			<div class="padding15 display">
								            				<h1 id="LS_ReturningCustomers"></h1>
								            			</div>
								            			<div class="padtop text-align left25 action-btn">
								            				<button type="button" class="btn btn-default btn-flat">View Recommended Actions</button>
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

		<section class="col-lg-11 connectedSortable ui-sortable">
			<div class="col-md-12 col-xs-12 col-sm-12">
				<h3 class="bold">Active Leads</h3>
			</div>
			<div class="col-md-12 col-xs-12 col-sm-12">
				<div class="alert-modal">
					<div class="modal">
						<div class="col-md-12 col-xs-12 col-sm-12"  style="padding: 0px !important;">
							<div class="modal-dialog">
							    <div class="modal-content">
							        <div class="modal-header light-blue">
							           <div class="float-right">
							              	<button type="button" class="close alert-cross" data-dismiss="modal" aria-label="Close">
							                  <span aria-hidden="true">&times;</span></button>
							           	</div>	          
							            <h4 class="modal-title"><strong><span class="active_leads_count"></span> active leads across {{$client_id}} campaigns</strong></h4>
							        </div>
							        <div class="modal-body">	
							        	<div id="active_lead_list" class="row active_leads">
								            
								            
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
		
		<section class="col-lg-11 connectedSortable ui-sortable">
			<div class="col-md-10 col-xs-12 col-sm-12">
				<h3 class="bold">Lead Progression</h3>
			</div>
			<!-- <div class="col-md-2 col-sm-12 col-xs-12">
					<select class="form-control tableselect" onchange="leadProgression(this.value)">
						<option value="7">Last 7 Days</option>
						<option value="14">Last 14 Days</option>
						<option value="21">Last 21 Days</option>
						<option value="30">Last 30 Days</option>
					</select>
			</div> -->

			<div class="col-md-12 col-lg-12 col-xs-12">
				<!-- <div class="col-lg-10 col-sm-10 col-xs-10 col-md-10 center"> -->
			    	<div class="col-md-12 box1">        
			        	<div class="row" id="action_item_content" >
			          		<div class="col-md-12">
					            <div class="col-lg-3 col-md-6">
					            	<div class="row">
					                	<div class="col-md-1"></div>
					                	<div class="col-md-10" align="center">
						                  	<!-- <img class="img-responsive" src="/img/cluster2.png" style="text-align: center;">  -->
						                  	<div id="bubble1" style="height: 200px;overflow: none;fill: #272a52;"></div>                    
					                	</div>
					              	</div>
					                <div class="row">
						                <div class="col-md-1"></div>
						                <div class="col-md-10">
						                  <p style="font-size: 30px;text-align: center;" id="LP_Awareness"></p>
						                  <p style="font-size: 20px;text-align: center;">Aware</p>
						                </div>
					              	</div>
					            </div>

			            		<div class="col-lg-3 col-md-6">
				              		<div class="row">
				                		<div class="col-md-1"></div>
				                		<div class="col-md-10" align="center">
				                  			<div id="bubble2" style="height: 200px;fill: #327aba;"></div>                    
				                		</div>
				              		</div>
						            <div class="row">
						                <div class="col-md-1"></div>
						                <div class="col-md-10">
						                  <p style="font-size: 30px;text-align: center;" id="LP_Engaged"></p>
						                  <p style="font-size: 20px;text-align: center;">Engaged</p>
						            	</div>
						        	</div>
				            	</div>
				            	<div class="col-lg-3 col-md-6">
						            <div class="row">
						                <div class="col-md-1"></div>
						                <div class="col-md-10" align="center">
						                  <div id="bubble3"  style="height: 200px;margin:auto;fill: #e70137;"></div>                    
						                </div>
						            </div>
					                <div class="row">
						                <div class="col-md-1"></div>
						                <div class="col-md-10">
						                  <p style="font-size: 30px;text-align: center;" id="LP_Considering"></p>
						                  <p style="font-size: 20px;text-align: center;">Considering</p>
						                </div>
					              	</div>
				            	</div>

				            	<div class="col-lg-3 col-md-6">
						            <div class="row">
						                <div class="col-md-1"></div>
						                <div class="col-md-10" align="center">
						                  <div id="bubble4"  style="height: 200px;margin:auto;fill: #31ca6a;"></div>                    
						                </div>
						            </div>
					                <div class="row">
						                <div class="col-md-1"></div>
						                <div class="col-md-10">
						                  <p style="font-size: 30px;text-align: center;" id="LP_Converted"></p>
						                  <p style="font-size: 20px;text-align: center;">Converted</p>
						                </div>
					              	</div>
				            	</div>
				          </div>
				        </div>        
				      </div>
				   <!--  </div> -->
			</div>
		</section>		

		<section class="col-lg-11 connectedSortable ui-sortable">
				<br />
					<div class="col-md-11 col-lg-12 col-xs-12">
						<div class="col-md-10 col-sm-12 col-xs-12">
								<h3 class="bold">Top Paths to Conversion</h3>	
						</div>	
						<!-- <div class="col-md-2 col-sm-12 col-xs-12">
							<select class="form-control tableselect" onchange="topPathsConversion(this.value)">
								<option value="7">Last 7 Days</option>
								<option value="14">Last 14 Days</option>
								<option value="21">Last 21 Days</option>
								<option value="30">Last 30 Days</option>
							</select>
					    </div> -->
					</div>

					<div class="col-md-11 col-lg-12 col-xs-12">
						<div class="alert-modal">
							<div class="modal">
								<div class="col-md-12 col-xs-12 col-sm-12">
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
				</section>
	</div>
</div>
<script type="text/javascript" src="{{URL::to('/plugins/chartjs/d3.min.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jcanvas/20.1.4/jcanvas.js"></script>
<script src="{{URL::to('/js/dashboard_pathchart.js')}}"></script>

<script type="text/javascript">
function show_data_fromDB(){
	/////// ajax part  for lead progression 
		$.get("{{URL::to('/dashboard/leadProgression')}}",{"client_id":"{{$client_id}}"}).done(function( data ) {

		var jsons=[
		  	{"countries_msg_vol": { }},
		  	{"countries_msg_vol": {"A": 9 }},
		  	{"countries_msg_vol": {"A": 9, "B": 4 }},
		  	{"countries_msg_vol": {"A": 9, "B": 4, "C": 3  }},
		  	{"countries_msg_vol": {"A": 9, "B": 4, "C": 3, "D": 2}},
		  	{"countries_msg_vol": {"A": 9, "B": 4, "C": 3, "D": 2, "E": 1 }},
		  	{"countries_msg_vol": {"A": 9, "B": 4, "C": 3, "D": 2, "E": 1, "F": 6}},
		  	{"countries_msg_vol": {"A": 9, "B": 4, "C": 3, "D": 2, "E": 1, "F": 6, "G": 4}},
		  	{"countries_msg_vol": {"A": 9, "B": 4, "C": 3, "D": 2, "E": 1, "F": 6, "G": 4, "H": 2}},
		  	{"countries_msg_vol": {"A": 9, "B": 4, "C": 3, "D": 2, "E": 1, "F": 6, "G": 4, "H": 2}},
		  	{"countries_msg_vol": {"A": 9, "B": 4, "C": 3, "D": 2, "E": 1, "F": 6, "G": 4, "H": 2}},
		 ];		 
		
		$("#bubble1").empty();
		$("#bubble2").empty();
		$("#bubble3").empty();
		$("#bubble4").empty();
		$("#LP_Awareness").html(data.Awareness_pct+"%");
		$("#LP_Engaged").html(data.Engaged_pct+"%");
		$("#LP_Considering").html(data.Considering_pct+"%");
		$("#LP_Converted").html(data.Converted_pct+"%");

		var bubble_count=Math.round(data.Awareness_pct/10);
	  if (data.Awareness_pct>0 && bubble_count==0) bubble_count=1;
	 	var json1=jsons[bubble_count];
		create_bubble(json1,'1',bubble_count);	

	 var bubble_count=Math.round(data.Engaged_pct/10);
	  if (data.Engaged_pct>0 && bubble_count==0) bubble_count=1;
	 	var json2=jsons[bubble_count];
		create_bubble(json2,'2',bubble_count);	

	 var bubble_count=Math.round(data.Considering_pct/10);
	  if (data.Considering_pct>0 && bubble_count==0) bubble_count=1;
	 	var json3=jsons[bubble_count];
		create_bubble(json3,'3',bubble_count);	

	 var bubble_count=Math.round(data.Converted_pct/10);
	  if (data.Converted_pct>0 && bubble_count==0) bubble_count=1;
	 	var json4=jsons[bubble_count];
		create_bubble(json4,'4',bubble_count);	
	});

	$.get("{{URL::to('/dashboard/actionItem')}}",{"client_id":"{{$client_id}}"}).done(function( data ) {
	  
			$(".actionItem_DateConverted").html("<h5>Date Converted: <strong>"+data.DateDetected
			+"</strong></h5>"); 

			$(".actionItem_Campaign").html("<h5>Campaign: <strong>"+data.client_id
			+"</strong></h5>"); 

			$(".actionItem_Engagement").html("<h5>Engagement: <strong>"+data.EngagementLevel
			+"</strong></h5>"); 

			$(".actionItem_TotalSessions").html("<h5>Total Sessions: <strong>"+data.TotalSessions
			+"</strong></h5>"); 

	});	
	$.get("{{URL::to('/dashboard/error404detected')}}",{"client_id":"{{$client_id}}"}).done(function( data ) {
		 
		$(".Error_Campaign").html(data.client_id
			);
			$(".Error_DateDetected").html("<h5>Date Detected: <strong>"+data.DateConceived
			+"</strong></h5>"); 

			$(".Error_Visitors").html("<h5>Unique Visitors Affected: <strong>"+data.TotalVisitors
			+"</strong></h5>"); 

			$(".Error_Sessions").html("<h5>Total Sessions Affected: <strong>"+data.TotalSessionsAttracted
			+"</strong></h5>"); 

			$(".Error_PageName").html('<h5 style="display: inline-block;">Page Name: <strong><a href="#" class="text">'+data.PageName+'</a></strong></h5>'); 
	});	
 
	$.get("{{URL::to('/dashboard/activeLeads_count')}}",{"client_id":"{{$client_id}}"}).done(function( data ) {
		 $(".active_leads_count").html(data);
	});	
	$.get("{{URL::to('/dashboard/activeLeads')}}",{"client_id":"{{$client_id}}"}).done(function( data ) {
		 
		var showleads="";
		for (i=0;i<data.length;i++){
	    	showleads=showleads+'<div class="col-md-12 alert-content left0"><div class="alert-label"><h5>'+data[i].Value +' viewing page: <strong class="text">'+data[i].PageName+'</strong></h5></div></div>';
		}
		$(".active_leads").html(showleads); 
	});	

	$.get("{{URL::to('/dashboard/nodePath')}}",{"client_id":"{{$client_id}}"}).done(function( data ) {
		var pathdata=JSON.parse(data);
		var element="#pathChart";
		
		pathChart_plot(pathdata,element);
	});


	$.get("{{URL::to('/dashboard/leadsSegmenting')}}",{"client_id":"{{$client_id}}"}).done(function( data ) {

		$("#LS_MarketingQualified").html(data.MarketingQualified);
		$("#LS_TopFunnel").html(data.TopFunnel);
		$("#LS_ReturningCustomers").html(data.ReturningCustomers);
	});
  	setTimeout(show_data_fromDB,300000);
}

$( window ).load(function() {  

	show_data_fromDB();

});


function create_bubble(json, num, bubble_count){

  	  var diameter = 200/10*bubble_count;
	  diameter = diameter.toFixed(0);

	  var svg = d3.select('#bubble'+num).append('svg')
				.attr('id','sg'+num)
				.attr('width', diameter)
				.attr('height', diameter);

	  var bubble = d3.layout.pack()
				.size([diameter, diameter])
				.value(function(d) {return d.size;})
          		
				.padding(3);
  
	  // generate data with calculated layout values
	  var nodes = bubble.nodes(processData(json)).filter(function(d) { return !d.children; }); // filter out the outer bubble
	 
	  var vis = svg.selectAll('circle').data(nodes);
	 
	  vis.enter().append('circle')
				.attr('transform', function(d) { console.log(d); return 'translate(' + d.x + ',' + d.y + ')'; })
				.attr('r', function(d) { return d.r; })
				.attr('class', function(d) { return d.className; });
	  
	  document.getElementById("sg"+num).style.marginTop  = (200-diameter)/2+'px'; 
}

function processData(data) {

    var obj = data.countries_msg_vol;
    var newDataSet = [];
    for(var prop in obj) {
      	newDataSet.push({name: prop, className: prop.toLowerCase(), size: obj[prop]});
    }
    return {children: newDataSet};
}

</script>


@endsection




