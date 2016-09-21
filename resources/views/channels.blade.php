@extends('template.template')

@section('content-header')
<section class="content-header">
	<div id="breadcrumbs">
		<h4 class="bold"><i class="fa fa-chevron-left" aria-hidden="true"></i> <br>
			</h4>
	</div>
	<div id="client_logo">
		<img src="img/{{Session('client_id')}}.png" alt="client_logo" >
	</div>
</section>
<style type="text/css">
	.wd{
		word-wrap: break-word;
	}
	 .box-header{height: 48px; overflow: hidden;color: black; }
	 .title_back_grey{
	 	background-color:#f5f7ff; 
	 }
</style>

@endsection
@section('content')
<section id="TOPchannels">
	<div class="row">
		<div class="col-md-11 col-sm-12 col-xs-12">
			<div class="col-md-10 col-sm-12 col-xs-12">
				<h3 class="bold">Top Channels</h3>
			</div>
			<div class="col-md-2 col-sm-12 col-xs-12">
				<select class="form-control tableselect" onchange="topChannels(this.value);">
		                <option value="30">Last 30 days</option>
		              	<option value="60">Last 60 days</option>
		              	<option value="90">Last 90 days</option>
			        </select>
		     </div>     
		</div>
		<div id="topChannelHtml" class="col-md-11 col-sm-12 col-xs-12">
			@foreach ($topChannels as $topchannel)
			<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="alert-modal">
					<div class="modal">
						<div class="modal-dialog alertbox">
						    <div class="modal-content">
						        <div class="modal-header title_back_grey">         
						            <h4 class="modal-title"><a href="{{URL::to('ChannelDetail')}}?DomainName={{$topchannel->domainname}}">{{$topchannel->domainname}}</a></h4>
						        </div>
						        <div class="modal-body">
						        	<div class="row left">
							            <div class="col-md-12 alert-content">
							            	<div class="alert-label">
							            		<h4 class="bold600">Change in Users</h4>
								            	<div class="text-align box-data">
								            		<div class="display">
								            			<i class="fa fa-arrow-up fa-4x green-trend" aria-hidden="true"></i>
								            		</div>
								            		<div class="padding15 display">
								            			<h1>{{round($topchannel->prospect/$prospects*100)}}%</h1>
								            		</div>								 
								            	</div>
										    </div>
										    <div class="col-md-12 col-sm-6 col-xs-12">
								            	<div>
								            		<h5>Conversion Rate: {{round($topchannel->conversion/$conversions*100)}}%</h5>
								            	</div>
								            	<div>
								            		<h5>Prospects Generated: {{$topchannel->prospect}}</h5>
								            	</div>
								            	<div>
								            		<h5>Lead Conversions: {{$topchannel->conversion}}</h5>
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
		<div class="col-md-11 col-sm-12 col-xs-12">
			<div class="col-md-10 col-sm-12 col-xs-12">
				<h3 class="bold">All Channels</h3>  
			</div>
			<div class="col-lg-2 col-sm-12 col-xs-12">
	            <form action="#" method="get" class="sidebar-form">
			        <div class="input-group">
			          <input name="search" id="cnlSearch" class="form-control" placeholder="Search Channles" type="text" style="background-color:transparent;">
			              <span class="input-group-btn">
			                <button type="button" onclick="allChannels()" name="search" id="search-btn" class="btn btn-flat" style="background-color:transparent;"><i class="fa fa-search" ></i>
			                </button>
			              </span>
			        </div>
			      </form>
	        </div>  
		</div>
		<div id="allChannelsHtml" class="col-md-11 col-sm-12 col-xs-12">
			@foreach ($allChannels as $allchannel)
			<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="alert-modal">
					<div class="modal">
						<div class="modal-dialog alertbox">
						    <div class="modal-content">
						        <div class="modal-header title_back_grey">         
						            <h4 class="modal-title"><a href="{{URL::to('ChannelDetail')}}?DomainName={{$allchannel->domainname}}">{{$allchannel->domainname}}</a></h4>
						        </div>
						        <div class="modal-body">
						        	<div class="row left">
							            <div class="col-md-12 alert-content">
							            	<div class="alert-label">
							            		<h4 class="bold600">Change in Users</h4>
								            	<div class="text-align box-data">
								            		<div class="display">
								            			<i class="fa fa-arrow-up fa-4x green-trend" aria-hidden="true"></i>
								            		</div>
								            		<div class="padding15 display">
								            			<h1>{{round($allchannel->prospect/$prospects*100)}}%</h1>
								            		</div>								 
								            	</div>
										    </div>
										    <div class="col-md-12 col-sm-6 col-xs-12">
								            	<div>
								            		<h5>Conversion Rate: {{round($allchannel->conversion/$conversions*100)}}%</h5>
								            	</div>
								            	<div>
								            		<h5>Prospects Generated: {{$allchannel->prospect}}</h5>
								            	</div>
								            	<div>
								            		<h5>Lead Conversions: {{$allchannel->conversion}}</h5>
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
		<div class="row">
			<div class="col-lg-11 col-md-12 col-sm-12 col-xs-12" style="text-align: right;">
			<button class="btn btn-info" id="loadmorebtn" onclick="viewMoreChannels()">View More Channels</button><input type="hidden" id="ChannelCnt" value="1">
			</div>
		</div>
		
	</div>
