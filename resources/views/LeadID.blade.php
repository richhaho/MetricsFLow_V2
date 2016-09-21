@extends('template.template')

@section('content-header')
<link rel="stylesheet" href="{{URL::to('/css/LeadID.css')}}">
<link rel="stylesheet" href="{{URL::to('/css/dashboard.css')}}">
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
		height: 80px;
		word-wrap: break-word;
	}
	.socialdata .warrantypagedata{
		background-color: #00B463;
		color: #FFF;
		padding: 5px 10px;
		border-radius: 5px 5px 0px 0px;
		height: 80px;
		word-wrap: break-word;

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
		<h4 class="bold"><i class="fa fa-chevron-left" aria-hidden="true"></i><a href="/leads">All Leads</a>
			</h4>
	</div>
	{{--<div class="row" >--}}
					{{--<div class="col-md-12 col-lg-11 col-xs-12">--}}
						{{--<div class="col-md-2 col-md-offset-10">--}}
							{{--<button type="button" class="float-right btn btn-primary btn-flat btn-sm">Push to CRM</button>--}}
						{{--</div>--}}
					{{--</div>--}}
	{{--</div>--}}
	<div id="client_logo" class="row" >
		<img src="img/{{$client_id}}.png" alt="client_logo">
	</div>
</section>
<style type="text/css">
	.wd{
		word-wrap: break-word;
	}
	 .box-header{height: 48px; overflow: hidden;color: black; }
</style>
@endsection
@section('content')

<div class="main-content">
	<div class="row">
		<section id="UserID" >
				<div class="row" >
					<div class="col-md-12 col-lg-11 col-xs-12">
						<div class="col-md-12 col-lg-10 col-xs-12">
							<h3 class="bold">User ID: <span id="UD_UserID"></span></h3>
						</div>
						
					</div>
				</div>
				<br />
				<div class="row">
					<div class="col-md-12 col-lg-12 col-xs-12">
						<div class="col-md-11 col-xs-12 col-sm-12">
							<div class="col-lg-2">
								<center><img src="img/Lead.png" alt="client_logo" class="img-responsive"></center>
								<center><h4 id="Stage"></h4></center>
							</div>
							<div class="col-lg-5">
								<div class="row">
									<div class="col-lg-5 col-xs-12 col-sm-4">
										<p>Last Seen:</p>
									</div>
									<div class="col-lg-7 col-xs-12 col-sm-8 wd" >
										<p><strong id="UD_LastSeen"></strong></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-5 col-xs-12 col-sm-4">
										<p>Device: </p>
									</div>
									<div class="col-lg-7 col-xs-12 col-sm-8 wd">
										<p><strong id="UD_Device"></strong></p>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-5 col-xs-12 col-sm-4">
										<p>Browser: </p>
									</div>
									<div class="col-lg-7 col-xs-12 col-sm-8 wd">
										<p><strong id="UD_Browser"></strong></p>
									</div>
								</div>

							</div>

							<div class="col-lg-5">

								<div class="row">
									<div class="col-lg-4 col-xs-12 col-sm-4">
										<p>Channels: </p>
									</div>
									<div class="col-lg-8 col-xs-12 col-sm-8">
										<p><strong id="UD_Channels"></strong></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-xs-12 col-sm-4">
										<p>Blocks Cookie: </p>
									</div>
									<div class="col-lg-8 col-xs-12 col-sm-8">
										<p><strong id="UD_blcookie"></strong></p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-xs-12 col-sm-4">
										<p>Delete Cookie: </p>
									</div>
									<div class="col-lg-8 col-xs-12 col-sm-8">
										<p><strong id="UD_dlcookie"></strong></p>
									</div>
								</div>
							</div>


						</div>
					</div>
				</div>
		</section>

			<section id="LeadProgression">
				<div class="row">
					<div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
						<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
							<h3 class="bold">Lead Progression</h3>
						</div>
						<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">

							<select class="form-control tableselect" style="border:none;" onchange="topPerformingContent(this.value)" >
								<option value="5" selected>Top 5</option>
								<option value="10">Top 10</option>
								<option value="20">Top 20</option>
								<option value="30">Top 30</option>
							</select>
						</div>
					</div>
					<div class="col-md-12 col-lg-11 col-xs-12">

						<div class="alert-modal">
							<div class="modal">
								<div class="col-md-12 col-xs-12 col-sm-12">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header light-blue">

												<div class="nav-tabs-custom light-blue" >
													<ul class="nav nav-tabs ">
														<li class="active"><a href="#tab_1" data-toggle="tab"><h3>Awareness</h3></a></li>
														<li><a href="#tab_2" data-toggle="tab"><h3>Engagement</h3></a></li>
														<li><a href="#tab_3" data-toggle="tab"><h3>Consideration</h3></a></li>
														<li><a href="#tab_4" data-toggle="tab"><h3>Conversion</h3></a></li>
													</ul>
													<div class="tab-content light-blue">
														<div class="tab-pane active" id="tab_1">

															<div class="row">
																<div class="col-xs-1 col-md-1 col-lg-1 col-sm-1">
																	<br><br><br><br><br><br><br>
																	<a onclick="AwarenessPlusDivs(-1)" class="float-right"><h1><i class="fa fa-chevron-left" aria-hidden="true"></i></h1></a>
																</div>


																<div id="AwarenessData" class="w3-content w3-display-container">

																</div>

																<div class="col-md-1 col-sm-1 col-lg-1 col-xs-1">
																	<br><br><br><br><br><br><br>
																	<a onclick="AwarenessPlusDivs(1)"><h1><i class="fa fa-chevron-right" aria-hidden="true"></i></h1></a>
																</div>
															</div>
														</div>
														<div class="tab-pane" id="tab_2">
															<div class="row">
																<div class="col-md-1 col-sm-1 col-lg-1 col-xs-1">
																	<br><br><br><br><br><br><br>
																	<a onclick="EngagementPlusDivs(-1)" class="float-right"><h1><i class="fa fa-chevron-left" aria-hidden="true"></i></h1></a>
																</div>


																<div id="EngagementData" class="w3-content w3-display-container">

																</div>

																<div class="col-md-1 col-sm-1 col-lg-1 col-xs-1">
																	<br><br><br><br><br><br><br>
																	<a onclick="EngagementPlusDivs(1)"><h1><i class="fa fa-chevron-right" aria-hidden="true"></i></h1></a>
																</div>
															</div>
														</div>
														<div class="tab-pane" id="tab_3">
															<div class="row">
																<div class="col-md-1 col-sm-1 col-lg-1 col-xs-1">
																	<br><br><br><br><br><br><br>
																	<a onclick="ConsiderationPlusDivs(-1)" class="float-right"><h1><i class="fa fa-chevron-left" aria-hidden="true"></i></h1></a>
																</div>

																<div id="ConsiderationData" class="w3-content w3-display-container">

																</div>

																<div class="col-md-1 col-sm-1 col-lg-1 col-xs-1">
																	<br><br><br><br><br><br><br>
																	<a onclick="ConsiderationPlusDivs(1)"><h1><i class="fa fa-chevron-right" aria-hidden="true"></i></h1></a>
																</div>
															</div>
														</div>
														<div class="tab-pane" id="tab_4">
															<div class="row">
																<div class="col-md-1 col-sm-1 col-lg-1 col-xs-1">
																	<br><br><br><br><br><br><br>
																	<a onclick="ConversionPlusDivs(-1)" class="float-right"><h1><i class="fa fa-chevron-left" aria-hidden="true"></i></h1></a>
																</div>

																<div id="ConversionData" class="w3-content w3-display-container">

																</div>

																<div class="col-md-1 col-sm-1 col-lg-1 col-xs-1">
																	<br><br><br><br><br><br><br>
																	<a onclick="ConversionPlusDivs(1)"><h1><i class="fa fa-chevron-right" aria-hidden="true"></i></h1></a>
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
		<section class="col-lg-11 connectedSortable ui-sortable">
			<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
				<h3 class="bold">Path to Conversion</h3>
			</div>
			<div class="row">
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

														</div>
														<div class="col-md-6 col-sm-12 datadivpart2">

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
</div>
</div>

<script src="{{URL::to('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- <script src="{{URL::to('plugins/flot/jquery.flot.min.js')}}"></script>
<script src="{{URL::to('plugins/flot/jquery.flot.resize.min.js')}}"></script>
<script src="{{URL::to('plugins/flot/jquery.flot.pie.min.js')}}"></script> -->


<!-- <script src="{{URL::to('js/LeadID.js')}}"></script> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jcanvas/20.1.4/jcanvas.js"></script>
<script src="{{URL::to('js/dashboard_pathchart.js')}}"></script>

<script src="{{URL::to('plugins/chartjs/Chart.min.js')}}"></script>

<script type="text/javascript">

var slideIndex = 1;

// AwarenessShowDivs(slideIndex);
function AwarenessPlusDivs(n) {
	AwarenessShowDivs(slideIndex += n);
}
function AwarenessShowDivs(n) {
	var i;
	var x = document.getElementsByClassName("AwarenessSlides");
	if (n > x.length) {slideIndex = 1}
	if (n < 1) {slideIndex = x.length}
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	x[slideIndex-1].style.display = "block";
}


// EngagementShowDivs(slideIndex);
function EngagementPlusDivs(n) {
	EngagementShowDivs(slideIndex += n);
}
function EngagementShowDivs(n) {
	var i;
	var x = document.getElementsByClassName("EngagementSlides");
	if (n > x.length) {slideIndex = 1}
	if (n < 1) {slideIndex = x.length}
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	x[slideIndex-1].style.display = "block";
}

// ConsiderationShowDivs(slideIndex);
function ConsiderationPlusDivs(n) {
	ConsiderationShowDivs(slideIndex += n);
}
function ConsiderationShowDivs(n) {
	var i;
	var x = document.getElementsByClassName("ConsiderationSlides");
	if (n > x.length) {slideIndex = 1}
	if (n < 1) {slideIndex = x.length}
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	x[slideIndex-1].style.display = "block";
}

// ConversionShowDivs(slideIndex);
function ConversionPlusDivs(n) {
	ConversionShowDivs(slideIndex += n);
}
function ConversionShowDivs(n) {
	var i;
	var x = document.getElementsByClassName("ConversionSlides");
	if (n > x.length) {slideIndex = 1}
	if (n < 1) {slideIndex = x.length}
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	x[slideIndex-1].style.display = "block";
}





function getLeadProg(a)
{
    $.get("{{URL::to('/Lead/getLeadIDProg')}}",{"clientID":"{{Session::get('userdata')->client_id}}",days:"{{$lastseen}}",days1:a,e_id:"{{$e_id}}"}).done(function(data)  {


		var AwarenessData = '<div class="AwarenessSlides" style="width:100%;text-align: center;">'
			+	'<div class="col-md-10 col-sm-10 col-lg-10 col-xs-10">';

		var i = 0;
		$.each(data.AwarenessData, function( index, value ) {
			var turl = value.PageURL;
			turl = 'https://'+turl.replace(/ /g, '');

			AwarenessData += '<div class="col-md-6 col-sm-12 col-lg-6 col-xs-12">'
				+		'<div class="alert-modal">'
				+			'<div class="modal">'
				+				'<div class="modal-dialog alertbox">'
				+				    '<div class="modal-content">'
				+				        '<div class="modal-header blue top_content_title">'
				+				            '<h4 class="modal-title"><a href="/ContentDetail?PageName='+value.PageName+'&PageURL='+value.PageURL+'&Date='+value.Date+'"  style="color: white">'+value.PageName+'</a></h4>'
				+				        '</div>'
				+				        '<div class="modal-body">'
				+				        	'<div class="row ">'
				+					            '<div class="col-md-12">'
				+					            	'<div class="alert-label">'
				+					            		'<div class="box-body">'
				+						            		'<div class="thumbnail_image">'
				+						                   		'<a href="/ContentDetail?PageName='+value.PageName+'&Date='+value.Date+'&PageURL='+value.PageURL+'">'
				+						                      		'<div id="screenshot" style="overflow: hidden; border: 1px solid black" >'
				+						                          		'<iframe name= "tabsa'+i+'" width="95%" height="100%" frameborder="0" allowtransparency="true" style="height: 250px;"></iframe>'
				+														' <p><a href="'+turl+'" target="tabsa'+i+'">View Page</a></p>'
				+						                       		'</div>'
				+						                   		'</a>'
				+						                	'</div>'
				+					                	'</div>'
				+								    '</div>'
				+								    '<div class="col-md-12 col-sm-12 col-xs-12">'
				+						            	 '<div class="col-lg-3" style="padding: 0px;">'
				// +						            	 	'<h1  style="margin: 0px; color:#7CFC00"><strong>'+value.avgscore+'</+strong></h1>'
				+						            	 '</div>'
				+						            	 '<div class="col-lg-9">'
				+						            	 	'<a class="btn btn-success" href="/LeadID_clickmap?leadID={{$e_id}}&Date='+value.Date+'&PageURL='+value.PageURL+'">Click maps</a>'
				+						            	 	'<p>Stage: '+value.Stage+' </p>'
				+						            	 	'<p>Last Seen: '+value.Date+'</p>'
				+						            	 '</div>'
				+						            '</div>'
				+								'</div>'
				+							'</div>'
				+						'</div>'
				+					'</div>'
				+				'</div>'
				+			'</div>'
				+		'</div>'
				+	'</div>';

			i++;

			if((index+1) % 2 == 0)
			{
				if(data.AwarenessData.length != (index+1))
					AwarenessData += '</div></div><div class="AwarenessSlides" style="width:100%;text-align: center;"><div class="col-md-10 col-sm-10 col-lg-10 col-xs-10">';
			}
		});

		AwarenessData += '</div>'
			+	'</div>';

		$('#AwarenessData').html(AwarenessData);

		AwarenessShowDivs(slideIndex);
        var EngagementData = '<div class="EngagementSlides" style="width:100%;text-align: center;">'
            +	'<div class="col-md-10 col-sm-10 col-lg-10 col-xs-10">';
        var i = 0;

        $.each(data.EngagementData, function( index, value ) {
            var turl = value.PageURL;
            turl = 'https://'+turl.replace(/ /g, '');
            EngagementData += '<div class="col-md-6 col-sm-12 col-lg-6 col-xs-12">'
                +		'<div class="alert-modal">'
                +			'<div class="modal">'
                +				'<div class="modal-dialog alertbox">'
                +				    '<div class="modal-content">'
                +				        '<div class="modal-header blue top_content_title">'
                +				            '<h4 class="modal-title"><a href="/ContentDetail?PageName='+value.PageName+'&PageURL='+value.PageURL+'&Date='+value.Date+'"  style="color: white">'+value.PageName+'</a></h4>'
                +				        '</div>'
                +				        '<div class="modal-body">'
                +				        	'<div class="row ">'
                +					            '<div class="col-md-12">'
                +					            	'<div class="alert-label">'
                +					            		'<div class="box-body">'
                +						            		'<div class="thumbnail_image">'
                +						                   		'<a href="/ContentDetail?PageName='+value.PageName+'&Date='+value.Date+'">'
                +						                      		'<div id="screenshot" style="overflow: hidden; border: 1px solid black">'
                +						                          		'<iframe name= "tabse'+i+'" width="95%" height="100%" frameborder="0" allowtransparency="true" style="height: 250px;"></iframe>'
                +														' <p><a href="'+turl+'" target="tabse'+i+'">View Page</a></p>'
                +						                       		'</div>'
                +						                   		'</a>'
                +						                	'</div>'
                +					                	'</div>'
                +								    '</div>'
                +								    '<div class="col-md-12 col-sm-12 col-xs-12">'
                +						            	 '<div class="col-lg-3" style="padding: 0px;">'
                // +						            	 	'<h1  style="margin: 0px; color:#7CFC00"><strong>'+value.avgscore+'</+strong></h1>'
                +						            	 '</div>'
                +						            	 '<div class="col-lg-9">'
                +						            	 	'<p>Stage: '+value.Stage+' </p>'
                +						            	 	'<p>Last Seen: '+value.Date+'</p>'
                +						            	 '</div>'
                +						            '</div>'
                +								'</div>'
                +							'</div>'
                +						'</div>'
                +					'</div>'
                +				'</div>'
                +			'</div>'
                +		'</div>'
                +	'</div>';

            if((index+1) % 2 == 0)
            {
                if(data.EngagementData.length != (index+1))
                    EngagementData += '</div></div><div class="EngagementSlides" style="width:100%;text-align: center;"><div class="col-md-10 col-sm-10 col-lg-10 col-xs-10">';
            }
            i++;
        });

        EngagementData += '</div>'
            +	'</div>';

        $('#EngagementData').html(EngagementData);

        EngagementShowDivs(slideIndex);

        var ConsiderationData = '<div class="ConsiderationSlides" style="width:100%;text-align: center;">'
            +	'<div class="col-md-10 col-sm-10 col-lg-10 col-xs-10">';
        var i = 0;

        $.each(data.ConsiderationData, function( index, value ) {
            var turl = value.PageURL;
            turl = 'https://'+turl.replace(/ /g, '');

            ConsiderationData += '<div class="col-md-6 col-sm-12 col-lg-6 col-xs-12">'
                +		'<div class="alert-modal">'
                +			'<div class="modal">'
                +				'<div class="modal-dialog alertbox">'
                +				    '<div class="modal-content">'
                +				        '<div class="modal-header blue top_content_title">'
                +				            '<h4 class="modal-title"><a href="/ContentDetail?PageName='+value.PageName+'&PageURL='+value.PageURL+'&Date='+value.Date+'"  style="color: white">'+value.PageName+'</a></h4>'
                +				        '</div>'
                +				        '<div class="modal-body">'
                +				        	'<div class="row ">'
                +					            '<div class="col-md-12">'
                +					            	'<div class="alert-label">'
                +					            		'<div class="box-body">'
                +						            		'<div class="thumbnail_image">'
                +						                   		'<a href="/ContentDetail?PageName='+value.PageName+'&Date='+value.Date+'">'
                +						                      		'<div id="screenshot" style="overflow: hidden; border: 1px solid black">'
                +						                          		'<iframe name= "tabsc'+i+'" width="95%" height="100%" frameborder="0" allowtransparency="true" style="height: 250px;"></iframe>'
                +														' <p><a href="'+turl+'" target="tabsc'+i+'">View Page</a></p>'
                +						                       		'</div>'
                +						                   		'</a>'
                +						                	'</div>'
                +					                	'</div>'
                +								    '</div>'
                +								    '<div class="col-md-12 col-sm-12 col-xs-12">'
                +						            	 '<div class="col-lg-3" style="padding: 0px;">'
                // +						            	 	'<h1  style="margin: 0px; color:#7CFC00"><strong>'+value.avgscore+'</+strong></h1>'
                +						            	 '</div>'
                +						            	 '<div class="col-lg-9">'
                +						            	 	'<p>Stage: '+value.Stage+' </p>'
                +						            	 	'<p>Last Seen: '+value.Date+'</p>'
                +						            	 '</div>'
                +						            '</div>'
                +								'</div>'
                +							'</div>'
                +						'</div>'
                +					'</div>'
                +				'</div>'
                +			'</div>'
                +		'</div>'
                +	'</div>';

            if((index+1) % 2 == 0)
            {
                if(data.ConsiderationData.length != (index+1))
                    ConsiderationData += '</div></div><div class="ConsiderationSlides" style="width:100%;text-align: center;"><div class="col-md-10 col-sm-10 col-lg-10 col-xs-10">';
            }
            i++;
        });

        ConsiderationData += '</div>'
            +	'</div>';

        $('#ConsiderationData').html(ConsiderationData);

        ConsiderationShowDivs(slideIndex);


        var ConversionData = '<div class="ConversionSlides" style="width:100%;text-align: center;">'
            +	'<div class="col-md-10 col-sm-10 col-lg-10 col-xs-10">';

        var i=0;

        $.each(data.ConversionData, function( index, value ) {
            var turl = value.PageURL;
            turl = 'https://'+turl.replace(/ /g, '');
            ConversionData += '<div class="col-md-6 col-sm-12 col-lg-6 col-xs-12">'
                +		'<div class="alert-modal">'
                +			'<div class="modal">'
                +				'<div class="modal-dialog alertbox">'
                +				    '<div class="modal-content">'
                +				        '<div class="modal-header blue top_content_title">'
                +				            '<h4 class="modal-title"><a href="/ContentDetail?PageName='+value.PageName+'&PageURL='+value.PageURL+'&Date='+value.Date+'"  style="color: white">'+value.PageName+'</a></h4>'
                +				        '</div>'
                +				        '<div class="modal-body">'
                +				        	'<div class="row ">'
                +					            '<div class="col-md-12">'
                +					            	'<div class="alert-label">'
                +					            		'<div class="box-body">'
                +						            		'<div class="thumbnail_image">'
                +						                   		'<a href="/ContentDetail?PageName='+value.PageName+'&Date='+value.Date+'">'
                +						                      		'<div id="screenshot" style="overflow: hidden; border: 1px solid black">'
                +						                          		'<iframe name= "tabsco'+i+'" width="95%" height="100%" frameborder="0" allowtransparency="true" style="height: 250px;"></iframe>'
                +														' <p><a href="'+turl+'" target="tabsco'+i+'">View Page</a></p>'
                +						                       		'</div>'
                +						                   		'</a>'
                +						                	'</div>'
                +					                	'</div>'
                +								    '</div>'
                +								    '<div class="col-md-12 col-sm-12 col-xs-12">'
                +						            	 '<div class="col-lg-3" style="padding: 0px;">'
                // +						            	 	'<h1  style="margin: 0px; color:#7CFC00"><strong>'+value.avgscore+'</+strong></h1>'
                +						            	 '</div>'
                +						            	 '<div class="col-lg-9">'
                +						            	 	'<p>Stage: '+value.Stage+' </p>'
                +						            	 	'<p>Last Seen: '+value.Date+'</p>'
                +						            	 '</div>'
                +						            '</div>'
                +								'</div>'
                +							'</div>'
                +						'</div>'
                +					'</div>'
                +				'</div>'
                +			'</div>'
                +		'</div>'
                +	'</div>';

            if((index+1) % 2 == 0)
            {
                if(data.ConversionData.length != (index+1))
                    ConversionData += '</div></div><div class="ConversionSlides" style="width:100%;text-align: center;"><div class="col-md-10 col-sm-10 col-lg-10 col-xs-10">';
            }
            i++;
        });

        ConversionData += '</div>'
            +	'</div>';

        $('#ConversionData').html(ConversionData);

        ConversionShowDivs(slideIndex);

	});
}

function getLeadIDData(){
	$.get("{{URL::to('/Lead/getLeadID')}}",{"clientID":"{{Session::get('userdata')->client_id}}",days:"{{$lastseen}}",e_id:"{{$e_id}}"}).done(function(data) {
	    // console.log(data[0]);
        $('#UD_email').html(data[0]['email']);
	    $('#UD_UserID').html(data[0]['e_id']);
        $('#UD_LastSeen').html(data[0]['last_seen']);
        $('#UD_Device').html(data[0]['device_type']);
        $('#UD_Browser').html(data[0]['browser']);
        $('#UD_Channels').html(data[0]['channel']);
        $('#UD_blcookie').html(data[0]['allow_cookies']);
        $('#UD_dlcookie').html(data[0]['has_cookies']);

	});
}

function getLeadData(){
    $.get("{{URL::to('/Lead/getLeadData')}}",{"clientID":"{{Session::get('userdata')->client_id}}",days:"{{$lastseen}}",e_id:"{{$e_id}}"}).done(function(data) {
        // console.log(data);
        function removeNulls(obj){
            var isArray = obj instanceof Array;
            for (var k in obj){
                if (obj[k]===null) isArray ? obj.splice(k,1) : delete obj[k];
                else if (typeof obj[k]=="object") removeNulls(obj[k]);
            }
        }


        removeNulls(data);

        for (var i=0; i< data.length; i++)
        {
            var s = '.datacommondiv'+i;
            if( i <= 2){ $('.datadivpart1').append('<div class="col-md-4 col-sm-4 col-xs-12 text-center datacommondiv'+i+'"> </div>');}
            else{$('.datadivpart2').append('<div class="col-md-4 col-sm-4 col-xs-12 text-center datacommondiv'+i+'"> </div>');}

            function attach(div) {
                if( i <= 2){ $(s).append(div);}
                else{$(s).append(div);}

            }



            var channel = data[i]['Channel_New'];
            var conversion = data[i]['conversion_page_e_id_SESSION_WISE'];

            var div ='<div class="socialdata">\n' +
                // '        <div class="pagedata">Channel</div>\n' +
                '        <div class="pagedata">\n' +
                '            <h4 align="center">'+ channel +'</h4>\n' +
                '        </div>\n' +
                '    </div>' +
                '<i class="fa fa-chevron-down" aria-hidden="true"></i>';
            attach(div);
            delete data[i]['Channel_New'];
            delete data[i]['conversion_page_e_id_SESSION_WISE'];

            for (var key in data[i]) {
                if (data[i].hasOwnProperty(key)) {
                    var div = '<div class="socialdata">\n' +
                        '<div class="pagedata">'+data[i][key]+'</div>\n' +
                        '<div class="usercount">\n' +
                        // '<p><span>321</span> Users Entered</p>\n' +
                        // '<p><span>78</span> Bounced</p>\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '<i class="fa fa-chevron-down" aria-hidden="true"></i>';

                    attach(div);
                }

            }

            var div = '<div class="socialdata">\n' +
                '                    <div class="warrantypagedata">'+conversion+'</div>\n' +
                '                <div class="usercount">\n' +
                // '                    <p><span>33</span> Users Entered</p>\n' +
                // '                <p><span>12</span> Converted</p>\n' +
                '                </div>\n' +
                '                </div>';
            attach(div);


        }

    });
}



$( document ).ready(function() {

	getLeadIDData();
	getLeadData();
	getLeadProg(5);
	// getLeadData();


});


 
</script>

@endsection



