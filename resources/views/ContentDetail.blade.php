@extends('template.template')

@section('content-header')
<link rel="stylesheet" href="{{URL::to('/css/ContentDetail.css')}}">
<style type="text/css">
	#ActionItems{display: none}
</style>
<section class="content-header">
	<div id="breadcrumbs">
		<h4 class="bold"><i class="fa fa-chevron-left" aria-hidden="true"></i><a href="/Content">Content</a>
			</h4>
	</div> 
	<div id="client_logo">
		<img src="img/{{$client_id}}.png" alt="client_logo" >
	</div>
</section>
@endsection
@section('content')
<div class="main-content">
<div class="row">
<section id="TOPchannels">
	<div class="row">
		<div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
			<h2 class="bold">{{$PageName}}</h2>
			<p>Posted: {{$PostDate}}</p>
		</div>
	</div>
</section>
<section id="Summary">
	<div class="row">
		<div class="col-lg-11 col-md-10 col-xs-12 col-sm-12">
			<div class="nav-tabs-custom" >
			    <ul class="nav nav-tabs ">
			          <li class="active"><a href="#tab_1" data-toggle="tab"><h3>Summary</h3></a></li>
			          <li><a href="#tab_2" data-toggle="tab"  ><h3>Engagement</h3></a></li>
			    </ul>
			    <div class="tab-content light-blue">
					<div class="tab-pane active" id="tab_1">
						<section id="TopKeywordsUsed">
							    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
									<h3 class="bold">Performance</h3>
								</div>
								<div class="row">
									<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
										<select class="form-control tableselect" id="seldays"  onchange="performance(this.value)">
							                <option value="7" selected>Last 7 days</option>
							              	<option value="14">Last 14 days</option>
							              	<option value="21">Last 21 days</option>
							              	<option value="28">Last 28 days</option>
							              	<option value="50">Last 50 days</option>

								        </select>
								     </div> 
								</div>    
					
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								    
								<div class="alert-modal">
									<div class="modal">
										<div class="row">
											<div class="modal-dialog">
											    <div class="modal-content">
											        <div class="modal-header light-blue">
											        	<div class="col-md-12 box1">
								                            <div id="jqChart" style="width:95%; height: 250px; margin-left: 20px;">
												    		  	<div class="col-xs-4 col-sm-4 col-lg-2 col-sm-4 text-right" style="color: #59f441">
											            			<p class="c_score"><strong id="P_Score"><?php /* {{number_format($contents_score,1)}} */ ?></strong></p>
											            		</div>		 
											            		<div class="col-xs-8 col-sm-8 col-lg-3 col-sm-8">
											            			 {{--<p class="c_trending"><strong>TRENDING UP</strong></p>--}}
											            			 {{--<p class="c_prospects">Prospects Generated: <span id="P_Prospects"></span></p>--}}
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

						<section id="TopKeywordsUsed">

							<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
								<h3 class="bold">Engagement</h3>
							</div>
							<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
								<select class="form-control tableselect" id="seldays"  onchange="engagement(this.value)">
					                <option value="7">Last 7 days</option>
					              	<option value="14">Last 14 days</option>
					              	<option value="21">Last 21 days</option>
					              	<option value="28">Last 28 days</option>
					              	<option value="50" selected>Last 50 days</option>
						        </select>
						     </div>   

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								    
								<div class="alert-modal">
									<div class="modal">
										<div class="row">
											<div class="modal-dialog">
											    <div class="modal-content" style="height:350px">
											        <div class="modal-header light-blue" > 
											        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="top:34px;">
												        	<div id="sq_chart1">
												        		<center id="E_AwarenessDetails">
												        			{{--<i class="fa  fa-4x white-trend" aria-hidden="true">{{$content_Awareness}}</i>--}}
												        		</center>
												        	</div>
												        	<div id="sq_chart2">
												        		<center id="E_EngagementDetails">
												        			{{--<i class="fa  fa-4x white-trend" aria-hidden="true">{{$content_Engagement}}</i>--}}
												        		</center>
												        	</div>
												        	<div id="sq_chart3">
												        		<center id="E_ConsiderationDetails">
												        			{{--<i class="fa  fa-4x white-trend" aria-hidden="true">{{$content_Consideration}}</i>--}}
												        		</center>
												        	</div>
												        	<div id="sq_chart4">
												        		<center id="E_ConvertedDetails">
												        			{{--<i class="fa fa-4x white-trend" aria-hidden="true">{{$content_Conversion}}</i>--}}
												        			 
												        		</center>
												        	</div>
											        	</div>
											         </div> 
											        
											    </div>
											    <div class="modal-footer">
											        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
											        		<div class="col-xs-3">
											        			<center><p>Awareness</p></center>
											        		</div>
											        		<div class="col-xs-3">
											        			<center><p>Engagement</p></center>
											        		</div>
											        		<div class="col-xs-3">
											        			<center><p>Consideration</p></center>
											        		</div>
											        		<div class="col-xs-3">
											        			<center><p>Conversion</p></center>
											        		</div>
											        	</div>
											        </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>


						<section id="TopKeywordsUsed">

							<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
								<h3 class="bold">Top entry Points</h3>
							</div>
							<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
								<select class="form-control tableselect" onchange="topEntryPoints(this.value)">
						            <option value="6">Last 6 Months</option>
					              	<option value="3">Last 3 Months</option>
					              	<option value="1">Last 1 Months</option>
						        </select>
						     </div>   

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
								    
								<div class="alert-modal">
									<div class="modal">
										<div class="row">
											<div class="modal-dialog">
											    <div class="modal-content">
											        
											        <div class="modal-header light-blue
											        ">
											        	<div class="navgroup nav-tabs-custom col-lg-2 col-md-4 col-sm-12 col-xs-12" >
														    <ul class="nav nav-tabs entry">
														          <li class="active"><a href="" data-toggle="tab"><h4>Social Media</h4></a></li>
														          <li><a href="" data-toggle="tab"><h4>Search Engines</h4></a></li>
														          <li><a href="" data-toggle="tab"><h4>Email Campaigns</h4></a></li>
														          <li><a href="" data-toggle="tab"><h4>PPC</h4></a></li>
														          <li><a href="" data-toggle="tab"><h4>Refferal Links</h4></a></li>
														    </ul>
														</div>
														<div class="col-lg-10 col-md-8 col-sm-12 col-xs-12" style="height:100%">
															<div class="row"><br><br></div>
															<div class="row">
																<div class="col-md-2 ">
																	{{--<canvas id="donut-chart" height="150"></canvas>--}}
																</div>
																<div class="col-md-8 ">
																	<div id="jqChart_bar" class="row">
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
					<div class="tab-pane" id="tab_2">    {{-- onclick="loadEngagement();" --}}
						

						<section id="heatmapsection">
							<div class="row">
								 

								<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
									<h3 class="bold">Visitor Engagement</h3>
									<span>A.I. Overlay</span>
					  				<input type="button" id="heat_btn" style="border: none;background: url('img/heatmap0.png');width: 31px;height: 18px;float: left;" onclick="onheatmap();" >
								</div>
								<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
									<select class="form-control tableselect heatmap_days">
						              	<option value="30">Last 30 days</option>
						              	<option value="60">Last 60 days</option>
						              	<option value="90">Last 90 days</option>
						              	<option value="120">Last 120 days</option>
							        </select>
							     </div> 
					
							</div>
							
							<!-- /.modal -->
							<div class="row">
								<div class="col-md-12 col-lg-12 col-xs-12">
									<div class="alert-modal">
										<div class="modal">
											<div class="col-md-12 col-xs-12 col-sm-12">
												<div class="modal-dialog">
												    <div class="modal-content">
												    	<div class="row"><h1><p></p><br></h1></div>
											  		 	<div class="row" id="heatmap_img">  		 		
											  		 		<div class="col-md-12" style="height: 2000px" id="heatmap_canvas">
											  		 			{{--<iframe src='{{$turl}}' style="width: 100%;height: 100% ;border: 1px solid gray;">--}}
											  		 			{{--</iframe>--}}
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
					</div>
					 
				</div>
			</div>
		</div>
	</div>