</section>


<script type="text/javascript">
function topChannels(days)
{ 
	$.get("{{URL::to('/Channel/topChannels')}}",{"clientID":"{{Session::get('userdata')->client_id}}",days:days}).done(function( data ) {

	var topChannelHtml = ''; 
	$.each(data.channelData, function( index, value ) {

		var flag = value.IsChannelUp?'<i class="fa fa-arrow-up fa-4x green-trend" aria-hidden="true"></i>':'<i class="fa fa-arrow-down fa-4x red-trend" aria-hidden="true"></i>';

		topChannelHtml += '<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">' 
		+		'<div class="alert-modal">'
		+			'<div class="modal">'
		+				'<div class="modal-dialog alertbox">'
		+				    '<div class="modal-content">'
		+				        '<div class="modal-header title_back_grey">'         
		+				            '<h4 class="modal-title"><a href="{{URL::to("ChannelDetail")}}?DomainName='+value.ChannelName+'">'+value.ChannelName+'</a></h4>'
		+				        '</div>'
		+				        '<div class="modal-body">'
		+				        	'<div class="row left">'
		+					            '<div class="col-md-12 alert-content">'
		+					            	'<div class="alert-label">'
		+					            		'<h4 class="bold600">'+value.ChannelText+'</h4>'
		+						            	'<div class="text-align box-data">'
		+						            		'<div class="display">'
		+						            			''+flag+''
		+						            		'</div>'
		+						            		'<div class="padding15 display">'
		+						            			'<h1>'+value.ChannelPer+'%</h1>'
		+						            		'</div>'								 
		+						            	'</div>'
		+								    '</div>'
		+								    '<div class="col-md-12 col-sm-6 col-xs-12">'
		+						            	'<div>'
		+						            		'<h5>Conversion Rate: '+value.ConversionRate+'%</h5>'
		+						            	'</div>'
		+						            	'<div>'
		+						            		'<h5>Prospects Generated: '+value.ProspectsGenerated+'</h5>'
		+						            	'</div>'
		+						            	'<div>'
		+						            		'<h5>Lead Conversions: '+value.LeadConversions+'</h5>'
		+						            	'</div>'							            			
		+						            '</div>'
		+								'</div>'
		+							'</div>'		           
		+						'</div>'
		+					'</div>'
		+				'</div>'
		+			'</div>'
		+		'</div>'
		+	'</div>';
		});

		$('#topChannelHtml').html(topChannelHtml);
	    
	});
}

