@extends('layouts.white')
@section('content')
	<div class="col-md-10">				
		<div class="row">
			<div class="content-box-header" style="background-color:#D1E9E9;">
				<div class="panel-title">101-106學年度各種入學管道之修業狀況<a href="{{ url('/analysis/analysis_menu') }}">(回選單)</a></div>
			</div>
		<p>
		<div class="btn-group">
			{!!Form::select('academe', array('0'=> '請選擇學院',
									'1' => '全校',
									'A' => '人文社會學院',
									'I' => '工學院',
									'B' => '生物科技學院',
									'O' => '光電學院',
									'L' => '科技法律學院',
									'D' => '國際半導體產業學院',
									'S' => '理學院',
									'C' => '資訊學院',
									'E' => '電機學院',
									'Y' => '電機學院與資訊學院',
									'M' => '管理學院',
									'K' => '客家文化學院'), 0, array('class'=>'form-control', 'id' => 'academe', 'onchange' => 'selectAcademeHandler()'));!!}
		</div>
		<div class="btn-group">
			{!!Form::select('degree', array('0'=> '請選擇學位',
									'1'=> '博班',
									'2' => '碩班',
									'3' => '全學院'), 0, array('class'=>'form-control', 'id' => 'degree', 'onchange' => 'selectAcademeHandler()'));!!}
		</div>
		<div class="btn-group">
			<select class="form-control" id="department" name="department"></select>
		</div>		
		</p>

		<div class="form-group">
		<!-- 全校 -->
		@if($academe == '1')
			<h3><font color="#008888"><strong>碩士</strong></font></h3>
			<table class="table table-striped">
				<thead>
				<tr>
					<td rowspan="3" align="center" valign="center">學年度</td>
					<td rowspan="3" align="center" valign="center">新生人數<br>A</td>
					<td colspan="12" align="center">最後修業狀態</td>			
				</tr>
				<tr>
					<td colspan="2" align="center">在學<br>(含當學期應畢與延畢)</td>
					<td colspan="2" align="center">畢業</td>
					<td colspan="2" align="center">休學</td>
					<td colspan="2" align="center">期中退學</td>
					<td colspan="2" align="center">期末退學</td>
					<td colspan="2" align="center">其它</td>
				</tr>
				<tr>
					<td align="center">人數<br>A</td>
					<td align="center">比例<br>(A/N)</td>
					<td align="center">人數<br>B</td>
					<td align="center">比例<br>(B/N)</td>
					<td align="center">人數<br>C</td>
					<td align="center">比例<br>(C/N)</td>
					<td align="center">人數<br>D</td>
					<td align="center">比例<br>(D/N)</td>
					<td align="center">人數<br>E</td>
					<td align="center">比例<br>(E/N)</td>
					<td align="center">人數<br>F</td>
					<td align="center">比例<br>(F/N)</td>
				</tr>
				</thead>
				<tbody>
				@foreach($semesters as $i=>$semester)
					<tr>
						<td align="center">{{$semester}}</td>
						<td align="center">{{$NCTU_new_m[$i]}}</td>
						<td align="center">{{$NCTU_m1[$i]}}</td>
						<td align="center">{{round($NCTU_m1[$i]/$NCTU_new_m[$i],4)*100}}%</td>
						<td align="center">{{$NCTU_m11[$i]}}</td>
						<td align="center">{{round($NCTU_m11[$i]/$NCTU_new_m[$i],4)*100}}%</td>
						<td align="center">{{$NCTU_m4[$i]}}</td>
						<td align="center">{{round($NCTU_m4[$i]/$NCTU_new_m[$i],4)*100}}%</td>
						<td align="center">{{$NCTU_m5[$i]}}</td>
						<td align="center">{{round($NCTU_m5[$i]/$NCTU_new_m[$i],4)*100}}%</td>
						<td align="center">{{$NCTU_m6[$i]}}</td>
						<td align="center">{{round($NCTU_m6[$i]/$NCTU_new_m[$i],4)*100}}%</td>
						<td align="center">{{$NCTU_mo[$i]}}</td>
						<td align="center">{{round($NCTU_mo[$i]/$NCTU_new_m[$i],4)*100}}%</td>
					</tr>  
				@endforeach
				</tbody>
			</table>
			<h3><font color="#008888"><strong>博士</strong></font></h3>
			<table class="table table-striped">
				<thead>
				<tr>
					<td rowspan="3" align="center" valign="center">學年度</td>
					<td rowspan="3" align="center" valign="center">新生人數<br>N</td>
					<td colspan="12" align="center">最後修業狀態</td>			
				</tr>
				<tr>
					<td colspan="2" align="center">在學<br>(含當學期應畢與延畢)</td>
					<td colspan="2" align="center">畢業</td>
					<td colspan="2" align="center">休學</td>
					<td colspan="2" align="center">期中退學</td>
					<td colspan="2" align="center">期末退學</td>
					<td colspan="2" align="center">其它</td>
				</tr>
				<tr>
					<td align="center">人數<br>A</td>
					<td align="center">比例<br>(A/N)</td>
					<td align="center">人數<br>B</td>
					<td align="center">比例<br>(B/N)</td>
					<td align="center">人數<br>C</td>
					<td align="center">比例<br>(C/N)</td>
					<td align="center">人數<br>D</td>
					<td align="center">比例<br>(D/N)</td>
					<td align="center">人數<br>E</td>
					<td align="center">比例<br>(E/N)</td>
					<td align="center">人數<br>F</td>
					<td align="center">比例<br>(F/N)</td>
				</tr>
				</thead>
				<tbody>
				@foreach($semesters as $i=>$semester)
					<tr>
						<td align="center">{{$semester}}</td>
						<td align="center">{{$NCTU_new_p[$i]}}</td>
						<td align="center">{{$NCTU_p1[$i]}}</td>
						<td align="center">{{round($NCTU_p1[$i]/$NCTU_new_p[$i],4)*100}}%</td>
						<td align="center">{{$NCTU_p11[$i]}}</td>
						<td align="center">{{round($NCTU_p11[$i]/$NCTU_new_p[$i],4)*100}}%</td>
						<td align="center">{{$NCTU_p4[$i]}}</td>
						<td align="center">{{round($NCTU_p4[$i]/$NCTU_new_p[$i],4)*100}}%</td>
						<td align="center">{{$NCTU_p5[$i]}}</td>
						<td align="center">{{round($NCTU_p5[$i]/$NCTU_new_p[$i],4)*100}}%</td>
						<td align="center">{{$NCTU_p6[$i]}}</td>
						<td align="center">{{round($NCTU_p6[$i]/$NCTU_new_p[$i],4)*100}}%</td>
						<td align="center">{{$NCTU_po[$i]}}</td>
						<td align="center">{{round($NCTU_po[$i]/$NCTU_new_p[$i],4)*100}}%</td>
					</tr>  
				@endforeach
				</tbody>
			</table>
		
		@else
			@if($degree == '3')
			<!--學院-->
				<h3><font color="#008888"><strong>碩士</strong></font></h3>
				<table class="table table-striped">
					<thead>
					<tr>
						<td rowspan="3" align="center" valign="center">學年度</td>
						<td rowspan="3" align="center" valign="center">新生人數<br>N</td>
						<td colspan="12" align="center">最後修業狀態</td>			
					</tr>
					<tr>
						<td colspan="2" align="center">在學<br>(含當學期應畢與延畢)</td>
						<td colspan="2" align="center">畢業</td>
						<td colspan="2" align="center">休學</td>
						<td colspan="2" align="center">期中退學</td>
						<td colspan="2" align="center">期末退學</td>
						<td colspan="2" align="center">放棄入學</td>
					</tr>
					<tr>
						<td align="center">人數<br>(A)</td>
						<td align="center">比例<br>(A/N)</td>
						<td align="center">人數<br>(B)</td>
						<td align="center">比例<br>(B/N)</td>
						<td align="center">人數<br>(C)</td>
						<td align="center">比例<br>(C/N)</td>
						<td align="center">人數<br>(D)</td>
						<td align="center">比例<br>(D/N)</td>
						<td align="center">人數<br>(E)</td>
						<td align="center">比例<br>(E/N)</td>
						<td align="center">人數<br>(F)</td>
						<td align="center">比例<br>(F/N)</td>
					</tr>
					</thead>
					<tbody>
					@foreach($semesters as $i=>$semester)
						<tr>
							<td align="center">{{$semester}}</td>
							<td align="center">{{$ACA_new_m[$i]}}</td>
							<td align="center">{{$ACA_m1[$i]}}</td>
							<td align="center">{{$ACA_m1_R[$i]}}%</td>
							<td align="center">{{$ACA_m11[$i]}}</td>
							<td align="center">{{$ACA_m11_R[$i]}}%</td>
							<td align="center">{{$ACA_m4[$i]}}</td>
							<td align="center">{{$ACA_m4_R[$i]}}%</td>
							<td align="center">{{$ACA_m5[$i]}}</td>
							<td align="center">{{$ACA_m5_R[$i]}}%</td>
							<td align="center">{{$ACA_m6[$i]}}</td>
							<td align="center">{{$ACA_m6_R[$i]}}%</td>
							<td align="center">{{$ACA_mo[$i]}}</td>
							<td align="center">{{$ACA_mo_R[$i]}}%</td>
						</tr>  
					@endforeach
					</tbody>
				</table>
				<h3><font color="#008888"><strong>博士</strong></font></h3>
				<table class="table table-striped">
					<thead>
					<tr>
						<td rowspan="3" align="center" valign="center">學年度</td>
						<td rowspan="3" align="center" valign="center">新生人數<br>(N)</td>
						<td colspan="12" align="center">最後修業狀態</td>			
					</tr>
					<tr>
						<td colspan="2" align="center">在學<br>(含當學期應畢與延畢)</td>
						<td colspan="2" align="center">畢業</td>
						<td colspan="2" align="center">休學</td>
						<td colspan="2" align="center">期中退學</td>
						<td colspan="2" align="center">期末退學</td>
						<td colspan="2" align="center">放棄入學</td>
					</tr>
					<tr>
						<td align="center">人數<br>(A)</td>
						<td align="center">比例<br>(A/N)</td>
						<td align="center">人數<br>(B)</td>
						<td align="center">比例<br>(B/N)</td>
						<td align="center">人數<br>(C)</td>
						<td align="center">比例<br>(C/N)</td>
						<td align="center">人數<br>(D)</td>
						<td align="center">比例<br>(D/N)</td>
						<td align="center">人數<br>(E)</td>
						<td align="center">比例<br>(E/N)</td>
						<td align="center">人數<br>(F)</td>
						<td align="center">比例<br>(F/N)</td>
					</tr>
					</thead>
					<tbody>
					@foreach($semesters as $i=>$semester)
						<tr>
							<td align="center">{{$semester}}</td>
							<td align="center">{{$ACA_new_p[$i]}}</td>
							<td align="center">{{$ACA_p1[$i]}}</td>
							<td align="center">{{$ACA_p1_R[$i]}}%</td>
							<td align="center">{{$ACA_p11[$i]}}</td>
							<td align="center">{{$ACA_p11_R[$i]}}%</td>
							<td align="center">{{$ACA_p4[$i]}}</td>
							<td align="center">{{$ACA_p4_R[$i]}}%</td>
							<td align="center">{{$ACA_p5[$i]}}</td>
							<td align="center">{{$ACA_p5_R[$i]}}%</td>
							<td align="center">{{$ACA_p6[$i]}}</td>
							<td align="center">{{$ACA_p6_R[$i]}}%</td>
							<td align="center">{{$ACA_po[$i]}}</td>
							<td align="center">{{$ACA_po_R[$i]}}%</td>
						</tr>  
					@endforeach
					</tbody>
				</table>
			
			@elseif($degree == '1')
			<!--系所博班-->
			<!--依各種不同入學管道區分-->
			<div class="btn-group">
				{!!Form::select('enrolltype', array('0'=> '請選擇入學管道',
										'1' => '考試入學-一般生',
										'2' => '考試入學-在職生',
										'4' => '甄試入學-一般生',
										'5' => '甄試入學-在職生',
										'6' => '僑生',
										'7' => '外籍生',
										'8' => '大學逕博',
										'9' => '碩士逕博',
										'17' => '陸生'), 0, array('class'=>'form-control', 'id' => 'enrolltype', 'onchange' => 'selectEnrolltypeHandler()'));!!}
			</div>
				<table class="table table-striped">
					<thead>
					<tr>
						<td rowspan="3" align="center" valign="center">學年度</td>
						<td rowspan="3" align="center" valign="center">新生人數<br>A</td>
						<td colspan="12" align="center">最後修業狀態</td>			
					</tr>
					<tr>
						<td colspan="2" align="center">在學<br>(含當學期應畢與延畢)</td>
						<td colspan="2" align="center">畢業</td>
						<td colspan="2" align="center">休學</td>
						<td colspan="2" align="center">期中退學</td>
						<td colspan="2" align="center">期末退學</td>
						<td colspan="2" align="center">其它</td>
					</tr>
					<tr>
						<td align="center">人數(A)</td>
						<td align="center">比例</td>
						<td align="center">人數(B)</td>
						<td align="center">比例</td>
						<td align="center">人數(C)</td>
						<td align="center">比例</td>
						<td align="center">人數(D)</td>
						<td align="center">比例</td>
						<td align="center">人數(E)</td>
						<td align="center">比例</td>
						<td align="center">人數(F)</td>
						<td align="center">比例</td>
					</tr>
					</thead>
					<tbody>
					@foreach($semesters as $i=>$semester)
						<tr>
							<td align="center">{{$semester}}</td>
							<td align="center">{{$DEP_new_p[$i]}}</td>
							<td align="center">{{$DEP_p1[$i]}}</td>
							<td align="center">{{$DEP_p1_R[$i]}}%</td>
							<td align="center">{{$DEP_p11[$i]}}</td>
							<td align="center">{{$DEP_p11_R[$i]}}%</td>
							<td align="center">{{$DEP_p4[$i]}}</td>
							<td align="center">{{$DEP_p4_R[$i]}}%</td>
							<td align="center">{{$DEP_p5[$i]}}</td>
							<td align="center">{{$DEP_p5_R[$i]}}%</td>
							<td align="center">{{$DEP_p6[$i]}}</td>
							<td align="center">{{$DEP_p6_R[$i]}}%</td>
							<td align="center">{{$DEP_po[$i]}}</td>
							<td align="center">{{$DEP_po_R[$i]}}%</td>
						</tr>  
					@endforeach
					</tbody>
				</table>
				@if ($enrolltype != 0)
					<hr color="#00FF00" size="2">
					<table class="table table-striped">
						<thead>
						<tr>
							<td rowspan="3" align="center" valign="center">學年度</td>
							<td rowspan="3" align="center" valign="center">{{$enrolltype_c}}人數<br>A</td>
							<td colspan="12" align="center">最後修業狀態</td>			
						</tr>
						<tr>
							<td colspan="2" align="center">在學<br>(含當學期應畢與延畢)</td>
							<td colspan="2" align="center">畢業</td>
							<td colspan="2" align="center">休學</td>
							<td colspan="2" align="center">期中退學</td>
							<td colspan="2" align="center">期末退學</td>
							<td colspan="2" align="center">其它</td>
						</tr>
						<tr>
							<td align="center">人數(A)</td>
							<td align="center">比例</td>
							<td align="center">人數(B)</td>
							<td align="center">比例</td>
							<td align="center">人數(C)</td>
							<td align="center">比例</td>
							<td align="center">人數(D)</td>
							<td align="center">比例</td>
							<td align="center">人數(E)</td>
							<td align="center">比例</td>
							<td align="center">人數(F)</td>
							<td align="center">比例</td>
						</tr>
						</thead>
						<tbody>
						@foreach($semesters as $i=>$semester)
							<tr>
							<td align="center">{{$semester}}</td>
							<td align="center">{{$DEPtype_new_p[$i]}}</td>
							<td align="center">{{$DEPtype_p1[$i]}}</td>
							<td align="center">{{$DEPtype_p1_R[$i]}}%</td>
							<td align="center">{{$DEPtype_p11[$i]}}</td>
							<td align="center">{{$DEPtype_p11_R[$i]}}%</td>
							<td align="center">{{$DEPtype_p4[$i]}}</td>
							<td align="center">{{$DEPtype_p4_R[$i]}}%</td>
							<td align="center">{{$DEPtype_p5[$i]}}</td>
							<td align="center">{{$DEPtype_p5_R[$i]}}%</td>
							<td align="center">{{$DEPtype_p6[$i]}}</td>
							<td align="center">{{$DEPtype_p6_R[$i]}}%</td>
							<td align="center">{{$DEPtype_po[$i]}}</td>
							<td align="center">{{$DEPtype_po_R[$i]}}%</td>
						</tr>    
						@endforeach
						</tbody>
					</table>			
				@endif
			
			@elseif($degree == '2')
			<!--系所碩班-->
			<h3>依各種不同入學管道區分</h3>
			<div class="btn-group">
				{!!Form::select('enrolltype', array('0'=> '請選擇入學管道',
										'1' => '考試入學-一般生',
										'2' => '考試入學-在職生',
										'4' => '甄試入學-一般生',
										'5' => '甄試入學-在職生',
										'6' => '僑生',
										'7' => '外籍生',
										'17' => '陸生'), 0, array('class'=>'form-control', 'id' => 'enrolltype', 'onchange' => 'selectEnrolltypeHandler()'));!!}
			</div>
				<table class="table table-striped">
					<thead>
					<tr>
						<td rowspan="3" align="center" valign="center">學年度</td>
						<td rowspan="3" align="center" valign="center">新生人數<br>A</td>
						<td colspan="12" align="center" valign="center">最後修業狀態</td>			
					</tr>
					<tr>
						<td colspan="2" align="center">在學<br>(含當學期應畢與延畢)</td>
						<td colspan="2" align="center">畢業</td>
						<td colspan="2" align="center">休學</td>
						<td colspan="2" align="center">期中退學</td>
						<td colspan="2" align="center">期末退學</td>
						<td colspan="2" align="center">其它</td>
					</tr>
					<tr>
						<td align="center">人數(A)</td>
						<td align="center">比例</td>
						<td align="center">人數(B)</td>
						<td align="center">比例</td>
						<td align="center">人數(C)</td>
						<td align="center">比例</td>
						<td align="center">人數(D)</td>
						<td align="center">比例</td>
						<td align="center">人數(E)</td>
						<td align="center">比例</td>
						<td align="center">人數(F)</td>
						<td align="center">比例</td>
					</tr>
					</thead>
					<tbody>
					@foreach($semesters as $i=>$semester)
						<tr>
							<td align="center">{{$semester}}</td>
							<td align="center">{{$DEP_new_m[$i]}}</td>
							<td align="center">{{$DEP_m1[$i]}}</td>
							<td align="center">{{$DEP_m1_R[$i]}}%</td>
							<td align="center">{{$DEP_m11[$i]}}</td>
							<td align="center">{{$DEP_m11_R[$i]}}%</td>
							<td align="center">{{$DEP_m4[$i]}}</td>
							<td align="center">{{$DEP_m4_R[$i]}}%</td>
							<td align="center">{{$DEP_m5[$i]}}</td>
							<td align="center">{{$DEP_m5_R[$i]}}%</td>
							<td align="center">{{$DEP_m6[$i]}}</td>
							<td align="center">{{$DEP_m6_R[$i]}}%</td>
							<td align="center">{{$DEP_mo[$i]}}</td>
							<td align="center">{{$DEP_mo_R[$i]}}%</td>
						</tr>  
					@endforeach
					</tbody>
				</table>
				@if ($enrolltype != 0)
					<p><hr></p>
					<table class="table table-striped">
						<thead>
						<tr>
							<td rowspan="3" align="center" valign="center">學年度</td>
							<td rowspan="3" align="center" valign="center">{{$enrolltype_c}}<br>新生人數<br>A</td>
							<td colspan="12" align="center">最後修業狀態</td>			
						</tr>
						<tr>
							<td colspan="2" align="center">在學<br>(含當學期應畢與延畢)</td>
							<td colspan="2" align="center">畢業</td>
							<td colspan="2" align="center">休學</td>
							<td colspan="2" align="center">期中退學</td>
							<td colspan="2" align="center">期末退學</td>
							<td colspan="2" align="center">其它</td>
						</tr>
						<tr>
							<td align="center">人數(A)</td>
							<td align="center">比例</td>
							<td align="center">人數(B)</td>
							<td align="center">比例</td>
							<td align="center">人數(C)</td>
							<td align="center">比例</td>
							<td align="center">人數(D)</td>
							<td align="center">比例</td>
							<td align="center">人數(E)</td>
							<td align="center">比例</td>
							<td align="center">人數(F)</td>
							<td align="center">比例</td>
						</tr>
						</thead>
						<tbody>
						@foreach($semesters as $i=>$semester)
							<tr>
							<td align="center">{{$semester}}</td>
							<td align="center">{{$DEPtype_new_m[$i]}}</td>
							<td align="center">{{$DEPtype_m1[$i]}}</td>
							<td align="center">{{$DEPtype_m1_R[$i]}}%</td>
							<td align="center">{{$DEPtype_m11[$i]}}</td>
							<td align="center">{{$DEPtype_m11_R[$i]}}%</td>
							<td align="center">{{$DEPtype_m4[$i]}}</td>
							<td align="center">{{$DEPtype_m4_R[$i]}}%</td>
							<td align="center">{{$DEPtype_m5[$i]}}</td>
							<td align="center">{{$DEPtype_m5_R[$i]}}%</td>
							<td align="center">{{$DEPtype_m6[$i]}}</td>
							<td align="center">{{$DEPtype_m6_R[$i]}}%</td>
							<td align="center">{{$DEPtype_mo[$i]}}</td>
							<td align="center">{{$DEPtype_mo_R[$i]}}%</td>
						</tr>    
						@endforeach
						</tbody>
					</table>			
				@endif
			
			@endif
		@endif
		</div>
		</div>
	


		<!--圖表-->
		<!--
		<div class="panel-body">			
			<div class="row">
				入學管道--{{$enrolltype_c}} v.s. {{$dep_name}}整體新生之修業狀況
			</div>
		</div>
		-->
		@if($degree == '1')
		<div class="panel-body">			
			<div class="row">
			    <!--在學-->
				<div class="col-md-6">				    
					<div id="inschool-p" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>
				<!--畢業-->
				<div class="col-md-6">
					<div id="graduation-p" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>
			</div>
			<div class="row">
				<!--期中與期末退學-->
				<div class="col-md-6">
					<div id="drop-p" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>
				<!--休學與其它狀態-->
				<div class="col-md-6">
					<div id="suspend-other-p" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>
			</div>			
		</div>
		@elseif($degree == '2')
		<div class="panel-body">
			<div class="row">
			    <!--在學-->
				<div class="col-md-6">				    
					<div id="inschool-m" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>
				<!--畢業-->
				<div class="col-md-6">
					<div id="graduation-m" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>
			</div>
			<div class="row">
				<!--期中與期末退學-->
				<div class="col-md-6">
					<div id="drop-m" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>
				<!--休學與其它狀態-->
				<div class="col-md-6">
					<div id="suspend-other-m" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
				</div>
			</div>
		</div>
