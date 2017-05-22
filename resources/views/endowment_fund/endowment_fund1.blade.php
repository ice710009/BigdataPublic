@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title"><h2>財務規劃報告書</h2></div>
				</div>
				<div class="panel-body">
  					<h4><a href="{{ url('/endowment_fund/106report.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>106年財務規劃報告書</a></h4>
				</div>
  				<div class="panel-body">
  					<h4><a href="{{ url('/endowment_fund/105report.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>105年財務規劃報告書</a></h4>
				</div>
  			</div>
  			</div>
  	</div>
@endsection