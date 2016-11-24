@extends('layouts.white')
@section('content')
<div class="container">
{!! Form::open(['url' => 'apply', 'files'=>true]) !!}
@include ('apply._form', ['submitButtonText' => 'Àx¦s'])
{!! Form::close() !!}
</div>
@endsection