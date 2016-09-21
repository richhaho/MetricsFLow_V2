@extends('template.template')

@section('content-header')

<link rel="stylesheet" href="\plugins\datatables\dataTables.bootstrap.css">
<style>
.canvasjs-chart-credit{
    display:none !important;
}
.btn-real{
    background-color:#058dc7 !important;
    border:none;
}
svg {
    width: 100%;
    height: 100%;
    position: center;
    }

    .line:hover{
      fill: none;
      stroke-width: 5;
    }
    
    .axis--x path {
      fill: none;
     display: yellow;
    } 

</style>
@endsection

@section('content')


    <section id="ChannelOverview">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <select class="form-control btn-success btn btn-real change_option" style="width: 200px;" onchange="change_option();">
                            <option value="language" {{($page=='language') ? 'selected':''}}>Language</option>
                            <option value="browser" {{($page=='browser') ? 'selected':''}}>Browser</option>
                            <option value="os" {{($page=='os') ? 'selected':''}}>Operating System</option>
                            <option value="country" {{($page=='country') ? 'selected':''}}>Country</option>
                            <option value="channel" {{($page=='channel') ? 'selected':''}}>Channel</option>
                        </select>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" >
                        <h4 class="bold pull-right"><a href="/Audience"><= Back</a></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xs-12">
                <div class="alert-modal">
                    <div class="modal">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                 
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" >
                                                <ul class="nav nav-tabs pull-right">
                                                    <li class="btn btn-success btn_day btn_period btn-real" onclick="select_period('day');">Day</li>
                                                    <li class="active btn btn-success btn_month btn_period btn-real" onclick="select_period('month');">Month</li>
                                                    <li class="btn btn-success btn_year btn_period btn-real" onclick="select_period('year');">Year</li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-md-11 chartContainer" style="height: 300px;">
                                                <svg width="100%" height="100%"></svg>
                                           </div>
                                           <div class="col-md-1 labels" style="height: 300px;">
                                                <div class="show_label">
                                                    <i class="fa fa-square" style="color:rgb(31, 119, 180)">&nbsp;&nbsp;</i><span>all</span>
                                                </div>
                                                @foreach ($items as $item)
                                                <div class="show_label" style="display:none">
                                                    <i class="fa fa-square">&nbsp;&nbsp;</i><span>{{$item->label}}</span>
                                                </div>
                                                @endforeach
                                           </div>
                                        </div>
                                        <div class="row" style="padding: 10px 0px 40px 0px">
                                            <div class="box-body table_group">
                                                <table id="detail_table" class="table table-hover">
                                                <thead >
                                                <tr>
                                                    <th width="40%">{{$pageLabel[$page]}}</th>
                                                    <th width="20%">Users</th>
                                                    <th width="30%">%Users</th>
                                                    <th width="10%">Compare</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>All</td>
                                                        <td>{{$sum}}</td>
                                                        <td><a class="btn btn-success" style="pointer-events: none;height:30px;width:200px !important;padding:0px !important;border-color:#1d9f58 !important;"></a>100</td>
                                                        <td><input name="show_graph" type="checkbox" class="show_graph show_graph_all" value="all" checked disabled onclick="show_chart(this);"></td>
                                                    </tr>
                                                <?php $i=-1;?>
                                                    @foreach ($items as $item)
                                                    <tr><?php $i++;?>
                                                        <td>{{$item->label}}</td>
                                                        <td>{{$item->users}}</td>
                                                        <td><a class="btn btn-success" style="pointer-events: none;height:30px;width:{{round($item->users/$sum*200)}}px !important;padding:0px !important;border-color:#1d9f58 !important;"></a>{{round($item->users/$sum*10000)/100}}</td>
                                                        <td><input name="show_graph" type="checkbox" class="show_graph" value="{{$item->label}}" disabled onclick="show_chart(this);"></td>

                                                    </tr>
                                                    @endforeach
                                                    
                                                </tbody>

                                                </table>
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
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/plugins/jQuery/jquery.canvasjs.min.js"></script>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script>

$(function () {
    $('#detail_table').DataTable({"order": [1, 'desc']});
});

var margin = {top: 30, right: 60, bottom: 50, left: 60};
var width = 1400 - margin.left - margin.right;
var height = 300 - margin.top - margin.bottom;
var parseTime = d3.timeParse("%b-%y");
var color = d3.scaleOrdinal(d3.schemeCategory10);

