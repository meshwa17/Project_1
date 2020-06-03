<style type="text/css">
	.academic-detail{
		white-space: normal;
		width: 400px;
	}
	table tbody > tr >td
	{
		vertical-align: middle;
	}
	
</style>


<table class="table table-hover table-striped table-condensed table-bordered" id="table-class-info">
	<thead>
		<tr>
			<th>Program</th>
			<th>Level</th>
			<th>Shift</th>
			<th>Time</th>
			<th>Academic Detail</th>
			<th id="hidden">Action</th>

			<th>
				<input type="checkbox" id="checkall">
			</th>
		</tr>
	</thead>

	<tbody>
	@foreach($classes as $key=>$c)
		<tr>
			<td>{{ $c->program }}</td>
			<td>{{ $c->level }}</td>
			<td>{{ $c->shift }}</td>
			<td>{{ $c->time }}</td>
			<td class="academic-detail">
				<a href="#" data-id="{{ $c->class_id }}" id="class-edit">
				Program:{{ $c->program }} / Level:{{ $c->level }} / Shift:{{ $c->shift }} / time:{{ $c->time }} / Batch:{{ $c->batch }} / Group:{{ $c->group }} / StartDate:{{ date("d-M-y",strtotime($c->start_date)) }} / EndDate:{{ date("d-M-y",strtotime($c->end_date)) }}
				</a>
			</td>
			<td style="vertical-align: middle;width: 50px;" id="hidden">
				<button value="{{ $c->class_id }}" class="btn btn-danger btn-sm del-class">Del</button>
			</td>
			<td>
				<input type="checkbox" name="chk[]" value="{{ $c->class_id }}" class="chk">
			</td>
		</tr>
	@endforeach
	</tbo