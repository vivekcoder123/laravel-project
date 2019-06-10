@extends('layouts.app')

@section('content')


  @if (Session::has('created_license'))
     <p class="text-success alert alert-success">{{session('created_license')}}</p>
  @endif


<div>
<h1 class="mb-2 text-center">All Licenses</h1>
</div>

<table class="table table-striped table-bordered">

<thead>
  <th>License Id</th>
  <th>Start Date</th>
  <th>End Date</th>
  <th># Of Licenses</th>
  <th>Software Name</th>
  <th>Type Of License</th>
</thead>

<tbody>
    @foreach ($licenses as $license)
      <tr>
        <td>{{$license->license_id}}</td>
        <td>{{$license->start_date}}</td>
        <td>{{$license->end_date}}</td>
        <td>{{$license->number_of_licenses}}</td>
        <td>{{ucwords($license->software_name)}}</td>
        <td>{{ucwords($license->type_of_license)}}</td>
      </tr>
    @endforeach
</tbody>

</table>

@endsection