@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title"><h2> 學校採購及處分重大資產情形</h2></div>
				</div>
  				<div class="panel-body">
  					<h4><a href="{{ url('/info_public/oth_info/4-3-1.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>1. 辦理100萬元以上採購案件一覽表</a></h4>
					<img src="/img/info_public/oth_info/4-3-1.png" width="100%" alt="辦理100萬元以上採購案件一覽表"></img><br>
				</div>
				<div class="panel-body">
  					<h4><a href="{{ url('/info_public/oth_info/4-3-2.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>2. 處分土地及重大資產案件一覽表</a></h4>
					<img src="/img/info_public/oth_info/4-3-2.png" alt="處分土地及重大資產案件一覽表" width="60%"></img><br>
				</div>
  			</div>
  			</div>
  	</div>
@endsection