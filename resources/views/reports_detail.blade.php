@extends('template.template')

@section('content-header')
	<link rel="stylesheet" href="/plugins/material/material-charts.css">
	<link rel="stylesheet" href="{{URL::to('/css/report.css')}}">
	<style type="text/css">
		.title_back_grey{
			background-color:#327aba;
			color:white;
		}
		.bar_avg_visitor{
			height: 10px;border:1px solid black;
			background-color: #7c9ebb;
			box-shadow: 1px 1px grey;
			padding: 0;
			margin-top: 15px;margin-bottom: 10px;
		}
		.lines{
			margin-top: 10px;
			height: 50px;
		}
		svg{
			background-color: white !important
		}
	</style>
	<section class="content-header">
		<div id="breadcrumbs">
			<h4 class="bold"><!-- <i class="fa fa-chevron-left" aria-hidden="true"></i> --><a href="/Reports">Reports </a> <i class="fa fa-chevron-right" aria-hidden="true"></i>
				<a href="#">Conversion Overview Details</a></h4>
		</div>
	</section>
@endsection

@section('content')

	<section >
		<div class="col-lg-11 col-md-12 col-xs-12 col-sm-12">
			<div class="box-tools pull-left">

			</div>

		</div>

		<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
			<h3 class="bold">Conversion Overview Details</h3>
			<div class="alert-modal">
				<div class="modal">
					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12"  style="padding: 0px !important;">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body row">
									<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
										<div class="row">
											<div class="nav-tabs-custom" >
												<ul class="nav nav-tabs">
													<li class="active tab01"><a href="#tab_w1" data-toggle="tab"><h4>Conversion Forms</h4></a></li>
													<li class="tab02"><a href="#tab_w2" data-toggle="tab"><h4>Content Consumed</h4></a></li>
												</ul>
												<div class="tab-content light-blue">
													<div class="tab-pane active" id="tab_w1">
														<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="padding-bottom: 10px;">
															<div class="box-tools pull-left">
																<select class="form-control">
																	<option>All Site</option>
																</select>
															</div>
															<div class="box-tools pull-right">
																<a href="#" class="btn btn-sm" style="color: #333; background-color: #e6e9f0 !important; font-size: 14px "  >Request Full Reports</a>
															</div>
														</div>
														<div class="table-box">
															<table id="table_id1" class="table table-hover">

																<thead>
																<tr id="tablehead" style="background-color: #3c8dbc !important;color:white; font-size: 16px;">
																	<th width="30%">Page Name</th>
																	<th width="25%">Web Page</th>
																	<th width="15%">Conversions</th>
																	<th width="15%">Conversions %</th>
																	<th width="15%"></th>
																</tr>
																</thead>
																<tbody class="conversion_detail">
																{{--@foreach($conversion_forms as $conv)--}}
																{{--<tr>--}}
																{{--<td>{{$conv->PageName}}</td>--}}
																{{--<td><p>{{$conv->PageURL}}</p></td>--}}
																{{--<td>{{$conv->conversions}}</td>--}}
																{{--<td>{{number_format($conv->conversions_PRCNT*100,1)}}%</td>--}}
																{{--<td> <a href="/Reports_warranty">View Details ></a></td>--}}
																{{--</tr>--}}
																{{--@endforeach--}}

																</tbody>
															</table>
														</div>
													</div>
													<div class="tab-pane" id="tab_w2">

														<div class="table-box">
															<table id="table_id2" class="table table-hover">
																<thead>
																<tr id="tablehead" style="background-color: #448DBB !important;color:white; font-size: 14px;">
																	<th style="width: 40% !important">Web Page</th>
																	<th style="width: 40% !important">Page URL</th>
																	<th style="width: 10% !important">Value</th>
																	<th style="width: 10% ">Average Time </th>
																</tr>
																</thead>
																<tbody class="conversion_detail2">
																{{--@foreach($contentDrivingReporting as $content)--}}
																{{--<tr>--}}
																{{--<td>{{$content->PageName}}</td>--}}
																{{--<td>{{$content->PageURL}}</td>--}}
																{{--<td>{{$content->freq}}</td>--}}
																{{--<td>{{$content->avgtime}}</td>--}}
																{{--</tr>--}}
																{{--@endforeach--}}
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
							<!-- /.modal-content -->
						</div>
					</div>
				</div>
				<!-- /.modal-dialog -->
			</div>

		</div>
	</section>
	<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script type="text/javascript">
        function ConversionDetails(){
            $.get("{{URL::to('/Reports/ConversionDetails')}}",{"clientID":"{{$client_id}}"}).done(function( data ) {
                // console.log(data);

                $('.conversion_detail').empty();


                var cf = data.ConversionForms;
                var cp = data.ConversionPages;
                var s = 'repage';

                tbody='';
                for (i=0;i<cf.length;i++){
					var tr='<tr><td>'+cf[i].Pagename+'</td><td><p>'+cf[i].PageURL+'</p></td><td>'+cf[i].Conversions+'</td><td>'+Math.round(cf[i].Conversions_PRCNT)+'%</td><td> <form method="get" action ="/WarrantyPage"><input type="text" id ="PageURL" name = "PageURL" value = "'+cf[i].PageURL+'" hidden><input type="text" id ="PageURL" name = "PageName" value = "'+cf[i].Pagename+'" hidden><button type = "submit" class = "btn btn-primary "> View Details </button><input type="hidden" name="up_esr" value="0"></form></td></tr>';
					//var tr='<tr><td>'+cf[i].Pagename+'</td><td><a href="/ContentDetail?PageName='+cf[i].Pagename+'&PageURL='+cf[i].PageURL+'&Date='+s+'">'+cf[i].PageURL+'</a></td><td>'+cf[i].Conversions+'</td><td>'+Math.round(cf[i].Conversions_PRCNT)+'%</td><td> <form method="get" action ="/WarrantyPage"><input type="text" id ="PageURL" name = "PageURL" value = "'+cf[i].PageURL+'" hidden><input type="text" id ="PageURL" name = "PageName" value = "'+cf[i].Pagename+'" hidden><button type = "submit" class = "btn btn-primary "> View Details </button> <input type="hidden" name="_token" value="{{csrf_token()}}"></form></td></tr>';
                    tbody+=tr;
                }
                $('.conversion_detail').append(tbody);
                $('#table_id1').DataTable({ "order": [3, 'desc']});

                tbody='';
                for (i=0;i<cp.length;i++){
                    var tr='<tr><td>'+cp[i].PageName+'</td><td><a href="/ContentDetail?PageName='+cp[i].PageName+'&PageURL='+cp[i].PageURL+'&Date='+s+'">'+cp[i].PageURL+'</a></td><td>'+cp[i].Value+'</td><td>'+Math.round(cp[i].Average/60)+'</td></tr>';
                    tbody+=tr;
                }
                $('.conversion_detail2').append(tbody);
                $('#table_id2').DataTable({"order": [2, 'desc']});
            });
        }

        ConversionDetails();
	</script>
@endsection