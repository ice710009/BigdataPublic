@extends('layouts.white')
@section('content')
<div class="container">
{!! Form::open(['url' => 'apply', 'files'=>true]) !!}
@include ('apply._form', ['submitButtonText' => '�x�s'])
{!! Form::close() !!}
</div>
@endsection