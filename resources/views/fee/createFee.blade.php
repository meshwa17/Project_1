


<style type="text/css">
	.table-fee{
		border: none;
	}
	.table-fee tr,td,th{
		border: none;
	}
</style>

<div class="modal fade" id="createFeepopup" role="dialog">
	<div class="modal-dialog modal-md">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<b><i class="glyphicon glyphicon-apple"></i>Create School Fee</b>
			</div>
			{{------------------------}}
			<form action="{{ route('createFee') }}" method="POST" id="frmFee">
				<div class="panel-body">
					<div class="table-responsive">
						{{----------------start table---------------}}
						<table class="table-fee">
							<tr>
								<td><label>Fee Type</label></td>
								<td>
									<select class="form-control" id="fee_type_id" name="fee_type_id">
										@foreach($feetypes as $key => $ft)
											<option value="{{ $ft->fee_type_id }}">{{ $ft->fee_type }}</option>
										@endforeach
									</select>
								</td>
							</tr>
							<tr>
								<td><label>Fee Heading</label></td>
								<td>
									<input type="text" class="form-control" id="fee_heading" name="fee_heading" value="Fees">
								</td>
							</tr>
							<tr>
								<td><label>Academic Year</label></td>
								<td>
									<input type="text" class="form-control" value="{{ $status->academic }}" disabled>
									<input type="hidden" name="academic_id" value="{{ $status->academic_id }}">
								</td>
							</tr>
							<tr>
								<td><label>Program</label></td>
								<td>
									<input type="text" value="{{ $status->program }}" disabled>
									<!--  <input type="hidden" name="program_id" value="{{ $status->program_id }}"> -->
								</td>
							</tr>
							<tr>
								<td><label>Level</label></td>
								<td>
									<input type="text" value="{{ $status->level }}" disabled>
									<input type="hidden" name="level_id" value="{{ $status->level_id }}" >
								</td>
							</tr>
							<tr>
								<td><label>School Fee($)</label></td>
								<td>
									<input type="text" class="form-control" id="amount" name="amount" placeholder="Amount">
								</td>
							</tr>
							
						</table>
						{{--------------End table--------------}}
						
					</div>						
				</div>
				<div class="panel-footer">
					<input type="submit" value="Create Fee" class="btn btn-default">
					<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				</div>
			</form>
			
		</div>	
	</div>
	</div>
</div>
