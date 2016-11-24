@extends('layouts.white')
@section('content')
       <div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title">我的檔案</div>
				</div>
  				<div class="content-box-large box-with-header">
  					@foreach($apply as $value)
					<a href="{{url('apply/' .$value->id)}}"><li>{{ $value->updated_at }}</li></a>
					@endforeach
  				</div>
  			</div>
  			</div>
  	</div>
@endsection