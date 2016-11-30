@extends('layouts.apply')
@section('content')
<div class="container">
{!! Form::model($apply, ['method'=>'PATCH', 'files'=>true, 'url' => 'apply/' . $apply->id]) !!}
@include ('apply._form', ['submitButtonText' => '儲存'])
{!! Form::close() !!}
</div>
@endsection