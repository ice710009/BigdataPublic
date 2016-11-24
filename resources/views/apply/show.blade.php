@extends('layouts.white')
@section('content')
		<div class="col-md-10">		  	
		  	<div class="row">
				<div class="col-md-12 panel-warning">
  				<div class="content-box-header">
					<div class="panel-title">{{$apply->updated_at}}</div>
				</div>
  				<div class="content-box-large box-with-header">
					<div class="form-group">
					{!! Form::open(['method' => 'DELETE', 'action' => ['ApplyController@destroy', $apply->id], 'onsubmit' => 'return ConfirmDelete()']) !!}
						<button type="submit" class="btn btn-default btn-upload pull-right" >刪除</button>
					{!! Form::close() !!}
					<a class="btn btn-default btn-upload pull-right" href="{{ URL::to('apply/' . $apply->id . '/edit') }}">編輯</a>
				
					<button type="button" class="btn btn-default btn-upload pull-right" onClick="Print(PrintData)">列印</button>
				</div>
				<div class="form-group" id="PrintData">
					{{ $objWriteHTML->save("php://output")}}		
				</div>
				</div>
				</div>
			</div>
		</div>

@endsection
@section('scripts')
<script type="text/javascript">
function ConfirmDelete()
{
	var x = confirm("確定要刪除此表格?");
	if (x)
 	  return true;
	else
  	  return false;
}
function Print(PrintData)
{
	var value = PrintData.innerHTML;
	var printPage = window.open("","printPage","");
	printPage.document.open();
	printPage.document.write(value);
	printPage.print();
}
</script>
@endsection