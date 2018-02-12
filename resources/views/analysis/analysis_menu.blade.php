@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header" style="background-color:#D1E9E9;">
					<div class="panel-title">NCTU碩博士生分析</div>
				</div>
				
				<div class="content-box-large box-with-header">
					<table class="table table-striped">
						<tr>
							<td align="center">1</td>
							<td align="left"><a href="{{ url('/analysis/_source') }}">近6年碩博士生生源調查</a></td>
						</tr>
						<tr>
							<td align="center">2</td>
							<td align="left"><a href="{{ url('/analysis/_status') }}">101-106學年度各種入學管道之修業狀況</a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

