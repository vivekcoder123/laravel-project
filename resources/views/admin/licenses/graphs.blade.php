@extends('layouts.app')

@section('content')

{!! $line1->html() !!}

{!! $line2->html() !!}

@endsection

@section('extra_js')

{!! Charts::scripts() !!}

{!! $line1->script() !!}

{!! $line2->script() !!}

@endsection