</section>
</div>
</div>

<script src="{{URL::to('/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{URL::to('/plugins/chartjs/areachart/jquery.jqChart.min.js')}}" type="text/javascript"></script>

<script src="{{URL::to('/plugins/flot/jquery.flot.min.js')}}"></script>
<script src="{{URL::to('/plugins/flot/jquery.flot.resize.min.js')}}"></script>
<script src="{{URL::to('/plugins/flot/jquery.flot.pie.min.js')}}"></script>

<script src="{{URL::to('plugins/chartjs/Chart.min.js')}}"></script>
<script src="{{URL::to('/js/ContentDetail.js')}}" type="text/javascript"></script>

<script type="text/javascript">

function performance(days=7)
{ 
	$.get("{{URL::to('/Content/performance')}}",{days:days,PageName:"{{$PageName}}", PageURL:"{{$PageURL}}"}).done(function( data ) {
	 
		$('#jqChart').jqChart({
	        title: { text: '' },
	        animation: { duration: 1 },
            axes: [
                {
                    type: 'linear',
                    location: 'left',
                    minimum: 0,
                    maximum: data.max
                }
            ],
	        series: data.jqChart
	    });

       
	    
	});
}
function engagement(days=50)
{ 
	$.get("{{URL::to('/Content/engagement')}}",{days:days,PageName:"{{$PageName}}", PageURL:"{{$PageURL}}"}).done(function( data ) {
	      

		$('#E_AwarenessDetails').html('<i class="fa fa-4x white-trend" aria-hidden="true">'+data.AwarenessValue+'</i>');
	    $('#E_EngagementDetails').html('<i class="fa fa-4x white-trend" aria-hidden="true">'+data.EngagementValue+'</i>');
	    $('#E_ConsiderationDetails').html('<i class="fa fa-4x white-trend" aria-hidden="true">'+data.ConsiderationValue+'</i>');
	    $('#E_ConvertedDetails').html('<i class="fa fa-4x white-trend" aria-hidden="true">'+data.ConvertedValue+'</i>');
	    
	});
}

