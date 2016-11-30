<!DOCTYPE html>
<html>
  <head>
    <title>國立交通大學資訊公開專區</title>
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
						<h1><a href="{{ url('/home') }}"><img src="/img/icon1.png"></img></a></h1>
					</div>
				</div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
			@yield('content')
		</div>
    </div>

    <footer>
         <div class="container">
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
	
	@yield('scripts')
  </body>
</html>