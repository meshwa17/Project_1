<script type="text/javascript">
	$(document).ready(function(){

		$(document).on("keyup",'#Discount',function(){
			var fee=parseFloat($('#Fee').val());
			var dis=0;
			dis= ((fee * parseFloat($(this).val()))) / 100;
			var amt=fee-dis;
			$('#Paid').val(parseInt(amt))
			$('#Amount').val(parseInt(amt))
		});	

		$(document).on("keyup",'#Paid',function(){
			b=$('#Amount').val();
			var pay=$('#Paid').val();
			if(pay==""){$('#Lack').val(0)};
			if(pay!=""){
				paid=parseFloat($('#Paid').val());
			}
			if(pay!="" && b!="")
			{
				var lack=parseFloat(b)-parseFloat(paid);
				$('#Lack').val(parseInt(lack));
			}
			if($('#Lack').val()<0)
			{
				$('#Lack').css('color','red');
			}
			else{
				$('#Lack').css('color','black');
			}
		
		});

		$(document).on("keyup",'#Pay',function(){
		b=$('#b').val()
		var pay=$('#Pay').val();
		if(pay==""){
			$('#Lack').val(0)
		}
		if(pay!=""){
			paid=parseFloat($('#Pay').val());
		}
		if(pay!="" && b!="")
		{
			var lack=parseFloat(b)-parseFloat(paid);
			$('#Lack').val(parseInt(lack));
		}
		if($('#Lack').val()<0){
			$('#Lack').css('color','red');
		}
		else{
			$('#Lack').css('color','black');
		}
	});

	});
</script>