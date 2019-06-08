@extends('layouts.app')

@section('content')

<div class="container" id="operationsContainer">
    <div class="row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="m-4">
                {!!$pie->html() !!}
                <div id="operationTableDiv">
                <table class="table table-bordered table-striped" id="operationTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Type</th>
                            <th>Server Id</th>
                            <th>User</th>
                            <th>Created</th>
                            <th>Updated</th>
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
                            <td>{{$operation->updated_at->diffForHumans()}}</td>
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

<script type="text/javascript">
    $(document).ready(function(){

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

    $('#errorTable').DataTable();
});
</script>

@endsection