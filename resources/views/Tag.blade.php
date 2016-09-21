@extends('template.template')
@section('content-header')

@endsection
@section('content')
    <div class="row">
    <h2 class="page-header " align="center">UTM CODE </h2>

    </div>

    {{--Modal template codes for when implementation--}}
    {{--<div class="modal modal-default fade" role="dialog" id="modal-success">--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span></button>--}}
                    {{--<h4 class="modal-title">Success </h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<textarea class="form-control" rows="2" id="final-url" readonly></textarea>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-outline-primary pull-left" data-dismiss="modal">Close</button>--}}
                    {{--<button type="button" class="btn btn-primary" onclick="copyToClipboard()"> Copy Text</button>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- /.modal-content -->--}}
        {{--</div>--}}
        {{--<!-- /.modal-dialog -->--}}
    {{--</div>--}}

    {{--<div class="modal modal-danger fade" id="modal-danger">--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span></button>--}}
                    {{--<h4 class="modal-title">Warning</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<p id="csv-danger">All fields are required.</p>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- /.modal-content -->--}}
        {{--</div>--}}
        {{--<!-- /.modal-dialog -->--}}
    {{--</div>--}}

    {{--<div class="modal modal-default fade" role="dialog" id="modal-success1">--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span></button>--}}
                    {{--<h4 class="modal-title">Success </h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<a id="out"><button type="button" name="output"class="btn btn-primary"> Download File </button></a>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-outline-primary pull-left" data-dismiss="modal">Close</button>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- /.modal-content -->--}}
        {{--</div>--}}
        {{--<!-- /.modal-dialog -->--}}
    {{--</div>--}}

    {{--<div class="modal modal-default fade" role="dialog" id="modal-success2">--}}
        {{--<div class="modal-dialog">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span></button>--}}
                    {{--<h4 class="modal-title">Success </h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<a id="out2"><button type="button" name="output" class="btn btn-primary"> Download File </button></a>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-outline-primary pull-left" data-dismiss="modal">Close</button>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- /.modal-content -->--}}
        {{--</div>--}}
        {{--<!-- /.modal-dialog -->--}}
    {{--</div>--}}

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
    <div class="alert-modal">
        <div class="modal">
            {{--<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12"  style="padding: 0px !important;">--}}
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body row">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Custom Tabs -->
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1" data-toggle="tab">Single Url</a></li>
                                            <li><a href="#tab_2" data-toggle="tab">Batch Url Procedure 1</a></li>
                                            <li><a href="#tab_3" data-toggle="tab">Batch Url Procedure 2</a></li>

                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-9">
                                                        <br/>
                                                        <div class="callout callout-success" id="alert-secondary" > <strong>Info!</strong> All fields are required. </div>

                                                        <div id="alert-danger" class="alert alert-danger" hidden>
                                                            All fields are required.
                                                        </div>
                                                        <p id="prompt"> </p>
                                                        <div class="form-group">
                                                            <label for="url">   <h4> Final Landing URL: </h4>      </label>
                                                            <input type="text" class="form-control" id="url" autocomplete=off style="width: 70%;">
                                                        </div>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="wordoption" id="aw" value="AW">  <p> AdWord </p>
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="wordoption" id="kw" value="KW"> <p> KeyWord </p>
                                                        </label>
                                                        <div class="form-group">
                                                            <label for="adname"> <h4>Ad Name: </h4></label>
                                                            <input type="text" class="form-control" id="adname" autocomplete=off style="width: 70%;">
                                                        </div>
                                                        <button type="button" class="btn btn-outline-info" onclick="generateURL()"> Generate </button>
                                                    </div>
                                                    <div class="col-md-1"></div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group" id="final-url-container" hidden>

                                                            <label for="final-url"><h4>Copy URL below:</h4></label>
                                                            <textarea class="form-control" rows="2" id="final-url" readonly></textarea>
                                                            <br/>
                                                            <button type="button" class="btn btn-outline-info" onclick="copyToClipboard()"> Copy Text</button>
                                                        </div></div>
                                                </div>


                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_2">

                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-9">
                                                        <br/>
                                                        <div class="callout callout-success" id="alert-secondary1" > <strong>Info!</strong> Fill in the name to upload file. </div>
                                                        <div id="alert-danger1" class="alert alert-danger" hidden>
                                                            Please fill out all the fields and reupload the file
                                                        </div>
                                                        <div id="alert-danger2" class="alert alert-danger" hidden>
                                                            Invalid csv file. Please reupload the file
                                                        </div>
                                                        <div class="row" hidden id="burl" style="width: 40%;" >
                                                            <div class="col-sm-4">
                                                                <input type="file" id="select" class="btn btn-block" value="Select File" onchange="onFile(event)">
                                                            </div>
                                                            <div class="col-sm-4">
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="wordoption" id="baw" value="AW"> <p> AdWord </p>
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="wordoption" id="bkw" value="KW"> <p> KeyWord </p>
                                                                </label>
                                                                <div class="form-group">
                                                                    <label for="adname"><h4> Ad Name:</h4></label>
                                                                    <input type="text" class="form-control" id="badname" onclick='show(1)' autocomplete=off style="width: 50%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group" id="file-container1" hidden>
                                                        <label for="output"><h4>Click on the button below to download the file:</h4></label>
                                                        <br/>
                                                        <a id="out"><button type="button" name="output"class="btn btn-primary"> Download File </button></a>
                                                    </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_3">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-9">
                                                        <br/>
                                                        <div class="callout callout-success" id="alert-secondary2"> <strong>Info!</strong> Fill in the name to upload file. </div>
                                                        <div id="alert-danger3" class="alert alert-danger" hidden>
                                                            Please fill out all the fields and reupload the file
                                                        </div>
                                                        <div id="alert-danger4" class="alert alert-danger" hidden>
                                                            Invalid csv file. Please reupload the file
                                                        </div>

                                                        <div class="row" hidden id="burl2" style="width: 40%;">
                                                            <div class="col-sm-4">
                                                                <input type="file" id="select2" class="btn btn-block" value="Select File" onchange="onFile2(event)">
                                                            </div>
                                                            <div class="col-sm-4">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="wordoption" id="baw2" value="AW"> <p> AW URL </p>
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="wordoption" id="bkw2" value="KW"> <p> KW URL </p>
                                                                </label>
                                                                <div class="form-group">
                                                                    <label for="adname"><h4>  URL :</h4></label>
                                                                    <input type="text" class="form-control" id="badname2" onclick='show(2)' autocomplete=off style="width: 50%;">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <br>

                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-9">
                                                        <div class="form-group" id="file-container2" hidden>
                                                            <label for="output"><h4>Click on the button below to download the file:</h4></label>
                                                            <br/>
                                                            <a id="out2"><button type="button" name="output"class="btn btn-primary"> Download File </button></a>
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                            <!-- /.tab-pane -->
                                        </div>
                                        <!-- /.tab-content -->
                                    </div>
                                    <!-- nav-tabs-custom -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
        </div>
        <!-- /.modal-dialog -->
    {{--</div>--}}
    </div>
    </div>


    <script>

        var uRL = "{{$uRL}}";

    </script>


    <script src="/js/tags.js"></script>

@endsection