function topEntryPoints(a)
{
	$.get("{{URL::to('/Content/topEntryPoints')}}",{dur:a,PageName:"{{$PageName}}", PageURL:"{{$PageURL}}"}).done(function( data ) {
		// Get context with jQuery - using jQuery's .get() method.
		//   var pieChartCanvas = $("#donut-chart").get(0).getContext("2d");
		//   // console.log(data.pieChartPoints);
        //
		//   var donut_data = [];
		//   var donut_labels = [];
		//   var donut_color = [];
        //
		//   for (var i=0; i< data.pieChartPoints.length; i++)
		//   {
		//       donut_data.push(data.pieChartPoints[i].value);
		//       donut_labels.push(data.pieChartPoints[i].label);
		//       donut_color.push(data.pieChartPoints[i].color);
        //
		//   }
        //
		//   var PieData = {type: 'doughnut',
		// 	  data: { datasets: [{ data: donut_data, backgroundColor: donut_color }], labels: donut_labels },
         //      options: {
         //          responsive: true,
         //          legend: {
         //              position: 'top',
         //          },
         //          title: {
         //              display: false,
         //              text: ''
         //          },
         //          animation: {
         //              animateScale: false,
         //              animateRotate: false
         //          }
         //      }
        //
		//   };
        //
        // var pieChart = new Chart(pieChartCanvas,PieData);

		  $('#jqChart_bar').empty();
		  $('#jqChart_bar').jqChart({
                title: { text: '' },
                legend: { location: 'top' }, // { visible: false },//
                animation: { duration: 1 },
                border: { visible: false },
                axes: data.barChartAxes,
                series: data.barChartPoints
            });
	});

}
var heatmapInstance;
$('.nav-tabs a[href="#tab_2"]').click(function () {
    // console.log('loading');

    var lenXY=0;
    var xx=[];
    var yy=[];
    let url = {!! json_encode($turl) !!};
    days=$('.heatmap_days').val();

    $("#heatmap_canvas").append('<iframe src='+url+'  style= "width:100%;height: 100% ;border: 1px solid gray;"> </iframe>');

    $.get("{{URL::to('/Content/clickMap')}}",{PageName:"{{$PageName}}", PageURL:"{{$PageURL}}",days:days}).done(function(clicks) {

        clicks.forEach(function (element) {
            // console.log(element);
            let coord = element['Clicks'];
            coord = JSON.parse("[" + coord + "]");
             console.log(coord);

            let lg = coord.length;
            // console.log(lg);
            if (lg>1){
                // console.log('inside');
                for (let i=1;i<=lg/2;i++){
                    xx[lenXY+i]=coord[2*(i-1)];
                    yy[lenXY+i]=coord[2*(i-1)+1];
                }
                lenXY+=lg/2;
            }
        });

        var points = [];
        var max = 0;
        var width = 1920;
        var height = 1080;
        var len = lenXY;
        var vals=[];

		for (i=1;i<=len;i++) {
			vals[i]=0;
			for (j=1;j<=len;j++) {
				if (xx[i]==xx[j] && yy[i]==yy[j]) vals[i]+=1;
			}
		}        

        for (i=1;i<=len;i++) {

            var d = new Date();
            var n = d.getSeconds();
            //var val = Math.floor(Math.random()*100);
            //var val=0.5;
            //var radius = Math.floor(Math.random(n)*70);
            var radius = 25;
            max = Math.max(max, vals[i]);
             
            var point = {
                x: xx[i],//Math.floor(Math.random()*width)+180,
                y: yy[i],//Math.floor(Math.random()*height),
                value: vals[i],
                // radius configuration on point basis
                radius: radius,
            };
            points.push(point);
        }
        console.log(points);
        // heatmap data format
        var data = {
            max: max,
            data: points
        };

        // if you have a set of datapoints always use setData instead of addData
        
        var setedHeatmap=true;
        var kkk=0;

        if (kkk === 0) {
            heatmapInstance = h337.create({container: document.querySelector('#heatmap_img'),
                opacity: 0.4,
                blur: 0.9
            });
            onheatmap();
            kkk=1;
        }

        function onheatmap(){
            if (setedHeatmap){
                $("#heat_btn").css({"background":"url('img/heatmap1.png')"});
                heatmapInstance.setData(data);
                setedHeatmap=false;

            }
            else{
                $("#heat_btn").css({"background":"url('img/heatmap0.png')"});
                heatmapInstance.setData({data:[]});
                setedHeatmap=true;
            }
        }

    });
});

