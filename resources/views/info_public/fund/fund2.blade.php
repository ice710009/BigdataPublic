﻿@extends('layouts.info_public')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title"><h2>學雜費與就學輔助資訊</h2></div>
				</div>
				
				<div class="content-box-large box-with-header">
				<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#t1" data-toggle="tab">1. 學校及各學院每生收費標準</a></li>
					<li role="presentation"><a href="#t2" data-toggle="tab">2. 學校及各學院每生平均教學成本</a></li>
					<li role="presentation"><a href="#t3" data-toggle="tab">3. 學校及各學院學雜費標準占平均每生教學成本比率</a></li>
					<li role="presentation"><a href="#t4" data-toggle="tab">4. 學生在學期間教育支出估算</a></li>
					<li role="presentation"><a href="#t5" data-toggle="tab">5. 政府、學校與民間機構提供之各項助學措施資訊</a></li>
					<li role="presentation"><a href="#t6" data-toggle="tab">6. 在校生申請就學貸款/獎助學金/學雜費減免之金額、人數與比率</a></li>
				</ul>
				
				<!-- Tab panes -->
				<div class="tab-content md-tab">
					<div role="tabpanel" class="tab-pane active" id="t1">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/fund/2-1-1_105.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>1. 學校及各學院每生收費標準</a></h4>
							<br>
							<img src="/img/info_public/fund/2-2-1_105_1.png" alt="國立交通大學105學年度學雜費收費標準" width="60%"></img><br>					
							<img src="/img/info_public/fund/2-2-1_105_2.png" alt="國立交通大學105學年度學雜費收費標準" width="60%"></img><br>					
						</div>
					</div>
					<div role="tabpanel" class="tab-pane " id="t2">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/fund/2-2-2.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>2. 學校及各學院每生平均教學成本</a></h4>
							<br>
							<img src="/img/info_public/fund/2-2-2_1.png" alt="大學部各學院每生平均教學成本" width="60%"></img><br>					
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="t3">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/fund/2-2-3.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>3. 學校及各學院學雜費標準占平均每生教學成本比率</a></h4>
							<br>
							<img src="/img/info_public/fund/2-2-3_1.png" alt="103年度各學院每生學雜費標準占平均每生教學成本比率" width="60%" height="60%"></img><br>
							<img src="/img/info_public/fund/2-2-3_2.png" alt="102年度各學院每生學雜費標準占平均每生教學成本比率" width="60%" height="60%"></img><br>
							<img src="/img/info_public/fund/2-2-3_3.png" alt="101年度各學院每生學雜費標準占平均每生教學成本比率" width="60%" height="60%"></img><br>					
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="t4">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/fund/2-2-4.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>4. 學生在學期間教育支出估算</a></h4>
							<br>
							<img src="/img/info_public/fund/2-2-4_1.PNG" width="60%"></img><br>					
						</div>
					</div>
					<div role="tabpanel" class="tab-pane" id="t5">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/fund/2-2-5.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>5. 政府、學校與民間機構提供之各項助學措施資訊</a></h4>
							<br>
							<font face="DFKai-sb" color="blue" size="5">【學校與民間機構提供之各項助學措施資訊】</font>
							<table style="border:3px double;padding:5px;" rules="all" width="60%">
							
								<tr>
							　　	<th><font face="DFKai-sb" color="black" size="4"><center> 提供單位 </center></font></th>
									<th><font face="DFKai-sb" color="black" size="4"><center> 說明 </center></font></th>
								</tr>
								<tr>
							　　	<td><font face="DFKai-sb" color="black" size="4"><center> 政府機關 </center></font></td>
									<td><font face="DFKai-sb" size="4"> <a href="http://helpdreams.moe.edu.tw/"  style="color:#000085;"> 1.教育部圓夢助學網 </a></font></td>
								</tr>
								<tr>
							　　	<td><font face="DFKai-sb" color="black" size="4"><center> 本校提供 </center></font></td>
									<td>
										<font face="DFKai-sb" size="4"> 
										<a href="http://scahss.sa.nctu.edu.tw/?page_id=338"  style="color:#000085;">1.學務處生輔組工讀助學金資訊網頁</a><br>
										<a href="http://parttime.nctu.edu.tw:8080/"          style="color:#000085;">2.校內工讀系統</a><br>
										<a href="http://scahss.sa.nctu.edu.tw/?page_id=335"  style="color:#000085;">3.學務處生輔組就學貸款資訊網頁</a><br>
										<a href="http://scahss.sa.nctu.edu.tw/?page_id=336"  style="color:#000085;">4.學務處生輔組學雜費減免資訊網頁</a><br>
										<a href="http://scahss.sa.nctu.edu.tw/?page_id=584"  style="color:#000085;">5.學務處生輔組生活助學金資訊網頁</a><br>
										<a href="http://scahss.sa.nctu.edu.tw/?page_id=340"  style="color:#000085;">6.學務處生輔組獎助學金資訊網頁</a>
										</font>
									</td>							
								</tr>
								<tr>
							　　	<td><font face="DFKai-sb" size="4"><center> 民間機構 </center></font></td>
									<td>
										<font face="DFKai-sb" size="4">
										<a href="http://sasystem.nctu.edu.tw/scholarship/index2.php" style="color:#000085;">1.校外獎助學金相關訊息網頁</a><br>
										<a href="http://www.bot.com.tw" style="color:#000085;">2.就學貸款承貸銀行（台灣銀行）網頁 </a>
										</font>
									</td>
								</tr>
							</table> 				
						</div>
					</div>	
					<div role="tabpanel" class="tab-pane" id="t6">
						<div class="panel-body">
							<h4><a href="{{ url('/info_public/fund/2-2-6.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i>6. 在校生申請就學貸款/獎助學金/學雜費減免之金額、人數與比率</a></h4>
							<br>
							<font face="DFKai-sb" color="blue" size="5">【在校生申請就學貸款/獎助學金/學雜費減免之金額、人數與比率】</font>
							<img src="/img/info_public/fund/2-2-6_1.png" alt="在校生申請就學貸款/獎助學金/學雜費減免之金額、人數與比率" width="60%" height="60%"></img><br>
							<img src="/img/info_public/fund/2-2-6_2.png" alt="獎助學金" width="60%"></img><br>
							<img src="/img/info_public/fund/2-2-6_3.png" alt="就學貸款" width="60%"></img><br>
							<img src="/img/info_public/fund/2-2-6_4.png" alt="學雜費減免" width="60%"></img><br>
						</div>
					</div>
				</div>
				</div>
				</div>
				
  			</div>
  			</div>
  	</div>
@endsection