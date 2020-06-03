<div class="modal fade" id="choose-academic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xs">

			<section class="panel panel-default">
			<header class="panel-heading">
				Choose Academic
			</header>
			<form action="#" class="form-horizintal" id="frm-view-class" method="Post">
				
				<div class="panel-body" style="border-bottom: 2px solid #ccc; ">
					<div class="form-group">
						
						<div class="col-sm-6">
							<label for="academic-year">Academic Year</label>
							<div class="input-group">
								<select class="form-control" name="academic_id" id="academic_id">
									<option value="">-------------</option>
									@foreach($academics as $key=>$y)
										<option value="{{ $y->academic_id }}">{{ $y->academic }}</option>
									@endforeach
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-academic"></span>	
								</div>


							</div>
						</div>

						{{--------------------------}}

						<div class="col-sm-6">
							<label for="program">Course</label>
							<div class="input-group">
								<select class="form-control" name="program_id" id="program_id">
									<option value="">-------------</option>
									@foreach($programs as $key=>$p)
										<option value="{{ $p->program_id }}">{{ $p->program }}</option>
									@endforeach
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-program"></span>	
								</div>
							</div>
						</div>


						{{--------------------------}}

						<div class="col-sm-6">
							<label for="level">Level</label>
							<div class="input-group">
								<select class="form-control" name="level_id" id="level_id">
									
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-level"></span>	
								</div>
							</div>
						</div>



						{{--------------------------}}

						<div class="col-sm-6">
							<label for="shift">Shift</label>
							<div class="input-group">
								<select class="form-control" name="shift_id" id="shift_id">
									@foreach($shift as $shf)
										<option value="{{ $shf->shift_id }}">{{ $shf->shift }}</option>
									@endforeach
									
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-shift"></span>	
								</div>
							</div>
						</div>


						{{--------------------------}}

						<div class="col-sm-6">
							<label for="time">Time</label>
							<div class="input-group">
								<select class="form-control" name="time_id" id="time_id">
									@foreach($time as $t)
										<option value="{{ $t->time_id }}">{{ $t->time }}</option>
									@endforeach
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-time"></span>	
								</div>
							</div>
						</div>


						{{--------------------------}}

						<div class="col-sm-3">
							<label for="batch">Batch</label>
							<div class="input-group">
								<select class="form-control" name="batch_id" id="batch_id">
									@foreach($batch as $bat)
										<option value="{{ $bat->batch_id }}">{{ $bat->batch }}</option>
									@endforeach	
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-batch"></span>	
								</div>
							</div>
						</div>

						{{--------------------------}}

						<div class="col-sm-2">
							<label for="group">Group</label>
							<div class="input-group">
								<select class="form-control" name="group_id" id="group_id">
									@foreach($group as $gro)
										<option value="{{ $gro->group_id}}">{{ $gro->group }}</option>
									@endforeach	
								</select>
								<div class="input-group-addon">
									<span class="fa fa-plus" id="add-more-group"></span>	
								</div>
							</div>
						</div>
						
						
						{{--------------------------}}



					</div>
				</div>
				
			</form>
				{{--------------------------}}

			<form action="#" method="get" id="frm-multi-class">
				
			<div class="panel panel-default">
				<div class="panel-heading">Class Information
					<button value="button" id="btn-go" class="btn btn-info btn-xs pull-right" style="margin-top: 5px;">Go</button>
				</div>
				<div class="panel-body" id="add-class-info" style="overflow-y: auto;height: 250px;">
					
				</div>
			</div>

			</form>
				{{--------------------------}}
		</section>
	</div>
</div>