@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title">2015年交大校務資訊摘要</div>
				</div>
  				<div class="content-box-large box-with-header">

  				<div class="panel-body">
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
						<tbody>
							<tr>
								<td width="10%" align="center">表格編號</td>
								<td width="65%" align="center">表格名稱</td>
								<td width="10%" align="center">學年度</td>
								<td width="5%" align="center">pdf</td>
								<td width="5%" align="center">xlsx</td>
								<td width="5%" align="center">ods</td>
							</tr>
							
							<tr>
								<td colspan="6" bgcolor="PowderBlue">壹、校務</td>
							</tr>
							@foreach($organize as $index=>$r)
								<tr>
									<td width="10%" align="center">{{$index+1}}</td>
									<td width="65%">{{$r->name}}</td>
									<td width="10%" align="center">{{$r->info}}</td>
									<td width="5%" align="center"><a href={{$r->file.".pdf"}}><i class="glyphicon glyphicon-eye-open"></i></a></td>
									<td width="5%" align="center"><a href={{$r->file.".xlsx"}}><i class="glyphicon glyphicon-download"></i></a></td>
									<td width="5%" align="center"><a href={{$r->file.".ods"}}><i class="glyphicon glyphicon-download"></i></a></td>
								</tr>
							@endforeach
							
							<tr>
								<td colspan="6" bgcolor="PowderBlue">貳、教師</td>
							</tr>
							@foreach($teacher as $index=>$r)
								<tr>
									<td width="10%" align="center">{{$index+1}}</td>
									<td width="65%">{{$r->name}}</td>
									<td width="10%" align="center">{{$r->info}}</td>
									<td width="5%" align="center"><a href={{$r->file.".pdf"}}><i class="glyphicon glyphicon-eye-open"></i></a></td>
									<td width="5%" align="center"><a href={{$r->file.".xlsx"}}><i class="glyphicon glyphicon-download"></i></a></td>
									<td width="5%" align="center"><a href={{$r->file.".ods"}}><i class="glyphicon glyphicon-download"></i></a></td>
								</tr>
							@endforeach
							
							<tr>
								<td colspan="6" bgcolor="PowderBlue">參、學生</td>
							</tr>
							@foreach($student as $index=>$r)
								<tr>
									<td width="10%" align="center">{{$index+1}}</td>
									<td width="65%">{{$r->name}}</td>
									<td width="10%" align="center">{{$r->info}}</td>
									<td width="5%" align="center"><a href={{$r->file.".pdf"}}><i class="glyphicon glyphicon-eye-open"></i></a></td>
									<td width="5%" align="center"><a href={{$r->file.".xlsx"}}><i class="glyphicon glyphicon-download"></i></a></td>
									<td width="5%" align="center"><a href={{$r->file.".ods"}}><i class="glyphicon glyphicon-download"></i></a></td>
								</tr>
							@endforeach
							
							<tr>
								<td colspan="6" bgcolor="PowderBlue">肆、研究</td>
							</tr>
							@foreach($research as $index=>$r)
								<tr>
									<td width="10%" align="center">{{$index+1}}</td>
									<td width="65%">{{$r->name}}</td>
									<td width="10%" align="center">{{$r->info}}</td>
									<td width="5%" align="center"><a href={{$r->file.".pdf"}}><i class="glyphicon glyphicon-eye-open"></i></a></td>
									<td width="5%" align="center"><a href={{$r->file.".xlsx"}}><i class="glyphicon glyphicon-download"></i></a></td>
									<td width="5%" align="center"><a href={{$r->file.".ods"}}><i class="glyphicon glyphicon-download"></i></a></td>
								</tr>
							@endforeach
							
							<tr>
								<td colspan="6" bgcolor="PowderBlue">伍、財務</td>
							</tr>
							@foreach($financial as $index=>$r)
								<tr>
									<td width="10%" align="center">{{$index+1}}</td>
									<td width="65%">{{$r->name}}</td>
									<td width="10%" align="center">{{$r->info}}</td>
									<td width="5%" align="center"><a href={{$r->file.".pdf"}}><i class="glyphicon glyphicon-eye-open"></i></a></td>
									<td width="5%" align="center"><a href={{$r->file.".xlsx"}}><i class="glyphicon glyphicon-download"></i></a></td>
									<td width="5%" align="center"><a href={{$r->file.".ods"}}><i class="glyphicon glyphicon-download"></i></a></td>
								</tr>
							@endforeach
							
							<tr>
								<td colspan="6" bgcolor="PowderBlue">陸、職員</td>
							</tr>
							@foreach($staff as $index=>$r)
								<tr>
									<td width="10%" align="center">{{$index+1}}</td>
									<td width="65%">{{$r->name}}</td>
									<td width="10%" align="center">{{$r->info}}</td>
									<td width="5%" align="center"><a href={{$r->file.".pdf"}}><i class="glyphicon glyphicon-eye-open"></i></a></td>
									<td width="5%" align="center"><a href={{$r->file.".xlsx"}}><i class="glyphicon glyphicon-download"></i></a></td>
									<td width="5%" align="center"><a href={{$r->file.".ods"}}><i class="glyphicon glyphicon-download"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					</div>
					</div>
					</div>
					</div>
					</div>
@endsection