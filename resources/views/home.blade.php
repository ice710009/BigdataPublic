@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title">
						<?php
							date_default_timezone_set('Asia/Taipei');
							//$tempDate = date("Y-m-d H:i");
							$tempDate = date("Y 年 m 月 d 日　H 時 i 分");
							echo "現在時間：";
							echo $tempDate;
							//echo date('Y 年 m 月 d 日　H 時 i 分');
						?>
					</div>
				</div>
  				<div class="content-box-large box-with-header">
  					<table class="table table-striped">
                        <tr>
                            <th  width="50%">
								<table>
									<tr><td>今日在學總人數：{{$num}}</td></tr>
									<tr><td>博士班人數：{{$phD}}</td></tr>
									<tr><td>碩士班人數：{{$master}}</td></tr>
									<tr><td>大學部人數：{{$ung}}</td></tr>
									<tr><td>男生人數：{{$male}}</td></tr>
									<tr><td>女生人數：{{$female}}</td></tr>
								</table>							
							</th>
                            <th  width="50%">
								<table>
									<tr><td>今日在校教職員總人數(不含借調與兼任)：</td></tr>
									<tr><td>教授人數：{{$pro}}</td></tr>
									<tr><td>副教授人數：{{$asso_pro}}</td></tr>
									<tr><td>助理教授人數：{{$assi_pro}}</td></tr>
									<tr><td>講師人數：{{$lecturer}}</td></tr>
									<!--
									<tr><td>博士後研究員人數：</td></tr>
									<tr><td>職員人數：</td></tr>
									-->
								</table>
							</th>                                        
                        </tr>                      
  					</table>
  				</div>
  			</div>
  			</div>
  	</div>
@endsection
