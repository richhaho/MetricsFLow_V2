@extends('template.template')

@section('content-header') 
 <style>
 .password_error{
     display:none;
     color:red;
 }
 </style>
	<section class="content-header">
		 
		<div id="client_logo">
			<img src="img/{{$client_id}}.png" alt="client_logo">
		</div>
	</section>
@endsection

@section('content')

     {!! Form::open(['route' => 'profile.update','files' => true,'class'=>'uploadfile']) !!}
        <div id="top-wrapper" >
            <div class="container-fluid">
            <div  class="col-xs-12">
                <h1 class="page-header">{{ $user->name }}'s Profile
                    <div class="pull-right">
                        <button class="btn btn-success " type="submit"> <i class="fa fa-floppy-o"></i> Save</button>
                        <a class="btn btn-danger " href="/Reports"><i class="fa fa-times-circle"></i> Cancel</a> &nbsp;&nbsp;
                    </div>
                </h1>
            </div>
            </div>
        </div>
            <div id="page-wrapper">

            <div class="container-fluid">

                        @if (Session::has('message'))
                            <div class="col-xs-12 message-box">
                            <div class="alert alert-info" style="background-color: #d9edf7 !important;border-color: #d9edf7 !important; color: red !important">{{ Session::get('message') }}</div>
                            </div>
                        @endif
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                User Info
                            </div>
                            <div class="panel-body">
                                <input name="id"  value="{{ old("name",$user->id)}}" type="hidden">
                                <div class="row">
	                                <div class="col-xs-12 col-md-6 form-group">
	                                    <label>Name:</label>
	                                    <input name="username" required value="{{ old("name",$user->name)}}" class="form-control" data-toggle="tooltip" data-placement="top" title="">
	                                </div>
	                                <div class="col-xs-12 col-md-6 form-group">
	                                    <label>Email:</label>
	                                    <input name="email" type="email" required value="{{ old("email",$user->email)}}" class="form-control" data-toggle="tooltip" data-placement="top" title="">
	                                </div>
                                </div>

                                <div class="row">
	                                <div class="col-xs-12 col-md-6 form-group">
	                                    <label>Password:</label>
	                                    <input name="new_password" type="password" class="new_password form-control noucase" data-toggle="tooltip" data-placement="top" title="">
                                        <p class="password_error length_err">Password length must be more than 8 letters.</p>
	                                </div>

	                                <div class="col-xs-12 col-md-6 form-group">
	                                    <label>Confirm Password:</label>
	                                    <input name="new_password_confirmation"  type="password" class="new_password_confirmation form-control noucase" data-toggle="tooltip" data-placement="top" title="">
                                        <p class="password_error confirm_err">Confirmation Password is incorrect. Please input same password on Confirm Password.</p>
	                                </div>
                                </div>
                                <div class="row">
                                	<div class="col-xs-12 col-md-6 form-group">
	                                    <label>Logo:</label>

	                                    {!!  Form::file('logo', ['class' => 'form-control logo_upload']) !!}
	                                </div>


                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->


            </div>
            <!-- /.container-fluid -->

        </div>
    </form>
<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
<script type="text/javascript">
	// $('.logo_upload').change(function(){
	// 	console.log($('.logo_upload').val());
	// 	var logoimg='<img src="'+$('.logo_upload').val()+'">';
	// 	$('.img_logo').append(logoimg);
	// });

$(function () {
    $(".message-box").fadeTo(2000, 500).slideUp(500, function(){
        $(".message-box").slideUp(500).remove();
    });
});

$('.uploadfile').submit(function(event){
    if ($('.new_password_confirmation').val()!=$('.new_password').val()){
        $('.confirm_err').css('display','block');
        event.preventDefault();
    }else if ($('.new_password_confirmation').val().length<8){
        $('.length_err').css('display','block');
        event.preventDefault();
    }
});
$('input').click(function(){
    $('.password_error').css('display','none');
});

</script>
@endsection
