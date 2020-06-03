<script type="text/javascript">
	
	//...........................................
		$('#academic_id').on('change',function(e){
			showClassInfo();
		})
		//............................................
		$('#level_id').on('change',function(e){
			showClassInfo();
		})
		//............................................
		$('#shift_id').on('change',function(e){
			showClassInfo();
		})
		//............................................
		$('#time_id').on('change',function(e){
			showClassInfo();
		})
		//............................................
		$('#batch_id').on('change',function(e){
			showClassInfo();
		})
		//............................................
		$('#group_id').on('change',function(e){
			showClassInfo();
		})
	//*******************************************************
	$("#frm-view-class #program_id").on('change',function(e){
			var program_id=$(this).val();
			var level=$('#level_id')
			$(level).empty();
			$.get("{{ route('showLevel') }}",{program_id:program_id},function(data){
				$.each(data,function(i,l){
					// alert(level.level);
					$(level).append($("<option/>",{
						value:l.level_id,
						text:l.level
					}))
				})
				showClassInfo();
			})
		})
	//...............................................
	$('#show-class-info').on('click',function(e){
		e.preventDefault();
		showClassInfo();
		$('#choose-academic').modal('show');
	})
	//...............................................
	function showClassInfo()
		{
			var data=$('#frm-view-class').serialize();
			$.get("{{ route('showClassInformation') }}",data,function(data){
				$('#add-class-info').empty().append(data);
				$('td#hidden').addClass('hidden');
				$('th#hidden').addClass('hidden');
				MergeCommonRows($('#table-class-info'));

			})		
		}

	function MergeCommonRows(table){
			var firstColumnBreaks=[];
			$.each(table.find('th'),function(i){
				var previous=null,cellToExtend=null,rowspan=1;
				table.find("td:nth-child(" + 1 + ")").each(function(index,i){
					var jthis=$(this),content=jthis.text();
					if(previous==content && content !== "" && $.inArray(index,firstColumnBreaks)==1){
						jthis.addClass("hidden");
						cellToExtend.attr("rowspan",(rowspan=rowspan+1));
					}
					else{
						if(i==1)
							firstColumnBreaks.push(index);
							rowspan=1;
							previous=content;
							cellToExtend=jthis;
					}
				});
			});
			$('td.hidden').remove();
		}
</script>