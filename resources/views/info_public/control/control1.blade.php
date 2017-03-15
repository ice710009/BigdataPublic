@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title"><h2>內部控制制度及執行</h2></div>
				</div>
				
				<div class="content-box-large box-with-header">
				<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#t1" data-toggle="tab">1. 內部控制聲明書</a></li>
					<!--<li role="presentation"><a href="#t2" data-toggle="tab">2. 近3年稽核計畫及稽核報告</a></li>	-->				
				</ul>
				
				<!-- Tab panes -->
				<div class="tab-content md-tab">
					<div role="tabpanel" class="tab-pane active" id="t1">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/control/5-1-1.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>1. 內部控制聲明書</a></h4>
							<table width="80%">
								<tr>
								<td valign="top"><font face="DFKai-sb" color="black" size="4">1.</td>
				　　			<td align="justify"><font face="DFKai-sb" color="black" size="4">
								為健全本校內部控制，本校訂有「國立交通大學強化內部控制專案小組設置要點」、「國立交通大學內部控制制度」、「國立交通大學內部控制制度自行評估實施計畫」，每年據以進行相關內控自行評估作業及內部稽核事宜。<br>
								</font></td>
								</tr>
								<tr>
								<td valign="top"><font face="DFKai-sb" color="black" size="4">2.</td>
				　　			<td align="justify"><font face="DFKai-sb" color="black" size="4">
								自103年以來每年皆辦理內部控制自行評估作業，檢視各單位作業程序是否遵循規定及是否落實執行，評估結果皆為本校整體內部控制制度係屬有效，能合理促使達成實現行政效能、遵循法令規定，保障資產安全以及提供可靠資訊等目標。<br>
								</font></td>
								</tr>
								<tr>
								<td valign="top"><font face="DFKai-sb" color="black" size="4">3.</td>
				　　			<td align="justify"><font face="DFKai-sb" color="black" size="4">
								內部稽核部分，自103年以來，本校稽核項目挑選原則如下：<br>
								(1)經審計部近年查核要求改善事項。<br>
								(2)本校重大政策及案件，如資訊安全、個人資料保護。<br>
								</font></td>
								</tr>
								<tr>
								<td valign="top"><font face="DFKai-sb" color="black" size="4">4.</td>
				　　			<td align="justify"><font face="DFKai-sb" color="black" size="4">
								本校內部控制聲明書如下。<br>
								</font></td>
								</tr>
							</table>
							
							<img src="/img/info_public/control/5-1-1.png" width="80%" alt="內部控制聲明書"></img><br>
							<!-- <img src="/img/info_public/fund/2-1-1_103.png" alt="103年度學校收入分析" width="60%"></img><br>
							<img src="/img/info_public/fund/2-1-1_102.png" alt="102年度學校收入分析" width="60%"></img><br>	-->				
						</div>
					</div>
					<!--
					<div role="tabpanel" class="tab-pane " id="t2">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/fund/2-1-2.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>2. 近3年稽核計畫及稽核報告</a></h4>
							 <img src="/img/info_public/fund/2-1-2_104.png" alt="104年度學校收入分析" width="60%"></img><br>
							<img src="/img/info_public/fund/2-1-2_103.png" alt="103年度學校支出分析" width="60%"></img><br>
							<img src="/img/info_public/fund/2-1-2_102.png" alt="102年度學校收入分析" width="60%"></img><br> 					
						</div>
					</div>-->
				</div>
				</div>
				</div>
  			</div>
  			</div>
  	</div>
@endsection