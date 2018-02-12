@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title">NCTU碩博士生調查</div>
				</div>
  				<div class="content-box-large box-with-header">
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
						<h3>碩士</h3>
						<table class="table table-striped">
							<thead>
							<tr>
								<td rowspan="2" align="center">學年度</td>
								<td rowspan="2" align="center">新生人數<br>A</td>
								<td rowspan="2" align="center">甄試入學</td>
								<td rowspan="2" align="center">考試入學</td>
								<td rowspan="2" align="center">大學畢業於交大<br>且甄試入學之新生</td>
								<td rowspan="2" align="center">大學畢業於台成清<br>且甄試入學之新生</td>
								<td rowspan="2" align="center">大學畢業於交大<br>且考試入學之新生</td>
								<td rowspan="2" align="center">大學畢業於台成清<br>且考試入學之新生</td>
								<td rowspan="2" align="center">碩士新生大學畢業於交大<br>且畢業排名為前50%之學生人數<br>B</td>
								<td rowspan="2" align="center">本校優秀學生<br>攻讀碩士班比率<br>B/A</td>
							</tr> 
							</thead>
							<tbody>
							@foreach($semesters as $i=>$semester)
								<tr>
									<td align="center">{{$semester}}</td>
									<td align="center">{{$NCTU_new_m[$i]}}</td>
									<td align="center">{{$NCTU_new_m_reco[$i]}}</td>
									<td align="center">{{$NCTU_new_m_exam[$i]}}</td>
									<td align="center">{{$NCTU_new_m_reco_fromN[$i]}}</td>
									<td align="center">{{$NCTU_new_m_reco_from3[$i]}}</td>
									<td align="center">{{$NCTU_new_m_exam_fromN[$i]}}</td>
									<td align="center">{{$NCTU_new_m_exam_from3[$i]}}</td>
									<td align="center">{{$NCTU_new_m_fromN_pre50[$i]}}</td>
									<td align="center">{{round($NCTU_new_m_fromN_pre50[$i]/$NCTU_new_m[$i],4)*100}}%</td>
								</tr>  
							@endforeach
							</tbody>
						</table>
						<h3>博士</h3>
						<table class="table table-striped">
							<thead>
							<tr>
								<td rowspan="2" align="center">學年度</td>
								<td rowspan="2" align="center">新生人數<br>N</td>
								<td rowspan="2" align="center">甄試入學</td>
								<td rowspan="2" align="center">考試入學</td>
								<td rowspan="2" align="center">學士逕博<br>U</td>
								<td rowspan="2" align="center">碩士逕博<br>M</td>
								<td rowspan="2" align="center">碩士畢業於交大<br>且甄試入學之新生</td>
								<td rowspan="2" align="center">碩士畢業於台成清<br>且甄試入學之新生</td>
								<td rowspan="2" align="center">碩士畢業於交大<br>且考試入學之新生</td>
								<td rowspan="2" align="center">碩士畢業於台成清<br>且考試入學之新生</td>
								<td rowspan="2" align="center">博士新生碩士畢業於交大<br>且畢業排名為前50%之學生人數<br>P</td>
								<td rowspan="2" align="center">本校優秀學生<br>攻讀博士班比率<br>(U+M+P)/N</td>
							</tr> 
							</thead>
							<tbody>
							@foreach($semesters as $i=>$semester)
								<tr>
									<td align="center">{{$semester}}</td>
									<td align="center">{{$NCTU_new_p[$i]}}</td>
									<td align="center">{{$NCTU_new_p_reco[$i]}}</td>
									<td align="center">{{$NCTU_new_p_exam[$i]}}</td>
									<td align="center">{{$NCTU_new_p_u2p[$i]}}</td>
									<td align="center">{{$NCTU_new_p_m2p[$i]}}</td>
									<td align="center">{{$NCTU_new_p_reco_fromN[$i]}}</td>
									<td align="center">{{$NCTU_new_p_reco_from3[$i]}}</td>
									<td align="center">{{$NCTU_new_p_exam_fromN[$i]}}</td>
									<td align="center">{{$NCTU_new_p_exam_from3[$i]}}</td>
									<td align="center">{{$NCTU_new_p_fromN_pre50[$i]}}</td>
									<td align="center">{{round(($NCTU_new_p_u2p[$i] + $NCTU_new_p_m2p[$i] + $NCTU_new_p_fromN_pre50[$i])/$NCTU_new_p[$i],4)*100}}%</td>
								</tr>  
							@endforeach
							
							</tbody>
						</table>
						<h4>*學士、碩士畢業生不限定為應屆畢業生</h4>
						<h4>*97學年度之前的畢業生無畢業排名紀錄</h4>
					@endif
					
					@if($degree == '2')
					<!--碩班-->
					<table class="table table-striped">
						<thead>
                        <tr>
                            <td rowspan="2" align="center">學年度</td>
							<td rowspan="2" align="center">入學年月</td>
							<td rowspan="2" align="center">新生人數<br>(N)</td>
							<td rowspan="2" align="center">甄試入學碩士新生<br>(R)</td>
							<td rowspan="2" align="center">考試入學碩士新生</td>
							<td rowspan="2" align="center">考試入學碩生且大學為交大畢業</td>
							@if($related_no != 0)
							<td rowspan="2">考試入學碩生且大學為交大{{$related_name}}<br>(Z)</td>
							<td colspan="7" align="center">甄試入學碩士新生大學畢業自交大{{$related_name}}之畢業總成績</td>
							<td rowspan="2">交大{{$related_name}}前20%+逕博佔當年度甄試錄取{{$dep_name}}新生比率<br>(C+M)/R</td>
							<td rowspan="2">交大{{$related_name}}前50%+逕博佔當年度甄試錄取{{$dep_name}}新生比率<br>(E+M)/R</td>
							<td rowspan="2">交大{{$related_name}}前50%+逕博佔當年度{{$dep_name}}新生比率<br>(E+M)/N</td>
							<td rowspan="2">交大{{$related_name}}後50%攻讀{{$dep_name}}佔當年度甄試錄取新生比率<br>F/R</td>
							<td rowspan="2">交大{{$related_name}}畢業生留校攻讀{{$dep_name}}佔當年度碩士新生比率<br>(G+Z+M)/N</td>
							<td>{{$related_name}}大學部學生</td>
							@endif
                        </tr> 
						@if($related_no != 0)
						<tr>
							<td align="center">~10%<br>(A)</td>
							<td align="center">11%-20%<br>(B)</td>
							<td align="center">小計(C=A+B)</td>
							<td align="center">21%-50%<br>(D)</td>
							<td align="center">小計<br>(E=C+D)</td>
							<td align="center">51%~<br>(F)</td>
							<td align="center">小計<br>(G=E+F)</td>
							<td>逕博<br>(M)</td>
                        </tr>  
						@endif
						</thead>
						<tbody>
						@foreach($semesters as $i=>$semester)
							<tr>
								<td align="center">{{$semester}}</td>
								<td align="center">{{$terms[$i]}}</td>
								<td align="right">{{$new[$i]}}</td>
								<td align="right">{{$m_new_reco[$i]}}</td>
								<td align="right">{{$m_new_exam[$i]}}</td>
								<td align="right">{{$m_new_exam_UfromNCTU[$i]}}</td>
								@if($related_no != 0)
								<td align="right">{{$m_new_exam_UfromNCTU_R[$i]}}</td>
								<td align="right">{{$m_new_reco_10[$i]}}</td>
								<td align="right">{{$m_new_reco_1120[$i]}}</td>
								<td align="right">{{$m_new_reco_10[$i] + $m_new_reco_1120[$i]}}</td>
								<td align="right">{{$m_new_reco_2150[$i]}}</td>
								<td align="right">{{$m_new_reco_10[$i] + $m_new_reco_1120[$i] + $m_new_reco_2150[$i]}}</td>
								<td align="right">{{$m_new_reco_51[$i]}}</td>
								<td align="right">{{$m_new_reco_10[$i] + $m_new_reco_1120[$i] + $m_new_reco_2150[$i] + $m_new_reco_51[$i]}}</td>
								<td align="right">{{round(($m_new_reco_10[$i] + $m_new_reco_1120[$i] + $m_new_u2p[$i])/$m_new_reco[$i],4)*100}}%</td>
								<td align="right">{{round(($m_new_reco_10[$i] + $m_new_reco_1120[$i] + $m_new_reco_2150[$i] + $m_new_u2p[$i])/$m_new_reco[$i],4)*100}}%</td>
								<td align="right">{{round(($m_new_reco_10[$i] + $m_new_reco_1120[$i] + $m_new_reco_2150[$i] + $m_new_u2p[$i])/$new[$i],4)*100}}%</td>
								<td align="right">{{round($m_new_reco_51[$i]/$m_new_reco[$i],4)*100}}%</td>
								<td align="right">{{round(($m_new_exam_UfromNCTU_R[$i] + $m_new_reco_10[$i] + $m_new_reco_1120[$i] + $m_new_reco_2150[$i] + $m_new_reco_51[$i] + $m_new_u2p[$i])/$new[$i],4)*100}}%</td>
								<td align="right">{{$m_new_u2p[$i]}}</td>
								@endif
							</tr>  
						@endforeach
						</tbody>
  					</table>
					
					@elseif($degree == '1')
					<!--博班-->
  					<table class="table table-striped">
						<thead>
                        <tr>
                            <td rowspan="2">學年度</td>
							<td rowspan="2">新生人數<br>(A)</td>
							<td rowspan="2">考試入學人數</td>
							<td rowspan="2">甄試入學人數</td>
							<td rowspan="2">碩士逕博人數</td>
							<td rowspan="2">學士逕博人數</td>
							<td rowspan="2">交大碩士生繼續博士人數</td>
							<td colspan="2" align="center">前一學歷為台成清交學生</td>
							<td colspan="2" align="center">大學為交大學生(科系不拘)</td>
							<td colspan="2" align="center">大學為交大且畢業總成績為全系前20%</td>
                        </tr> 
						<tr>
							<td align="right">人數<br>(B)</td>
							<td align="right">佔總人數比<br>(B/A)</td>
							<td align="right">人數<br>(C)</td>
							<td align="right">佔總人數比<br>(C/A)</td>
							<td align="right">人數<br>(D)</td>
							<td align="right">佔總人數比<br>(D/A)</td>
                        </tr>  
						</thead>
						<tbody>
						@foreach($semesters as $i=>$semester)
							<tr>
								<td align="right">{{$semester}}</td>
								<td align="right">{{$new[$i]}}</td>
								<td align="right">{{$p_new_exam[$i]}}</td>
								<td align="right">{{$p_new_reco[$i]}}</td>
								<td align="right">{{$p_new_m2p[$i]}}</td>
								<td align="right">{{$p_new_u2p[$i]}}</td>
								<td align="right">{{$p_new_nctuM2P[$i]}}</td>
								<td align="right">{{$p_new_4U[$i] + $p_new_m2p[$i] + $p_new_u2p[$i]}}</td>
								<td align="right">@if($new[$i] == 0){{$new[$i]}}% @else{{round((($p_new_4U[$i] + $p_new_m2p[$i] + $p_new_u2p[$i])/$new[$i])*100,2)}}% @endif</td>
								<td align="right">{{$p_new_nctuU[$i]}}</td>
								<td align="right">@if($new[$i] == 0){{$new[$i]}}% @else{{round(($p_new_nctuU[$i]/$new[$i])*100,2)}}% @endif</td>
								<td align="right">{{$p_new_nctuU20[$i]}}</td>
								<td align="right">@if($new[$i] == 0){{$new[$i]}}% @else{{round(($p_new_nctuU20[$i]/$new[$i])*100,2)}}% @endif</td>
							</tr>  
						@endforeach
						</tbody>
  					</table>
					
					@elseif($degree == '3')
					<!--學院-->
  						<h3>碩士</h3>
						<table class="table table-striped">
							<thead>
							<tr>
								<td rowspan="2" align="center">學<br>年<br>度</td>
								<td rowspan="2" align="center">新生<br>人數<br>A</td>
								<td rowspan="2" align="center">甄試<br>入學</td>
								<td rowspan="2" align="center">考試<br>入學</td>
								<td rowspan="2" align="center">大學畢業於交大<br>相同學院且甄試入學之新生</td>
								<td rowspan="2" align="center">大學畢業於交大<br>不同學院且甄試入學之新生</td>
								<td rowspan="2" align="center">大學畢業於<br>台成清且甄試入學之新生</td>
								<td rowspan="2" align="center">大學畢業於交大<br>相同學院且考試入學之新生</td>
								<td rowspan="2" align="center">大學畢業於交大<br>不同學院且考試入學之新生</td>
								<td rowspan="2" align="center">大學畢業於<br>台成清且考試入學之新生</td>
								<td rowspan="2" align="center">碩士新生大學<br>畢業於本學院<br>且畢業排名為前50%之學生人數<br>B</td>
								<td rowspan="2" align="center">本學院優秀學生<br>攻讀本學院碩士班比率<br>B/A</td>
								<td rowspan="2" align="center">大學畢業於本學院<br>攻讀其他學院碩士班人數</td>
							</tr> 
							</thead>
							<tbody>
							@foreach($semesters as $i=>$semester)
								<tr>
									<td align="center">{{$semester}}</td>
									<td align="center">{{$ACA_new_m[$i]}}</td>
									<td align="center">{{$ACA_new_m_reco[$i]}}</td>
									<td align="center">{{$ACA_new_m_exam[$i]}}</td>
									<td align="center">{{$ACA_new_m_reco_fromS[$i]}}</td>
									<td align="center">{{$ACA_new_m_reco_fromD[$i]}}</td>
									<td align="center">{{$ACA_new_m_reco_from3[$i]}}</td>
									<td align="center">{{$ACA_new_m_exam_fromS[$i]}}</td>
									<td align="center">{{$ACA_new_m_exam_fromD[$i]}}</td>
									<td align="center">{{$ACA_new_m_exam_from3[$i]}}</td>
									<td align="center">{{$ACA_new_m_fromS_pre50[$i]}}</td>
									@if($ACA_new_m[$i] != 0)
										<td align="center">{{round($ACA_new_m_fromS_pre50[$i]/$ACA_new_m[$i],4)*100}}%</td>
									@else
										<td align="center">{{$ACA_new_m[$i]}}%</td>
									@endif
									<td align="center">{{$ACA_U2Dm[$i]}}</td>
								</tr>  
							@endforeach
							</tbody>
						</table>
						<h3>博士</h3>
						<table class="table table-striped">
							<thead>
							<tr>
								<td rowspan="2" align="center">學<br>年<br>度</td>
								<td rowspan="2" align="center">新生<br>人數<br>N</td>
								<td rowspan="2" align="center">甄試<br>入學</td>
								<td rowspan="2" align="center">考試<br>入學</td>
								<td rowspan="2" align="center">學士<br>逕博<br>U</td>
								<td rowspan="2" align="center">碩士<br>逕博<br>M</td>
								<td rowspan="2" align="center">碩士畢業於交大<br>相同學院且甄試入學之新生</td>
								<td rowspan="2" align="center">碩士畢業於交大<br>不同學院且甄試入學之新生</td>
								<td rowspan="2" align="center">碩士畢業於<br>台成清且甄試入學之新生</td>
								<td rowspan="2" align="center">碩士畢業於交大<br>相同學院且考試入學之新生</td>
								<td rowspan="2" align="center">碩士畢業於交大<br>不同學院且考試入學之新生</td>
								<td rowspan="2" align="center">碩士畢業於<br>台成清且考試入學之新生</td>
								<td rowspan="2" align="center">碩士畢業於本學院<br>且畢業排名為前50%之學生人數<br>P</td>
								<td rowspan="2" align="center">本學院優秀碩士<br>生攻讀本學院博士班比率<br>(U+M+P)/N</td>
								<td rowspan="2" align="center">碩士畢業於本學<br>院攻讀其他學院博士班人數</td>
							</tr> 
							</thead>
							<tbody>
							@foreach($semesters as $i=>$semester)
								<tr>
									<td align="center">{{$semester}}</td>
									<td align="center">{{$ACA_new_p[$i]}}</td>
									<td align="center">{{$ACA_new_p_reco[$i]}}</td>
									<td align="center">{{$ACA_new_p_exam[$i]}}</td>
									<td align="center">{{$ACA_new_p_u2p[$i]}}</td>
									<td align="center">{{$ACA_new_p_m2p[$i]}}</td>
									<td align="center">{{$ACA_new_p_reco_fromS[$i]}}</td>
									<td align="center">{{$ACA_new_p_reco_fromD[$i]}}</td>
									<td align="center">{{$ACA_new_p_reco_from3[$i]}}</td>
									<td align="center">{{$ACA_new_p_exam_fromS[$i]}}</td>
									<td align="center">{{$ACA_new_p_exam_fromD[$i]}}</td>
									<td align="center">{{$ACA_new_p_exam_from3[$i]}}</td>
									<td align="center">{{$ACA_new_p_fromS_pre50[$i]}}</td>
									@if($ACA_new_p[$i] != 0)
										<td align="center">{{round(($ACA_new_p_u2p[$i] + $ACA_new_p_m2p[$i] + $ACA_new_p_fromS_pre50[$i])/$ACA_new_p[$i],4)*100}}%</td>
									@else
										<td align="center">{{$ACA_new_p[$i]}}%</td>
									@endif
									<td align="center">{{$ACA_M2Dp[$i]}}</td>
								</tr>  
							@endforeach
							
							</tbody>
						</table>
						<h4>*學士、碩士畢業生不限定為應屆畢業生</h4>
						<h4>*97學年度之前的畢業生無畢業排名紀錄</h4>
					@endif
					</div>
					
					<!--圖表-->
					@if($degree == '2' && $related_no != '0')
					<div class="panel-body">
						<div class="row">
							<div class="col-md-6">
								<div id="excellent_study20" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
							</div>
							<div class="col-md-6">
								<div id="excellent_study50" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div id="behind_study" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
							</div>
							<div class="col-md-6">
								<div id="graduate" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
							</div>
						</div>
					</div>
					@endif
  				</div>
  			</div>
  			</div>
  	</div>