</div>
@endif


@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<!-- <script src="https://code.highcharts.com/modules/exporting.js"></script> 圖表匯出-->

<script>
$( document ).ready(function() {
		@if(isset($academe))
			$('#academe').val('{{$academe}}');
		@endif
		@if(isset($degree))
			$('#degree').val('{{$degree}}');
		@endif
		
		selectAcademeHandler();
		//selectEnrolltypeHandler();
		
		var url = document.URL
		var tempArray = url.split("?");
		var baseURL = tempArray[0];
		
		$('#academe').change(function(){
				window.location.href = baseURL + "?academe=" + $('#academe').val() + "&degree=" + $('#degree').val() + "&department=" + $('#department').val();
				//可以導到另一個全校特定的頁面
		});
		
		$('#degree').change(function(){
				window.location.href = baseURL + "?academe=" + $('#academe').val() + "&degree=" + $('#degree').val() + "&department=" + $('#department').val();
		});
		
		$('#department').change(function(){
			window.location.href = baseURL + "?academe=" + $('#academe').val() + "&degree=" + $('#degree').val() + "&department=" + $('#department').val() + "&enrolltype=" + $('#enrolltype').val();
		});
		
		$('#enrolltype').change(function(){
			window.location.href = baseURL + "?academe=" + $('#academe').val() + "&degree=" + $('#degree').val() + "&department=" + $('#department').val() + "&enrolltype=" + $('#enrolltype').val();
		});
			
	});
	function selectAcademeHandler(){
		
		if ($( "#academe" ).val() == '1'){
			$("#degree option").remove();
			$("#department option").remove();
			$("#degree").attr("disabled","disabled");
			$("#department").attr("disabled","disabled");
		}
		else if ($( "#degree" ).val() == '3'){
			$("#department option").remove();
			$("#department").attr("disabled","disabled");
		}
		else if($( "#academe" ).val() != '0' && $( "#degree" ).val() != '0'){
			$("#department option").remove();
			var request = $.ajax({
				url: "/analysis/status/get_departments",
				type: "GET",
				data: { academe : $( "#academe" ).val(), degree : $( "#degree" ).val()},
				dataType: "json",
				async: true,
				success: function( msg ) {
					$("#department").append($("<option value='" + '0' + "'>" + "請選擇系所" + "</option>"));
					$.each(msg.name, function(i, val) {
						$("#department").append($("<option value='" + msg.no[i] + "'>" + msg.name[i] + "</option>"));
					});
					if(msg.no.indexOf('{{$dep_no}}') != -1)
						$('#department').val('{{$dep_no}}');
					else
						$('#department').val('0');
				}				
			});
		}
	}

	
	function selectEnrolltypeHandler(){
		
		$('#enrolltype').change(function(){
			window.location.href = baseURL + "?academe=" + $('#academe').val() + "&degree=" + $('#degree').val() + "&department=" + $('#department').val() + "&enrolltype=" + $('#enrolltype').val();
		});
	}
	


