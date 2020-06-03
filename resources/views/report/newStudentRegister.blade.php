@extends('layouts.master')
@section('title','Student Report')
@section('content')

 {!! Charts::assets() !!}
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><i class="fa fa-file-text-o"></i>New Student Enroll</h1>
		<ol class="breadcrumb">
			<li><i class="fa fa-home"></i><a href="{{ route('dashboard') }}"></a>Home</li>
			<li><i class="icon_document_alt"></i>Reports</li>
			<li><i class="fa fa-file-text-o"></i></a>New Student Enroll</li>
		</ol>
		
	</div>
</div>

<div class="panel panel-default">
	
	<div class="panel-body" style="padding-bottom: 4px;">
			{!! $chart->render() !!}
	</div>
</div>



@endsection