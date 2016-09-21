@extends('template.template')

@section('content-header')
    <link rel="stylesheet" href="/plugins/material/material-charts.css">
    <link rel="stylesheet" href="{{URL::to('/css/report.css')}}">
    <style>
        .datagraph{
            float: left;
            width: 100%;
            padding-top: 50px;
        }
        .datagraph i{
            float: left;
            width: 100%;
            font-size: 28px;
            padding: 10px 0px;
        }
        .socialdata{
            float: left;
            width: 100%;
            border-radius: 5px;
            text-align: left;
            padding: 0px;
            box-shadow: 0px 2px 8px #bababa;
        }
        .socialdata .pagedata{
            background-color: #1E7DBF;
            color: #FFF;
            padding: 5px 10px;
            border-radius: 5px 5px 0px 0px;
            height: 80px;
            word-wrap: break-word; 
        }
        .socialdata .warrantypagedata{
            background-color: #00B463;
            color: #FFF;
            padding: 5px 10px;
            border-radius: 5px 5px 0px 0px;
            height: 80px;
            word-wrap: break-word;

        }
        .socialdata .usercount{
            float: left;
            width: 100%;
            padding: 5px 10px;
        }
        .socialdata .usercount p{
            margin-bottom: 0px;
        }
        .datagraph .datadivpart1{
            padding-right: 0px;
        }
        .datagraph .datadivpart2{
            padding-left: 0px;
        }

        @media (min-width: 768px) and (max-width: 990px) {
            .datagraph .datadivpart2 {
                padding-top: 30px;
            }
        }
        @media (min-width: 990px) and (max-width: 1024px) {
            .socialdata .pagedata,
            .socialdata .usercount
            {
                font-size: 12px;
            }
        }
        @media (max-width: 480px) {
            .datagraph .datadivpart1 .datacommondiv,
            .datagraph .datadivpart2 .datacommondiv{
                padding-top: 30px;
            }
            .datagraph .datadivpart1{
                padding-right: 15px;
            }
            .datagraph .datadivpart2
            {
                padding-left: 15px;
            }
        }

        @media (min-width: 551px) and (max-width: 767px) {
            .datagraph .datadivpart1,
            .datagraph .datadivpart2
            {
                width: 50%;
                float: left;
            }
            .datagraph .datadivpart1 .datacommondiv,
            .datagraph .datadivpart2 .datacommondiv{
                padding-top: 30px;
            }
        }
    </style>

    <style>
        * {
            box-sizing: border-box;
        }

        #progress {
            padding: 0;
            list-style-type: none;
            font-family: arial;
            font-size: 12px;
            clear: both;
            line-height: 1em;
            margin: 0 -1px;
            text-align: center;
            display: list-inline;
        }

        #progress li {
            float: left;
            padding: 10px 30px 10px 40px;
            background: #F0F8FF;
            color: #fff;
            position: relative;
            border-top: 1px solid transparent;
            border-bottom: 1px solid transparent;
            /* width: 32%;*/
            margin: 0 1px;

        }

        #progress li:before {
            content: '';
            border-left: 16px solid #fff;
            border-top: 16px solid transparent;
            border-bottom: 16px solid transparent;
            position: absolute;
            top: 0;
            left: 0;

        }
        #progress li:after {
            content: '';
            border-left: 16px solid #b3daff;
            border-top: 16px solid transparent;
            border-bottom: 16px solid transparent;
            position: absolute;
            top: 0;
            left: 100%;
            z-index: 20;
        }

        #progress li.active {
            background: #e9fce9;
            color: #595959;
        }
        #progress li.active:after {
            border-left-color:#bcf6bc;
        }
        thead th {
            font-size: 1em;
            padding: 1px !important;
            height: 35px;
            color: white;
            text-align: center;
            background-color: #3c8dbc;

        }
        img {max-width:100%}
    /*  td {
        width: 100px;
        }*/
        .navbar{
            background-color: #3c8dbc;
        }
        .navbar-brand{
            color: #fff;
        }
        .select_channel, .select_up_esr{
            border:none;
        }


    </style>
    <section class="content-header">

        <div id="breadcrumbs">
            <h4 class="bold"><i class="fa fa-chevron-left" aria-hidden="true"></i><a href="/Reports">Reports</a> <i class="fa fa-chevron-left" aria-hidden="true"></i> <a href="/ReportsDetail">Conversion Details</a> <i class="fa fa-chevron-left" aria-hidden="true"></i> Top conversion paths</h4>
        </div>

    </section>