@endsection

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
		window.location.href = baseURL + "?academe=" + $('#academe').val() + "&degree=" + $('#degree').val() + "&department=" + $('#department').val();
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
			url: "/analysis/get_departments",
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


/* 圖表區 */
Highcharts.chart('excellent_study20', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '交大{{$related_name}}前20%+逕博佔當年度甄試錄取{{$dep_name}}新生人數與比率'
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
	/*
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 100,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
	*/
    series: [{
		showInLegend: false,
        name: '人數',
        type: 'column',
        yAxis: 1,
        data: [{{$m_new_reco_10[0] + $m_new_reco_1120[0] + $m_new_u2p[0]}},
		       {{$m_new_reco_10[1] + $m_new_reco_1120[1] + $m_new_u2p[1]}},
			   {{$m_new_reco_10[2] + $m_new_reco_1120[2] + $m_new_u2p[2]}},
			   {{$m_new_reco_10[3] + $m_new_reco_1120[3] + $m_new_u2p[3]}},
			   {{$m_new_reco_10[4] + $m_new_reco_1120[4] + $m_new_u2p[4]}},
			   {{$m_new_reco_10[5] + $m_new_reco_1120[5] + $m_new_u2p[5]}}],
        tooltip: {
            valueDecimals: 0			
        }

    }, {
		showInLegend: false,
        name: '佔甄試新生比率',
        type: 'spline',
        data: [{{$excellent_study20[0]}},{{$excellent_study20[1]}},{{$excellent_study20[2]}},{{$excellent_study20[3]}},{{$excellent_study20[4]}},{{$excellent_study20[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    }, {
		showInLegend: false,
        name: '佔全部新生比率',
        type: 'spline',
        data: [{{$excellent20[0]}},{{$excellent20[1]}},{{$excellent20[2]}},{{$excellent20[3]}},{{$excellent20[4]}},{{$excellent20[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    }]
});

Highcharts.chart('excellent_study50', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '交大{{$related_name}}前50%+逕博佔當年度甄試錄取{{$dep_name}}新生人數與比率'
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
	/*
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 100,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
	*/
    series: [{
		showInLegend: false,
        name: '人數',
        type: 'column',
        yAxis: 1,
        data: [{{$m_new_reco_10[0] + $m_new_reco_1120[0] + $m_new_reco_2150[0] + $m_new_u2p[0]}},
		       {{$m_new_reco_10[1] + $m_new_reco_1120[1] + $m_new_reco_2150[1] + $m_new_u2p[1]}},
			   {{$m_new_reco_10[2] + $m_new_reco_1120[2] + $m_new_reco_2150[2] + $m_new_u2p[2]}},
			   {{$m_new_reco_10[3] + $m_new_reco_1120[3] + $m_new_reco_2150[3] + $m_new_u2p[3]}},
			   {{$m_new_reco_10[4] + $m_new_reco_1120[4] + $m_new_reco_2150[4] + $m_new_u2p[4]}},
			   {{$m_new_reco_10[5] + $m_new_reco_1120[5] + $m_new_reco_2150[5] + $m_new_u2p[5]}}],
        tooltip: {
            valueDecimals: 0			
        }

    }, {
		showInLegend: false,
        name: '佔甄試新生比率',
        type: 'spline',
        data: [{{$excellent_study50[0]}},{{$excellent_study50[1]}},{{$excellent_study50[2]}},{{$excellent_study50[3]}},{{$excellent_study50[4]}},{{$excellent_study50[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    }, {
		showInLegend: false,
        name: '佔全部新生比率',
        type: 'spline',
        data: [{{$excellent50[0]}},{{$excellent50[1]}},{{$excellent50[2]}},{{$excellent50[3]}},{{$excellent50[4]}},{{$excellent50[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    }]
});


Highcharts.chart('behind_study', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '交大{{$related_name}}後50%攻讀{{$dep_name}}佔當年度甄試錄取新生人數與比率'
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
	/*
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 100,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
	*/
    series: [{
		showInLegend: false,
        name: '人數',
        type: 'column',
        yAxis: 1,
        data: [{{$m_new_reco_51[0]}},{{$m_new_reco_51[1]}},{{$m_new_reco_51[2]}},{{$m_new_reco_51[3]}},{{$m_new_reco_51[4]}},{{$m_new_reco_51[5]}}],
        tooltip: {
            valueDecimals: 0
        }

    }, {
		showInLegend: false,
        name: '比例',
        type: 'spline',
        data: [{{$behind_study[0]}},{{$behind_study[1]}},{{$behind_study[2]}},{{$behind_study[3]}},{{$behind_study[4]}},{{$behind_study[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    }]
});

Highcharts.chart('graduate', {
    chart: {
        zoomType: 'xy'
    },
    title: {
        text: '交大{{$related_name}}畢業生留校攻讀{{$dep_name}}佔當年度碩士新生人數與比率'
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
	/*
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 100,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
	*/
    series: [{
		showInLegend: false,
        name: '人數',
        type: 'column',
        yAxis: 1,
        data: [{{$m_new_reco_10[0] + $m_new_reco_1120[0] + $m_new_reco_2150[0] + $m_new_u2p[0] + $m_new_exam_UfromNCTU_R[0]}},
		       {{$m_new_reco_10[1] + $m_new_reco_1120[1] + $m_new_reco_2150[1] + $m_new_u2p[1] + $m_new_exam_UfromNCTU_R[1]}},
			   {{$m_new_reco_10[2] + $m_new_reco_1120[2] + $m_new_reco_2150[2] + $m_new_u2p[2] + $m_new_exam_UfromNCTU_R[2]}},
			   {{$m_new_reco_10[3] + $m_new_reco_1120[3] + $m_new_reco_2150[3] + $m_new_u2p[3] + $m_new_exam_UfromNCTU_R[3]}},
			   {{$m_new_reco_10[4] + $m_new_reco_1120[4] + $m_new_reco_2150[4] + $m_new_u2p[4] + $m_new_exam_UfromNCTU_R[4]}},
			   {{$m_new_reco_10[5] + $m_new_reco_1120[5] + $m_new_reco_2150[5] + $m_new_u2p[5] + $m_new_exam_UfromNCTU_R[5]}}],
        tooltip: {
            valueDecimals: 0
        }

    }, {
		showInLegend: false,
        name: '比率',
        type: 'spline',
        data: [{{$graduate[0]}},{{$graduate[1]}},{{$graduate[2]}},{{$graduate[3]}},{{$graduate[4]}},{{$graduate[5]}}],
        tooltip: {
            valueSuffix: '%'
        }
    }]
});

</script>
@endsection