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
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
          folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="css/skins/skin-blue.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style type="text/css">
        .content-wrapper, .right-side, .main-footer{
            margin-left: 0;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue">

<!-- Site wrapper -->
<div class="wrapper" id="login">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Display content header -->
        <section class="content">
            <div class="login-box">
                <div class="login-logo">
                    <a href="http://metricsflow.com/"><b>metrics</b>flow</a>
                </div>
                <!-- /.login-logo -->
                <div class="login-box-body">
                    @if (Session::has('message'))
                            <div class="col-xs-12 message-box">
                            <div class="alert {{ Session::get('message-class','alert-info') }}">{{ Session::get('message') }}</div>
                            </div>
                            <p class="login-box-msg">We sent a code to your email address again. please verify code from your email.</p>
                    @else
                        <p class="login-box-msg">We sent a code to your email address. please verify code from your email.</p>
                    @endif
                    <form role="form" action="/submitverify" method="POST">
                    {{ csrf_field() }}
                    <!-- E-mail Address -->
                        <div class="form-group has-feedback">
                            Your email: {{Auth::user()->email}}
                        </div>
                        <!-- Password -->
                        <div class="form-group">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="verify_code" placeholder="Verify Code">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="row">
                          
                            <!-- Confirm Button -->
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                                        Confirm
                                    </button>
                                </div>
                                <div class="col-xs-4">
                                    <br>
                                    <a href="{{ url('/password/reset') }}" class="pull-right">Resend Code</a>
                                </div>
                                <div class="col-xs-4"><br>
                                    <a href="{{ url('/logout') }}" class="pull-right">Logout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- /.login-box-body -->
            </div>
            <!-- /.login-box -->
        </section>
    </div>
    <footer class="main-footer">
        <strong>Copyright © 2017 <a href="http://www.metricsflow.com">metricsflow</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
<script type="text/javascript">
    $(".message-box").fadeTo(6000, 500).slideUp(500, function(){
        $(".message-box").slideUp(500).remove();
    });
</script>
</body>
</html>