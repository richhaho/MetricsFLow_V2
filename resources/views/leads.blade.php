@extends('template.template')

@section('content-header') 
<link rel="stylesheet" href="{{URL::to('/css/leads.css')}}">
	<section class="content-header">
		 
		<div id="client_logo">
			<img src="img/{{$client_id}}.png" alt="client_logo">
		</div>
	</section>
@endsection
@section('content')
<div class="main-content">
<div class="row">
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
</style>
<section class="col-lg-12 connectedSortable ui-sortable">

	<div class="row">
		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
			<h3 class="bold">Lead Funnel</h3>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
			<select class="form-control tableselect" style="border:none;" onchange="leadsFunnel(this.value);">
				<option value="10">Last 10 Days</option>
				<option value="20">Last 20 Days</option>
				<option value="30">Last 30 Days</option>
				<option value="60">Last 60 Days</option>
				<option value="90">Last 90 Days</option>
				<option value="0" selected>Overall</option>
			</select>
		</div>
	</div>

	<div class="alert-modal">
		<div class="modal">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-body">
						<div class="row">
							{{--<div id='leadfunnel_loader' class="col-md-12 col-sm-12 col-xs-12" style='display: none;text-align:center;'><img src='{{URL::to('/img/loader.gif')}}'></div>--}}
							<div id="leadfunnel_contain" class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="col-lg-12 col-md-12" >
										<div class="row">
											<div class="col-md-1"></div>
											<div class="col-md-5 col-sm-12 col-xs-12">
												<div id="lead_funnel_barchart1" class="modal-body">
												</div>
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12 align">
												<div id="lead_funnel_barchart1_data" class="modal-body">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div></div></div></div></div>
</section>
<section class="col-lg-12 connectedSortable ui-sortable">
			<div class="col-md-10 col-xs-12 col-sm-12">
				<h3 class="bold">Lead Progression</h3>
			</div>
			

			<div class="col-md-12 col-lg-12 col-xs-12">
				
			    	<div class="col-md-12 box1">        
			        	<div class="row" id="action_item_content" >
			          		<div class="col-md-12">
					            <div class="col-lg-3 col-md-6">
					            	<div class="row">
					                	<div class="col-md-1"></div>
					                	<div class="col-md-10" align="center">
						                  	
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
 <section class="col-lg-12 connectedSortable ui-sortable content">
	 <div class="alert-modal">
		 <div class="modal">
			 <div class="modal-dialog">
				 <div class="modal-content">

					 <div class="modal-body">
						 <div class="row">
							 <div class="col-lg-12">
								 <div class="">
									 <div class="box-header">
										 <h3 class="bold">Recent Leads</h3>
									 </div>
									 <!-- /.box-header -->
									 <div class="box-body">
										 <table id="bt_dt" class="table table-hover">
											 <thead >
											 <tr>
												 <th width="5%">User ID</th>
												 <th width="5%">Channel</th>
												 <th width="30%">Latest Content</th>
												 <th width="5%">Stage</th>
												 <th width="10%">Last Seen</th>

											 </tr>
											 </thead>
											 <tbody>
                                             @foreach ($recentLeads['LeadList'] as $value)
												 <tr>
													 <td><a href="/LeadID?e_id={{$value['UserID']}}&lastseen={{$value['LastSeen']}}">{{$value['UserID']}}</a></td>
													 <td>{{$value['Channel']}}</td>
 
													 <td><a href="/ContentDetail?PageName={{$value['LatestContent']}}&PageURL={{$value['URL']}}&Date={{$value['LastSeen']}}">{{$value['LatestContent']}}</a></td>
 
													 <td>{{$value['Stage']}}</td>
													 <td>{{$value['LastSeen']}}</td>
												 </tr>
											 @endforeach
											 </tbody>

										 </table>
									 </div>
									 <!-- /.box-body -->
								 </div>
								 <!-- /.box -->
								 <!-- /.box -->
							 </div>
							 <!-- /.col -->
						 </div>
					 </div>

				 </div>

			 </div>


		 </div>
	 </div>

      <!-- /.row -->
    </section>



<script src="{{URL::to('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{URL::to('plugins/morris/morris.min.js')}}"></script>
<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script type="text/javascript" src="{{URL::to('js/horizontal-chart.js')}}"></script>

<script src="{{URL::to('plugins/chartjs/Chart.min.js')}}"></script>

