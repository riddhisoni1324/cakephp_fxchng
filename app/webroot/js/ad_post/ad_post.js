$(document).ready(function() {

	// set datepicker for Insurance_valid_till and event_date
	$('.date_picker').datepicker({
		changeMonth: true,
		changeYear:true
	});

	// set global variables
	var type_id = ""; // store the item type id
	var cat_id = ""; // stores the selected category_id
	var cat_name = ""; // stores the selected category name
	var brand_id = ""; // stores the brand id

	// First hide extra details
	$('#information_container').hide();
	$('#jobs_container').hide();
	$('#automobiles_container').hide();
	$('#events_container').hide();
	$('#real_estate_container').hide();
	$('.you_are_last').hide(); // 3rd radio button of you are

	// get condition val
	// show how old/usage your items when selection of used in radio button
	$(document).on('change', '.ItemUsage', function() {
		if ($(this).val() == 'used') {
			$('#usage_id').attr("disabled", false);
		}
		else {
			$('#usage_id').attr("disabled", true);
		}
	});

	// get model name and id
	$(document).on('change', '#model_id', function() {
		var model_id = $(this).val();
		var model_name = $('#model_id option:selected').text();
		$('#model_name').val(model_name);
	});

	// get the role_name and id
	$(document).on('change', '#role_id', function () {
		role_id = $(this).val();
		var role_name = $('#role_id option:selected').text();
		$('#role_name').val(role_name);
	});

	// Set Category according to selection of item
	$(document).on('change', '#type_id', function() {

		// Get type_id
		type_id = $(this).val();
		// console.log(type_id);
		var type_name = $('#type_id option:selected').text();
		$('#item_type_name').val(type_name);

		var url1 = baseUrl+"ad_posts/get_item_categories/"+type_id;
		$.ajax({
			type: "GET",
			url: url1,
			success: function(data) {

				// set categories
				$('#item_category_id').html(data);

				// if type_id == "" then hide extra information
				if(type_id == "") {
					$('#information_container').hide();
				}
				else {
					 change_extra_fields();
				}
			}
		});
	});

	// get category name
	$(document).on('change', '#item_category_id', function() {
		cat_id = $(this).val();
		// console.log(cat_id);
		cat_name = $('#item_category_id option:selected').text();
		$('#item_cat_name').val(cat_name); // get sub category name

		// add brands according item type
				var url2 = baseUrl+"ad_posts/get_brands/"+cat_id;
				console.log(url2);
				$.ajax({
					type: "GET",
					url: url2,
					success: function(data1) {

						// set categories
						$('#brand_id').html(data1);

						// get the brand_id
						$(document).on('change', '#brand_id', function () {
							brand_id = $(this).val();
							var brand_name = $('#brand_id option:selected').text();
							$('#brand_name').val(brand_name);
							// add brands according item type
							// var url3 = baseUrl+"ad_posts/get_models/"+brand_id;
							// $.ajax({
							// 	type: "GET",
							// 	url: url3,
							// 	success: function(data2) {
							// 		// set models
							// 		$('#model_id').html(data2);
							// 	}
							// });
						});
					}
				});

		change_extra_fields();
	});

	// this function change the extra fields name value or add or delete new fields according.
	function change_extra_fields() {
		if (!cat_id == "") {
			$('#information_container').show();

			// for usage_container
			// show only MObile & tablates or Electronic and multimedia
			if (type_id === '55680b32-400c-4133-97a5-1dd4bf642048' || type_id === '55683520-6028-48f4-95ff-691dbf642048') {
				$("#usage_container").show();
			}
			else {
				$("#usage_container").hide();
			}

			// Real Estate related
			if (type_id === '55680b69-543c-459b-8ac2-14f3bf642048') {
				$('#real_estate_container').show();

				// hide negotiable
				$("#negotiable_container").hide();

				// set personale details 'you are' = 'i am' and 'individual' or 'broker' or 'builder'
				$('#you_are_text_1').html('Individual');
				$('#you_are_text_2').html('Broker');

				// set value of 'i want to' radio button
				$('#you_are_1').val('Individual');
				$('#you_are_2').val('Broker');

				// hide builder
				$('.you_are_last').show();

				// change text 'You are' to 'I am'
				$('#you_are_label').html('I am').append("<span style='color:red'>*</span>");;
			}
			else {
				$('#real_estate_container').hide();

				// show negotiable
				$("#negotiable_container").show();

				// set personale details 'you are' = 'i am' and 'individual' or 'broker' or 'builder'
				$('#you_are_text_1').html('Individual');
				$('#you_are_text_2').html('Delear');

				// set value of 'i want to' radio button
				$('#you_are_1').val('Individual');
				$('#you_are_2').val('Dealer');

				// show builder
				$('.you_are_last').hide();

				// change text 'I am' to 'You are'
				$('#you_are_label').html('You are').append("<span style='color:red'>*</span>");;

			}

			// events related - old when single
			// if (type_id === '55686052-c120-4145-860c-019abf642048') {
			// 	// show events_container
			// 	$('#events_container').show();
			// }
			// else {
			// 	$('#events_container').hide();
			// }

			// // events related after merge
			// if (cat_id === '556eaa04-8864-4c36-bddd-0d7ebf642048' || cat_id === '556eaa0e-dbac-4c8c-a479-0c7ebf642048' || cat_id === '556eaa17-79bc-4d0c-b7da-157abf642048' || cat_id === '556eaa21-7b38-4bb8-9d7e-0c7bbf642048') {
			// 	// show events_container
			// 	$('#events_container').show();
			// }
			// else {
			// 	$('#events_container').hide();
			// }

			// automobiles related
			if (type_id === '55680b42-e360-4882-8274-1b96bf642048') {

				// show auto_mobiles container
				$('#automobiles_container').show();

				// set year in year field
				for (i = new Date().getFullYear(); i > 1989; i--)
				{
				    $('#year').append($('<option />').val(i).html(i));
				}

				if (cat_id === '55680d26-bda8-4af7-bd4a-1cfabf642048' || cat_id === '55680d4a-ed04-4b04-a7d6-2097bf642048') {
					// if category = "cars" or "Motorcycles-scooters"
					$('#information_container').show();
					$('#model_container').show();
					$('#kms_driven_container').show();
					$('#valid_till_container').show();
					$('year_container').show();
					$('fuel_type_container').show();

					$('#vehicle_type_container').hide();
				}
				else if (cat_id === '556ea1ef-87a4-4828-aecc-0c7abf642048') {
					// if category = "Other vehicles"
					$('#information_container').hide();
					$('#model_container').hide();
					$('#kms_driven_container').hide();
					$('#valid_till_container').hide();
					$('#vehicle_type_container').hide();

					$('#year_container').show();
					$('#fuel_type_container').show();
				}
				else if (cat_id === '556ea2b3-2dac-4d08-b493-0d7ebf642048') {
					// if category = "Commercial transportation"
					$('#information_container').hide();
					$('#model_container').hide();
					$('#kms_driven_container').hide();
					$('#valid_till_container').hide();
					$('#year_container').hide();
					$('#fuel_type_container').hide();

					$('#vehicle_type_container').show();

				}
				else if (cat_id === '556ea2dc-68ac-4419-a951-0c7cbf642048' || cat_id === '556ea30e-93e0-4add-9bdb-0dbfbf642048') {
					// if category = "Spare Parts - Accessories" or Tractors - 'Agricultural Equipments'

					$('#information_container').hide();
					$('#model_container').hide();
					$('#kms_driven_container').hide();
					$('#valid_till_container').hide();
					$('#year_container').hide();
					$('#fuel_type_container').hide();
					$('#vehicle_type_container').hide();
				}
			}
			else {
				$('#automobiles_container').hide();
			}

			// Jobs related
			if (type_id === '5568353e-8100-4254-936e-2cb0bf642048') {
				// Hide price and condition if "Jobs selected"
				$('#price_container').hide();
				$('#condition_container').hide();
				// $("#usage_container").hide();

				// make price optionl
				$("#price").removeAttr('required');
				$('.star').text('');

				// make condition optionl
				$(".ItemUsage").removeAttr('required');

				// show jobs related fields
				$('#jobs_container').show();

			}
			else {
				$('#price_container').show();
				$('#condition_container').show();
				// $("#usage_container").show();

				// make price required
				$("#price").attr('required', true);
				$('.star').text('*');

				// make condition required
				$(".ItemUsage").attr('required');

				// hide jobs related fields
				$('#jobs_container').hide();
			}

			// Show "also include" only in "Mobiles & tablets"
			if (type_id === '55680b32-400c-4133-97a5-1dd4bf642048') {
				$('#also_include_container').show();
			}
			else {
				$('#also_include_container').hide();
			}

			// show brand if selected from these 'mobile & tablets' or 'Electronics and multimedia' or 'Automobiles'
			if (type_id === '55680b32-400c-4133-97a5-1dd4bf642048' || type_id === '55683520-6028-48f4-95ff-691dbf642048' || type_id === '55680b42-e360-4882-8274-1b96bf642048') {
				$('#brand_container').show();
			}
			else {
				$('#brand_container').hide();
			}

			// start main if elseif for all types
			if (type_id === '55680b32-400c-4133-97a5-1dd4bf642048' || type_id === '55683520-6028-48f4-95ff-691dbf642048' || type_id === '55685b20-192c-4cab-b473-0a5bbf642048' || type_id === '55685b98-caec-4fc3-aac4-4496bf642048' || type_id === '55685f87-e654-4d82-87fd-739dbf642048' || type_id === '55680b42-e360-4882-8274-1b96bf642048') {

				//if id = 'mobile & tablets' or 'Electronics and multimedia' or 'Home & store' or 'Faishon & beauty' or 'kids & baby' or 'Automobiles' then
				// change I want to value = 'sell' or 'buy'
				$('#i_want_to_text1').html('Sell');
				$('#i_want_to_text2').html('Buy');

				// set value of 'i want to' radio button
				$('#want_to_1').val('Sell');
				$('#want_to_2').val('Buy');

				// make price required
				$("#price").attr('required', true);
				$('.star').text('*');

				$('#i_want_to_container').show();

			}
			else if (type_id === '55685b5e-3934-4e8e-87b9-0a5cbf642048') {
				// if selects 'services' then
				// change 'i want to' = 'provide service' or 'Get this service'
				$('#i_want_to_text1').html('Provide Service');
				$('#i_want_to_text2').html('Get this service');

				// set value of 'i want to' radio button
				$('#want_to_1').val('Provide Service');
				$('#want_to_2').val('Get this service');

				// make price optionl
				$("#price").removeAttr('required');
				$('.star').text('');

				// make condition hide and optional
				$(".ItemUsage").removeAttr('required');
				$("#condition_container").hide();
				// $("#usage_container").hide();

			}
			else if (type_id === '5568353e-8100-4254-936e-2cb0bf642048') {
				// if selects 'Jobs' then
				// change 'i want to' = 'Offer a job' or 'Get a JOb'
				$('#i_want_to_text1').html('Offer a Job');
				$('#i_want_to_text2').html('Get a Job');

				// set value of 'i want to' radio button
				$('#want_to_1').val('Offer a Job');
				$('#want_to_2').val('Get a Job');

				// $("#usage_container").hide();

				if (cat_id === '556ea983-7e90-4fc7-b7d0-0c7bbf642048') {
					// if category = resumes
					$('#i_want_to_container').hide();

					// make 'title' to resume 'title'
					$('#resume_title').text('Resume Title').append("<span style='color:red'>*</span>");

					// make required education and experience
					$('#edu_text').append("<span style='color:red'>*</span>");
					$('#exp_text').append("<span style='color:red'>*</span>");
					$('#education').attr('required', true);
					$('#experience').attr('required', true);

					// Hide company,designation
					$('#company_container').hide();
					$('#designation_container').hide();

					// show resume_container
					$('#resume_container').show();
				}
				else {
					$('#i_want_to_container').show();

					// make 'resume title' to 'title'
					$('#resume_title').text('Title').append("<span style='color:red'>*</span>");

					// make optional education and experience
					$('#edu_text').text('Education');
					$('#exp_text').text('Experience');
					$('#education').removeAttr('required');
					$('#experience').removeAttr('required');

					// Show company,designation
					$('#company_container').show();
					$('#designation_container').show();

					// hide resume_container
					$('#resume_container').hide();
				}

			}
			else if (type_id === '55686035-36e8-4495-a8d7-0b36bf642048') {
				// if type = community
				// change I want to value = 'offer' or 'seek'
				$('#i_want_to_text1').html('Offer');
				$('#i_want_to_text2').html('Seek');

				// set value of 'i want to' radio button
				$('#want_to_1').val('Offers');
				$('#want_to_2').val('Seek');

				// make condition hide and optional
				$(".ItemUsage").removeAttr('required');
				$("#condition_container").hide();
				// $("#usage_container").hide();

				if(cat_id === '556ea9c6-bb64-40c6-b60b-150cbf642048') {
					// for carpol & bike Ride Share
					$('#i_want_to_container').show();
				}
				else if(cat_id === '556ea9d2-6890-4b8f-a533-0c7cbf642048') {
					// if category = Musicians, Artists, Bands
					// make price optionl and hide
					$("#price").removeAttr('required');
					$('.star').text('');
					$("#price_container").hide();
					$('#i_want_to_container').show();

				}
				else if (cat_id === '556ea9de-bf30-4da2-acf0-0dc0bf642048' || cat_id === '556ea9e7-1d18-4bc0-ab37-0e99bf642048') {
					// if category = 'Lost and Found' or 'Charity, NGO, Volunteers'
					// hide i want and price and condition
					$('#i_want_to_container').hide();

					// make price optionl and hide
					$("#price").removeAttr('required');
					$('.star').text('');
					$("#price_container").hide();

					// make condition hide and optional
					$(".ItemUsage").removeAttr('required');
					$("#condition_container").hide();
					// $("#usage_container").hide();
					$('#events_container').hide();

				}
				else if (cat_id === '556eaa04-8864-4c36-bddd-0d7ebf642048' || cat_id === '556eaa0e-dbac-4c8c-a479-0c7ebf642048' || cat_id === '556eaa17-79bc-4d0c-b7da-157abf642048' || cat_id === '556eaa21-7b38-4bb8-9d7e-0c7bbf642048') {
				// if type = Events
				// show only title, description, event date, venue
				$('#events_container').show();

				// hide 'i want to'
				$('#i_want_to_container').hide();

				// make price optionl and hide
				$("#price").removeAttr('required');
				$('.star').text('');
				$("#price_container").hide();

				// make condition hide and optional
				$(".ItemUsage").removeAttr('required');
				$("#condition_container").hide();
				// $("#usage_container").hide();
			}

			}
			// old events before merged
			// else if (type_id === '55686052-c120-4145-860c-019abf642048') {
			// 	// if type = Events
			// 	// show only title, description, event date, venue

			// 	// hide 'i want to'
			// 	$('#i_want_to_container').hide();

			// 	// make price optionl and hide
			// 	$("#price").removeAttr('required');
			// 	$('.star').text('');
			// 	$("#price_container").hide();

			// 	// make condition hide and optional
			// 	$(".ItemUsage").removeAttr('required');
			// 	$("#condition_container").hide();
			// 	// $("#usage_container").hide();
			// }
			else if (type_id === '55686166-176c-4353-bd82-09e2bf642048' || type_id === '5568618f-fa84-4c77-8e35-7664bf642048') {
				// category = Education and coaching or 'pets'
				// hide 'i want to'
				$('#i_want_to_container').hide();

				// make condition hide and optional
				$(".ItemUsage").removeAttr('required');
				$("#condition_container").hide();
				// $("#usage_container").hide();
			}
			else if (type_id === '55680b69-543c-459b-8ac2-14f3bf642048') {
				// if type = real estate then
				// make condition hide and optional
				$(".ItemUsage").removeAttr('required');
				$("#condition_container").hide();
				// $("#usage_container").hide();

				if(cat_id === '556ea35c-f728-450b-b06e-0da4bf642048' || cat_id === '556ea3dd-f290-4bcf-8a03-0c7ebf642048' || cat_id === '556ea42e-3fd0-43b4-946c-0c7bbf642048' || cat_id === '556ea5bd-6940-4ad0-86a7-0da4bf642048') {
					// if category = 'Houses & Flats for sale' OR 'Land - Plots For Sale' OR 'Office – Shop -- Commercial Space'
					// set want to 'Buy' OR 'Sell'
					$('#i_want_to_text1').html('Sell');
					$('#i_want_to_text2').html('Buy');

					// set value of 'i want to' radio button
					$('#want_to_1').val('Sell');
					$('#want_to_2').val('Buy');
				}
				else if (cat_id === '556ea37a-d78c-4e90-a9f0-0dc0bf642048' || cat_id === '556ea57c-0c5c-472e-9906-0c7bbf642048' || cat_id === '556ea5a8-30d4-4622-9175-0e99bf642048') {
					// if category = 'Houses & Flats for rent' OR 'Vacation Rental' OR 'PG - Roommates - Hostel'
					// set want to 'Buy' OR 'Sell'
					$('#i_want_to_text1').html('Give on rent');
					$('#i_want_to_text2').html('Take on rent');

					// set value of 'i want to' radio button
					$('#want_to_1').val('Give on rent');
					$('#want_to_2').val('Take on rent');
				}
			}
		}
		else {
			$('#information_container').hide();
			// $('#usage_container').hide();
			$('#jobs_container').hide();
			$('#automobiles_container').hide();
			$('#events_container').hide();
			$('#real_estate_container').hide();
		}
	}

	 $(document).on('keyup', '#personal_city', function() {

        // get current val of city textbox.
        var search = $(this).val().toLowerCase();

        cities_url = baseUrl+"ad_posts/get_cities/"+search;

          $('#personal_city').autocomplete({
            source: cities_url,
            delay: false,
            minLength: 3,

            focus: function(event, ui) {
              $('#personal_city').val(ui.item.city_name);
              return false;
            },
            select: function(event, ui) {
              	$('#personal_city').val(ui.item.city_name);
              	$('#city_region').val(ui.item.region);
              	current_city = ui.item.city_name;

				var keyword = $(this).val();
				areas_url = baseUrl+"ad_posts/get_areas/"+keyword;
				// console.log(areas_url);
				$.ajax({
					type: "GET",
					url: areas_url,
					success: function(areas) {
						// console.log(areas);
						$('#personal_area').autocomplete({
							source: JSON.parse(areas)
						});
					} // end of success: function(areas)
				}); // end of ajax of areas

              return false;
            }
          })
          .data("ui-autocomplete")._renderItem = function( ul, item ) {
            return $( "<li>" )
              .append( "<a>" + item.city_name + "-" + item.region + "</a>" )
              .appendTo( ul );
          };
      }); // end of keyup event of id=city

	$(document).on('keyup', '#city', function() {

        // get current val of city textbox.
        var search = $(this).val().toLowerCase();

        cities_url = baseUrl+"ad_posts/get_cities/"+search;

          $('#city').autocomplete({
            source: cities_url,
            delay: false,
            minLength: 3,

            focus: function(event, ui) {
              $('#city').val(ui.item.city_name);
              return false;
            },
            select: function(event, ui) {
              	$('#city').val(ui.item.city_name);
              	$('#city_region').val(ui.item.region);
              	current_city = ui.item.city_name;

				var keyword = $(this).val();
				areas_url = baseUrl+"ad_posts/get_areas/"+keyword;
				// console.log(areas_url);
				$.ajax({
					type: "GET",
					url: areas_url,
					success: function(areas) {
						// console.log(areas);
						$('#area').autocomplete({
							source: JSON.parse(areas)
						});
					} // end of success: function(areas)
				}); // end of ajax of areas

              return false;
            }
          })
          .data("ui-autocomplete")._renderItem = function( ul, item ) {
            return $( "<li>" )
              .append( "<a>" + item.city_name + "-" + item.region + "</a>" )
              .appendTo( ul );
          };
      }); // end of keyup event of id=city

    // titan validation and form submit
    titanUI.superValidation("#type_id", "", true, null, null);
    titanUI.superValidation("#item_category_id", "", true, null, null);
 	titanUI.superValidation("#title", "", true, 3, 100);
 	titanUI.superValidation("#desc", "", true, 3, 700);
 	titanUI.superValidation("#name", "alpha-only", true, 3, 50);
 	// titanUI.superValidation("#price", "mobile", true, null, 15);
 	// titanUI.superValidation("#mobile_id", "", true, 10, 10);
 	 titanUI.superValidation("#mobile_id", "mobile", true, 10, 10);
 	titanUI.superValidation("#email", "emailid", true, null,100);
 	titanUI.superValidation("#personal_city", "alpha-only", true, 3, 50);
 	titanUI.superValidation("#personal_area", "alpha-only", true, 3, 50);

    // $('#submit_btn').click(function(e) {
    //     e.preventDefault();

    //     if ($('#is_logged_in').val() == 1) {
    //     	if(titanUI.checkValidation("#ad-form","#errors-list")) {

    //     		// $('#submit_btn').attr('disabled', true);
	   //         	$('#ad-form').submit();
    //         	return true;
	   //      }
    //     	return false;
  		// }
    //   	else {
    //     	$('#ad_post_modal').modal('show');
    //   	}
    // });

	$('#submit_btn').click(function(e) {
       e.preventDefault();
       if(cat_name=='' &&  cat_id==''){

		$('#c_id').css("background-color", "red");
		$('#c_id').css("padding", "1px");
		$('#c_id').css("padding-top", "2px");
		$('#c_id').css("border-radius", "5px");


		$('#sc_id').css("background-color", "red");
		$('#sc_id').css("padding", "1px");
		$('#sc_id').css("padding-top", "2px");
		$('#sc_id').css("border-radius", "5px");

		$('#pc').css("background-color", "red");
		$('#pc').css("padding", "1px");
		$('#pc').css("padding-top", "2px");
		$('#pc').css("border-radius", "5px");

	}

if ($('#is_logged_in').val() == 1) {
	if(titanUI.checkValidation("#ad-form","#errors-list")) {

		// $('#submit_btn').attr('disabled', true);
	  $('#ad-form').submit();
	   	return true;
	}
		return false;
}
else {
	$('#ad_post_modal').modal('show');
}
});

	$('#mobile').keydown(function(e) {

	if (e.shiftKey || e.ctrlKey || e.altKey) {
		e.preventDefault();
	} else {

		var key = e.keyCode;
		if (!((key == 8) || (key == 46) || (key >= 35 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))) {
			e.preventDefault();
		}
	  }
	});

	$('#price').keydown(function(e) {

	if (e.shiftKey || e.ctrlKey || e.altKey) {
		e.preventDefault();
	} else {

		var key = e.keyCode;
		if (!((key == 8) || (key == 46) || (key >= 35 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))) {
			e.preventDefault();
		}
	  }
	});

	$('#kms_driven').keydown(function(e) {

	if (e.shiftKey || e.ctrlKey || e.altKey) {
		e.preventDefault();
	} else {

		var key = e.keyCode;
		if (!((key == 8) || (key == 46) || (key >= 35 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105))) {
			e.preventDefault();
		}
	  }
	});

   $('#div2').hover(function() {
   	if ($('#is_logged_in').val() == 1) {}
   	else{
       $('#ad_post_modal').modal('show').fadeIn(500)}
   },function(){
       $('#ad_post_modal').modal('hide').fadeOut(500)
   });
   // close ad_post_modal on click fb button
   $('#ad_post_login').click(function() {
    $('#ad_post_modal').modal('hide');
   });

    // close ad_post_modal on click fb button
    $('#ad_post_login').click(function() {
    	$('#ad_post_modal').modal('hide');
    });
}); // end of main document ready function