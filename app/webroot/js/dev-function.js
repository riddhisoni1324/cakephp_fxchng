// This Coustom JS function created by Dev ( Developer )

function show(id)
{
	$( "#second"+id ).removeClass('divhide');
	$( "#first"+id ).addClass('divhide');
	$( "#first"+id ).removeClass('divshow');
	$( '.listmain' ).removeClass('listdisnone');
}
function hide(id)
{
	$( "#first"+id ).addClass('divshow');
	$( "#second"+id ).addClass('divhide');
}

function counter12(id){	
	$.ajax({
			type:"POST",
			url:"index.php/dashboard/visiter_count",
			data: 'id='+id,
			success: function(data){
				jQuery('#visiter_count_'+id).text(data);
				jQuery('#visiter_countval_'+id).val(data);
				//jQuery('#poplinkclose'+id).css('display','none');
			}
		})
	}
function commonfriendmail(){
	
}

function message_replay2(){
	alert('message_replay2');
}