/* 圖表區 */
/*博班*/
@if ($degree == 1){
Highcharts.chart('inschool-p', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '在學'
    },
    subtitle: {
        text: 'Source: NCTU'
    },
    xAxis: [{
        categories: ['{{$semesters[0]}}', '{{$semesters[1]}}', '{{$semesters[2]}}', '{{$semesters[3]}}', '{{$semesters[4]}}', '{{$semesters[5]}}'],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}%',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: '百分比',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: '人數',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    series: [
	{
		showInLegend: false,
        name: '{{$dep_name}}新生人數',
        type: 'column',
        yAxis: 1,
		data: [{{$DEP_new_p[0]}}, {{$DEP_new_p[1]}}, {{$DEP_new_p[2]}}, {{$DEP_new_p[3]}}, {{$DEP_new_p[4]}}, {{$DEP_new_p[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}新生人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_new_p[0]}}, {{$DEPtype_new_p[1]}}, {{$DEPtype_new_p[2]}}, {{$DEPtype_new_p[3]}}, {{$DEPtype_new_p[4]}}, {{$DEPtype_new_p[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$dep_name}}仍在學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEP_p1[0]}}, {{$DEP_p1[1]}}, {{$DEP_p1[2]}}, {{$DEP_p1[3]}}, {{$DEP_p1[4]}}, {{$DEP_p1[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}仍在學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_p1[0]}}, {{$DEPtype_p1[1]}}, {{$DEPtype_p1[2]}}, {{$DEPtype_p1[3]}}, {{$DEPtype_p1[4]}}, {{$DEPtype_p1[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$dep_name}}仍在學人數所佔比例',
        type: 'spline',
		data: [{{$DEP_p1_R[0]}}, {{$DEP_p1_R[1]}}, {{$DEP_p1_R[2]}}, {{$DEP_p1_R[3]}}, {{$DEP_p1_R[4]}}, {{$DEP_p1_R[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}仍在學人數所佔比例',
        type: 'spline',
		data: [{{$DEPtype_p1_R[0]}}, {{$DEPtype_p1_R[1]}}, {{$DEPtype_p1_R[2]}}, {{$DEPtype_p1_R[3]}}, {{$DEPtype_p1_R[4]}}, {{$DEPtype_p1_R[5]}}],		
        tooltip: {
            valueSuffix: '%'
        }
    }]
});

Highcharts.chart('graduation-p', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '畢業'
    },
    xAxis: [{
        categories: ['{{$semesters[0]}}', '{{$semesters[1]}}', '{{$semesters[2]}}', '{{$semesters[3]}}', '{{$semesters[4]}}', '{{$semesters[5]}}'],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}%',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: '百分比',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: '人數',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    series: [	
	{
		showInLegend: false,
        name: '{{$dep_name}}畢業人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEP_p11[0]}}, {{$DEP_p11[1]}}, {{$DEP_p11[2]}}, {{$DEP_p11[3]}}, {{$DEP_p11[4]}}, {{$DEP_p11[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}畢業人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_p11[0]}}, {{$DEPtype_p11[1]}}, {{$DEPtype_p11[2]}}, {{$DEPtype_p11[3]}}, {{$DEPtype_p11[4]}}, {{$DEPtype_p11[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$dep_name}}畢業人數所佔比例',
        type: 'spline',
		data: [{{$DEP_p11_R[0]}}, {{$DEP_p11_R[1]}}, {{$DEP_p11_R[2]}}, {{$DEP_p11_R[3]}}, {{$DEP_p11_R[4]}}, {{$DEP_p11_R[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}仍在學人數所佔比例',
        type: 'spline',
		data: [{{$DEPtype_p11_R[0]}}, {{$DEPtype_p11_R[1]}}, {{$DEPtype_p11_R[2]}}, {{$DEPtype_p11_R[3]}}, {{$DEPtype_p11_R[4]}}, {{$DEPtype_p11_R[5]}}],		
        tooltip: {
            valueSuffix: '%'
        }
    }]
});

Highcharts.chart('drop-p', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '期中與期末退學'
    },
    xAxis: [{
        categories: ['{{$semesters[0]}}', '{{$semesters[1]}}', '{{$semesters[2]}}', '{{$semesters[3]}}', '{{$semesters[4]}}', '{{$semesters[5]}}'],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}%',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: '百分比',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: '人數',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    series: [	
	{
		showInLegend: false,
        name: '{{$dep_name}}期中退學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEP_p5[0]}}, {{$DEP_p5[1]}}, {{$DEP_p5[2]}}, {{$DEP_p5[3]}}, {{$DEP_p5[4]}}, {{$DEP_p5[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    },
	{
		showInLegend: false,
        name: '{{$dep_name}}期末退學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEP_p6[0]}}, {{$DEP_p6[1]}}, {{$DEP_p6[2]}}, {{$DEP_p6[3]}}, {{$DEP_p6[4]}}, {{$DEP_p6[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    },	
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}期中退學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_p5[0]}}, {{$DEPtype_p5[1]}}, {{$DEPtype_p5[2]}}, {{$DEPtype_p5[3]}}, {{$DEPtype_p5[4]}}, {{$DEPtype_p5[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}期末退學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_p6[0]}}, {{$DEPtype_p6[1]}}, {{$DEPtype_p6[2]}}, {{$DEPtype_p6[3]}}, {{$DEPtype_p6[4]}}, {{$DEPtype_p6[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$dep_name}}期中退學人數所佔比例',
        type: 'spline',
		data: [{{$DEP_p5_R[0]}}, {{$DEP_p5_R[1]}}, {{$DEP_p5_R[2]}}, {{$DEP_p5_R[3]}}, {{$DEP_p5_R[4]}}, {{$DEP_p5_R[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    },
	{
		showInLegend: false,
        name: '{{$dep_name}}期末退學人數所佔比例',
        type: 'spline',
		data: [{{$DEP_p6_R[0]}}, {{$DEP_p6_R[1]}}, {{$DEP_p6_R[2]}}, {{$DEP_p6_R[3]}}, {{$DEP_p6_R[4]}}, {{$DEP_p6_R[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    },	
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}期中退學人數所佔比例',
        type: 'spline',
		data: [{{$DEPtype_p5_R[0]}}, {{$DEPtype_p5_R[1]}}, {{$DEPtype_p5_R[2]}}, {{$DEPtype_p5_R[3]}}, {{$DEPtype_p5_R[4]}}, {{$DEPtype_p5_R[5]}}],		
        tooltip: {
            valueSuffix: '%'
        }
    },
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}期末退學人數所佔比例',
        type: 'spline',
		data: [{{$DEPtype_p6_R[0]}}, {{$DEPtype_p6_R[1]}}, {{$DEPtype_p6_R[2]}}, {{$DEPtype_p6_R[3]}}, {{$DEPtype_p6_R[4]}}, {{$DEPtype_p6_R[5]}}],		
        tooltip: {
            valueSuffix: '%'
        }
    }]
});

Highcharts.chart('suspend-other-p', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '休學與其它狀態'
    },
    xAxis: [{
        categories: ['{{$semesters[0]}}', '{{$semesters[1]}}', '{{$semesters[2]}}', '{{$semesters[3]}}', '{{$semesters[4]}}', '{{$semesters[5]}}'],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}%',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: '百分比',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: '人數',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    series: [	
	{
		showInLegend: false,
        name: '{{$dep_name}}休學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEP_p4[0]}}, {{$DEP_p4[1]}}, {{$DEP_p4[2]}}, {{$DEP_p4[3]}}, {{$DEP_p4[4]}}, {{$DEP_p4[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    },
	{
		showInLegend: false,
        name: '{{$dep_name}}其它狀態人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEP_po[0]}}, {{$DEP_po[1]}}, {{$DEP_po[2]}}, {{$DEP_po[3]}}, {{$DEP_po[4]}}, {{$DEP_po[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    },	
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}休學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_p4[0]}}, {{$DEPtype_p4[1]}}, {{$DEPtype_p4[2]}}, {{$DEPtype_p4[3]}}, {{$DEPtype_p4[4]}}, {{$DEPtype_p4[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}其它狀態人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_po[0]}}, {{$DEPtype_po[1]}}, {{$DEPtype_po[2]}}, {{$DEPtype_po[3]}}, {{$DEPtype_po[4]}}, {{$DEPtype_po[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$dep_name}}休學人數所佔比例',
        type: 'spline',
		data: [{{$DEP_p4_R[0]}}, {{$DEP_p4_R[1]}}, {{$DEP_p4_R[2]}}, {{$DEP_p4_R[3]}}, {{$DEP_p4_R[4]}}, {{$DEP_p4_R[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    },
	{
		showInLegend: false,
        name: '{{$dep_name}}其它狀態人數所佔比例',
        type: 'spline',
		data: [{{$DEP_po_R[0]}}, {{$DEP_po_R[1]}}, {{$DEP_po_R[2]}}, {{$DEP_po_R[3]}}, {{$DEP_po_R[4]}}, {{$DEP_po_R[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    },	
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}休學人數所佔比例',
        type: 'spline',
		data: [{{$DEPtype_p4_R[0]}}, {{$DEPtype_p4_R[1]}}, {{$DEPtype_p4_R[2]}}, {{$DEPtype_p4_R[3]}}, {{$DEPtype_p4_R[4]}}, {{$DEPtype_p4_R[5]}}],		
        tooltip: {
            valueSuffix: '%'
        }
    },
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}其它狀態人數所佔比例',
        type: 'spline',
		data: [{{$DEPtype_po_R[0]}}, {{$DEPtype_po_R[1]}}, {{$DEPtype_po_R[2]}}, {{$DEPtype_po_R[3]}}, {{$DEPtype_po_R[4]}}, {{$DEPtype_po_R[5]}}],		
        tooltip: {
            valueSuffix: '%'
        }
    }]
});
}

/*碩班*/
@elseif ($degree == 2){
Highcharts.chart('inschool-m', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '在學'
    },
    subtitle: {
        text: 'Source: NCTU'
    },
    xAxis: [{
        categories: ['{{$semesters[0]}}', '{{$semesters[1]}}', '{{$semesters[2]}}', '{{$semesters[3]}}', '{{$semesters[4]}}', '{{$semesters[5]}}'],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}%',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: '百分比',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: '人數',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    series: [
	{
		showInLegend: false,
        name: '{{$dep_name}}新生人數',
        type: 'column',
        yAxis: 1,
		data: [{{$DEP_new_m[0]}}, {{$DEP_new_m[1]}}, {{$DEP_new_m[2]}}, {{$DEP_new_m[3]}}, {{$DEP_new_m[4]}}, {{$DEP_new_m[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}新生人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_new_m[0]}}, {{$DEPtype_new_m[1]}}, {{$DEPtype_new_m[2]}}, {{$DEPtype_new_m[3]}}, {{$DEPtype_new_m[4]}}, {{$DEPtype_new_m[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$dep_name}}仍在學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEP_m1[0]}}, {{$DEP_m1[1]}}, {{$DEP_m1[2]}}, {{$DEP_m1[3]}}, {{$DEP_m1[4]}}, {{$DEP_m1[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}仍在學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_m1[0]}}, {{$DEPtype_m1[1]}}, {{$DEPtype_m1[2]}}, {{$DEPtype_m1[3]}}, {{$DEPtype_m1[4]}}, {{$DEPtype_m1[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$dep_name}}仍在學人數所佔比例',
        type: 'spline',
		data: [{{$DEP_m1_R[0]}}, {{$DEP_m1_R[1]}}, {{$DEP_m1_R[2]}}, {{$DEP_m1_R[3]}}, {{$DEP_m1_R[4]}}, {{$DEP_m1_R[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}仍在學人數所佔比例',
        type: 'spline',
		data: [{{$DEPtype_m1_R[0]}}, {{$DEPtype_m1_R[1]}}, {{$DEPtype_m1_R[2]}}, {{$DEPtype_m1_R[3]}}, {{$DEPtype_m1_R[4]}}, {{$DEPtype_m1_R[5]}}],		
        tooltip: {
            valueSuffix: '%'
        }
    }]
});

Highcharts.chart('graduation-m', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '畢業'
    },
    xAxis: [{
        categories: ['{{$semesters[0]}}', '{{$semesters[1]}}', '{{$semesters[2]}}', '{{$semesters[3]}}', '{{$semesters[4]}}', '{{$semesters[5]}}'],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}%',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: '百分比',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: '人數',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    series: [	
	{
		showInLegend: false,
        name: '{{$dep_name}}畢業人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEP_m11[0]}}, {{$DEP_m11[1]}}, {{$DEP_m11[2]}}, {{$DEP_m11[3]}}, {{$DEP_m11[4]}}, {{$DEP_m11[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}畢業人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_m11[0]}}, {{$DEPtype_m11[1]}}, {{$DEPtype_m11[2]}}, {{$DEPtype_m11[3]}}, {{$DEPtype_m11[4]}}, {{$DEPtype_m11[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$dep_name}}畢業人數所佔比例',
        type: 'spline',
		data: [{{$DEP_m11_R[0]}}, {{$DEP_m11_R[1]}}, {{$DEP_m11_R[2]}}, {{$DEP_m11_R[3]}}, {{$DEP_m11_R[4]}}, {{$DEP_m11_R[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}仍在學人數所佔比例',
        type: 'spline',
		data: [{{$DEPtype_m11_R[0]}}, {{$DEPtype_m11_R[1]}}, {{$DEPtype_m11_R[2]}}, {{$DEPtype_m11_R[3]}}, {{$DEPtype_m11_R[4]}}, {{$DEPtype_m11_R[5]}}],		
        tooltip: {
            valueSuffix: '%'
        }
    }]
});

Highcharts.chart('drop-m', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '期中與期末退學'
    },
    xAxis: [{
        categories: ['{{$semesters[0]}}', '{{$semesters[1]}}', '{{$semesters[2]}}', '{{$semesters[3]}}', '{{$semesters[4]}}', '{{$semesters[5]}}'],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}%',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: '百分比',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: '人數',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    series: [	
	{
		showInLegend: false,
        name: '{{$dep_name}}期中退學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEP_m5[0]}}, {{$DEP_m5[1]}}, {{$DEP_m5[2]}}, {{$DEP_m5[3]}}, {{$DEP_m5[4]}}, {{$DEP_m5[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    },
	{
		showInLegend: false,
        name: '{{$dep_name}}期末退學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEP_m6[0]}}, {{$DEP_m6[1]}}, {{$DEP_m6[2]}}, {{$DEP_m6[3]}}, {{$DEP_m6[4]}}, {{$DEP_m6[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    },	
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}期中退學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_m5[0]}}, {{$DEPtype_m5[1]}}, {{$DEPtype_m5[2]}}, {{$DEPtype_m5[3]}}, {{$DEPtype_m5[4]}}, {{$DEPtype_m5[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}期末退學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_m6[0]}}, {{$DEPtype_m6[1]}}, {{$DEPtype_m6[2]}}, {{$DEPtype_m6[3]}}, {{$DEPtype_m6[4]}}, {{$DEPtype_m6[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$dep_name}}期中退學人數所佔比例',
        type: 'spline',
		data: [{{$DEP_m5_R[0]}}, {{$DEP_m5_R[1]}}, {{$DEP_m5_R[2]}}, {{$DEP_m5_R[3]}}, {{$DEP_m5_R[4]}}, {{$DEP_m5_R[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    },
	{
		showInLegend: false,
        name: '{{$dep_name}}期末退學人數所佔比例',
        type: 'spline',
		data: [{{$DEP_m6_R[0]}}, {{$DEP_m6_R[1]}}, {{$DEP_m6_R[2]}}, {{$DEP_m6_R[3]}}, {{$DEP_m6_R[4]}}, {{$DEP_m6_R[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    },	
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}期中退學人數所佔比例',
        type: 'spline',
		data: [{{$DEPtype_m5_R[0]}}, {{$DEPtype_m5_R[1]}}, {{$DEPtype_m5_R[2]}}, {{$DEPtype_m5_R[3]}}, {{$DEPtype_m5_R[4]}}, {{$DEPtype_m5_R[5]}}],		
        tooltip: {
            valueSuffix: '%'
        }
    },
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}期末退學人數所佔比例',
        type: 'spline',
		data: [{{$DEPtype_m6_R[0]}}, {{$DEPtype_m6_R[1]}}, {{$DEPtype_m6_R[2]}}, {{$DEPtype_m6_R[3]}}, {{$DEPtype_m6_R[4]}}, {{$DEPtype_m6_R[5]}}],		
        tooltip: {
            valueSuffix: '%'
        }
    }]
});

Highcharts.chart('suspend-other-m', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '休學與其它狀態'
    },
    xAxis: [{
        categories: ['{{$semesters[0]}}', '{{$semesters[1]}}', '{{$semesters[2]}}', '{{$semesters[3]}}', '{{$semesters[4]}}', '{{$semesters[5]}}'],
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}%',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: '百分比',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: '人數',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    series: [	
	{
		showInLegend: false,
        name: '{{$dep_name}}休學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEP_m4[0]}}, {{$DEP_m4[1]}}, {{$DEP_m4[2]}}, {{$DEP_m4[3]}}, {{$DEP_m4[4]}}, {{$DEP_m4[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    },
	{
		showInLegend: false,
        name: '{{$dep_name}}其它狀態人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEP_mo[0]}}, {{$DEP_mo[1]}}, {{$DEP_mo[2]}}, {{$DEP_mo[3]}}, {{$DEP_mo[4]}}, {{$DEP_mo[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    },	
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}休學人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_m4[0]}}, {{$DEPtype_m4[1]}}, {{$DEPtype_m4[2]}}, {{$DEPtype_m4[3]}}, {{$DEPtype_m4[4]}}, {{$DEPtype_m4[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}其它狀態人數',
        type: 'column',
        yAxis: 1,
        data: [{{$DEPtype_mo[0]}}, {{$DEPtype_mo[1]}}, {{$DEPtype_mo[2]}}, {{$DEPtype_mo[3]}}, {{$DEPtype_mo[4]}}, {{$DEPtype_mo[5]}}],
        tooltip: {
            valueDecimals: 0			
        }
    }, 
	{
		showInLegend: false,
        name: '{{$dep_name}}休學人數所佔比例',
        type: 'spline',
		data: [{{$DEP_m4_R[0]}}, {{$DEP_m4_R[1]}}, {{$DEP_m4_R[2]}}, {{$DEP_m4_R[3]}}, {{$DEP_m4_R[4]}}, {{$DEP_m4_R[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    },
	{
		showInLegend: false,
        name: '{{$dep_name}}其它狀態人數所佔比例',
        type: 'spline',
		data: [{{$DEP_mo_R[0]}}, {{$DEP_mo_R[1]}}, {{$DEP_mo_R[2]}}, {{$DEP_mo_R[3]}}, {{$DEP_mo_R[4]}}, {{$DEP_mo_R[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    },	
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}休學人數所佔比例',
        type: 'spline',
		data: [{{$DEPtype_m4_R[0]}}, {{$DEPtype_m4_R[1]}}, {{$DEPtype_m4_R[2]}}, {{$DEPtype_m4_R[3]}}, {{$DEPtype_m4_R[4]}}, {{$DEPtype_m4_R[5]}}],		
        tooltip: {
            valueSuffix: '%'
        }
    },
	{
		showInLegend: false,
        name: '{{$enrolltype_c}}其它狀態人數所佔比例',
        type: 'spline',
		data: [{{$DEPtype_mo_R[0]}}, {{$DEPtype_mo_R[1]}}, {{$DEPtype_mo_R[2]}}, {{$DEPtype_mo_R[3]}}, {{$DEPtype_mo_R[4]}}, {{$DEPtype_mo_R[5]}}],		
        tooltip: {
            valueSuffix: '%'
        }
    }]
});
}
@endif

</script>
@endsection
@endsection

