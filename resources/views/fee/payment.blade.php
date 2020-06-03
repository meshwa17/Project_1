@extends('layouts.master')

@section('content')

@include('fee.stylesheet.css-payment')
@include('fee.createFee')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-3">
			<form action="{{ route('showStudentPayment') }}" class="search-payment" method="GET">
				<input type="text" name="student_id" value="{{ $student_id }}" class="form-control" placeholder="Student Id">
			</form>
		</div>
		<div class="col-md-3">
			<label class="eng-name">Name:<b class="student-name">{{ $status->first_name." ".$status->last_name }}</b></label>	
		</div>
		<div class="col-md-3">
			
		</div>
		<div class="col-md-3" style="text-align: right;">
			<label class="date-invoice">Date:<b>{{ date('d-M-Y') }}</b></label>
		</div>
		<div class="col-md-3" style="text-align: right;">
			<label class="invoice-number">Receipt No:<sup>0</sup><b>{{ sprintf('%05d',$receipt_id)  }}</b></label>
		</div>

	</div>

	<form action="{{ count('$readStudentFee')!=0 ? route('exstraPay') : route('savePayment') }}" method="POST" id="frmPayment">
		{{ csrf_field() }}
	<div class="panel-body">
		<table style="margin-top: -12px;">
			<caption class="academicDetail">
				{{ $status->program }} /
				Level-{{ $status->level }} /
				Shift-{{ $status->shift }} /
				Time-{{ $status->time }} /
				Batch-{{ $status->batch }} /
				Group-{{ $status->group }} /
			</caption>
			<thead>
				<tr>
					<th>Program</th>
					<th>Level</th>
					<th>School Fee($)</th>
					<th>Amount($)</th>
					<th>Dis(%)</th>
					<th>paid($)</th>
					<th>Amount Lack($)</th>
				</tr>
			</thead>
				<tr>
					<td>
						<select id="program_id" name="program_id" class="d">
							<option value="">================</option>	
							@foreach($programs as $key=>$p)
								<option value="{{ $p->program_id }}" {{ $p->program_id==$status->program_id ? 'selected' : null }}>{{ $p->program }}</option>
							@endforeach		
						</select>
					</td>
					<td>
						<select id="Level_ID" class="d">
							<option value="">================</option>
							@foreach($levels as $key=>$l)
								<option value="{{ $l->level_id }}" {{ $l->level_id==$status->level_id ? 'selected' : null }}>{{ $l->level }}</option>
							@endforeach				
						</select>
					</td>
					<td>
					<div class="input-group">
						<span class="input-group-addon create-fee" title="create-fee" style="cursor: pointer;color: blue;padding: 0px 3px;border-right:none;">($)</span>
						<input type="text" name="fee" id="Fee" value="{{ $studentfee->amount or null }}" readonly="true">
					</div>
						<input type="hidden" name="fee_id" value="{{ $studentfee->fee_id or null }}" id="FeeId">
						<input type="hidden" name="student_id" value="{{ $student_id }}" id="studentId">
						<input type="hidden" name="level_id" value="{{ $status->level_id }}" id="LevelId">
						<input type="hidden" name="user_id" value="1" id="UserId">
						<input type="hidden" name="transaction_date" value="{{ date('Y-m-d H:i:s') }}" id="TransacDate">
						<input type="hidden" name="s_fee_id" id="s_fee_id">
					</td>
					<td>
						<input type="text" name="amount" id="Amount" class="d" required>
					</td>
					<td>
						<input type="text" name="discount" id="Discount" class="d">
					</td>
					<td>
						<input type="text" name="paid" id="Paid">
					</td>
					<td>
						<input type="text" name="lack" id="Lack" disabled>
					</td>
				</tr>
			<thead>
				<tr>
					<th colspan="2">Remark</th>
					<th colspan="5">Description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="2">
						<input type="text" name="description" id="description">
					</td>
					<td colspan="5">
						<input type="text" name="remark" id="remark">
					</td>
				</tr>
			</tbody>
		</table>
	</div>
		<div class="panel-footer">
			<input type="submit" name="btn-go" id="btn-go" class="btn btn-default btn-payment" value="{{ count($readStudentFee)!=0 ? 'Exstra Pay':'Save' }}">
			@if(count($readStudentFee)!=0)
			<a href="{{ route('printInvoice',$receipt_id)}}" class="btn btn-primary btn-sm" target="_blank" title="print"><i class="fa fa-print"></i></a>
			@endif
			<input type="button" onclick="this.form.reset()" class="btn btn-default btn-reset pull-right" value="Reset">
		</div>

	</form>
	</div>
	@if(count($readStudentFee)!=0)
		@include('fee.list.studentFeeList')
		<input type="hidden" value="0" id="disabled">
	@endif
</div>
@endsection

@section('script')
	@include('fee.script.calculate')
	@include('fee.script.payment')
@endsection