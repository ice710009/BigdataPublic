@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title"><h2>績效報告書</h2></div>
				</div>
				<div class="panel-body">
  					<h4><a href="{{ url('/endowment_fund/105fundreport.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>105年度校務基金績效報告書</a></h4>
					<h4><a href="{{ url('/endowment_fund/106fundreport.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>106年度校務基金績效報告書</a></h4>
				</div>
  			</div>
  			</div>
  	</div>
@endsection