<script>
  $(function () {
    $('#bt_dt').DataTable({"order": [4, 'desc']
      // "paging": true,
      // "lengthChange": true,
      // "searching": true,
      // "ordering": true,
      // // "info": true,
      // "autoWidth": true
    });
  });

function leadsFunnel(days = 0)
{ 
 
	$.get("{{URL::to('/Lead/leadsFunnel')}}",{"clientID":"{{$client_id}}",days:days}).done(function( data ) {
 
			var lead_funnel_barchart1 = ''; 
			var lead_funnel_barchart1_data = '';
			$.each(data.barChart1, function( index, value ) {

			 	lead_funnel_barchart1 += '<div class="col-md-12 col-sm-12 col-xs-12  bar_avg_visitor">' 
		        +      '<div class="float-right" style="width:'+value.SessionPer+'%;height:100%;background-color: '+value.SessionColor+';"></div>'
		        + '</div>';

	        	lead_funnel_barchart1_data += '<div class="col-md-12 col-sm-12 col-xs-12  bar_avg_visitor">'
	        	+	'<div class="float-right" style="width:100%;height:100%;padding-top:8px;"><b>'+value.TotalSession+' '+value.SessionTitle+'</b></div>'
	        	+'</div>';
	        	
			});
			$('#lead_funnel_barchart1').html(lead_funnel_barchart1);
			$('#lead_funnel_barchart1_data').html(lead_funnel_barchart1_data);
			  
	});
}


function leadsBreakdown(days = 30)
{ 
	$('#breakdown_contain').hide();
	$('#breakdown_loader').show();
	$.get("{{URL::to('/Lead/leadsBreakdown')}}",{"clientID":"{{$client_id}}",days:days}).done(function( data ) {

				$('#breakdown_contain').show();
				$('#breakdown_loader').hide();

				$('#bar-chart').empty();
				var bar = new Morris.Bar({
			      element: 'bar-chart',   
			      data: data.totalVisitsUniqueLeads
			      /*[{y: ['M-15'], a: 100, b: 10},{y: ['16'], a: 200, b: 80} ]*/,      
			      barColors: ['#32CD32','#3c8dbc'],
			      xkey: 'y',
			      ykeys: ['a', 'b'],
			      /*labels: ['Unique Leads', 'Total Visitors'],*/
			      hideHover: 'auto',
			      stacked: true,
			      axes: true,
			      grid: false,
			      barSize: 10,
			      barGap: 0.05,
			      barSizeRatio: 1,
			      resize: true,
			      width: true,
			      xLabelMargin: 0
			    });

			  // Get context with jQuery - using jQuery's .get() method.
			
			  var pieChartCanvas = $("#pieChart2").get(0).getContext("2d");
			 
			  var pieChart = new Chart(pieChartCanvas);

			  var PieData = data.osUsage;
			 
			  var pieOptions = {
			    segmentShowStroke: true,
			    segmentStrokeColor: "#fff",
			    segmentStrokeWidth: 1,
			    percentageInnerCutout: 50, // This is 0 for Pie charts
			    animationSteps: 100,
			    animationEasing: "easeOutBounce",
			    animateRotate: true,
			    animateScale: false,
			    responsive: true,
			    maintainAspectRatio: false,
			    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
			    tooltipTemplate: "<%=value %> <%=label%> users"
			  };
			  pieChart.Doughnut(PieData, pieOptions);
			  
	});
}

