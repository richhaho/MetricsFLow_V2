@extends('template.template')

@section('content-header')
<style type="text/css">
.top_content_title a{
line-height: 35px;
}
.top_content_title{
height: 60px;
}

.table-sm {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
  
}
.table-sm tr{
	border-bottom: 1px solid #ddd ;
	background-color: #f2f2f2
}
.table-sm tr td{
	border-bottom: 1px solid #ddd ;
}
</style>
<section class="content-header">

<div id="client_logo">
<img src="img/{{$client_id}}.png" alt="client_logo"  >
</div>
</section>
@endsection
@section('content')

<div class="main-content">
<div class="row">
<section id="ActionItems">
	<div class="row">
		<div class="col-md-12 col-lg-12 col-xs-12">
			<h3 class="bold">Action Items</h3>
		</div>
	</div>
	
	<!-- /.modal -->
	<div class="row">
		<div class="col-md-12 col-lg-11 col-xs-12">
			<div class="alert-modal">
				<div class="modal">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="modal-dialog">
						    <div class="modal-content">
						        <div class="modal-header" style="background-color: green;color: white">
						        	<div class="col-md-12 col-xs-12 col-sm-12" style="padding: 0;">
							           	<div class="col-md-8 col-sm-8 col-xs-10">          
							            	<h4 class="modal-title"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Best Performing Content</h4>
							            </div>
							            <div class="col-md-4 col-sm-4 col-xs-2">
								            <div class="float-right">
								              	{{--<button type="button" class="close alert-button" data-dismiss="modal" aria-label="Close" style="padding: 5px">--}}
								                  {{--<span aria-hidden="true">&times;</span></button>--}}
								           	</div>
								        </div>
							        </div>
						        </div>
						        <div class="modal-body">
									<table  class="table ">
										<thead>
										<tr >
											<th scope="col" style="font-weight:500">&nbsp;Content</th>
											<th scope="col" style="font-weight:500">Score</th>
											<th scope="col" style="font-weight:500">Converted</th>
											<th scope="col" style="font-weight:500">Not Converted</th>
											<th scope="col" style="font-weight:500"></th>
										</tr>
										</thead> 
										<tbody>
											@foreach ($bcontents as $content)
											<tr data-toggle="collapse" data-target="#detail{{$content->index}}" class="accordion-toggle">
												<td><a data-toggle="collapse" href="#collapseOne">{{$content->PageName}}</a></td>
												<td>{{round($content->Score*100)/100}}</td>
												<td>{{$content->CEngage}}</td>
												<td>{{$content->NCEngage}}</td>
												<td><a href='/ContentDetail?PageName={{$content->PageName}}&PageURL={{$content->PageURL}}&Date={{$content->Date}}'>Details</a></td>
											</tr>
											<tr>
												<td colspan="5"  class="hiddenRow">
													<div id="detail{{$content->index}}" class="accordian-body collapse">
														<table class="table table-sm">
															<thead>
																<tr>
																	<th scope="col" style="border-bottom: 1px solid #ddd ;font-weight:normal">Engagements</th>
																	<th scope="col" style="border-bottom: 1px solid #ddd ;font-weight:normal">stage</th>
																	<th scope="col" style="border-bottom: 1px solid #ddd ;font-weight:normal">Last Seen</th>
																</tr>
															</thead>
															<tbody>
																@foreach(\App\ContentsDetail::where('client_id',$content->client_id)->where('PageURL',$content->PageURL)->where('PageName',$content->PageName)->get() as $detail)
																<tr>
																	<td>{{$detail->Engage}}</td>
																	<td>{{$detail->Stage}}</td>
																	<td>{{date('m/d/y',strtotime($detail->Date))}}</td>
																</tr>
																@endforeach
															</tbody>
														</table>
													</div>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>

									{{--</tbody>--}}

						        	{{--<div class="row left">--}}
							            {{--<div class="col-md-6 col-xs-12 col-sm-12 alert-content left">--}}
							            	{{--<div class="alert-label">--}}
							            		{{--<h5>Only 3 clicks <strong>During the selected date range</strong></h5>--}}
							            	{{--</div>--}}
							            {{--</div>--}}
							            {{--<div class="col-md-3 col-xs-12 col-sm-12 alert-content left">--}}
							            	{{--<div class="alert-label">--}}
							            		{{--<h5>Target click rate: <strong>20%</strong></h5>--}}
							            	{{--</div>--}}
							            {{--</div>--}}
							            {{--<div class="col-md-3 col-xs-12 col-sm-12 alert-content left">--}}
							            	{{--<div class="alert-label">--}}
							            		{{--<h5>Actual click rate: <strong>0.5%</strong></h5>--}}
							            	{{--</div>--}}
							            {{--</div>--}}
							            {{--<div class="col-md-12 col-xs-12 col-sm-12 left15">--}}
							            	{{--<div class="alert-label">--}}
							            		{{--<h5 style="display: inline-block;">Suggestion: <strong>This button might not helpful to your funnel. Try chaging the call option, or perhaps experiment with the button removed entirely.</strong></h5> --}}
							            	{{--</div>--}}
							            {{--</div>--}}
							        {{--</div>--}}
						           
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

	<!-- /.modal -->
	<div class="row">
		<div class="col-md-12  col-lg-11 col-xs-12">
			<div class="alert-modal">
				<div class="modal">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="modal-dialog">
						    <div class="modal-content">
						        <div class="modal-header red">
						        	<div class="col-md-12 col-xs-12 col-sm-12" style="padding: 0;">
							           	<div class="col-md-8 col-sm-8 col-xs-10">          
							            	<h4 class="modal-title"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Least Performing Content </h4>
							            </div>
							            <div class="col-md-4 col-sm-4 col-xs-2">
								            <div class="float-right">
								              	{{--<button type="button" class="close alert-button" data-dismiss="modal" aria-label="Close" style="padding: 5px">--}}
								                  {{--<span aria-hidden="true">&times;</span></button>--}}
								           	</div>
								        </div>
							        </div>
						        </div>
						        <div class="modal-body">
									<table  class="table ">
										<thead>
										<tr >
											<th scope="col" style="font-weight:500">&nbsp;Content</th>
											<th scope="col" style="font-weight:500">Score</th>
											<th scope="col" style="font-weight:500">Converted</th>
											<th scope="col" style="font-weight:500">Not Converted</th>
											<th scope="col" style="font-weight:500"></th>
										</tr>
										</thead> 
										<tbody>
											@foreach ($lcontents as $content)
											<tr data-toggle="collapse" data-target="#detail{{$content->index}}" class="accordion-toggle">
												<td><a data-toggle="collapse" href="#collapseOne">{{$content->PageName}}</a></td>
												<td>{{round($content->Score*100)/100}}</td>
												<td>{{$content->CEngage}}</td>
												<td>{{$content->NCEngage}}</td>
												<td><a href='/ContentDetail?PageName={{$content->PageName}}&PageURL={{$content->PageURL}}&Date={{$content->Date}}'>Details</a></td>
											</tr>
											<tr>
												<td colspan="5"  class="hiddenRow">
													<div id="detail{{$content->index}}" class="accordian-body collapse">
														<table class="table table-sm">
															<thead>
																<tr>
																	<th scope="col" style="border-bottom: 1px solid #ddd ;font-weight:normal">Engagements</th>
																	<th scope="col" style="border-bottom: 1px solid #ddd ;font-weight:normal">stage</th>
																	<th scope="col" style="border-bottom: 1px solid #ddd ;font-weight:normal">Last Seen</th>
																</tr>
															</thead>
															<tbody>
																@foreach(\App\ContentsDetail::where('client_id',$content->client_id)->where('PageURL',$content->PageURL)->where('PageName',$content->PageName)->get() as $detail)
																<tr>
																	<td>{{$detail->Engage}}</td>
																	<td>{{$detail->Stage}}</td>
																	<td>{{date('m/d/y',strtotime($detail->Date))}}</td>
																</tr>
																@endforeach
															</tbody>
														</table>
													</div>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
						        	{{--<div class="row left">--}}
							            {{--<div class="col-md-6 col-xs-12 col-sm-12 alert-content left">--}}
							            	{{--<div class="alert-label">--}}
							            		{{--<h5>Only 3 Submissions <strong>During the selected date range</strong></h5>--}}
							            	{{--</div>--}}
							            {{--</div>--}}
							            {{--<div class="col-md-3 col-xs-12 col-sm-12 alert-content left">--}}
							            	{{--<div class="alert-label">--}}
							            		{{--<h5>Target Submit rate: <strong>10%</strong></h5>--}}
							            	{{--</div>--}}
							            {{--</div>--}}
							            {{--<div class="col-md-3 col-xs-12 col-sm-12 alert-content left">--}}
							            	{{--<div class="alert-label">--}}
							            		{{--<h5>Actual Submit rate: <strong>2.2%</strong></h5>--}}
							            	{{--</div>--}}
							            {{--</div>--}}
							            {{--<div class="col-md-12 col-xs-12 col-sm-12 left15">--}}
							            	{{--<div class="alert-label">--}}
							            		{{--<h5 style="display: inline-block;">Suggestion: <strong>Lots of users start but don't finish completing the form, Try removing unnecessary from fields to help make the from quicker and simpler to fill out. Try changing the call to action on the subit button.</strong></h5> --}}
							            	{{--</div>--}}
							            {{--</div>--}}
							        {{--</div>--}}
						           
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
	<!-- /.modal -->
	
</section>	
<section id="ContentSearch">
	<div class="row">
		<div class="col-md-12 col-lg-11 col-xs-12">
			<h3 class="bold">Contents Trending</h3>
			<div class="alert-modal">
				<div class="modal">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="row">
					    	<div class="box">
		                      <div class="table-box">
		                        <table id="example1" class="table table-hover">
		                            <thead>
		                              	<tr id="tablehead">
			                                <th>Latest Content</th>
											<th>Stage</th>
			                                <th>Score</th>
			                                <th>Engagement</th>
			                                <th>Last Seen</th>
		                              	</tr>
		                            </thead>
		                            <tbody>
		                            	@foreach ($contents as $content)
		                            	<tr>
			                                <td><a href='/ContentDetail?PageName={{$content->PageName}}&PageURL={{$content->PageURL}}&Date={{$content->Date}}'>{{$content->PageName}}</a></td>
											<td>{{$content->Stage}}</td>
			                                <td>{{number_format($content->score*10,1)}}</td>
			                                <td>{{$content->Engage}}</td>
			                                <td>{{date("M d, Y",strtotime($content->Date))}}</td>
			                            </tr>
			                            @endforeach
		                            
		                            </tbody>
		                          </table>
		                      </div>
		                    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="TopPerformingContent">
	<div class="row">
		<div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
			<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
				<h3 class="bold">Top Performing Content</h3>
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


<section id="TopKeywordsUsed">
	<div class="row">

		<div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
			<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
				<h3 class="bold">Top Keywords Used</h3>
			</div>
			<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
				<select class="form-control tableselect" style="border:none;" onchange="topKeywordsUsed(this.value)">

					<option value="30" selected>Top 30</option>
					<option value="60">Top 60</option>
					<option value="90">Top 90</option>
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
						                <ul class="nav nav-tabs " >
											{{--onclick="KeywordsTabClick();"--}}
							                  <li class="active tab01"><a href="#tab_w1" data-toggle="tab"><h3>Awareness</h3></a></li>
							                  <li class="tab02" ><a href="#tab_w2" data-toggle="tab"><h3>Engagement</h3></a></li>
							                  <li class="tab03"><a href="#tab_w3" data-toggle="tab"><h3>Consideration</h3></a></li>
							                  <li class="tab04"><a href="#tab_w4" data-toggle="tab"><h3>Conversion</h3></a></li>
						                </ul>
						                <div class="tab-content light-blue">
          									<div class="tab-pane active" id="tab_w1">
          										<div class="row">
          											<div id="Word_chart1"></div>
          										</div>

          									</div>
          									<div class="tab-pane" id="tab_w2">
          										<div class="row">
          											<div id="Word_chart2"></div>
          										</div>
          									</div>
          									<div class="tab-pane" id="tab_w3">
          										<div class="row">
          											<div id="Word_chart3"></div>
          										</div>
          									</div>
          									<div class="tab-pane" id="tab_w4">
          										<div class="row">
          											<div id="Word_chart4"></div>
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


<section id="ContentSearch">
	<div class="row">
		<div class="col-md-12 col-lg-11 col-xs-12">
			<h3 class="bold">Content List</h3>
			<div class="alert-modal">
				<div class="modal">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="row">
					    	<div class="box">
		                      <div class="table-box">
		                        <table id="content_list_table" class="table table-hover">
		                            <thead>
		                              	<tr id="tablehead">
			                                <th>Page Name</th>
											<th>URL</th>
		                              	</tr>
		                            </thead>
		                            <tbody>
		                            	@foreach($clicks as $click) 
		                            		<tr>
		                            			<td>{{$click->PageName}}</td>
		                            			<td><a href='/ContentDetail?PageName={{$click->PageName}}&PageURL={{$click->parsedPageURL}}&Date={{$click->SystemDate}}'>{{$click->parsedPageURL}}</a></td>
		                            		</tr>
		                            	@endforeach		                            
		                            </tbody>
		                          </table>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.4.11/d3.min.js"></script>
<script src="{{URL::to('/plugins/chartjs/d3.layout.cloud.js')}}"></script>
 
<script>

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





function topPerformingContent(a){
$.get("{{URL::to('/Content/topPerformingContent')}}",{days:a,dt:1}).done(function( data ) {


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
+						                   		'<a href="/ContentDetail?PageName='+value.PageName+'&PageURL='+value.PageURL+'&Date='+value.Date+'">'
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
+						            	 	'<h1  style="margin: 0px; color:#7CFC00"><strong>'+value.avgscore+'</+strong></h1>'
+						            	 '</div>'								            			
+						            	 '<div class="col-lg-9">'
+						            	 	'<p>Engagements Generated: '+value.sum+' </p>'
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

});
}
function topPerformingContent1(a){
    $.get("{{URL::to('/Content/topPerformingContent')}}",{days:a,dt:2}).done(function( data ) {


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
                +						                   		'<a href="/ContentDetail?PageName='+value.PageName+'&PageURL='+value.PageURL+'&Date='+value.Date+'">'
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
                +						            	 	'<h1  style="margin: 0px; color:#7CFC00"><strong>'+value.avgscore+'</+strong></h1>'
                +						            	 '</div>'
                +						            	 '<div class="col-lg-9">'
                +						            	 	'<p>Engagements Generated: '+value.sum+' </p>'
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

    });
}
function topPerformingContent2(a){
    $.get("{{URL::to('/Content/topPerformingContent')}}",{days:a,dt:3}).done(function( data ) {
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
                +						                   		'<a href="/ContentDetail?PageName='+value.PageName+'&PageURL='+value.PageURL+'&Date='+value.Date+'">'
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
                +						            	 	'<h1  style="margin: 0px; color:#7CFC00"><strong>'+value.avgscore+'</+strong></h1>'
                +						            	 '</div>'
                +						            	 '<div class="col-lg-9">'
                +						            	 	'<p>Engagements Generated: '+value.sum+' </p>'
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
    });
}
function topPerformingContent3(a){
    $.get("{{URL::to('/Content/topPerformingContent')}}",{days:a,dt:4}).done(function( data ) {
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
                +						                   		'<a href="/ContentDetail?PageName='+value.PageName+'&PageURL='+value.PageURL+'&Date='+value.Date+'">'
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
                +						            	 	'<h1  style="margin: 0px; color:#7CFC00"><strong>'+value.avgscore+'</+strong></h1>'
                +						            	 '</div>'
                +						            	 '<div class="col-lg-9">'
                +						            	 	'<p>Engagements Generated: '+value.sum+' </p>'
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




// Made it global because of width issue for d3 - v3.3 Push
var dwidth = 0;

function topKeywordsUsed(a)
{ 

$.get("{{URL::to('/Content/topPerformingContent')}}",{days:a,dt:5}).done(function( data ) {

var string1 = '';
var string2 = '';
var string3 = '';
var string4 = '';

$.each(data.AwarenessData, function( index, value ) {
	string1 += value.PageName;
});

$.each(data.EngagementData, function( index, value ) {
	string2 += value.PageName;
});

$.each(data.ConsiderationData, function( index, value ) {
	string3 += value.PageName;
});

$.each(data.ConversionData, function( index, value ) {
	string4 += value.PageName;
});


    $("#Word_chart1").empty();
    dwidth = $("#Word_chart1").width();
    drawWordCloud(string1,"#Word_chart1");
    $("#Word_chart2").empty();
    drawWordCloud(string2,"#Word_chart2");
    $("#Word_chart3").empty();
    drawWordCloud(string3,"#Word_chart3");
    $("#Word_chart4").empty();
    drawWordCloud(string4,"#Word_chart4");

});

}
 

function drawWordCloud(text_string,element){
var common = text_string;
var word_count = {};
var words = text_string.split(/[ '\-\(\)\*":;\[\]|{},.!?]+/);
  if (words.length == 1){
    word_count[words[0]] = 1;
  } else {
    words.forEach(function(word){
      var word = word.toLowerCase();
      if (word != "" && common.indexOf(word)==-1 && word.length>1){
        if (word_count[word]){
          word_count[word]++;
        } else {
          word_count[word] = 1;
        }
      }
    })
  }
var svg_location = element;
// var width = $(element).width();
var height = '400';//$("#chart").height();
var fill = d3.scale.category20();
var word_entries = d3.entries(word_count);
var xScale = d3.scale.linear()
   .domain([0, d3.max(word_entries, function(d) {
      return d.value;
    })
   ])
   .range([10,100]);
d3.layout.cloud().size([dwidth, height])
  .timeInterval(20)
  .words(word_entries)
  .fontSize(function(d) { return xScale(+d.value); })
  .text(function(d) { return d.key; })
  .rotate(function() { return ~~(Math.random() * 2) * 90; })
  .font("Impact")
  .on("end", draw)
  .start();
function draw(words) {
  d3.select(svg_location).append("svg")
      .attr("width", dwidth)
      .attr("height", height)
    .append("g")
      .attr("transform", "translate(" + [dwidth >> 1, height >> 1] + ")")
    .selectAll("text")
      .data(words)
    .enter().append("text")
      .style("font-size", function(d) { return xScale(d.value) + "px"; })
      .style("font-family", "Impact")
      .style("fill", function(d, i) { return fill(i); })
      .attr("text-anchor", "middle")
      .attr("transform", function(d) {
        return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
      })
      .text(function(d) { return d.key; });
}
d3.layout.cloud().stop();
}


$(window).load(function(){
	$('#content_list_table').DataTable();
topPerformingContent(5);
topPerformingContent1(5);
topPerformingContent2(5);
topPerformingContent3(5);
topKeywordsUsed(30);
});
</script>


@endsection



