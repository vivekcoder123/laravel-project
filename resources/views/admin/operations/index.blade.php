@extends('layouts.app')

@section('content')

<div class="container" id="operationsContainer">
    <div class="row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="m-4">
                {!!$pie->html() !!}
                <h4 class="my-4 text-center alert alert-info" style="cursor:pointer;" 
                    id="operationClick">List Format Of The Above Operations 
                    <span class="dropdown-toggle float-right"></span>
                </h4>
                <div id="operationTableDiv" style="display:none;">
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
                <hr>
                <div class="m-4">
                {!!$pieE->html() !!}
                <h4 class="my-4 text-center alert alert-info" style="cursor:pointer;" 
                    id="errorClick">List Format Of The Above Errors 
                    <span class="dropdown-toggle float-right"></span>
                </h4>
                <div id="errorTableDiv" style="display:none;">
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

{!! $pie->script() !!}
{!! $pieE->script() !!}

@endsection

@section('extra_js')

<script type="text/javascript">
    $(document).ready(function(){

    $('input[type=search]').trigger('change');

    $("#operationClick").click(function(){
        $("#operationTableDiv").toggle();
    });

    $("#errorClick").click(function(){
        $("#errorTableDiv").toggle();
    });

    $(".highcharts-color-0").click(function(){
        $('input[type=search]').val("Run Successfully").focus();
    });
    $('input[type=search]').trigger('change');

    })
    
jQuery(function ($) {

    $('#errorTable').DataTable();
    $('#operationTable').DataTable();
});
</script>

@endsection