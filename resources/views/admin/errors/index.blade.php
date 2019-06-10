@extends('layouts.app')

@section('content')

<div class="container" id="operationsContainer">
    <div class="row">
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="m-4">
                <div class="filterationButtons mb-4 text-center">
                    <a class="btn btn-primary" href="{{route('admin.errors')}}">All Errors</a>
                    @foreach($errorsCategory as $category)
                        <button class="btn btn-primary filterButton" data-value="{{$category->name}}">{{$category->name}}</button>
                    @endforeach
                </div>
                <div id="mainLoading" style="display:none;text-align:center;">
                    <img src="{{ asset('images/loader.gif') }}" alt="Loading....">
                </div>
                <div id="mainTable">
                <div id="errorTableDiv">
                <h4 class="text-center alert alert-info">All Errors</h4>
                <table class="table table-bordered table-striped" id="errorTable">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Server</th>
                            <th>Description</th>
                            <th>User</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($errors as $error)
                        <tr>
                            <td>{{$error->type}}</td>
                            <td>{{$error->name}}</td>
                            <td>{{$error->server}}</td>
                            <td>{{$error->description}}</td>
                            <td>{{$error->user->name}}</td>
                            <td>{{$error->created_at->diffForHumans()}}</td>
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

@endsection

@section('extra_js')
<script type="text/javascript">    
jQuery(function ($) {
    $('#errorTable').DataTable();
    $(".filterButton").on('click',function(){
        var type=$(this).data("value");
        $.ajax({
            url: '{{url("/admin/errors")}}/'+type,
            beforeSend:function(){
                $("#mainTable").hide();
                $("#mainLoading").show();
            }
        })
        .done(function(res) {
            $("#mainTable").show();
            $("#mainLoading").hide();
            $("#errorTableDiv").html(res);
            $('#errorTable').DataTable();
        })
        .fail(function(err) {
            console.log(err);
        });
        
    });
});
</script>

@endsection