var g = d3.select("svg")
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

var xRange = d3.scaleTime()
        .rangeRound([0, width]);

var yRange = d3.scaleLinear()
    .range([height, 0]);

var line = d3.line()
    .x(function(d) { return xRange(d.Date);  })
    .y(function(d) { return yRange(d.market_share);  })
    .curve(d3.curveMonotoneX);


function select_period(period){
    $('.show_graph').each(function(index){
            $(this).attr('disabled',true);
    });
    $('.show_graph').prop("checked",false);
    $('.show_graph_all').prop("checked",true);
    $('.btn_period').removeClass('active');
    $('.btn_'+period).addClass('active');
    $('.labels').empty();
    var show_label='<div class="show_label"><i class="fa fa-square" style="color:rgb(31, 119, 180)">&nbsp;&nbsp;</i><span>all</span></div>';
    $('.labels').append(show_label);

    $("svg").empty();
    //alert($('ul .active').text());
    $.get("{{URL::to('/Audience/graphData')}}",{"client_id":"{{$client_id}}","page":$('.change_option').val(),"period":period}).done(function(e)  {
        var x_format="%Y-%m";
        if (period=='year') x_format='%Y';
        if (period=='day')  x_format='%Y-%m-%d';
        var color = d3.scaleOrdinal(d3.schemeCategory10);
        var parseTime = d3.timeParse(x_format);
        var data=e.values;
        for (i=0;i<data.length;i++){
            data[i].Date=parseTime(data[i].Date);
        }
        data.columns=e.columns;


        var browsers = data.columns.slice(1).map(function(id) {
            return {
            id: id,
            values: data.map(function(d) {
            return {Date: d.Date, market_share: d[id]};
            })
            };     
        });
       

        var g = d3.select("svg")
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

        var xRange = d3.scaleTime()
                .rangeRound([0, width]);

        var yRange = d3.scaleLinear()
            .range([height, 0]);

        var line = d3.line()
            .x(function(d) { return xRange(d.Date);  })
            .y(function(d) { return yRange(d.market_share);  })
            .curve(d3.curveMonotoneX);
        xRange.domain(d3.extent(data, function(d) {return d.Date; }));
        
        yRange.domain([
            d3.min(browsers, function(c) { return d3.min(c.values, function(d) { return d.market_share; }); }),
            d3.max(browsers, function(c) { return d3.max(c.values, function(d) { return d.market_share; }); })
        ]);

        color.domain(browsers.map(function(c) { return c.id; }));

        g.append("g")
            .attr("class", "axis")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(xRange).tickFormat(d3.timeFormat(x_format)))
            .style("text-anchor", "middle")
            .attr("dx", "-.1em");

        g.append("g")
            .attr("class", "axis")
            .call(d3.axisLeft(yRange))
            .append("text")
            .attr("x",2)
            .attr("y", 6)
            .attr("dy", "0.71em")
            .attr("fill", "#000")
            .attr("text-anchor", "start")
            .text("");

        var browser = g.selectAll(".browsers")
            .data(browsers)
            .enter()
            .append("g")
            .attr("class", "browser");

        browser.append("path")
            .style("fill", "none")
            .attr("class", "line")
            .attr("d", function(d) { return line(d.values); })
            .style("stroke", function(d) { return color(d.id); });
            
        browser.append("text")
            .datum(function(d) { return {id: d.id, value: d.values[0]}; })
            .attr("transform", function(d) { return "translate(" + xRange(d.value.Date) + "," + yRange(d.value.market_share) + ")"; })
            .attr("x", 3)
            .attr("dy", "0.35em")
            .style("font", "1px sans-serif")
            .text(function(d) { return d.id; });

        $('.browser').css('display','none');
        $('.browser').each(function(index){
            if($(this).find('text').text()=='all'){
                $(this).css('display','block');
            }
        }); 
        $('.show_graph').each(function(index){
            $(this).removeAttr('disabled');
        });
        
    });

}
function change_option(){
    var options = [];
    options['language']='Language';
    options['browser']='Browser';
    options['os']='Operating System';
    options['country']='Country';
    options['channel']='Channel';

    var title=options[$('.change_option').val()];
    $('.title').text(title);
    $('.table_group').empty();

    $('.labels').empty();
    
    $.get("{{URL::to('/Audience/pagesDetail')}}",{"client_id":"{{$client_id}}","page":$('.change_option').val()}).done(function(data)  {
        var show_label='<div class="show_label"><i class="fa fa-square" style="color:rgb(31, 119, 180)">&nbsp;&nbsp;</i><span>all</span></div>';
                
        var items=data.items;
        var brow='<table id="detail_table" class="table table-hover">'+
            '<thead >'+
            '<tr>'+
                '<th width="40%">'+title+'</th>'+
                '<th width="20%">Users</th>'+
                '<th width="30%">%Users</th>'+
                '<th width="10%">Compare</th>'+
            '</tr>'+
            '</thead>'+
            '<tbody>'+
            '<tr>'+
                '<td>All</td>'+
                '<td>'+data.sum+'</td>'+
                '<td><a class="btn btn-success" style="pointer-events: none;height:30px;width:200px !important;padding:0px !important;border-color:#1d9f58 !important;"></a>100</td>'+
                '<td><input name="show_graph" type="checkbox" class="show_graph show_graph_all" value="all" checked disabled onclick="show_chart(this);"></td>'+
            '</tr>';
        for (i=0;i<items.length;i++){
            brow+='<tr>'+
            '<td>'+items[i].label+'</td>'+
            '<td>'+items[i].users+'</td>'+
            '<td><a class="btn btn-success" style="pointer-events: none;height:30px;width:'+Math.round(items[i].users/data.sum*200)+'px !important;padding:0px !important;border-color:#1d9f58 !important;"></a>'+ Math.round(items[i].users/data.sum*10000)/100+
            '%</td><td><input name="show_graph" type="checkbox" class="show_graph" disabled value="'+items[i].label+'" onclick="show_chart(this);"></td></tr>';
            show_label+='<div class="show_label" style="display:none"><i class="fa fa-square">&nbsp;&nbsp;</i><span>'+items[i].label+'</span></div>';
        }
        brow+='</tbody></table>';
        $('.labels').append(show_label);
        $('.table_group').append(brow);
        $('#detail_table').DataTable({"order": [1, 'desc']});
    });
    var period='month';$("svg").empty();
    var pr=$('ul .active').text();
    if (pr=="Year") period='year';
    if (pr=="Day") period='day';
 
    $.get("{{URL::to('/Audience/graphData')}}",{"client_id":"{{$client_id}}","page":$('.change_option').val(),"period":period}).done(function(e)  {
        var x_format="%Y-%m";
        if (period=='year') x_format='%Y';
        if (period=='day')  x_format='%Y-%m-%d';

        var parseTime = d3.timeParse(x_format);
        var data=e.values;
        for (i=0;i<data.length;i++){
            data[i].Date=parseTime(data[i].Date);
        }
        data.columns=e.columns;

        var g = d3.select("svg")
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

        var xRange = d3.scaleTime()
                .rangeRound([0, width]);

        var yRange = d3.scaleLinear()
            .range([height, 0]);

        var line = d3.line()
            .x(function(d) { return xRange(d.Date);  })
            .y(function(d) { return yRange(d.market_share);  })
            .curve(d3.curveMonotoneX);
        var browsers = data.columns.slice(1).map(function(id) {
            return {
            id: id,
            values: data.map(function(d) {
            return {Date: d.Date, market_share: d[id]};
            })
            };     
        });

        xRange.domain(d3.extent(data, function(d) { return d.Date; }));

        yRange.domain([
            d3.min(browsers, function(c) { return d3.min(c.values, function(d) { return d.market_share; }); }),
            d3.max(browsers, function(c) { return d3.max(c.values, function(d) { return d.market_share; }); })
        ]);

        color.domain(browsers.map(function(c) { return c.id; }));

        g.append("g")
            .attr("class", "axis")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(xRange).tickFormat(d3.timeFormat(x_format)))
            .style("text-anchor", "middle")
            .attr("dx", "-.1em");

        g.append("g")
            .attr("class", "axis")
            .call(d3.axisLeft(yRange))
            .append("text")
            .attr("x",2)
            .attr("y", 6)
            .attr("dy", "0.71em")
            .attr("fill", "#000")
            .attr("text-anchor", "start")
            .text("");

        var browser = g.selectAll(".browsers")
            .data(browsers)
            .enter()
            .append("g")
            .attr("class", "browser");

        browser.append("path")
            .style("fill", "none")
            .attr("class", "line")
            .attr("d", function(d) { return line(d.values); })
            .style("stroke", function(d) { return color(d.id); });
            
        browser.append("text")
            .datum(function(d) { return {id: d.id, value: d.values[0]}; })
            .attr("transform", function(d) { return "translate(" + xRange(d.value.Date) + "," + yRange(d.value.market_share) + ")"; })
            .attr("x", 3)
            .attr("dy", "0.35em")
            .style("font", "1px sans-serif")
            .text(function(d) { return d.id; });
        
        $('.browser').css('display','none');
        $('.browser').each(function(index){
            if($(this).find('text').text()=='all'){
                $(this).css('display','block');
            }
        }); 
        $('.show_graph').each(function(index){
            $(this).removeAttr('disabled');
        });
        
    });
}


