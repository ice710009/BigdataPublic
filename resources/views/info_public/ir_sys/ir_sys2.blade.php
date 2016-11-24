@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title"><h2>組織架構</h2></div>
				</div>
  				<div class="panel-body">
  					<h4><a href="{{ url('/info_public/ir_sys/1-2-1.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>1. 學校組織架構圖</a></h4>
					<h4><a href="{{ url('/info_public/ir_sys/1-2-2.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>2. 本校組織系統表</a></h4>
					<br>
					<font face="DFKai-sb" color="#2B2B2B" size="5"><b>學校組織架構圖</b></font><br>
					<img src="/img/info_public/ir_sys/1-2-1_1.png" alt="學校組織架構圖" width="60%"></img><br>
				</div>
  			</div>
  			</div>
  	</div>
@endsection