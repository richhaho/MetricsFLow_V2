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
          <h1><p class="Welcome">User Management System</p></h1>
           
        </div>
        
      </div>
      <div class="col-md-12">
        <div class="col-md-12">
          <div class="col-md-12">
            <a href="{{route('logout')}}" class="btn btn-default btn-flat pull-right" style="margin-right: 40px"><i class="glyphicon glyphicon-log-out"></i> Sign out</a> 
            <a href="{{route('Portfolio')}}" class="btn btn-default btn-flat pull-right" style="margin-right: 20px"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
          </div>
        </div> 
      </div>
      
    </section>
     

    <section class="col-lg-12  ">
       <div class="row">
         <div class="col-lg-12">
           <div class="">
             <div class="box-header">
               <a href="#" class="btn btn-success"  data-toggle="modal" data-target="#modal-create-user"><i class="glyphicon glyphicon-plus" ></i> Create New User</a>
                  @component('user_components.createmodal')
                  @endcomponent
             </div>
             <div class="box-header">
              <p></p>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
               <table id="client_list" class="table table-hover">
                 <thead >
                 <tr>
                   <th width="20%">Name</th>
                   <th width="15%">Email</th>
                   <th width="10%">Client ID</th>
                   <th width="10%">Portfolio ID</th>
                   <th width="10%">Country</th>
                   <th width="10%">Status</th>
                   <th width="10%">Role</th>
                   <th width="10%">Last Seen</th>
                   <th width="20%">&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;</th>
                 </tr>
                 </thead>
                 <tbody>
                   @foreach($users as $user)                    
                   <tr>
                      
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->client_id}}</td>
                      <td>{{$user->portfolio}}</td>
                      <td>{{$user->country}}</td>
                      <td>
                        {{$user->status==1 ? 'Approved':'Pending'}}
                      </td>
                      <td>{{$user->user_role()->role()->description}}</td>
                      <td>@if($user->last_read_announcements_at) {{date('F j, Y',strtotime($user->last_read_announcements_at))}} @endif</td>
                      <td> 
                        <a href="#" class="btn btn-success btn-xs btn-login"  data-toggle="modal" data-target="#modal-login-{{$user->id}}"><i class="glyphicon glyphicon-log-in"></i></a>
                          @component('user_components.loginmodal')
                          @slot('id') 
                              {{ $user->id }}
                          @endslot
                          @slot('name') 
                              {{ $user->name }}
                          @endslot
                          @slot('email') 
                              {{ $user->email }}
                          @endslot
                          @slot('client_id') 
                              {{ $user->client_id }}
                          @endslot
                          @slot('role') 
                              {{ $user->user_role()->role()->name }}
                          @endslot 
                          @endcomponent
                        <a href="#" class="btn btn-warning btn-xs btn-edit" data-toggle="modal" data-target="#modal-edit-{{$user->id}}"><i class="glyphicon glyphicon-edit"></i></a>
                          @component('user_components.editmodal')
                          @slot('id') 
                              {{ $user->id }}
                          @endslot
                          @slot('name') 
                              {{ $user->name }}
                          @endslot
                          @slot('email') 
                              {{ $user->email }}
                          @endslot
                          @slot('client_id') 
                              {{ $user->client_id }}
                          @endslot
                          @slot('portfolio') 
                              {{ $user->portfolio }}
                          @endslot
                          @slot('country') 
                              {{ $user->country }}
                          @endslot

                          @slot('status') 
                              {{ $user->status }}
                          @endslot
                          @slot('role') 
                              {{ $user->user_role()->role()->name }}
                          @endslot                       

                           
                          @endcomponent
                          @if($user->id!=Auth::user()->id)         
                          <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete-{{$user->id}}"><i class="glyphicon glyphicon-trash" ></i></a>
                           
                          @component('user_components.deletemodal')
                          @slot('id') 
                              {{ $user->id }}
                          @endslot
                          @endcomponent

                          @endif
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
    $('#client_list').DataTable({"order": [2, 'asc'] 
      
    });
  });
  
  $('.btn-edit').click(function(){
    $('.tab-pane').removeClass('active');
    $('.tab-btn').removeClass('active');
    $('.tab01').addClass('active');
    $('.tab_w1').addClass('active');
  });
  $('.tab01').click(function(){
    $('.tab-pane').removeClass('active');
    
    $('.tab_w1').addClass('active');
  });
  $('.tab02').click(function(){
    $('.tab-pane').removeClass('active');
    $('.tab_w2').addClass('active');
  });
  $('.tab03').click(function(){
    $('.tab-pane').removeClass('active');
    $('.tab_w3').addClass('active');
  });

  function updatePasswordForm(e){
    if ($(e).find('.password').val()!=$(e).find('.confirm_password').val()){
      $(e).find('.not_match').css('display','block');event.preventDefault();return;
    }
    if ($(e).find('.password').val().length<8){
      $(e).find('.pass_length').css('display','block');
      event.preventDefault();
    }
  }
  $('input[type="password"]').click(function(){
    $('.not_match').css('display','none');
    $('.pass_length').css('display','none');
  });
</script>
</html>