function allChannels()
{ 
	var cnlSearch = $('#cnlSearch').val();
	$.get("{{URL::to('/Channel/allChannels')}}",{"clientID":"{{Session::get('userdata')->client_id}}",cnlSearch:cnlSearch}).done(function( data ) {

	var allChannelsHtml = ''; 
	$.each(data.channelData, function( index, value ) {

		var flag = value.IsChannelUp?'<i class="fa fa-arrow-up fa-4x green-trend" aria-hidden="true"></i>':'<i class="fa fa-arrow-down fa-4x red-trend" aria-hidden="true"></i>';

		allChannelsHtml += '<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">' 
		+		'<div class="alert-modal">'
		+			'<div class="modal">'
		+				'<div class="modal-dialog alertbox">'
		+				    '<div class="modal-content">'
		+				        '<div class="modal-header title_back_grey">'         
		+				            '<h4 class="modal-title"><a href="{{URL::to("ChannelDetail")}}?DomainName='+value.ChannelName+'">'+value.ChannelName+'</a></h4>'
		+				        '</div>'
		+				        '<div class="modal-body">'
		+				        	'<div class="row left">'
		+					            '<div class="col-md-12 alert-content">'
		+					            	'<div class="alert-label">'
		+					            		'<h4 class="bold600">'+value.ChannelText+'</h4>'
		+						            	'<div class="text-align box-data">'
		+						            		'<div class="display">'
		+						            			''+flag+''
		+						            		'</div>'
		+						            		'<div class="padding15 display">'
		+						            			'<h1>'+value.ChannelPer+'%</h1>'
		+						            		'</div>'								 
		+						            	'</div>'
		+								    '</div>'
		+								    '<div class="col-md-12 col-sm-6 col-xs-12">'
		+						            	'<div>'
		+						            		'<h5>Conversion Rate: '+value.ConversionRate+'%</h5>'
		+						            	'</div>'
		+						            	'<div>'
		+						            		'<h5>Prospects Generated: '+value.ProspectsGenerated+'</h5>'
		+						            	'</div>'
		+						            	'<div>'
		+						            		'<h5>Lead Conversions: '+value.LeadConversions+'</h5>'
		+						            	'</div>'							            			
		+						            '</div>'
		+								'</div>'
		+							'</div>'		           
		+						'</div>'
		+					'</div>'
		+				'</div>'
		+			'</div>'
		+		'</div>'
		+	'</div>';
		});

		$('#allChannelsHtml').html(allChannelsHtml);
	    
	});
}


function viewMoreChannels()
{ 
	var Start = $("#ChannelCnt").val();

	
	$("#loadmorebtn").prop("disabled", true);

	$("#ChannelCnt").val(parseFloat(Start)+1);
	$.get("{{URL::to('/Channel/viewMoreChannels')}}",{"clientID":"{{Session::get('userdata')->client_id}}",Start:Start}).done(function( data ) {

	var allChannelsHtml = ''; 
	$.each(data.channelData, function( index, value ) {

		var flag = value.IsChannelUp?'<i class="fa fa-arrow-up fa-4x green-trend" aria-hidden="true"></i>':'<i class="fa fa-arrow-down fa-4x red-trend" aria-hidden="true"></i>';

		allChannelsHtml += '<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">' 
		+		'<div class="alert-modal">'
		+			'<div class="modal">'
		+				'<div class="modal-dialog alertbox">'
		+				    '<div class="modal-content">'
		+				        '<div class="modal-header title_back_grey">'         
		+				            '<h4 class="modal-title"><a href="{{URL::to("ChannelDetail")}}?DomainName='+value.ChannelName+'">'+value.ChannelName+'</a></h4>'
		+				        '</div>'
		+				        '<div class="modal-body">'
		+				        	'<div class="row left">'
		+					            '<div class="col-md-12 alert-content">'
		+					            	'<div class="alert-label">'
		+					            		'<h4 class="bold600">'+value.ChannelText+'</h4>'
		+						            	'<div class="text-align box-data">'
		+						            		'<div class="display">'
		+						            			''+flag+''
		+						            		'</div>'
		+						            		'<div class="padding15 display">'
		+						            			'<h1>'+value.ChannelPer+'%</h1>'
		+						            		'</div>'								 
		+						            	'</div>'
		+								    '</div>'
		+								    '<div class="col-md-12 col-sm-6 col-xs-12">'
		+						            	'<div>'
		+						            		'<h5>Conversion Rate: '+value.ConversionRate+'%</h5>'
		+						            	'</div>'
		+						            	'<div>'
		+						            		'<h5>Prospects Generated: '+value.ProspectsGenerated+'</h5>'
		+						            	'</div>'
		+						            	'<div>'
		+						            		'<h5>Lead Conversions: '+value.LeadConversions+'</h5>'
		+						            	'</div>'							            			
		+						            '</div>'
		+								'</div>'
		+							'</div>'		           
		+						'</div>'
		+					'</div>'
		+				'</div>'
		+			'</div>'
		+		'</div>'
		+	'</div>';
		});

		$('#allChannelsHtml').append(allChannelsHtml);


		$("#loadmorebtn").prop("disabled", false);
	    
	});
}
</script>

@endsection