$(window).load(function(){
    $.get("{{URL::to('/Audience/graphData')}}",{"client_id":"{{$client_id}}","page":$('.change_option').val(),"period":"month"}).done(function(e)  {
        var parseTime = d3.timeParse("%Y-%m");
        var data=e.values;
        for (i=0;i<data.length;i++){
            data[i].Date=parseTime(data[i].Date);
        }
        data.columns=e.columns;


        var browsers = data.columns.slice(1).map(function(id) {
            return {
            id: id,
            values: data.map(function(d) {
            return {Date: d.Date, market_share: d[id]};
            })
            };     
        });

        xRange.domain(d3.extent(data, function(d) { return d.Date; }));

        yRange.domain([
            d3.min(browsers, function(c) { return d3.min(c.values, function(d) { return d.market_share; }); }),
            d3.max(browsers, function(c) { return d3.max(c.values, function(d) { return d.market_share; }); })
        ]);

        color.domain(browsers.map(function(c) { return c.id; }));

        g.append("g")
            .attr("class", "axis")
            .attr("transform", "translate(0," + height + ")")
            .call(d3.axisBottom(xRange).tickFormat(d3.timeFormat('%Y-%m')))
            .style("text-anchor", "middle")
            .attr("dx", "-.1em");

        g.append("g")
            .attr("class", "axis")
            .call(d3.axisLeft(yRange))
            .append("text")
            .attr("x",2)
            .attr("y", 6)
            .attr("dy", "0.71em")
            .attr("fill", "#000")
            .attr("text-anchor", "start")
            .text("");

        var browser = g.selectAll(".browsers")
            .data(browsers)
            .enter()
            .append("g")
            .attr("class", "browser");

        browser.append("path")
            .style("fill", "none")
            .attr("class", "line")
            .attr("d", function(d) { return line(d.values); })
            .style("stroke", function(d) { return color(d.id); });
            
        browser.append("text")
            .datum(function(d) { return {id: d.id, value: d.values[0]}; })
            .attr("transform", function(d) { return "translate(" + xRange(d.value.Date) + "," + yRange(d.value.market_share) + ")"; })
            .attr("x", 3)
            .attr("dy", "0.35em")
            .style("font", "1px sans-serif")
            .text(function(d) { return d.id; });
        
        $('.browser').css('display','none');
        $('.browser').each(function(index){
            if($(this).find('text').text()=='all'){
                $(this).css('display','block');
            }
        }); 
        $('.show_graph').each(function(index){
            $(this).removeAttr('disabled');
        });
	});

});
        
function show_chart(e){
    if($(e).is(":checked")){
        var color="";
        $('.browser').each(function(index){
            if($(this).find('text').text()==$(e).val()){
                $(this).css('display','block');color=$(this).find('path').css('stroke');
            }
        });
        $('.show_label').each(function(index){
            if($(this).find('span').text()==$(e).val()){
                $(this).css('display','block');
                $(this).find('i').css('color',color);
            }
        });
        
    }else{
        $('.browser').each(function(index){
            if($(this).find('text').text()==$(e).val()){
                $(this).css('display','none');
            }
        });
        $('.show_label').each(function(index){
            if($(this).find('span').text()==$(e).val()){
                $(this).css('display','none');
            }
        });
    }
} 


</script>

@endsection
