@extends('layouts.app')

@section('content')

<h1 class="text-center mb-2">Update Site Credentials</h1>

@include('includes/form_error')

{!!Form::model($credential,['method'=>'PATCH','action'=>['AdminSiteCredentialsController@update',$credential->id]])!!}

<div class="form-group">
  {!!Form::label('type','Type (Site):')!!}
  {!!Form::text('type',null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::label('site_url','Site Url:')!!}
{!!Form::text('site_url',null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::label('site_port','Site Port:')!!}
{!!Form::text('site_port',null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::label('login','Login Username:')!!}
{!!Form::text('login',null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::label('remarks','Remarks:')!!}
{!!Form::text('remarks',null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::submit('Update Credentials',['class'=>'btn btn-primary form-control'])!!}
</div>

{!!Form::close()!!}

@endsection