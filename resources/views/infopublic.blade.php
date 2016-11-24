@extends('layouts.white')
@section('content')
	<div class="col-md-10">		  	
		  	<div class="row">
  			<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title"><h2>校務及財務資訊公開內容架構</h2></div>
				</div>
  				<div class="panel-body">
  					<table width="60%" border=1>
						<tr>
							<td><font face="DFKai-sb" color="black" size="4"><center><b>校務資訊系統說明</b></center></td>
					　　	<td><table>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/ir_sys/ir_sys1') }}" style="color:black;">1.學校沿革</a></font></td>
								</tr>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/ir_sys/ir_sys2') }}" style="color:black;">2.組織架構</a></font></td>
								</tr>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/ir_sys/ir_sys3') }}" style="color:black;">3.基本數據及趨勢</a></font></td>
								</tr>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/ir_sys/ir_sys4') }}" style="color:black;">4.學校特色與發展願景</a></font></td>
								</tr>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/ir_sys/ir_sys5') }}" style="color:black;">5.學校績效表現</a></font></td>
								</tr>
							</table>							
						</tr>
						<tr>
							<td><font face="DFKai-sb" color="black" size="4"><center><b>財務資訊分析</b></center></td>
					　　	<td><table>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/fund/fund1') }}" style="color:black;">1.學校收入支出分析</a></font></td>
								</tr>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/fund/fund2') }}" style="color:black;">2.學雜費與就學輔助資訊</a></font></td>
								</tr>
							</table>							
						</tr>
						<tr>
							<td><font face="DFKai-sb" color="black" size="4"><center><b>學雜費調整之規劃與審議程序</b></center></td>
					　　	<td><table>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/fee/fee1') }}" style="color:black;">1.學雜費調整之用途規劃說明</a></font></td>
								</tr>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/fee/fee2') }}" style="color:black;">2.學雜費調整校內審議程序說明</a></font></td>
								</tr>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/fee/fee3') }}" style="color:black;">3.其他補充說明</a></font></td>
								</tr>
							</table>							
						</tr>
						<tr>
							<td><font face="DFKai-sb" color="black" size="4"><center><b>學校其他重要資訊</b></center></td>
					　　	<td><table>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/oth_info/oth_info1') }}" style="color:black;">1.預算編審程序</a></font></td>
								</tr>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/oth_info/oth_info2') }}" style="color:black;">2.會計師查核報告</a></font></td>
								</tr>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/oth_info/oth_info3') }}" style="color:black;">3.學校採購及處分重大資產情形</a></font></td>
								</tr>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/oth_info/oth_info4') }}" style="color:black;">4.開課與師資資訊</a></font></td>
								</tr>
								<tr>
									<td><font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/oth_info/oth_info5') }}" style="color:black;">5.其他</a></font></td>
								</tr>
							</table>							
						</tr>										
					</table> 
					<font face="DFKai-sb" color="black" size="4"><a href="{{ url('/info_public/contact') }}">分工表及聯絡資訊</a></font>
				</div>
  			</div>
  			</div>
  	</div>
@endsection