@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title">基本數據及趨勢</div>
				</div>
				
				<div class="content-box-large box-with-header">
				<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#t1" data-toggle="tab">1. 近3年學生人數與變動趨勢圖</a></li>
					<li role="presentation"><a href="#t2" data-toggle="tab">2. 近3年教職員人數與變動趨勢圖</a></li>
					<li role="presentation"><a href="#t3" data-toggle="tab">3. 近3年生師比與變動趨勢圖</a></li>
					<li role="presentation"><a href="#t4" data-toggle="tab">4. 每生校地及校舍（或樓地板）面積</a></li>
					<li role="presentation"><a href="#t5" data-toggle="tab">5. 學校圖書資源</a></li>
					<li role="presentation"><a href="#t6" data-toggle="tab">6. 學校設備與資源</a></li>
				</ul>
				
				<!-- Tab panes -->
				<div class="tab-content md-tab">
					<div role="tabpanel" class="tab-pane active" id="t1">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/ir_sys/1-3-1.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>1. 近3年學生人數與變動趨勢圖</a></h4>
							<img src="/img/info_public/ir_sys/1-3-1_1.png" alt="學生人數" width="60%"></img><br>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane " id="t2">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/ir_sys/1-3-2.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>2. 近3年教職員人數與變動趨勢圖</a></h4>
							<img src="/img/info_public/ir_sys/1-3-2_1.png" alt="教職員人數"></img><br>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="t3">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/ir_sys/1-3-3.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>3. 近3年生師比與變動趨勢圖</a></h4>
							<img src="/img/info_public/ir_sys/1-3-3_1.png" alt="生師比" width="60%"></img><br>
							<img src="/img/info_public/ir_sys/1-3-3_2.png" alt="生師比-台南分部" width="60%"></img><br>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="t4">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/ir_sys/1-3-4.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>4. 每生校地及校舍（或樓地板）面積</a></h4>
							<img src="/img/info_public/ir_sys/1-3-4_1.png" alt="每生校地及校舍面積" width="60%"></img><br>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="t5">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/ir_sys/1-3-5.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>5. 學校圖書資源</a></h4>
							<img src="/img/info_public/ir_sys/1-3-5_1.PNG" alt="學校圖書資源" width="60%"></img><br>
						</div>
					</div>	
					<div role="tabpanel" class="tab-pane" id="t6">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/ir_sys/1-3-6.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>6. 學校設備與資源</a></h4>
							<?php
								for($i=1; $i <= 9; $i++){
									echo '<img src="/img/info_public/ir_sys/1-3-6/1-4-1-0'.$i.'.png" width="60%">';		
								}		
								for($i=10; $i <=48; $i++){
									echo '<img src="/img/info_public/ir_sys/1-3-6/1-4-1-'.$i.'.png" width="60%">';		
								}
							?>							
						</div>
					</div>
				</div>
				</div>
				</div>
			</div>
	</div>
	</div>
@endsection