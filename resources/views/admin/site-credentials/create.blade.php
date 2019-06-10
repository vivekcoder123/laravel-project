@extends('layouts.app')

@section('content')

<h1 class="text-center mb-2">Create Site Credentials</h1>

@include('includes/form_error')

{!!Form::open(['method'=>'post','action'=>'AdminSiteCredentialsController@store'])!!}

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
{!!Form::label('password','Password:')!!}
{!!Form::password('password',['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::label('remarks','Remarks:')!!}
{!!Form::text('remarks',null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::submit('Create Credentials',['class'=>'btn btn-primary form-control'])!!}
</div>

{!!Form::close()!!}

@endsection