<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    </style>
</head>
<body>
  <div class="content-wrapper" style="height: 30%;">
    <section class="content">
      <div class="row" id="title">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <h1><p class="Welcome"><b style="font-size:40px;color: #282e62">Metrics</b>flow</p></h1>
          <h1><p class="Welcome">Welcome Admin!</p></h1>
          <h3><p class="Welcome">Click Users to see their Portfolio.</p></h3>
        </div>
      </div>
      
    </section>
    <section class="content" style="height: 100%; ">
      <div class="col-md-12" id="contents" style="padding-bottom: 500px;padding-top: 50px;">
       
        <div class="col-md-12" id="port1">
           
          @foreach($users as $user)
          <div class="col-md-2">
            <div id="portfolio">
              <div class=" "><h4><a href="/SelectUser?user_id={{$user->id}}">{{$user->name}}</a></div></h4>
            </div>
          </div>
          @endforeach
        </div>
        <br><br>
        <div class="row">
          <div class="col-md-12">
           <center><a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a></center>
          </div>
        </div>
      </div>
    </section>
         
  </div>

</body>
</html>
