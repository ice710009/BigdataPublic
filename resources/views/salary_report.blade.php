@extends('layouts.white')
@section('content')
	<div class="col-md-10">
  			<div class="content-box-large">
  				<div class="panel-heading">
					<a href="{{ url('/SalaryReport/NCTU_99-100_salary_report.pdf') }}"><i class="glyphicon glyphicon-download-alt"></i></a>
					<div class="panel-title"><font face="DFKai-sb" color="black" size="5">國立交通大學99-101學年度畢業生流向與薪資報告</font></div>
				</div>
  				<div class="panel-body">
  					<iframe style="width:100%;height:800px;" src="/SalaryReport/NCTU_99-100_salary_report.pdf"></iframe>
  				</div>
  			</div>
  	</div>
@endsection