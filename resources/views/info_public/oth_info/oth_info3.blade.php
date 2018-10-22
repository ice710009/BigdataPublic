@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		<div class="row">
			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title">學校採購及處分重大資產情形</div>
				</div>
				
				<div class="content-box-large box-with-header">
				<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#t1" data-toggle="tab">106學年度下學期</a></li>
					<li role="presentation"><a href="#t2" data-toggle="tab">106學年度上學期</a></li>
					<li role="presentation"><a href="#t3" data-toggle="tab">105學年度上學期</a></li>
					<li role="presentation"><a href="#t4" data-toggle="tab">104學年度下學期</a></li>
				</ul>
				
				<!-- Tab panes -->
				<div class="tab-content md-tab">
					<div role="tabpanel" class="tab-pane active" id="t1">
						<div class="panel-body">
							<h4>106學年度下學期(107/02/01-107/07/31)</h4>
							<h4><a href="{{ url('/info_public/oth_info/4-3-1_10602.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>1. 辦理100萬元以上採購案件一覽表</a></h4>
							<img src="/img/info_public/oth_info/4-3-1_10602.png" width="100%" alt="辦理100萬元以上採購案件一覽表"></img><br>							
						</div>
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/oth_info/4-3-2_10602.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>2. 處分土地及重大資產案件一覽表</a></h4>
							<img src="/img/info_public/oth_info/4-3-2_10602.png" alt="處分土地及重大資產案件一覽表" width="60%"></img><br>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane " id="t2">
						<div class="panel-body">
							<h4>106學年度上學期(106/08/01-107/01/31)</h4>
							<h4><a href="{{ url('/info_public/oth_info/4-3-1_10601.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>1. 辦理100萬元以上採購案件一覽表</a></h4>
							<img src="/img/info_public/oth_info/4-3-1_10601_1.png" width="100%" alt="辦理100萬元以上採購案件一覽表"></img><br>
							<img src="/img/info_public/oth_info/4-3-1_10601_2.png" width="100%" alt="辦理100萬元以上採購案件一覽表"></img><br>
						</div>
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/oth_info/4-3-2_10601.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>2. 處分土地及重大資產案件一覽表</a></h4>
							<img src="/img/info_public/oth_info/4-3-2_10601.png" alt="處分土地及重大資產案件一覽表" width="60%"></img><br>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="t3">
						<div class="panel-body">
							<h4>105學年度上學期(105/08/01-106/01/31)</h4>
							<h4><a href="{{ url('/info_public/oth_info/4-3-1_10501.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>1. 辦理100萬元以上採購案件一覽表</a></h4>
							<img src="/img/info_public/oth_info/4-3-1_10501.png" width="100%" alt="辦理100萬元以上採購案件一覽表"></img><br>
						</div>
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/oth_info/4-3-2_10501.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>2. 處分土地及重大資產案件一覽表</a></h4>
							<img src="/img/info_public/oth_info/4-3-2_10501.png" alt="處分土地及重大資產案件一覽表" width="60%"></img><br>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="t4">
						<div class="panel-body">
							<h4>104學年度下學期(105/02/01-105/07/31)</h4>
							<h4><a href="{{ url('/info_public/oth_info/4-3-1_10402.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>1. 辦理100萬元以上採購案件一覽表</a></h4>
							<img src="/img/info_public/oth_info/4-3-1_10402.png" width="100%" alt="辦理100萬元以上採購案件一覽表"></img><br>
						</div>
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/oth_info/4-3-2_10402.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>2. 處分土地及重大資產案件一覽表</a></h4>
							<img src="/img/info_public/oth_info/4-3-2_10402.png" alt="處分土地及重大資產案件一覽表" width="60%"></img><br>
						</div>
					</div>					
				</div>
				</div>
				</div>
			</div>
  		</div>
  	</div>
@endsection