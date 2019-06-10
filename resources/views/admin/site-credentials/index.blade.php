@extends('layouts.app')

@section('content')

  @if (Session::has('created_credential'))
     <p class="text-success alert alert-success">{{session('created_credential')}}</p>
  @endif

  @if (Session::has('updated_credential'))
     <p class="text-success alert alert-success">{{session('updated_credential')}}</p>
  @endif

<div>
<h1 class="mb-2 text-center">All Sites Credentials</h1>
</div>

<table class="table table-striped table-bordered">

<thead>
  <th style="white-space:nowrap;">Created By</th>
  <th>Type (Site)</th>
  <th>Site Url</th>
  <th>Site Port</th>
  <th>Login Username</th>
  <th>Remarks</th>
  <th>Created</th>
  <th>Updated</th>
</thead>

<tbody>
    @foreach ($siteCredentials as $credential)
      <tr>
        <td>{{$credential->user->name}}</td>
        <td>{{$credential->type}}</td>
        <td>{{$credential->site_url}}</td>
        <td>{{$credential->site_port}}</td>
        <td>{{$credential->login}}</td>
        <td>{{$credential->remarks}}</td>
        <td>{{$credential->created_at->diffForHumans()}}</td>
        <td>{{$credential->updated_at->diffForHumans()}}</td>
        @if((Auth::user()->id==$credential->user->id) || (Auth::user()->role=="site-admin") || (Auth::user()->role=="org-admin" && $credential->user->role=="user"))
        <td><a href="{{route('admin.site-credentials.edit',$credential->id)}}" class="btn btn-primary">Edit</a></td>
        @endif
      </tr>
    @endforeach
</tbody>

</table>

@endsection