@endsection

@section('content')

    <section>
        <div class="row">
            <div class="col-lg-11 col-md-12 col-xs-12 col-sm-12">
                <h3 class="bold">{{$PageName}} </h3>
                <br>
                <button type="button" class="btn btn-light pull-right btn-filter"> Filter </button>
                <div class="box-tools pull-right">
                    <select class="form-control select_up_esr" onchange="select_up_esr(this);">
                        <option value="0">All</option>
                        <option value="1">L</option>
                        <option value="2">C</option>
                    </select>
                </div>
                <div class="box-tools pull-right">
                    {!! Form::select('channel',$channel,"",['class'=>'form-control select_channel','onchange'=>'select_channel(this);'])!!}
                </div>


            </div>
            <div class="col-lg-11 col-md-12 col-xs-12 col-sm-12" >
                <div class="alert-modal">
                    <div class="modal">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12"  style="padding: 0px !important;">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-body row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="row">

                                                <div class="container-fluid" style="max-width:1450px">
                                                    <br><div class="card">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th width="10%">Channel</th>
                                                                     
                                                                    <th width="90%">Path</th>
                                                                </tr>
                                                            </thead><!--end-of-thead-->
                                                            <tbody class="table_conversion">
                                                                                                                                
                                                            </tbody>
                                                        </div>
                                                    </table><!--end-of-table-->
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
        </div>
    </section>
    <script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script>
    var up_esr="{{$up_esr}}";
    $('.select_up_esr').val(up_esr);

        function removeNulls(obj){
            var isArray = obj instanceof Array;
            for (var k in obj){
                if (obj[k]===null) isArray ? obj.splice(k,1) : delete obj[k];
                else if (typeof obj[k]=="object") removeNulls(obj[k]);
            }
        }
 
        var sites = {!! json_encode($data->toArray()) !!} ;
        //console.log(sites); 
         
        removeNulls(sites);

        for (var i=0; i< sites.length; i++)
        {
            var s = '.datacommondiv'+i;
            if( i <= 2){ $('.datadivpart1').append('<div class="col-md-4 col-sm-4 col-xs-12 text-center datacommondiv'+i+'"> </div>');}
            else{$('.datadivpart2').append('<div class="col-md-4 col-sm-4 col-xs-12 text-center datacommondiv'+i+'"> </div>');}

            function attach(div) {
                if( i <= 2){ $(s).append(div);}
                else{$(s).append(div);}

            }
            var conv='';
            var channel = sites[i]['Channel_New'];
            var conversion = sites[i]['conversion_page_e_id_SESSION_WISE'];
            


            conv+='<tr>'
            +    '<td width="10%" style="text-align:center;"><div>'+ channel +'</div></td>'
            +    '<td width="90%" style="text-align:center;">'
            +        '<ul id ="progress">';
            
            for (var key in sites[i]) {
                if (sites[i].hasOwnProperty(key)) {
                conv+='<li><strong><span title="'+sites[i][key]+'"><a href="'+sites[i][key]+'" style="color: #595959">'+sites[i][key]+'</span></strong></a></li>'
                }

            }
            conv+=       '</ul>'
                 +    '</td>'
                 +'</tr>';


            $('.table_conversion').append(conv);
            $('.table_conversion').find('tr td ul li').last().addClass('active');


        }

    // function select_up_esr(val){
    //     window.location.href="{{URL::to('/WarrantyPage')}}?PageName={{$PageName}}&PageURL={{$PageURL}}&up_esr="+$(val).val();
    // } 

    // function select_channel(val){
    //     var channel=$(val).val();
    //     if (channel!="Channel"){
    //         $('.table_conversion tr').each(function(e){
    //             var chn=$(this).first().find('div').text();
    //             if (chn==channel) {
    //                 $(this).css('display','block');
    //             }else{
    //                 $(this).css('display','none');
    //             }
    //         });
    //     }else{
    //         $('.table_conversion tr').each(function(e){
    //             $(this).css('display','block');
    //         });
    //     }
    // }
    $('.btn-filter').click(function(){
        window.location.href="{{URL::to('/WarrantyPage')}}?PageName={{$PageName}}&PageURL={{$PageURL}}&up_esr="+$('.select_up_esr').val()+"&channel="+$('.select_channel').val();
    });

    </script>


@endsection

