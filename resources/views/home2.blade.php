@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title">大數據研究中心目前可供校務資訊研究之資料庫列表如下<small>(依單位區分)</small></div>
				</div>
  				<div class="content-box-large box-with-header">
  					<table class="table table-striped">
  							    <thead>
                                    <tr>
                                        <th  width="25%"></th>
                                        <th  width="25%">單位</th>
                                        <th  width="25%">資料庫名稱</th>
                                        <th  width="25%">備註</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align:center;vertical-align:middle;">教務處</td>
                                        <td>
											<div>註冊組</div>
                                        	<div>課務組</div>
											<div>教學發展中心</div>
                                        	<div>數位內容製作中心</div>
                                        </td>
                                        <td>
											<div>
                                        	    <a href="#" data-toggle="collapse" data-target="#aad1"><i class="fa fa-fw fa-bar-chart-o"></i> 學籍共同資料庫 <i class="fa fa-fw fa-caret-down"></i></a>
												<ul id="aad1" class="collapse">
													<li>學生基本資料<i class="fa fa-fw fa-caret-down"></i></li>
													<li>學生每學期資料</li>
													<li>學生過去學歷</li>
													<li>當學期課程檔</li>
													<li>英語能力註記</li>
													<li>永久課程檔</li>
													<li>成績檔</li>
													<li>學院代碼表</li>
													<li>系所代碼表</li>
													<li>組別代碼表</li>
											</div>
                                        	<div>
											<a href="#" data-toggle="collapse" data-target="#aad2"><i class="fa fa-fw fa-bar-chart-o"></i> 選課系統 <i class="fa fa-fw fa-caret-down"></i></a>
												<ul id="aad2" class="collapse">
													<li>修習學期<i class="fa fa-fw fa-caret-down"></i></li>
													<li>員工</li>
													<li>問卷課程</li>
													<li>學籍</li>
													<li>科目</li>
													<li>系所</li>
													<li>課程表</li>
													<li>開課教師</li>
													<li>開課系所</li>
											</div>
											<div>
												<a href="#" data-toggle="collapse" data-target="#aad3"><i class="fa fa-fw fa-bar-chart-o"></i> 助教問卷評量系統 <i class="fa fa-fw fa-caret-down"></i></a>
												<ul id="aad3" class="collapse">
													<li>課程時間<i class="fa fa-fw fa-caret-down"></i></li>
													<li>助教基本資料</li>
													<li>TA_MonthlyResult</li>
													<li>TA_survey</li>
													<li>TA_survey意見</li>
													<li>TA_survey題目</li>
													<li>TA_survey結果</li>
													<li>TA_選課</li>
											</div>
                                        	<div>
												<a href="#" data-toggle="collapse" data-target="#aad4"><i class="fa fa-fw fa-bar-chart-o"></i> e3資料庫 <i class="fa fa-fw fa-caret-down"></i></a>
												<ul id="aad4" class="collapse">
													<li>課程資料<i class="fa fa-fw fa-caret-down"></i></li>
													<li>開課教師</li>
													<li>開課系所</li>
													<li>修課學生</li>
													<li>系統使用紀錄</li>
													<li>系統頁面說明</li>
											</div>
                                        </td>
                                        <td>
                                        	<div>97年至105年</div>
                                        	<div></div>
                                        	<div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;vertical-align:middle;">學務處</td>
                                        <td>
                                        	<div>生輔組</div>
                                        	<div>生輔組</div>
                                        	<div>諮商中心</div>
                                        </td>
                                        <td>
                                        	<div>
											<a href="#" data-toggle="collapse" data-target="#sa1"><i class="fa fa-fw fa-bar-chart-o"></i> 弱勢助學系統 <i class="fa fa-fw fa-caret-down"></i></a>
												<ul id="sa1" class="collapse">
													<li>弱勢助學資料表<i class="fa fa-fw fa-caret-down"></i></li>													
											</div>
											<div>
											<a href="#" data-toggle="collapse" data-target="#sa2"><i class="fa fa-fw fa-bar-chart-o"></i> 學雜費減免資料庫 <i class="fa fa-fw fa-caret-down"></i></a>
												<ul id="sa2" class="collapse">
													<li>學雜費減免資料表<i class="fa fa-fw fa-caret-down"></i></li>													
											</div>
											<div>
											<a href="#" data-toggle="collapse" data-target="#sa3"><i class="fa fa-fw fa-bar-chart-o"></i> 預約系統資料庫 <i class="fa fa-fw fa-caret-down"></i></a>
												<ul id="sa3" class="collapse">
													<li>預約時間表<i class="fa fa-fw fa-caret-down"></i></li>													
											</div>
                                        </td>
                                        <td>
                                        	<div>為保護個人隱私，無法提供學務處三個資料庫原始資料</div>
                                        	<div></div>
                                        	<div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td style="text-align:center;vertical-align:middle;">研發處</td>
                                    	<td><div>計畫業務組</div>
                                    	<td>
										<div>
											<a href="#" data-toggle="collapse" data-target="#rd1"><i class="fa fa-fw fa-bar-chart-o"></i> 建教合作計畫資料庫 <i class="fa fa-fw fa-caret-down"></i></a>
												<ul id="rd1" class="collapse">
													<li>科技部計畫處理表<i class="fa fa-fw fa-caret-down"></i></li>
													<li>非科技部計畫處理表</li>
										</div>
                                    	<td></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center;vertical-align:middle;">人事室</td>
                                        <td></td>
                                        <td>
										<div>
											<a href="#" data-toggle="collapse" data-target="#hu1"><i class="fa fa-fw fa-bar-chart-o"></i> 人事共同資料庫 <i class="fa fa-fw fa-caret-down"></i></a>
												<ul id="hu1" class="collapse">
													<li>人力資源管理系統<i class="fa fa-fw fa-caret-down"></i></li>
													<li>約用人員系統</li>
										</div>
										<div>
											<a href="#" data-toggle="collapse" data-target="#hu2"><i class="fa fa-fw fa-bar-chart-o"></i> 兼任請核系統資料庫 <i class="fa fa-fw fa-caret-down"></i></a>
												<ul id="hu2" class="collapse">
													<li>請核、異動表<i class="fa fa-fw fa-caret-down"></i></li>
										</div>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
  					</table>
  				</div>
  			</div>
  			</div>
  	</div>
@endsection