<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Metricsflow</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="\plugins\datatables\dataTables.bootstrap.css">
<!-- Theme style -->

<link rel="stylesheet" href="/css/AdminLTE.min.css">
@if (!isset($AudiencePage))
<link rel="stylesheet" type="text/css" href="/plugins/chartjs/areachart/jquery.jqChart.css" />
@endif
<link rel="stylesheet" type="text/css" href="/plugins/chartjs/areachart/jquery.jqRangeSlider.css" />
<link rel="stylesheet" type="text/css" href="/plugins/chartjs/areachart/jquery-ui-1.10.4.css" /> 


<!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="/css/skins/_all-skins.min.css">
<link rel="stylesheet" type="text/css" href="/css/style.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

  <style type="text/css">
  table.table.dataTable thead tr{
    background: #448DBB;
    color: white;
  }
  .table-bordered > thead > tr > th
  {
    /* border: 1px solid #00003f !important;  */
  }
  table.table.dataTable tr:nth-child(even){background-color: #f2f2f2;}

  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Top Header -->
    @include('nav.header')

    <!-- Sidebar navigation --> 
    @include('nav.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="containter">
    <div class="content-wrapper">
      <!-- Display content header --> 
       @yield('content-header')
        {{--@include('flash-message')--}}


       <section class="content row">
       @yield('content')
       </section>
    </div>
  </div>

  <!-- /.content-wrapper -->
  @include('nav.right')
  @include('nav.footer')
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
<!-- <script src="/plugins/jQuery/jquery-2.2.3.min.js"></script> -->
<!-- Bootstrap 3.3.6 -->
<script src="/plugins/bootstrap3.3.7/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/plugins/fastclick/fastclick.js"></script>
<script src="\plugins\datatables\jquery.dataTables.js"></script>
<script src="\plugins\datatables\dataTables.bootstrap.js"></script>
<script src="\plugins\datatables\datatable.js"></script>
@if (!isset($AudiencePage))
<script src="/plugins/chartjs/areachart/jquery.jqChart.min.js" type="text/javascript"></script>
<script src="/plugins/chartjs/areachart/jquery.mousewheel.js" type="text/javascript"></script>
<script src="/plugins/chartjs/areachart/jquery.jqRangeSlider.min.js" type="text/javascript"></script>
@endif
<!-- AdminLTE App -->
<script src="/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/js/demo.js"></script>
<script src="/plugins/jQuery/jquery.canvasjs.min.js"></script>
@if (!isset($AudiencePage))
<script src="/js/heatmap.js"></script>
<script src="/js/heatmap_user.js"></script>
@endif
</body>
</html>