function channelsDrivingConversion(days = 30)
{ 
	$('#channelsDrivingConversion_contain').hide();
	$('#channelsDrivingConversion_loader').show();
	$.get("{{URL::to('/Lead/channelsDrivingConversion')}}",{"clientID":"{{Session::get('userdata')->client_id}}",days:days}).done(function( data ) {

		$('#channelsDrivingConversion_contain').show();
		$('#channelsDrivingConversion_loader').hide();

		var flag = data.channelData1.IsChannelUp?'<i class="fa fa-arrow-up green-trend" aria-hidden="true"></i>':'<i class="fa fa-arrow-down red-trend" aria-hidden="true"></i>';
		$('#ChannelName1').html(data.channelData1.ChannelName);
		$('#ChannelText1').html(data.channelData1.ChannelText);
		$('#ChannelPer1').html(flag+' '+data.channelData1.ChannelPer);
		$('#ConversionRate1').html(data.channelData1.ConversionRate);
		$('#ProspectsGenerated1').html(data.channelData1.ProspectsGenerated);
		$('#LeadConversions1').html(data.channelData1.LeadConversions);

		var flag2 = data.channelData2.IsChannelUp?'<i class="fa fa-arrow-up green-trend" aria-hidden="true"></i>':'<i class="fa fa-arrow-down red-trend" aria-hidden="true"></i>';
		$('#ChannelName2').html(data.channelData2.ChannelName);
		$('#ChannelText2').html(data.channelData2.ChannelText);
		$('#ChannelPer2').html(flag2+' '+data.channelData2.ChannelPer);
		$('#ConversionRate2').html(data.channelData2.ConversionRate);
		$('#ProspectsGenerated2').html(data.channelData2.ProspectsGenerated);
		$('#LeadConversions2').html(data.channelData2.LeadConversions);

		var flag3 = data.channelData3.IsChannelUp?'<i class="fa fa-arrow-up green-trend" aria-hidden="true"></i>':'<i class="fa fa-arrow-down red-trend" aria-hidden="true"></i>';
		$('#ChannelName3').html(data.channelData3.ChannelName);
		$('#ChannelText3').html(data.channelData3.ChannelText);
		$('#ChannelPer3').html(flag3+' '+data.channelData3.ChannelPer);
		$('#ConversionRate3').html(data.channelData3.ConversionRate);
		$('#ProspectsGenerated3').html(data.channelData3.ProspectsGenerated);
		$('#LeadConversions3').html(data.channelData3.LeadConversions);
	});
}
function contentDrivingConversion(days = 30)
{ 
	
	$('#contentDriving1Div_contain').hide();
	$('#contentDriving1Div_loader').show();
	$.get("{{URL::to('/Lead/contentDrivingConversion')}}",{"clientID":"{{Session::get('userdata')->client_id}}",days:days}).done(function( data ) {
 
 		$('#contentDriving1Div_contain').show();
		$('#contentDriving1Div_loader').hide();

		if(data.contentData1 == undefined)
			$('#contentDriving1Div').hide();
		else {
			$('#contentDriving1Div').show();
			$('#ContentTitle1').html(data.contentData1.ContentTitle);
			$('.ContentUrl1').html('<iframe scrolling="no" src="'+data.contentData1.ContentUrl+'" style="border:none;height: 200px"></iframe>');
			$('#ContentPer1').html(data.contentData1.ContentPer);
			$('#content_ProspectsGenerated1').html(data.contentData1.ProspectsGenerated);
			$('#Posted1').html(data.contentData1.Posted);
		}

		if(data.contentData2 == undefined)
			$('#contentDriving2Div').hide();
		else {
			$('#contentDriving2Div').show();
			$('#ContentTitle2').html(data.contentData2.ContentTitle);
			$('.ContentUrl2').html('<iframe scrolling="no" src="'+data.contentData2.ContentUrl+'" style="border:none;height: 200px"></iframe>');
			$('#ContentPer2').html(data.contentData2.ContentPer);
			$('#content_ProspectsGenerated2').html(data.contentData2.ProspectsGenerated);
			$('#Posted2').html(data.contentData2.Posted);
		}

		if(data.contentData3 == undefined)
			$('#contentDriving3Div').hide();
		else {
			$('#contentDriving3Div').show();
			$('#ContentTitle3').html(data.contentData3.ContentTitle);
			$('.ContentUrl3').html('<iframe scrolling="no" src="'+data.contentData3.ContentUrl+'" style="border:none;height: 200px"></iframe>');
			$('#ContentPer3').html(data.contentData3.ContentPer);
			$('#content_ProspectsGenerated3').html(data.contentData3.ProspectsGenerated);
			$('#Posted3').html(data.contentData3.Posted);
		}
	});
}

function show_LeadProgression(){
	///// ajax part  for lead progression 
		$.get("{{URL::to('/Lead/leadProgression')}}",{"client_id":"{{$client_id}}"}).done(function( data ) {
			//data={"Awareness_pct":78,"Engaged_pct":56,"Considering_pct":43,"Converted_pct":35}	 ;
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
}

 
  leadsFunnel();
  show_LeadProgression();
 

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
				.attr('transform', function(d) { return 'translate(' + d.x + ',' + d.y + ')'; })
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