@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title"><h2>學校績效表現</h2></div>
				</div>
				
				<div class="content-box-large box-with-header">
				<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#t1" data-toggle="tab">1. 近3年各類評鑑結果</a></li>
					<li role="presentation"><a href="#t2" data-toggle="tab">2. 近3年畢業生流向與校友表現</a></li>
					<li role="presentation"><a href="#t3" data-toggle="tab">3. 其他與學校績效表現有關之訊息</a></li>
				</ul>
								
				
				<div class="tab-content md-tab">
					<div role="tabpanel" class="tab-pane active" id="t1">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/ir_sys/1-5-1.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>1. 近3年各類評鑑結果</a></h4>
							<img src="/img/info_public/ir_sys/1-5-1_1.png" width="50%"></img><br>
							<img src="/img/info_public/ir_sys/1-5-1_2.png" width="50%"></img><br>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane " id="t2">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/ir_sys/1-5-2.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>2. 近3年畢業生流向與校友表現</a></h4>
							<br>
							<img src="/img/info_public/ir_sys/1-5-2.png"></img><br>
							<img src="/img/info_public/ir_sys/1-5-2_1.png"></img><br>
							<img src="/img/info_public/ir_sys/1-5-2_2.png"></img><br>
							<img src="/img/info_public/ir_sys/1-5-2_3.png"></img><br>
							<img src="/img/info_public/ir_sys/1-5-2_4.png"></img><br>
							<img src="/img/info_public/ir_sys/1-5-2_5.png"></img><br>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="t3">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/ir_sys/1-5-3.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>3. 其他與學校績效表現有關之訊息</a></h4>
							<img src="/img/info_public/ir_sys/1-5-3_1.png" width="50%"></img><br>
							<img src="/img/info_public/ir_sys/1-5-3_2.png" width="50%"></img><br>
						</div>
					</div>
					
				</div>
				</div>
				</div>
				
			</div>
  		</div>
	</div>
@endsection