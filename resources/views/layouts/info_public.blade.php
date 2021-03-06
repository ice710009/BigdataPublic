﻿<!DOCTYPE html>
<html>
  <head>
    <title>校務與財務資訊公開專區</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
    <!-- styles -->
    <link href="/css/styles.css" rel="stylesheet">

    <link href="/css/calendar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-7">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="{{ url('/infopublic') }}"><img src="/img/icon2.png"></img></a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li id="submenu1" class="submenu">
                    	<a href="#">
                    		<i class="glyphicon glyphicon-tasks"></i> 校務資訊系統說明
                    		<span class="caret pull-right"></span>
                    	</a>
                    	<ul>
                            <li>
                            	<a href="{{ url('/info_public/ir_sys/ir_sys1') }}">學校沿革</a>                            	
                            </li>
                            <li>
                                <a href="{{ url('/info_public/ir_sys/ir_sys2') }}">組織架構</a>
                            </li>
                            <li>
                                <a href="{{ url('/info_public/ir_sys/ir_sys3') }}">基本數據及趨勢</a>
                            </li>							
                            <li>
                                <a href="{{ url('/info_public/ir_sys/ir_sys4') }}">學校特色與發展願景</a>
                            </li>
                            <li>
                                <a href="{{ url('/info_public/ir_sys/ir_sys5') }}">學校績效表現</a>
                            </li>
                        </ul>
                    </li>
					<li id="submenu2" class="submenu">
                    	<a href="#">
                    		<i class="glyphicon glyphicon-stats"></i> 財務資訊分析
                    		<span class="caret pull-right"></span>
                    	</a>
                    	<ul>
                            <li>
                                <a href="{{ url('/info_public/fund/fund1') }}">學校收入支出分析</a>
                            </li>
                            <li>
                                <a href="{{ url('/info_public/fund/fund2') }}">學雜費與就學輔助資訊</a>
                            </li>							
                        </ul>
                    </li>
					<li id="submenu3" class="submenu">
                    	<a href="#">
                    		<i class="glyphicon glyphicon-credit-card"></i> 學雜費與就學補助資訊
                    		<span class="caret pull-right"></span>
                    	</a>
                    	<ul>
                            <li>
                            	<a href="{{ url('/info_public/fee/fee1') }}">學雜費與就學補助資訊</a>                            	
                            </li>
                            <li>
                                <a href="{{ url('/info_public/fee/fee2') }}">學雜費調整之用途規劃說明</a>
                            </li>
                            <li>
                                <a href="{{ url('/info_public/fee/fee3') }}">學雜費調整校內審議程序說明</a>
                            </li>                            
                        </ul>
                    </li>
					<li id="submenu4" class="submenu">
                    	<a href="#">
                    		<i class="glyphicon glyphicon-book"></i> 學校其他重要資訊
                    		<span class="caret pull-right"></span>
                    	</a>
                    	<ul>
                            <li>
                            	<a href="{{ url('/info_public/oth_info/oth_info1') }}">預算編審程序</a>                            	
                            </li>
                            <li>
                                <a href="{{ url('/info_public/oth_info/oth_info2') }}">會計師查核報告</a>
                            </li>
                            <li>
                                <a href="{{ url('/info_public/oth_info/oth_info3') }}">學校採購及處分重大資產情形</a>
                            </li>
                            <li>
                                <a href="{{ url('/info_public/oth_info/oth_info4') }}">開課與師資資訊</a>
                            </li>
							<li>
                                <a href="{{ url('/info_public/oth_info/oth_info5') }}">其他</a>
                            </li>							
                        </ul>
                    </li>
					<li id="submenu5" class="submenu">
                    	<a href="#">
                    		<i class="glyphicon glyphicon-book"></i> 內控內稽執行情形
                    		<span class="caret pull-right"></span>
                    	</a>
                    	<ul>
                            <li>
                            	<a href="{{ url('/info_public/control/control1') }}">內部控制制度及執行</a>                            	
                            </li>                            			
                        </ul>
                    </li>
					<li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> 回首頁</a></li>                    
                </ul>
             </div>
		  </div>

		  @yield('content')

		</div>
    </div>

    <footer>
         <div class="container">
		<div class="copy text-center">
                       <i class="glyphicon glyphicon-info-sign"></i> 建議使用Firefox或Chrome瀏覽器開啟本網頁
                </div>
			<div class="copy text-center">
               <a href='http://www.nctu.edu.tw/'><i class="glyphicon glyphicon-globe"></i> 國立交通大學</a>  |  
			   <a href='http://www.nctu.edu.tw/'><i class="glyphicon glyphicon-home"></i> 新竹市大學路1001號</a>  |  
			   <a href='http://www.nctu.edu.tw/'><i class="glyphicon glyphicon-earphone"></i> 電話：+886-3-5712121</a>  |  
			   <a href='http://www.nctu.edu.tw/'><i class="glyphicon glyphicon-phone-alt"></i>從美國撥打：1-800-409-9811</a>
            </div>
            <div class="copy text-center">
               Copyright © 2016 | <a href='http://www.nctu.edu.tw/'>National Chiao Tung University</a> All rights reserved |
			   網站維護：<a href='mailto:liuyj@g2.nctu.edu.tw'>大數據研究中心 劉育君(分機號碼:50177)</a>
            </div>
         </div>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>

    <script src="/vendors/fullcalendar/fullcalendar.js"></script>
    <script src="/vendors/fullcalendar/gcal.js"></script>
    <script src="/js/custom.js"></script>
    <script src="/js/calendar.js"></script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-84082048-1', 'auto');
		ga('send', 'pageview');
	</script>
  </body>
</html>

<script type="text/javascript">

$( document ).ready(function() {
	var tok = document.location.toString().split("/");
	if(tok[4] == "ir_sys"){
	$("#submenu1").attr('class',function() {
		return 'submenu open' ;
	});
	}
	else if(tok[4] == "fund"){
	$("#submenu2").attr('class',function() {
		return 'submenu open' ;
	});
	}
	else if(tok[4] == "fee"){
	$("#submenu3").attr('class',function() {
		return 'submenu open' ;
	});
	}
	else if(tok[4] == "oth_info"){
	$("#submenu4").attr('class',function() {
		return 'submenu open' ;
	});
	}

});

</script>