$('.heatmap_days').change(function () {
    var lenXY=0;
    var xx=[];
    var yy=[];
    days=$('.heatmap_days').val();
    if (heatmapInstance) heatmapInstance.setData({data:[]});
    
    $.get("{{URL::to('/Content/clickMap')}}",{PageName:"{{$PageName}}", PageURL:"{{$PageURL}}",days:days}).done(function(clicks) {

        clicks.forEach(function (element) {
            let coord = element['Clicks'];
            coord = JSON.parse("[" + coord + "]");
            console.log(coord);

            let lg = coord.length;
            if (lg>1){
                for (let i=1;i<=lg/2;i++){
                    xx[lenXY+i]=coord[2*(i-1)];
                    yy[lenXY+i]=coord[2*(i-1)+1];
                }
                lenXY+=lg/2;
            }
        });

        var points = [];
        var max = 0;
        var width = 1920;
        var height = 1080;
        var len = lenXY;
        var vals=[];

		for (i=1;i<=len;i++) {
			vals[i]=0;
			for (j=1;j<=len;j++) {
				if (xx[i]==xx[j] && yy[i]==yy[j]) vals[i]+=1;
			}
		}        

        for (i=1;i<=len;i++) {

            var d = new Date();
            var n = d.getSeconds();
            var radius = 25;
            max = Math.max(max, vals[i]);
             
            var point = {
                x: xx[i],
                y: yy[i],
                value: vals[i],
                radius: radius,
            };
            points.push(point);
        }
        console.log(points);
        var data = {
            max: max,
            data: points
        };

        var setedHeatmap=true;
        var kkk=0;

        if (kkk === 0) {
            heatmapInstance = h337.create({container: document.querySelector('#heatmap_img'),
                opacity: 0.4,
                blur: 0.9
            });
            onheatmap();
            kkk=1;
        }

        function onheatmap(){
            if (setedHeatmap){
                $("#heat_btn").css({"background":"url('img/heatmap1.png')"});
                heatmapInstance.setData(data);
                setedHeatmap=false;

            }
            else{
                $("#heat_btn").css({"background":"url('img/heatmap0.png')"});
                heatmapInstance.setData({data:[]});
                setedHeatmap=true;
            }
        }

    });
});


$(document).ready(function() {
  performance();
  engagement();
  topEntryPoints(6);
});
</script>

@endsection



