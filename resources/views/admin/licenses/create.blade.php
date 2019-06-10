@extends('layouts.app')

@section('content')

<h1 class="text-center mb-2">Save License</h1>

@include('includes/form_error')

{!!Form::open(['method'=>'post','action'=>'AdminLicensesController@store'])!!}

<div class="form-group">
  {!!Form::label('license_id','License Id:')!!}
  {!!Form::text('license_id',null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::label('start_date','Start Date:')!!}
{!!Form::date('start_date',null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::label('end_date','End Date:')!!}
{!!Form::date('end_date',null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::label('number_of_licenses','# Of Licenses:')!!}
{!!Form::text('number_of_licenses',null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::label('software_name','Software Name:')!!}
{!!Form::text('software_name',null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::label('type_of_license','Type Of License:')!!}
{!!Form::select('type_of_license',['server'=>'Server','agent'=>'Agent'],null,['class'=>'form-control'])!!}
</div>

<div class="form-group">
{!!Form::submit('Save',['class'=>'btn btn-primary form-control'])!!}
</div>

{!!Form::close()!!}

@endsection