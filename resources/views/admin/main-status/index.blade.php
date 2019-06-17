@extends('layouts.app')

@section('content')

<div class="container" id="operationsContainer">
    <div class="row">
        <div class="col-6">
            <div class="panel panel-default">
                <div class="panel-body">
                {!!$pie->html() !!}
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="panel panel-default">
                <div class="panel-body">
                {!!$pieU->html() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="mainLoader" style="display:none;text-align:center;">
        <img src="{{ asset('images/loader.gif') }}" alt="">
    </div> 
    <div class="row" id="operationTableRow">   
        <div id="operationTableDiv">
        <h4 class="alert alert-info text-center my-4">All Operations</h4>
        <table class="table table-bordered table-striped" id="operationTable">
            <thead>
                <tr>
                <th>Server</th>
                <th>Service Type Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Size</th>
                <th>Status</th>
                <th>Duration</th>
                <th>Last Success On</th>
                <th>Policy</th>
                </tr>
            </thead>
            <tbody>
                @if($operations)
                @foreach($operations as $operation)
                <tr>
                    <td>{{$operation->server}}</td>
                    <td>{{$operation->service_type_name}}</td>
                    <td>{{$operation->start_time}}</td>
                    <td>{{$operation->end_time}}</td>
                    <td>{{$operation->size}}</td>
                    <td class="text-capitalize">{{$operation->status}}</td>
                    <td>{{$operation->duration}}</td>
                    <td>{{$operation->last_success_on}}</td>
                    <td>{{$operation->policy}}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}

{!! $pie->script() !!}
{!! $pieU->script() !!}

@endsection

@section('extra_js')

<script>
jQuery(function ($) {
    $('#operationTable').DataTable();
    $(".highcharts-color-0").click(function(){
        if($(this).attr("fill")=="green"){
            
        
        $.ajax({
        url: '{{url("/admin/main-status/successful")}}',
        beforeSend:function(){
            $("#operationTableRow").hide();
            $("#mainLoader").show();
        }
    })
    .done(function(res) {
        $("#mainLoader").hide();
        $("#operationTableRow").show();
        $('#operationTableDiv').html(res);
        $('#operationTable').DataTable();
    })
    .fail(function(err) {
        console.log(err);
    })
    }
    });

    $(".highcharts-color-1").click(function(){
        if($(this).attr("fill")=="red"){
        $.ajax({
        url: '{{url("/admin/main-status/failed")}}',
        beforeSend:function(){
            $("#operationTableRow").hide();
            $("#mainLoader").show();
        }
    })
    .done(function(res) {
        $("#mainLoader").hide();
        $("#operationTableRow").show();
        $('#operationTableDiv').html(res);
        $('#operationTable').DataTable();
    })
    .fail(function(err) {
        console.log(err);
    })
    }
    });


    $(".highcharts-color-2").click(function(){

        $.ajax({
        url: '{{url("/admin/main-status/errors")}}',
        beforeSend:function(){
            $("#operationTableRow").hide();
            $("#mainLoader").show();
        }
    })
    .done(function(res) {
        $("#mainLoader").hide();
        $("#operationTableRow").show();
        $('#operationTableDiv').html(res);
        $('#operationTable').DataTable();
    })
    .fail(function(err) {
        console.log(err);
    })

    });

    $(".highcharts-color-3").click(function(){

        $.ajax({
        url: '{{url("/admin/main-status/missed")}}',
        beforeSend:function(){
            $("#operationTableRow").hide();
            $("#mainLoader").show();
        }
    })
    .done(function(res) {
        $("#mainLoader").hide();
        $("#operationTableRow").show();
        $('#operationTableDiv').html(res);
        $('#operationTable').DataTable();
    })
    .fail(function(err) {
        console.log(err);
    })

    });

});
</script>

@endsection