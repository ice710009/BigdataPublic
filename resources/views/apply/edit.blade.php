@extends('layouts.white')
@section('content')
<div class="container">
{!! Form::model($form, ['method'=>'PATCH', 'files'=>true, 'url' => 'apply/' . $form->id]) !!}
@include ('apply._form', ['submitButtonText' => '�x�s'])
{!! Form::close() !!}
</div>
@endsection