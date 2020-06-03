<table class="table table-bordered table-hover table-striped table-condesed" id="fee-list">
	<thead>
		<tr>
			<th>#</th>
			<th>Accountant</th>
			<th>Stu. Id</th>
			<th>Student Name</th>
			<th>Transacted Date</th>
			<th>School Fee</th>
			<th>Discount</th>
			<th>Student Amount</th>
			<th>Paid Amount</th>
		</tr>
	</thead>
	<tbody>
		@foreach($fees as $key=>$fee)
		<tr>
			<td>{{ ++$key }}</td>
			<td>{{ $fee->name }}</td>
			<td>{{ $fee->student_id }}</td>
			<td>{{ $fee->first_name." ".$fee->last_name }}</td>
			<td>{{ $fee->transaction_date }}</td>
			<td>$ {{ number_format($fee->school_fee,2) }}</td>
			<td>{{ $fee->discount }}%</td>
			<td>$ {{ number_format($fee->student_fee,2) }}</td>
			<td>$ {{ number_format($fee->paid,2) }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function(){
		$('#fee-list').DataTable({
			 dom: 'Bfrtip',
		        buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdfHtml5'
		        ]
		})
	})
</script>