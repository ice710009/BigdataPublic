<form class="form-horizontal" action="">
	<div class="form-group">
	<legend style="font-weight:bold;">申請表類別</legend>	
	@if(isset($apply))
	{!!Form::select('type', array( config('GV.form_1') => '校務系統資料使用申請表',
												  config('GV.form_2') => '學籍共同資料庫使用權申請表',
												  config('GV.form_3') => '人事共同資料庫使用權申請表'
												), $apply->type, array('class'=>'form-control', 'id' => 'type'));!!}
	@else
	{!!Form::select('type', array( config('GV.form_1') => '校務系統資料使用申請表',
												  config('GV.form_2') => '學籍共同資料庫使用權申請表',
												  config('GV.form_3') => '人事共同資料庫使用權申請表'
												), 0, array('class'=>'form-control', 'id' => 'type'));!!}
	@endif
	</div>
	
	<div class="form-group">
		<legend style="font-weight:bold;">申請人資料</legend>
			<div class="form-group row">
				<label class="col-md-2 control-label">申請單位</label>
					<div class="col-md-10">
						{!!Form::text('department', null, array('class'=>'form-control', 'id'=>'department'))!!}
					</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 control-label">申請日期</label>
					<div class="col-md-10">
							{!!Form::text('apply_date', null, array('class'=>'form-control', 'id'=>'apply_date', 'readonly', 'style' => 'background-color:white;'))!!}
					</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 control-label">申請人</label>
					<div class="col-md-10">
						{!!Form::text('name', null, array('class'=>'form-control', 'id'=>'name'))!!}
					</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 control-label">連絡電話</label>
					<div class="col-md-10">
						{!!Form::text('phone', null, array('class'=>'form-control', 'id'=>'phone'))!!}
					</div>
			</div>	
			<div class="form-group row">
				<label class="col-md-2 control-label">Email</label>
					<div class="col-md-10">
						{!!Form::text('email', null, array('class'=>'form-control', 'id'=>'email'))!!}
					</div>
			</div>	
    </div>
	
	<div class="form-group">
		<legend style="font-weight:bold;">用途</legend>	
		<div class="form-group row">
			<div class="col-md-12">
				{!!Form::textarea('purpose', null, array('class'=>'form-control', 'id'=>'purpose'))!!}
			</div>
		</div>
	</div>

	<fieldset id="form1">
	
	<div class="form-group">
		<legend style="font-weight:bold;width:100%;">所需項目</legend>	
		<div class="form-group row">
			<div class="col-md-12">
				{!!Form::textarea('form1_need', null, array('class'=>'form-control', 'id'=>'form1_need'))!!}
			</div>
		</div>
	</div>

	</fieldset>
	
	
	<fieldset id="form2">
	
	<div class="form-group">
	<legend style="font-weight:bold;">所需欄位</legend>
		<div class="form-group row">
			<div class="col-md-12">
			@foreach($form2_block1_sub1 as $index => $f)
			<label class="checkbox-inline">
				{!!Form::checkbox('form2_need['.$index.']', $index, null,  array('id'=>'form2_need['.$index.']'))!!}{!! Form::label($f->name) !!}
			</label>
			@endforeach
		
			<label class="form-inline">
				{!!Form::text('form2_need_other', null, array('class'=>'form-control', 'id'=>'form2_need_other'))!!}
			</label>
			<div class="form-group has-success">
				<span class="help-block">※ 如需身分證字號或生日請在「用途」說明原因</span>
			</div>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<legend style="font-weight:bold;">篩選條件</legend>						
			<div class="form-group row">
				<label class="col-md-2 control-label">入學身分</label>
					<div class="col-md-10">
					@foreach($form2_block2_sub1 as $index => $f)
					<label class="checkbox-inline">
						{!!Form::checkbox('form2_filter_enter['.$index.']', $index, null,  array('id'=>'form2_filter_enter['.$index.']'))!!}{!! Form::label($f->name) !!}
					</label>
					@endforeach
					</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 control-label">在學身分</label>
					<div class="col-md-10">
					@foreach($form2_block2_sub2 as $index => $f)
					<label class="checkbox-inline">
						{!!Form::checkbox('form2_filter_id['.$index.']', $index, null,  array('id'=>'form2_filter_id['.$index.']'))!!}{!! Form::label($f->name) !!}
					</label>
					@endforeach
					</div>
			</div>		
			<div class="form-group row">
				<label class="col-md-2 control-label">在學狀況</label>
					<div class="col-md-10">
					@foreach($form2_block2_sub3 as $index => $f)
					<label class="checkbox-inline">
						{!!Form::checkbox('form2_filter_status['.$index.']', $index, null,  array('id'=>'form2_filter_status['.$index.']'))!!}{!! Form::label($f->name) !!}
					</label>
					@endforeach
					</div>
			</div>		
	</div>
	
	</fieldset>
			
	
	<fieldset id="form3">
	
	<div class="form-group">
	<legend style="font-weight:bold;">篩選條件</legend>
		<div class="form-group row">
			<label class="col-md-2 control-label">員工編號</label>
				<div class="col-md-10">
					@foreach($form3_block2_sub1 as $index => $f)
					<label class="checkbox-inline">
						{!!Form::checkbox('form3_filter_no['.$index.']', $index, null,  array('id'=>'form3_filter_no['.$index.']'))!!}{!! Form::label($f->name) !!}
					</label>
					@endforeach
				</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 control-label">在職單位</label>
				<div class="col-md-10">
					{!!Form::text('form3_filter_department', null, array('class'=>'form-control', 'id'=>'form3_filter_department'))!!}
				</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 control-label">在職職稱</label>
				<div class="col-md-10">
					{!!Form::text('form3_filter_title', null, array('class'=>'form-control', 'id'=>'form3_filter_title'))!!}
				</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 control-label">聘用起日</label>
				<div class="col-md-10">
					{!!Form::text('form3_filter_start', null, array('class'=>'form-control', 'id'=>'form3_filter_start', 'readonly', 'style' => 'background-color:white;'))!!}
				</div>	
		</div>
		<div class="form-group row">
			<label class="col-md-2 control-label">聘用迄日</label>
				<div class="col-md-10">
			  		{!!Form::text('form3_filter_end', null, array('class'=>'form-control', 'id'=>'form3_filter_end', 'readonly', 'style' => 'background-color:white;'))!!}
				</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 control-label">經費來源-計畫編號</label>
				<div class="col-md-10">
					{!!Form::text('form3_filter_program', null, array('class'=>'form-control', 'id'=>'form3_filter_program'))!!}
				</div>
		</div>
		<div class="form-group row">
			<label class="col-md-2 control-label">經費來源-補助編號</label>
				<div class="col-md-10">
					{!!Form::text('form3_filter_financial', null, array('class'=>'form-control', 'id'=>'form3_filter_financial'))!!}
				</div>
		</div>
	</div>
					
	<div class="form-group">
	<legend style="font-weight:bold;">所需欄位</legend>
		<div class="form-group row">
			<div class="col-md-12">
			@foreach($form3_block1_sub1 as $index => $f)
			<label class="checkbox-inline">
				{!!Form::checkbox('form3_need['.$index.']', $index, null,  array('id'=>'form3_need['.$index.']'))!!}{!! Form::label($f->name) !!}
			</label>
			@endforeach
			<label class="form-inline">
				{!!Form::text('form3_need_other', null, array('class'=>'form-control', 'id'=>'form3_need_other'))!!}
			</label>
			</div>
		</div>
	</div>
	</fieldset>
	
	
	<div class="form-group">
		<legend style="font-weight:bold;">方法</legend>	
			<div class="form-group row">
				<div class="col-md-10">
					{!!Form::radio('way', '0', true, array('id'=>'way1'))!!}{!! Form::label('方法一：提供資料庫檢視表') !!}
					{!!Form::radio('way', '1', false, array('id'=>'way2'))!!}{!! Form::label('方法二：提供檔案下載') !!}
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 control-label">IP</label>
					<div class="col-md-10">
						{!!Form::text('ip', null, array('class'=>'form-control', 'id'=>'way'))!!}
					</div>
			</div>	
			<div class="form-group row">
				<label class="col-md-2 control-label">帳號</label>
					<div class="col-md-10">
						{!!Form::text('account', null, array('class'=>'form-control', 'id'=>'account'))!!}
					</div>
			</div>	
			<div class="form-group row">
				<label class="col-md-2 control-label">密碼</label>
					<div class="col-md-10">
						{!!Form::text('password', null, array('class'=>'form-control', 'id'=>'password'))!!}
					</div>
			</div>	
			<div class="form-group row">
				<label class="col-md-2 control-label">存放位置</label>
					<div class="col-md-10">
						{!!Form::text('location', null, array('class'=>'form-control', 'id'=>'location'))!!}
					</div>
			</div>	
    </div>
</form>
