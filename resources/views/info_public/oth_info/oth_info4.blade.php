@extends('layouts.info_public')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title"><h2>開課與師資資訊</h2></div>
				</div>
  				<div class="panel-body">
					<font face="DFKai-sb" color="#9E0000" size="4">
					各學系所科學位學程、各學制、各年級入學年度課程規劃、<br>
					當學期實際開設課表及授課教師姓名及專長</font><br><br>
					<font face="DFKai-sb" color="#0000BD" size="5">(1) 課程時間表</font><br>
					<font face="DFKai-sb" color="#262626" size="4">（業務單位：課務組）</font><br>
					<font face="DFKai-sb" color="#262626" size="4"><a href="http://timetable.nctu.edu.tw/">
					http://timetable.nctu.edu.tw/</a></font><br><br><br>
					<font face="DFKai-sb" color="#0000BD" size="5">(2) 師資資訊/師資專長</font><br>
					<font face="DFKai-sb" color="#262626" size="4">（業務單位：人事室）</font><br>
  					<font face="DFKai-sb" color="#262626" size="4"><a href="{{ url('/info_public/oth_info/4-4-105.xlsx') }}">
					<i class="glyphicon glyphicon-download-alt"></i>專兼任教師暨學術專長明細表</a></font>					
				</div>
  			</div>
  			</div>
  	</div>
@endsection