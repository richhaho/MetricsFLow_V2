@extends('template.template')

@section('content-header')
<link rel="stylesheet" href="/plugins/material/material-charts.css"> 
<link rel="stylesheet" href="{{URL::to('/css/report.css')}}">
<link rel="stylesheet" href="{{URL::to('/css/report_warranty.css')}}">
<style type="text/css">
	 
	 
</style>
<section class="content-header">

	<div id="breadcrumbs">
		<h4 class="bold"><a href="/Reports">Reports </a> <i class="fa fa-chevron-right" aria-hidden="true"></i> 
			<a href="#">Conversion Overview Details</a><i class="fa fa-chevron-right" aria-hidden="true"></i>
			<a href="#">Top conversion paths</a>
		</h4>
	</div>
 
</section>
@endsection

@section('content')
 
<section >
	<div class="col-lg-11 col-md-12 col-xs-12 col-sm-12">
		<div class="box-tools pull-left">
		 
			<select class="form-control" >
				<option>Last 30 Days</option>
				<option>Last 60 Days</option>
				<option>Last 90 Days</option>
				<option>Last 10 Days</option>
				<option>Last 20 Days</option>
			</select>
			
		</div>
		
	</div>

  	<div class="col-lg-11 col-md-11 col-xs-12 col-sm-12" >
		<h3 class="bold"><a href="#">Warrant Page</a></h3>
			<div class="col-md-12 col-lg-12 col-xs-12">
			<div class="alert-modal">
				<div class="modal">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="modal-dialog">
						    <div class="modal-content">
						        <div class="modal-header light-blue">
						        	<div class="pathChart_group">
						        	<div id="pathChart">
						        		 
						        		
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jcanvas/20.1.4/jcanvas.js"></script>
<script src="{{URL::to('/js/report_warranty.js')}}"></script>
<script type="text/javascript">
   
  var pathdata=[
	{path:1,contents:
		[{title:"Landing Page 12 Big Words", Prospects: "12,345", BounceRate: "32%"},{title:"Anti-Fraud Vido 06", Prospects: "8,765", BounceRate: "24%"},
		{title:"Anti-Fraud Video Verafin", Prospects: "3,210", BounceRate: "41%"},
		{title:"Content Piece X", Prospects: "123", BounceRate: "13%"},
		{title:"Content Piece Y", Prospects: "85", BounceRate: "4%"}]
	},
	{path:2,contents:
		[{title:"Blog Post 08", Prospects: "8,765", BounceRate: "24%"},
		{title:"Anti-Fraud Video Verafin", Prospects: "3,210", BounceRate: "41%"},
		{title:"Content Piece X", Prospects: "123", BounceRate: "13%"},
		{title:"Content Piece Y", Prospects: "85", BounceRate: "4%"}
		]
	},
	{path:3,contents:
		[{title:"How to stop money", Prospects: "4235", BounceRate: "21%"},
		{title:"Content Piece A", Prospects: "345", BounceRate: "15%"},
		{title:"Content Piece B", Prospects: "245", BounceRate: "12%"},
		{title:"Anti-Fraud Vido 06", Prospects: "8,765", BounceRate: "24%"},
		{title:"Anti-Fraud Video Verafin", Prospects: "3,210", BounceRate: "41%"},
		{title:"Content Piece X", Prospects: "123", BounceRate: "13%"},
		{title:"Content Piece Y", Prospects: "85", BounceRate: "4%"}
		]
	},
	{path:4,contents:
		[{title:"Fraud Protection Strages", Prospects: "4315", BounceRate: "52%"},
		{title:"Content Piece A", Prospects: "345", BounceRate: "15%"},
		{title:"Content Piece B", Prospects: "245", BounceRate: "12%"},
		{title:"Content Piece A", Prospects: "345", BounceRate: "15%"},
		{title:"Content Piece B", Prospects: "245", BounceRate: "12%"},
		{title:"Content Piece B", Prospects: "245", BounceRate: "12%"}
		]
	},
	{path:5,contents:
		[{title:"Anti-Fraud Vido 06", Prospects: "8,765", BounceRate: "24%"},
		{title:"Anti-Fraud Video Verafin", Prospects: "3,210", BounceRate: "41%"},
		{title:"Content Piece X", Prospects: "123", BounceRate: "13%"},
		{title:"Content Piece Y", Prospects: "85", BounceRate: "4%"}
		]
	}
];
		var element="#pathChart";
		
		pathChart_plot(pathdata,element);
 

</script>

@endsection