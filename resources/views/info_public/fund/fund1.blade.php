@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title"><h2>學校收入支出分析</h2></div>
				</div>
				
				<div class="content-box-large box-with-header">
				<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#t1" data-toggle="tab">1. 學校收入分析</a></li>
					<li role="presentation"><a href="#t2" data-toggle="tab">2. 學校支出分析</a></li>					
				</ul>
				
				<!-- Tab panes -->
				<div class="tab-content md-tab">
					<div role="tabpanel" class="tab-pane active" id="t1">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/fund/2-1-1.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>1. 學校收入分析</a></h4>
							<img src="/img/info_public/fund/2-1-1_106.png" alt="106年度學校收入分析"></img><br>					
							<img src="/img/info_public/fund/2-1-1_105.png" alt="105年度學校收入分析"></img><br>
							<img src="/img/info_public/fund/2-1-1_104.png" alt="104年度學校收入分析"></img><br>							
						</div>
					</div>
					<div role="tabpanel" class="tab-pane " id="t2">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/fund/2-1-2.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>2. 學校支出分析</a></h4>
							<img src="/img/info_public/fund/2-1-2_106_1.png" alt="106年度學校支出分析項目"></img><br>
							<img src="/img/info_public/fund/2-1-2_106_2.png" alt="106年度學校支出分析圖表"></img><br>	
							<img src="/img/info_public/fund/2-1-2_105_1.png" alt="105年度學校支出分析項目"></img><br>
							<img src="/img/info_public/fund/2-1-2_105_2.png" alt="105年度學校支出分析圖表"></img><br>
							<img src="/img/info_public/fund/2-1-2_104_1.png" alt="104年度學校支出分析項目"></img><br>
							<img src="/img/info_public/fund/2-1-2_104_2.png" alt="104年度學校支出分析圖表"></img><br>
						</div>
					</div>
				</div>
				</div>
				</div>
  			</div>
  			</div>
  	</div>
@endsection