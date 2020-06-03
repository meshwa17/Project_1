<!DOCTYPE html>
<html>
<head>
	<title>Student Invoice</title>
	<style type="text/css">
		html,body{
			padding: 0;
			margin: 0;
			width: 100%;
			background: #fff;
			font-family: Arial,'Sans Serif','Time News Romin';
			font-size: 10pt;
		}
		table{
			width: 700px;
			margin: 0 auto;
			text-align: left;
			border-collapse: collapse;
		}
		th{
			padding-left: 2px;
		}
		td{
			padding: 2px;
		}
		.aeu{
			text-align: right;
			padding-right:10px;
			font-family: 'times news romin','Kheen 05 Muol Light';
		}
		.line-top{
			border-left:1px solid;
			padding-left: 10px;
			font-family: 'times news romin','Kheen 05 Muol Light'; 
		}
		.verify{
			font-family: 'times news romin','Kheen 05 Muol Light';
		}
		.imageAeu{
			width: 50px;
			height: 70px;
		}
		.th{
			background-color: #ddd;
			border: 1px solid;
			text-align: center;
		}
		.line-row{
			background-color: #ddd;
			border: 1px solid;
			text-align: center;
		}
		#container{
			width: 100%;
			margin: 0 auto;
		}
		.khm-os{font-family: 'times news romin';}
		.divide{ width: 100%; margin: 0 auto; }
		hr{
			width: 100%;
			margin-right: 0;
			margin-left: 0;
			padding: 0;
			margin-top: 35px;
			margin-bottom: 20px;
			border: 0 none;
			border-top: 1px dashed #322f32;
			background: none;
			height: 0;
		}
		button{
			margin:0 auto;
			text-align: center;
			height: 100%;
			width: 100%;
			cursor: pointer;
			font-weight: bold;
		}
		.length-limit{max-height: 350px;min-height: 350px;}
		.div-button{
			width: 100%;
			margin-top: 0px;
			height: 50px;
			text-align: center;
			margin-bottom: 10px;
			background-bottom:1px solid;
			background: #ccc;
		}

	</style>
</head>
<body>
	<div class="div-button"><button onclick="printContent('divide')">Print</button></div>
	<div id="divide">
		<?php for($i=0;$i<2;$i++) { ?>
		<div id="container">
			<div class="length-limit">
				{{-----------------------}}
				<table>
					<tr>
						<td style="padding-left: 40px;width: 50px;">
							<img src="{{ asset('logo/logo.jpg') }}" class="imageAeu">
						</td>
						<td class="aeu">
							<b style="font-weight: normal;">USB;USB;USB;USB;</b><br>
							<b>American School</b>
						</td>
						<td class="line-top">
							<b style="font-weight: normal;">USB;USB;USB;USB;</b><br>
							<b>RECEIPT</b>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: right;"></td>
						<td colspan="0" style="text-align: right;padding-left: 80px;">
							<b>Receipt N<sup>0</sup>:{{ sprintf("%05d",$invoice->receipt_id) }}</b>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: right;"></td>
						<td colspan="0" style="text-align: right;padding-left: 80px;">
							<b>Date</b>:{{ date('d-M-Y',strtotime($invoice->transaction_date)) }}
						</td>
					</tr>
				</table>
				{{-----------------------}}
					<table>
						<tr>
							<td style="width: 120px;padding: 5px 0px;">
								StudentId:<b>{{ sprintf("%05d",$invoice->student_id) }}</b>
							</td>
							<td style="width: 120px;padding: 5px 0px;">
								First Name:<b>{{ $invoice->first_name }}</b>
							</td>
							<td style="width: 120px;padding: 5px 0px;">
								Last Name:<b>{{ $invoice->last_name }}</b>
							</td>
							<td>Gender:
								<b>
									@if($invoice->sex==0) Male @else Female @endif
								</b>
							</td>
							
						</tr>
					</table>
				{{-----------------------}}
					 <table>
						<thead>
							<tr>
								<th class="th" style="text-align: left;">Description</th>
								<th style="width: 70px;" class="th">Fee</th>
								<th style="width: 70px;" class="th">Dis</th>
								<th style="width: 70px;" class="th">Amount</th>
								<th style="width: 70px;" class="th">Pay</th>
								<th style="width: 70px;" class="th">Balance</th>
							</tr>
						</thead>
						<tbody>

							 <tr>
								<td class="line-row" style="text-align: left;">
									{{ $status->detail }}
								</td>
								<td class="line-row">
									$ {{ number_format ( $invoice->school_fee,2) }}
								</td>
								<td class="line-row">
									{{ $studentFee->discount }}%
								</td>
								<td class="line-row">
									$ {{ number_format ( $studentFee->amount,2) }}
								</td>
								<td class="line-row">
									$ {{ number_format ( $invoice->paid,2) }}
								</td>
								<td class="line-row">
									$ {{ number_format ( $studentFee->amount-$totalPaid,2) }}
								</td>
							</tr> 
						</tbody>
					</table>
 				{{-----------------------}}
 				<table>
 					<tr>
 						<td>
 							<b class="verify">Note:</b>
 							<p style="display: inline-block;">All Parents Are not Refaund or Transferable</p>
 						</td>
 						<td>
 							<b style="margin-bottom: 5px;">Cashier:{{ $invoice->name }}</b><br><br>
 							Printed:{{ date('d-m-Y g:i:s A')}}
 						</td>
 						 <td style="vertical-align: top;">
 							Printed By:{{ $invoice->name }}
 						</td> 
 					</tr>
 					<br><br>
 				</table>
				{{-----------------------}}
				<table>
					<tr>
						<td style="font-size: 10pt;text-align: center;">
							1234,pkanpu from Lack $,phone kingdom of comdolis,postal code:12156
						</td>
						<td style="font-size: 10pt;text-align: center;">
							phone:(+61)9898074596 Email:zinal@gmail.com
						</td>
					</tr>
				</table>

			</div>
			@if($i==0)
			<br>
			<hr>
			@endif
		<?php } ?>

		</div>
		{{-----------------------}}
		<script type="text/javascript">
			function  printContent(el){
				var restorepage=document.body.innerHTMl;
				var printContent=document.getElementById(el).innerHTMl;
				window.print();
				document.body.innerHTMl=restorepage;
				window.close();
			}
		</script>

		{{-----------------------}}

	</div>
</body>
</html>