<!DOCTYPE html>
<html lang="en">
<head>
     
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="\plugins\datatables\dataTables.bootstrap.css">

    <link href="css/portfolio.css" rel="stylesheet" type="text/css" />

    <style>
        @media (max-width: 800px) {
            .flexbox {
                flex-direction: column;
            }
        }
        .flexbox {
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            overflow: hidden;
        }
        .flexbox .col {
            flex: 1;
            margin: 4px;
        }
        .btn-status{
          pointer-events: none;
        }
    </style>
</head>
<body>
  <div class="content-wrapper" style="height: 30%;">
    <section class="content">
      <div class="row" id="title">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <h1><p class="Welcome"><b style="font-size:40px;color: #282e62">Metrics</b>flow</p></h1>
          <h1><p class="Welcome">Admin Panel</p></h1>
           
        </div>
        
      </div>
      <div class="col-md-12">
        <div class="col-md-12">
          <div class="col-md-12">
            <a href="{{route('logout')}}" class="btn btn-default btn-flat pull-right" style="margin-right: 40px"><i class="glyphicon glyphicon-log-out"></i> Sign out</a> 
            <a href="{{route('userManagement')}}" class="btn btn-default btn-flat pull-right" style="margin-right: 20px"><i class="glyphicon glyphicon-user"></i> User Management</a>
          </div>
        </div> 
      </div>
      
    </section>
     

    <section class="col-lg-12  ">
        

               <div class="modal-body">
                 <div class="row">
                   <div class="col-lg-12">
                     <div class="">
                       <div class="box-header">
                         <h3 class="bold">All Clients</h3>
                       </div>
                       <!-- /.box-header -->
                       <div class="box-body">
                         <table id="client_list" class="table table-hover">
                           <thead >
                           <tr>
                             <th width="20%">Client ID</th>
                             <th width="20%">Client Name</th>
                             <th width="20%">Status</th>
                             <th width="40%">Pages</th>
                             

                           </tr>
                           </thead>
                           <tbody>
                             @foreach($users as $user)                    
                             <tr>
                                <td>{{$user->client_id}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                  @if ($user->status==1)
                                  <a class="btn btn-success btn-status">Approved</a>
                                  @else
                                  <a class="btn btn-warning btn-status">Pending</a>
                                  @endif
                                </td>
                                <td> 
                                  <a href="/adminReports?client_id={{$user->client_id}}" class="btn btn-default">Reports</a>
                                  <a href="/adminLeads?client_id={{$user->client_id}}" class="btn btn-default">Leads</a>
                                  <a href="/adminContents?client_id={{$user->client_id}}" class="btn btn-default">Contents</a>
                                  <a href="/adminChannels?client_id={{$user->client_id}}" class="btn btn-default">Channels</a>
                                  <a href="/adminCampaigns?client_id={{$user->client_id}}" class="btn btn-default">Campaigns</a>
                                  <a href="/adminAudience?client_id={{$user->client_id}}" class="btn btn-default">Audience</a>
                                </td>
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

          <!-- /.row -->
    </section>
         
  </div>

</body>
<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="\plugins\datatables\jquery.dataTables.js"></script>
<script src="\plugins\datatables\dataTables.bootstrap.js"></script>
<script src="\plugins\datatables\datatable.js"></script>





<script>
  $(function () {
    $('#client_list').DataTable({"order": [0, 'asc']
      // "paging": true,
      // "lengthChange": true,
      // "searching": true,
      // "ordering": true,
      // // "info": true,
      // "autoWidth": true
    });
  });
</script>
</html>
