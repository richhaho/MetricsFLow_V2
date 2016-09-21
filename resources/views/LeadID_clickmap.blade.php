@extends('template.template')

@section('content-header')
<link rel="stylesheet" href="{{URL::to('/css/ContentDetail.css')}}">
<style type="text/css">
	#ActionItems{display: none}
</style>
<section class="content-header">
	<div id="client_logo">
		<img src="img/{{$client_id}}.png" alt="client_logo" >
	</div>
</section>
@endsection
@section('content')
<div class="main-content">
<div class="row">

<section id="Summary">
	<div class="row">
		<div class="col-lg-11 col-md-10 col-xs-12 col-sm-12">
			    <div class="light-blue">
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



var heatmapInstance;

    var lenXY=0;
    var xx=[];
    var yy=[];
    let url = {!! json_encode($turl) !!};
    days=$('.heatmap_days').val();

    $("#heatmap_canvas").append('<iframe src='+url+'  style= "width:100%;height: 100% ;border: 1px solid gray;"> </iframe>');

    $.get("{{URL::to('/Content/clickMap_lead')}}",{leadID:"{{$leadID}}", PageURL:"{{$PageURL}}",days:days}).done(function(clicks) {

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


$('.heatmap_days').change(function () {
    var lenXY=0;
    var xx=[];
    var yy=[];
    days=$('.heatmap_days').val();
    if (heatmapInstance) heatmapInstance.setData({data:[]});
    
    $.get("{{URL::to('/Content/clickMap_lead')}}",{leadID:"{{$leadID}}", PageURL:"{{$PageURL}}",days:days}).done(function(clicks) {

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

</script>

@endsection



