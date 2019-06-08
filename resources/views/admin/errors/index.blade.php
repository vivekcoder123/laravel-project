@extends('layouts.app')

@section('content')

<div class="container" id="operationsContainer">
    <div class="row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="m-4">
                {!!$pieE->html() !!}
                <div id="errorTableDiv">
                <table class="table table-bordered table-striped" id="errorTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Type</th>
                            <th>Details</th>
                            <th>Description</th>
                            <th>Server Id</th>
                            <th>User</th>
                            <th>Created</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($allErrors as $error)
                        <tr>
                            <td>{{$error->id}}</td>
                            <td style="white-space:nowrap;">{{$error->type}}</td>
                            <td>{{$error->details}}</td>
                            <td>{{$error->description}}</td>
                            <td>{{$error->server_id}}</td>
                            <td>{{$error->user->name}}</td>
                            <td>{{$error->created_at->diffForHumans()}}</td>
                            <td>{{$error->updated_at->diffForHumans()}}</td>
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

{!! $pieE->script() !!}

@endsection

@section('extra_js')

<script type="text/javascript">
    $(document).ready(function(){

    $(".highcharts-color-0").click(function(){

        $.ajax({
        url: '{{url("/admin/operations/errors/fd")}}'
    })
    .done(function(res) {
        $('#errorTableDiv').html(res);
    })
    .fail(function(err) {
        console.log(err);
    })

    });

    $(".highcharts-color-1").click(function(){

        $.ajax({
        url: '{{url("/admin/operations/errors/se")}}'
    })
    .done(function(res) {
        $('#errorTableDiv').html(res);
    })
    .fail(function(err) {
        console.log(err);
    })

    });

    $(".highcharts-color-2").click(function(){

        $.ajax({
        url: '{{url("/admin/operations/errors/sna")}}'
    })
    .done(function(res) {
        $('#errorTableDiv').html(res);
    })
    .fail(function(err) {
        console.log(err);
    })

    });

});
    
jQuery(function ($) {

    $('#errorTable').DataTable();
});
</script>

@endsection