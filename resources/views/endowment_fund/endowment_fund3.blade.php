@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title"><h2>可用資金變化情形及支出用途</h2></div>
				</div>
				
				<div class="content-box-large box-with-header">
				<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#t1" data-toggle="tab">107年第2季可用資金變化情形</a></li>
					<li role="presentation"><a href="#t2" data-toggle="tab">107年第1季可用資金變化情形</a></li>
					<li role="presentation"><a href="#t3" data-toggle="tab">106年全年可用資金變化情形</a></li>
					<li role="presentation"><a href="#t4" data-toggle="tab">105年全年可用資金變化情形</a></li>
					<li role="presentation"><a href="#t5" data-toggle="tab">104年全年可用資金變化情形</a></li>				
				</ul>
				
				<!-- Tab panes -->
				<div class="tab-content md-tab">
					<div role="tabpanel" class="tab-pane active" id="t1">
						<div class="panel-body">
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-107s2.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 107年第2季可用資金變化情形</a></h4>
							<br>
							<img src="/img/endowment_fund/endowment_fund-3-107s2.png" width = "80%"></img>
						</div>
					</div>	
					<div role="tabpanel" class="tab-pane" id="t2">
						<div class="panel-body">
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-107s1.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 107年第1季可用資金變化情形</a></h4>
							<br>
							<img src="/img/endowment_fund/endowment_fund-3-107s1.png" width = "80%"></img>
						</div>
					</div>					
					<div role="tabpanel" class="tab-pane" id="t3">
						<div class="panel-body">
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-106s4.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 106年第4季可用資金變化情形</a></h4><br>
							<img src="/img/endowment_fund/endowment_fund-3-106s4.png"></img><br>
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-106s3.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 106年第3季可用資金變化情形</a></h4><br>
							<img src="/img/endowment_fund/endowment_fund-3-106s3.png"></img><br>
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-106s2.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 106年第2季可用資金變化情形</a></h4><br>
							<img src="/img/endowment_fund/endowment_fund-3-106s2.png"></img><br>
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-106s1.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 106年第1季可用資金變化情形</a></h4><br>
							<img src="/img/endowment_fund/endowment_fund-3-106s1.png"></img>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="t4">
						<div class="panel-body">
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-105s4.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 105年第4季可用資金變化情形</a></h4><br>
							<img src="/img/endowment_fund/endowment_fund-3-105s4.png"></img><br>
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-105s3.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 105年第3季可用資金變化情形</a></h4><br>
							<img src="/img/endowment_fund/endowment_fund-3-105s3.png"></img><br>
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-105s2.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 105年第2季可用資金變化情形</a></h4><br>
							<img src="/img/endowment_fund/endowment_fund-3-105s2.png"></img><br>
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-105s1.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 105年第1季可用資金變化情形</a></h4><br>
							<img src="/img/endowment_fund/endowment_fund-3-105s1.png"></img>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="t5">
						<div class="panel-body">
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-104s4.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 104年第4季可用資金變化情形</a></h4><br>
							<img src="/img/endowment_fund/endowment_fund-3-104s4.png"></img><br>
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-104s3.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 104年第3季可用資金變化情形</a></h4><br>
							<img src="/img/endowment_fund/endowment_fund-3-104s3.png"></img><br>
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-104s2.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 104年第2季可用資金變化情形</a></h4><br>
							<img src="/img/endowment_fund/endowment_fund-3-104s2.png"></img><br>
							<h4><a href="{{ url('/endowment_fund/endowment_fund-3-104s1.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i> 104年第1季可用資金變化情形</a></h4><br>
							<img src="/img/endowment_fund/endowment_fund-3-104s1.png"></img>
						</div>
					</div>
				</div>
				</div>
				</div>
				
  			</div>
  			</div>
  	</div>
@endsection