		@if($errors->any())
			<ul class="alert alert-danger">
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		@endif
		{!! Form::submit($submitButtonText, array('class' => 'btn btn btn-small btn-upload pull-right', 'onClick' => 'return true')) !!}
		<div class="container">
			@include ('apply._basic')
		</div>
		
@section('scripts')
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="../vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
    <link href="../vendors/select/bootstrap-select.min.css" rel="stylesheet">
    <link href="../vendors/tags/css/bootstrap-tags.css" rel="stylesheet">
    <link href="../css/forms.css" rel="stylesheet">
 
    <script src="../vendors/form-helpers/js/bootstrap-formhelpers.min.js"></script>

    <script src="../vendors/select/bootstrap-select.min.js"></script>

    <script src="../vendors/tags/js/bootstrap-tags.min.js"></script>

    <script src="../vendors/mask/jquery.maskedinput.min.js"></script>

    <script src="../vendors/moment/moment.min.js"></script>

    <script src="../vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

     <!-- bootstrap-datetimepicker -->
     <link href="../vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">
     <script src="../vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script> 

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>


<script type="text/javascript">

	//choose form type
	$( "#type" ).change(function() 
	{
		switch($(this).val()){
			case '0':	form_1();		break;
			case '1':	form_2();		break;
			case '2':	form_3();		break;
		}
	});

	//form3 所需欄位
	$( "#form3_need_11" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_0").css("display","block");
		}
		else
		{
			$("#sub_0").css("display","none");
		}
	});
	$( "#form3_need_12" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_1").css("display","block");
		}
		else
		{
			$("#sub_1").css("display","none");
		}
	});
	$( "#form3_need_13" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_2").css("display","block");
		}
		else
		{
			$("#sub_2").css("display","none");
		}
	});
	$( "#form3_need_14" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_3").css("display","block");
		}
		else
		{
			$("#sub_3").css("display","none");
		}
	});
	$( "#form3_need_15" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_4").css("display","block");
		}
		else
		{
			$("#sub_4").css("display","none");
		}
	});
	$( "#form3_need_16" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_5").css("display","block");
		}
		else
		{
			$("#sub_5").css("display","none");
		}
	});
	$( "#form3_need_17" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_6").css("display","block");
		}
		else
		{
			$("#sub_6").css("display","none");
		}
	});
	$( "#form3_need_18" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_7").css("display","block");
		}
		else
		{
			$("#sub_7").css("display","none");
		}
	});
	$( "#form3_need_19" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_8").css("display","block");
		}
		else
		{
			$("#sub_8").css("display","none");
		}
	});
	$( "#form3_need_20" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_9").css("display","block");
		}
		else
		{
			$("#sub_9").css("display","none");
		}
	});
	$( "#form3_need_21" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_10").css("display","block");
		}
		else
		{
			$("#sub_10").css("display","none");
		}
	});
	$( "#form3_need_22" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_11").css("display","block");
		}
		else
		{
			$("#sub_11").css("display","none");
		}
	});
	$( "#form3_need_23" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_12").css("display","block");
		}
		else
		{
			$("#sub_12").css("display","none");
		}
	});
	$( "#form3_need_24" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#sub_13").css("display","block");
		}
		else
		{
			$("#sub_13").css("display","none");
		}
	});
	

$( "#first_year").css("display","none");
$( "#first_check" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#first_year").css("display","inline");
		}
		else
		{
			$("#first_year").css("display","none");
		}
	});
$( "#second_year").css("display","none");
$( "#second_check" ).change(function() 
	{
		if ( $(this).is(":checked") ) 
		{
			$(this).attr("checked");
			$("#second_year").css("display","inline");
		}
		else
		{
			$("#second_year").css("display","none");
		}
	});

$( document ).ready(function() {

	//default form type 1
	form_1();	

	//申請日期
	$("#apply_date").datepicker({
		dateFormat: 'yy-mm-dd',
		autoclose: true,
		todayHighlight: true
	});
	//聘用起迄日
	$("#form3_filter_start").datepicker({
		dateFormat: 'yy-mm-dd',
		autoclose: true,
		todayHighlight: true
	});
	$("#form3_filter_end").datepicker({
		dateFormat: 'yy-mm-dd',
		autoclose: true,
		todayHighlight: true
	});


	@if($CtorEd =='edit')//edit
		@if($form->first_check == true)
			$("#first_year").css("display","inline");
		@endif
		@if($form->second_check == true)
			$("#second_year").css("display","inline");
		@endif
	@endif
});

	function form_1(){
		$("#form1").css("display","block");
		$("#form2").css("display","none");
		$("#form3").css("display","none");
		document.getElementById("way1").disabled = false;
		document.getElementById("way2").disabled = false;
	}
	function form_2(){
		$("#form1").css("display","none");
		$("#form2").css("display","block");
		$("#form3").css("display","none");
		document.getElementById("way1").disabled = true;
		document.getElementById("way2").disabled = true;
	}
	function form_3(){
		$("#form1").css("display","none");
		$("#form2").css("display","none");
		$("#form3").css("display","block");
		document.getElementById("way1").disabled = true;
		document.getElementById("way2").disabled = true;
		
		for(i=0; i<15; i++)
			$("#sub_"+i).css("display","none");
	}
</script>
@endsection

