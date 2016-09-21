@extends('template.template')

@section('content-header')

<link rel="stylesheet" href="\plugins\datatables\dataTables.bootstrap.css">
<style>
    .title_back_grey{
	 	background-color:#f5f7ff; 
	 }
</style>
@endsection

@section('content')


    <section id="AudienceCardPage">
        <div class="row">

            <div class="col-lg-11 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="bold">Audience</h3>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="alert-modal">
                    <div class="modal">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                            <div class="alert-modal">
                                                <div class="modal">
                                                    <div class="modal-dialog alertbox">
                                                        <div class="modal-content">
                                                            <a href="{{URL::to('AudienceDetail')}}?page=language">
                                                            <div class="modal-header light-blue">         
                                                                <h4 class="modal-title">Languages</h4>
                                                            </div>
                                                            </a>
                                                            <div class="modal-body">
                                                                <div class="row left">
                                                                    <div class="col-md-12 alert-content">
                                                                        <div class="alert-label">
                                                                            <h4 class="bold600 pull-right">Languages</h4>
                                                                        </div>
                                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <table id="card_Language" class="table table-hover">
                                                                            <tbody>
                                                                            @foreach ($languages as $item)
                                                                                <tr>
                                                                                    <td class="bold600" style="color:blue">{{$item->label}}</a></td>
                                                                                    <td class="bold600">{{$item->users}}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        </div>
                                                                    </div>
                                                                </div>			           
                                                            </div>
                                                        </div>
                                                    <!-- /.modal-content -->
                                                    </div>
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                            <div class="alert-modal">
                                                <div class="modal">
                                                    <div class="modal-dialog alertbox">
                                                        <div class="modal-content">
                                                            <a href="{{URL::to('AudienceDetail')}}?page=browser">
                                                            <div class="modal-header light-blue">         
                                                                <h4 class="modal-title">Browser</h4>
                                                            </div>
                                                            </a>
                                                            <div class="modal-body">
                                                                <div class="row left">
                                                                    <div class="col-md-12 alert-content">
                                                                        <div class="alert-label">
                                                                            <h4 class="bold600 pull-right">Browser</h4>
                                                                        </div>
                                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <table id="card_Language" class="table table-hover">
                                                                            <tbody>
                                                                            @foreach ($browsers as $item)
                                                                                <tr>
                                                                                    <td class="bold600" style="color:blue">{{$item->label}}</a></td>
                                                                                    <td class="bold600">{{$item->users}}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        </div>
                                                                    </div>
                                                                </div>			           
                                                            </div>
                                                        </div>
                                                    <!-- /.modal-content -->
                                                    </div>
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                            <div class="alert-modal">
                                                <div class="modal">
                                                    <div class="modal-dialog alertbox">
                                                        <div class="modal-content">
                                                            <a href="{{URL::to('AudienceDetail')}}?page=os">
                                                            <div class="modal-header light-blue">         
                                                                <h4 class="modal-title">Operating System</h4>
                                                            </div>
                                                            </a>
                                                            <div class="modal-body">
                                                                <div class="row left">
                                                                    <div class="col-md-12 alert-content">
                                                                        <div class="alert-label">
                                                                            <h4 class="bold600 pull-right">Operating System</h4>
                                                                        </div>
                                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <table id="card_Language" class="table table-hover">
                                                                            <tbody>
                                                                            @foreach ($oss as $item)
                                                                                <tr>
                                                                                    <td class="bold600" style="color:blue">{{$item->label}}</a></td>
                                                                                    <td class="bold600">{{$item->users}}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        </div>
                                                                    </div>
                                                                </div>			           
                                                            </div>
                                                        </div>
                                                    <!-- /.modal-content -->
                                                    </div>
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                            <div class="alert-modal">
                                                <div class="modal">
                                                    <div class="modal-dialog alertbox">
                                                        <div class="modal-content">
                                                            <a href="{{URL::to('AudienceDetail')}}?page=channel">
                                                            <div class="modal-header light-blue">         
                                                                <h4 class="modal-title">Channel</h4>
                                                            </div>
                                                            </a>
                                                            <div class="modal-body">
                                                                <div class="row left">
                                                                    <div class="col-md-12 alert-content">
                                                                        <div class="alert-label">
                                                                            <h4 class="bold600 pull-right">Channel</h4>
                                                                        </div>
                                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <table id="card_Language" class="table table-hover">
                                                                            <tbody>
                                                                            @foreach ($channels as $item)
                                                                                <tr>
                                                                                    <td class="bold600" style="color:blue">{{$item->label}}</a></td>
                                                                                    <td class="bold600">{{$item->users}}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        </div>
                                                                    </div>
                                                                </div>			           
                                                            </div>
                                                        </div>
                                                    <!-- /.modal-content -->
                                                    </div>
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                            <div class="alert-modal">
                                                <div class="modal">
                                                    <div class="modal-dialog alertbox">
                                                        <div class="modal-content">
                                                            <a href="{{URL::to('AudienceDetail')}}?page=country">
                                                            <div class="modal-header light-blue">         
                                                                <h4 class="modal-title">Country</h4>
                                                            </div>
                                                            </a>
                                                            <div class="modal-body">
                                                                <div class="row left">
                                                                    <div class="col-md-12 alert-content">
                                                                        <div class="alert-label">
                                                                            <h4 class="bold600 pull-right">Country</h4>
                                                                        </div>
                                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <table id="card_Language" class="table table-hover">
                                                                            <tbody>
                                                                            @foreach ($countrys as $item)
                                                                                <tr>
                                                                                    <td class="bold600" style="color:blue">{{$item->label}}</a></td>
                                                                                    <td class="bold600">{{$item->users}}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        </div>
                                                                    </div>
                                                                </div>			           
                                                            </div>
                                                        </div>
                                                    <!-- /.modal-content -->
                                                    </div>
                                                </div>
                                                <!-- /.modal-dialog -->
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
<script>
</script>

@endsection
