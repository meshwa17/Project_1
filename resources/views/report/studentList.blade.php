@extends('layouts.master')
@section('title','Student Report')
@section('content')
<style type="text/css">
	caption
	{
		height: 50px;
		font-size: 15px;
		font-weight: bold;
	}
</style>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><i class="fa fa-file-text-o"></i>Student List</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="{{ route('dashboard') }}"></a>Home</li>
			<li><i class="icon_document_alt"></i>Reports</li>
			<li><i class="fa fa-file-text-o"></i></a>Student-list</li>
		</ol>
		
	</div>
</div>


 <div class="panel panel-default">
	<div class="panel-heading">
		<b><i class="fa fa-apple"></i>Student Information</b>
		<a href="#" class="pull-right" id="show-class-info"><i class="fa fa-plus"></i></a>		
	</div>
	<div class="panel-body" style="padding-bottom: 4px;">
		<p style="text-align: center;font-size: 20px;font-weight: bold;">Student Report</p>
		<div class="show-student-info">
			

		</div>
	</div>
</div>

@include('class.classPopup')
@endsection
@section('script')
@include('script.scriptClassPopup')
<script type="text/javascript">
	$(document).on('click','#class-edit',function(e){
		e.preventDefault();
		class_id=$(this).data('id');
		$.get('{{ route("showStudentInfo") }}',{class_id:class_id},function(data){
			//console.log(data);
			$('.show-student-info').empty().append(data);
		})
	})
	//.........................................

</script>
@endsection