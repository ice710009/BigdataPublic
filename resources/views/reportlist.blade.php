@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title">交大歷年統計年報</div>
				</div>
  				<div class="content-box-large box-with-header">
  					<h4><a href="{{ url('/reports/104/index') }}"><i class="glyphicon glyphicon-chevron-right"></i> 2015年</a></h4>
					<h4><a href="{{ url('/reports/105/index') }}"><i class="glyphicon glyphicon-chevron-right"></i> 2016年</a></h4>
				</div>
  			</div>
  			</div>
  	</div>
@endsection