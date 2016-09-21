@extends('template.template')

@section('content-header')



    <div class="row form-group">

        <div class="col-md-4"></div>
        <div class="col-md-3">
            <section class="content-header">

                <div id="client_logo">
                    <img src="img/{{$client_id}}.png" alt="client_logo">
                </div>
            </section>
        </div>
        <div class="col-md-5"></div>


    </div>
@endsection


@section('content')

    <div class="row form-group">

        <div class="col-md-4">
        </div>
        <div class="col-md-4" >
            @if (Session::has('message'))
                <div class="col-xs-12 message-box">
                    <div class="alert alert-info" style="background-color: #d9edf7 !important;border-color: #d9edf7 !important; color: red !important">{{ Session::get('message') }}</div>
                </div>
            @endif
        </div>
        <div class="col-md-3"></div>


    </div>

    <div class="row form-group">

        <div class="col-md-5">
        </div>
        <div class="col-md-2" align="center">
            <form role="form" action="/confirmProfile" method="POST" align="center">
                {{ csrf_field() }}
                <input type="password" class="form-control" id="password" name="password" align="center" placeholder="Password">
                <br/>
                <button class="btn btn-primary" type="submit"> Confirm Password </button>
            </form>
        </div>
        <div class="col-md-5"></div>


    </div>
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function () {
            $(".message-box").fadeTo(2000, 500).slideUp(500, function(){
                $(".message-box").slideUp(500).remove();
            });
        });

    </script>
@endsection
