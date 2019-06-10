@extends('layouts.app')

@section('content')

<div class="container" id="operationsContainer">
    <div class="row">
        <div class="col-8">
            <div class="panel panel-default">
                <div class="panel-body">
                {!!$pie->html() !!}
                </div>
            </div>
        </div>
        <div class="col-4">
            <div id="chartContainer" style="height: 250px; width: 320px;"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h4 class="alert alert-info my-4 text-center">List Format Of All Operations</h4>
            <div id="operationTableDiv">
                <div id="operationTableDiv">
                <table class="table table-bordered table-striped" id="operationTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Type</th>
                            <th>Server Id</th>
                            <th>User</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($allOperations as $operation)
                        <tr>
                            <td>{{$operation->id}}</td>
                            <td style="white-space:nowrap;">{{$operation->type}}</td>
                            <td>{{$operation->server_id}}</td>
                            <td>{{$operation->user->name}}</td>
                            <td>{{$operation->created_at->diffForHumans()}}</td>
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
{!! Charts::scripts() !!}

{!! $pie->script() !!}

@endsection

@section('extra_js')
<script>
window.onload = function() {
var failed={{$failed}};
var system_error={{$system_error}};
var space_not_available={{$space_not_available}};
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    title: {
        text: "Errors Division"
    },
    data: [{
        type: "pie",
        startAngle: 240,
        yValueFormatString: "##0.00\"%\"",
        indexLabel: "{label} {y}",
        dataPoints: [
            {y: failed, label: "Failed"},
            {y: system_error, label: "System Error"},
            {y: space_not_available, label: "Space Not Available"}
        ]
    }]
});
chart.render();

}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

    $(".canvasjs-chart-credit").hide();

    $(".highcharts-color-0").click(function(){

        $.ajax({
        url: '{{url("/admin/operations/run")}}'
    })
    .done(function(res) {
        $('#operationTableDiv').html(res);
    })
    .fail(function(err) {
        console.log(err);
    })

    });

    $(".highcharts-color-1").click(function(){

     window.location.href = "{{URL::to('/admin/operations/errors')}}"

    });

    $(".highcharts-color-2").click(function(){

        $.ajax({
        url: '{{url("/admin/operations/dnrun")}}'
    })
    .done(function(res) {
        $('#operationTableDiv').html(res);
    })
    .fail(function(err) {
        console.log(err);
    })

    });

    })
    
jQuery(function ($) {

    $('#operationTable').DataTable();
    $('#errorTable').DataTable();
});
</script>

@endsection