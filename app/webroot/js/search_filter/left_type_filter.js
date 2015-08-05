$(document).ready(function() {
	
	var current_id = $('#get_current_id').val();
	var used = null;	
	var new_condition =null;
	var from_date = null;
	var to_date = null ;
	var left_individual = null;
	var left_dealer = null;
	var left_minvalue = null;
	var left_maxvalue = null;
	var main_search = null;

	function get_filter_results() {
		
		var get_filter_data = baseUrl+"/categories/get_type_filter_data/"+current_id+'/'+used+'/'+new_condition+'/'+from_date+'/'+to_date+'/'+left_individual+'/'+left_dealer+'/'+left_minvalue+'/'+left_maxvalue+'/'+main_search;
		$.ajax({
			type: "POST",
			url: get_filter_data,
			success: function(data) {				
				// console.log(data);
				$('.dynamic_filter_content').html(data);	
			}
		});
	}

	// from used and new
	$('#left_used').click(function() {

		if($(this).prop("checked")){
			used = 'used'
		}	
		else{
			used = null;
		}
		
		get_filter_results();
	});
	$('#left_new').click(function() {

		if($(this).prop("checked")){
			new_condition = 'new'
		}	
		else{
			new_condition = null;
		}	
		get_filter_results();
	});	

	// for last days
	$('#1_day').click(function() {
		from_date = parseInt($.datepicker.formatDate('yymmdd', new Date()));
		to_date = from_date;
		get_filter_results();
	});
	$('#7_days').click(function() {
		var oneWeekAgo = new Date();
		oneWeekAgo.setDate(oneWeekAgo.getDate() - 7);
		from_date = parseInt($.datepicker.formatDate('yymmdd', oneWeekAgo));
		to_date = parseInt($.datepicker.formatDate('yymmdd', new Date()));
		get_filter_results();
	});
	$('#10_days').click(function() {
		var oneWeekAgo = new Date();
		oneWeekAgo.setDate(oneWeekAgo.getDate() - 10);
		from_date = parseInt($.datepicker.formatDate('yymmdd', oneWeekAgo));
		to_date = parseInt($.datepicker.formatDate('yymmdd', new Date()));
		get_filter_results();
	});
	$('#15_days').click(function() {
		var oneWeekAgo = new Date();
		oneWeekAgo.setDate(oneWeekAgo.getDate() - 15);
		from_date = parseInt($.datepicker.formatDate('yymmdd', oneWeekAgo));
		to_date = parseInt($.datepicker.formatDate('yymmdd', new Date()));
		get_filter_results();
	});
	$('#30_days').click(function() {
		var oneWeekAgo = new Date();
		oneWeekAgo.setDate(oneWeekAgo.getDate() - 30);
		from_date = parseInt($.datepicker.formatDate('yymmdd', oneWeekAgo));
		to_date = parseInt($.datepicker.formatDate('yymmdd', new Date()));
		get_filter_results();
	});

	// from individual and dealer
	$('#left_individual').click(function() {

		if ($(this).prop("checked")) {
			left_individual = 'Individual'
		}	
		else {
			left_individual = null;
		}	
		get_filter_results();
	});
	$('#left_dealer').click(function() {

		if ($(this).prop("checked")){
			left_dealer = 'Dealer'
		}	
		else{
			left_dealer = null;
		}
		
		get_filter_results();
	});

	// for price
	$('#left_price_submit').click(function(e) {

		e.preventDefault();
		tmp_min_price = $('#left_minvalue').val();
		tmp_max_price = $('#left_maxvalue').val();

		if (tmp_min_price != "" && tmp_max_price != "") {
			left_minvalue = $('#left_minvalue').val();
			left_maxvalue = $('#left_maxvalue').val();
		}
		else {
			left_minvalue = null;
			left_maxvalue = null;
		}

		get_filter_results();
	});

	// for main search
	$('#left_main_search').click(function() {
		tmp_search_val = $('#left_main_search_textbox').val();
		if(tmp_search_val != "") {
			main_search = $('#left_main_search_textbox').val();
		}
		else {
			main_search = null
		}

		get_filter_results();
	});

}); // end of main ready function