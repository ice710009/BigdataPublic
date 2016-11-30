@extends('layouts.apply')
@section('content')
<div class="container">
{!! Form::open(['url' => 'apply', 'files'=>true]) !!}
@include ('apply._form', ['submitButtonText' => '儲存'])
{!! Form::close() !!}
</div>
@endsection