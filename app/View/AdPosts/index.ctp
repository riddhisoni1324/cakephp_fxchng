<?php $this->start('page-wrapper'); ?>

<?php
// add js and css for checkbox

echo $this->Html->css('ad_post/dropdowns-enhancement');
echo $this->html->css('validation/titan-ui');

// page level plugin script files
echo $this->HTML->script('ad_post/dropdowns-enhancement');
echo $this->HTML->script('ad_post/ad_post');
echo $this->Html->script('validation/titan-ui');
?>
<script type="text/javascript">
	// $(document).ready(function() {
	// 	console.log('hi');
	// 	console.log(baseUrl+'ad_posts/live_at_cloudant');
	// 	$.ajax({
	// 		url: baseUrl+'ad_posts/live_at_cloudant',
	// 		Type: 'GET',
	// 		success: function(data) {
	// 			// console.log(JSONdata);
	// 			json = JSON.parse(data);
	// 			console.log(JSON.stringify(json));
	// 			// console.log(JSON.parse(json));
	// 			$.ajax({
	// 				// url: 'https://coneverelfconerstriesome:dCMmAFDkRnt1n5fY7llkQlGF@actonatedev.cloudant.com/axi_fxchng/_bulk_docs',
	// 				url: baseUrl+'ad_posts/get_data',
	// 				type: 'POST',
	// 				// data: {"docs":json},
	// 				data : json,
	// 				success: function() {
	// 					alert('success');
	// 				}
	// 			});
	// 		}
	// 	});
	// });

</script>
<?php
// check user logged in or not
if ($activeUser) {
	$check_logged_in = 1;
}
else {
	$check_logged_in = 0;
}
echo $this->Form->input('is_logged_in', array('type' => 'hidden', 'id' => 'is_logged_in', 'value' => $check_logged_in));
?>

<div class="bannerdown">
	<div class="">
	 	<?php echo $this->element('mainNavi'); ?>
		<div class="container">
			<?php //echo $this->element('homeBanner'); ?>
		</div>
	</div>
</div>

<?php
// Get user data if logged in.
if($user_data){

	$fb_name = $user_data['User']['fb_name'];
	$fb_email = $user_data['User']['username'];
	if(isset($user_data['User']['fb_phone'])) {
		$fb_mobile = $user_data['User']['fb_phone'];
	}
	else {
		$fb_mobile = "";
	}
	$fb_link = $user_data['User']['fb_link'];

}
else {

	$fb_name = "";
	$fb_email = "";
	$fb_mobile = "";
}
?>

<?php

echo $this->Form->create('ItemType', array(
		'type' => 'file',
		'multiple',
        'id' => 'ad-form',
        'data-titan-validate' => "true",
        'name' => 'myForm',
        'url'=>array('controller' => 'ad_posts', 'action' => 'index')));
?>

<div class="container formareaspical" >
	<div id="div1">
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="headtitle">
							<h2>General Information</h2>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-3">
						<label>Category<span style="color:red">&nbsp;*</span></label>
					</div>
					<div class="col-md-9">
						<div class="dropdown" id="c_id">
							<?php
								echo $this->Form->input('item_type_id', array('type' => 'select', 'empty' => 'Select', 'class' => "required form-control custom-select", 'div' => false, 'label' => false, 'id' => 'type_id', 'options' => $item_types, 'name'=>"data[ItemType][id]", 'required'));
								echo $this->Form->input('item_cat_name', array('type' => 'hidden', 'id'=>'item_type_name', 'name' => "data[ItemType][name]"));
							?>
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group">
					<div class="col-md-3">
						<label>Sub Category<span style="color:red">&nbsp;*</span></label>
					</div>
					<div class="col-md-9" id="divname">
						<div id="sc_id">
					 	<?php
					 		echo $this->form->input('item_category_id', array('type' => 'select', 'empty' => 'Select', 'class' => 'required form-control custom-select', 'div' => false, 'label' => false, 'id' => 'item_category_id', 'name' => "data[ItemCategory][id]", 'required'));
					 		echo $this->Form->input('item_cat_name', array('type' => 'hidden', 'id'=>'item_cat_name', 'name' => "data[ItemCategory][name]"));
					 	?>
					 </div>
					</div>
					<div class="clear"></div>
				</div>

				<div id='information_container'>

					<div class="form-group" id="i_want_to_container">
						<div class="col-md-3">
							<label>I want To</label>
						</div>
						<div class="col-md-9">
					 		<table border="0" cellspacing="0" cellpadding="0" class="rediboxarea">
				                <tr>
				                  	<td><input type="radio" name="i_want_to" checked value="" id="want_to_1"></td>
				                  	<td><label id="i_want_to_text1"></label></td>
			                   		<td><input type="radio" name="i_want_to"  value="" id="want_to_2"></td>
				                  	<td><label id="i_want_to_text2"></label></td>
				                </tr>
	              			</table>
						</div>
						<div class="clear"></div>
					</div>

					<div class="form-group" id="brand_container">
						<div class="col-md-3">
							<label>Brand</label>
						</div>
						<div class="col-md-9" id="divname">
						 	<?php
						 		echo $this->form->input('brand_id', array('type' => 'select', 'empty' => 'Select Brand', 'class' => 'form-control custom-select', 'div' => false, 'label' => false, 'id' => 'brand_id', 'name' => 'data[brand][id]'));

						 		echo $this->form->input('brand_name', array('type' => 'hidden', 'id' => 'brand_name', 'name' => 'data[brand][name]'));
						 	?>
						</div>
						<div class="clear"></div>
					</div>

					<div class="form-group" id="also_include_container">
						<div class="col-md-3">
							<label>Also Includes</label>
						</div>
						<div class="col-md-9">
							<div class="btn-group also_includes">
							  	<button data-toggle="dropdown" class="btn dropdown-toggle"  data-placeholder="Please select">Choose Items<span class="caret"></span></button>
							    <ul class="dropdown-menu">
							      <li><input type="checkbox" id="ID0" name="data[included][charger]"><label for="ID0" value="Charger">Charger</label></li>
							      <li><input type="checkbox" id="ID1" name="data[included][data_cabel]"><label for="ID1" value="Data Cable">Data Cable</label></li>
							      <li><input type="checkbox" id="ID2" name="data[included][ear_phone]"><label for="ID2" value="Earphones/Headphones">Earphones/Headphones</label></li>
							      <li><input type="checkbox" id="ID3" name="data[included][memory_card]"><label for="ID3" value="Memory Card">Memory Card</label></li>
							      <li><input type="checkbox" id="ID4" name="data[included][others]"><label for="ID4" value="Others">Others</label></li>

							    </ul>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div> <!-- End of id="information_container" -->
				<div id="jobs_container">

						<div class="form-group" id="company_container">
							<div class="col-md-3">
								<label>Company Name</label>
							</div>
							<div class="col-md-9">
							 	<?php
							 		echo $this->form->input('company_name', array( 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'company_name', 'maxlength' => 100));
							 	?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="form-group">
							<div class="col-md-3">
								<label>Role</label>
							</div>
							<div class="col-md-9" id="divname">
							 	<?php
							 		echo $this->form->input('role_id', array('type' => 'select', 'empty' => 'Select', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'role_id', 'options' => $roles, 'name' => 'data[Role][id]'));

							 		echo $this->form->input('role_name', array('type' => 'hidden', 'name' => 'data[Role][name]', 'id' => 'role_name'));
							 	?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="form-group" id="designation_container">
							<div class="col-md-3">
								<label>Designation</label>
							</div>
							<div class="col-md-9">
							 	<?php
							 		echo $this->form->input('designation', array( 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'designation', 'maxlength' => 50));
							 	?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="form-group">
							<div class="col-md-3">
								<label id="edu_text">Education</label>
							</div>
							<div class="col-md-9">
							 	<?php
							 		echo $this->form->input('education', array( 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'education'));
							 	?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="form-group">
							<div class="col-md-3">
								<label id="exp_text">Experience</label>
							</div>
							<div class="col-md-9">
							 	<?php
							 		echo $this->form->input('experience', array( 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'experience', 'maxlength' => 100));
							 	?>
							</div>
							<div class="clear"></div>
						</div>

						<div class="form-group">
							<div class="col-md-3">
								<label>Key Skills</label>
							</div>
							<div class="col-md-9">
							 	<?php
							 		echo $this->form->input('key_skills', array( 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'key_skills', 'placeholder' => 'skills seperated by comma - i.e : c++,java,php'));
							 	?>
							</div>
							<div class="clear"></div>
						</div>

						<div id="resume_container">

							<div class="form-group">
				           		<div class="col-md-3">
					            	<label>Job Type</label>
				          		</div>
					          	<div class="col-md-9">
								  	<div>
										<table border="0" cellspacing="0" cellpadding="0" class="rediboxarea">
										<tr>
											<td><input type="radio" name="job_type" value="FT" class="JobType" checked></td>
										  	<td><label>FT</label>
									  		<td><input type="radio" name="job_type" value="PT"  class="JobType"></td>
									  		<td><label>PT</label>
									  		<td><input type="radio" name="job_type" value="Freelancer"  class="JobType"></td>
									  		<td><label>Freelancer</label></td>
										   </td>
										</tr>
										</table>
						            </div>
					          	</div>
					          <div class="clear"></div>
					        </div>

					        <div class="form-group">
								<div class="col-md-3">
									<label>Upload Resume</label>
								</div>
								<div class="col-md-9">
								 	<?php
								 		echo $this->Form->input('resume_file',array('type'=>'file','label' => false,'div' => false));
								 	?>
								</div>
								<div class="clear"></div>
							</div>

						</div> <!-- End of resume_container -->

				</div> <!-- End of jobs_container -->

				<div id="automobiles_container">

					<!-- <div class="form-group" id="model_container">
						<div class="col-md-3">
							<label>Model</label>
						</div>
						<div class="col-md-9">
						 	<?php
						 		echo $this->form->input('model_id', array('type' => 'select', 'empty' => 'Select Model', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'model_id', 'name' => 'data[AutoModel][id]'));

						 		echo $this->form->input('model_name', array('type' => 'hidden', 'id' => 'model_name', 'name' => 'data[AutoModel][name]'));
						 	?>
						</div>
						<div class="clear"></div>
					</div>
 -->
					<div class="form-group" id="year_container">
						<div class="col-md-3">
							<label>Year</label>
						</div>
						<div class="col-md-9">
						 	<?php
						 		echo $this->form->input('year', array('type' => 'select','empty' => 'Select year', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'year',));
						 	?>
						</div>
						<div class="clear"></div>
					</div>

					<div class="form-group" id="kms_driven_container">
						<div class="col-md-3">
							<label>Kms Driven</label>
						</div>
						<div class="col-md-9">
						 	<?php
						 		echo $this->form->input('kms_driven', array('type' => 'number', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'kms_driven'));
						 	?>
						</div>
						<div class="clear"></div>
					</div>

					<div class="form-group" id="fuel_type_container">
						<div class="col-md-3">
							<label>Fuel Type</label>
						</div>
						<div class="col-md-9">
						 	<?php
						 		echo $this->form->input('fuel_type', array('type' => 'select', 'empty' => 'Fuel Type', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'fuel_type', 'options' => array('CNG'=>'CNG', 'Diesel'=>'Diesel', 'Electric'=>'Electric', 'Hybrid'=>'Hybrid', 'LPG'=>'LPG', 'Petrol'=>'Petrol')));
						 	?>
						</div>
						<div class="clear"></div>
					</div>

					<div class="form-group" id="valid_till_container">
						<div class="col-md-3">
							<label>Insurance Valid Till</label>
						</div>
						<div class="col-md-9">
						 	<?php
						 		echo $this->form->input('valid_till', array('type' => 'text', 'class' => 'form-control date_picker', 'div' => false, 'label' => false, 'id' => 'valid_till'));
						 	?>
						</div>
						<div class="clear"></div>
					</div>

					<div class="form-group" id="vehicle_type_container">
						<div class="col-md-3">
							<label>Vehicle Type</label>
						</div>
						<div class="col-md-9">
						 	<?php
						 		echo $this->form->input('vehicle_type', array('type' => 'select', 'empty' => 'Vehicle Type', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'vehicle_type', 'options' => array('Auto Rickshaw'=>'Auto Rickshaw', 'Bulldozer'=>'Bulldozer', 'Bus'=>'Bus', 'Cement Mixer'=>'Cement Mixer', 'Crane'=>'Crane', 'Cycle Rickshaw'=>'Cycle Rickshaw', 'Tempo'=>'Tempo', 'Tractor'=>'Tractor', 'Truck'=>'Truck', 'Van'=>'Van', 'Other'=>'Other')));
						 	?>
						</div>
						<div class="clear"></div>
					</div>

				</div> <!-- End of automobiles_container -->

				<div id="events_container">

					<div class="form-group">
						<div class="col-md-3">
							<label>Event Date</label>
						</div>
						<div class="col-md-9">
						 	<?php
						 		echo $this->form->input('event_date', array('type' => 'text', 'class' => 'form-control date_picker', 'div' => false, 'label' => false, 'id' => 'event_date'));
						 	?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label>Venue</label>
						</div>
						<div class="col-md-9">
						 	<?php
						 		echo $this->form->input('venue', array('type' => 'text', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'venue'));
						 	?>
						</div>
						<div class="clear"></div>
					</div>
				</div> <!-- End of events_container -->

				<div id="real_estate_container">

					<div class="form-group">
						<div class="col-md-3">
							<label>City</label>
						</div>
						<div class="col-md-9">
						 	<?php
						 		echo $this->form->input('city', array('type' => 'text', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'city'));
						 	?>
						</div>
						<div class="clear"></div>
					</div>

					<div class="form-group">
						<div class="col-md-3">
							<label>Area</label>
						</div>
						<div class="col-md-9">
						 	<?php
						 		echo $this->form->input('area', array('type' => 'text', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'area'));
						 	?>
						</div>
						<div class="clear"></div>
					</div>



					<div class="form-group">
						<div class="col-md-3">
							<label>Locality</label>
						</div>
						<div class="col-md-9">
						 	<?php
						 		echo $this->form->input('locality', array('type' => 'text', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'locality'));
						 	?>
						</div>
						<div class="clear"></div>
					</div>
				</div> <!-- End of real_estate_container -->

				<div class="form-group">
					<div class="col-md-3">
						<label id="resume_title">Title<span style="color:red">&nbsp;*</span></label>
					</div>
					<div class="col-md-9">
					 	<?php
					 		echo $this->form->input('title', array( 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'title', 'maxlength' => 100, 'required'));
					 	?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group">
					<div class="col-md-3">
						<label>Description<span style="color:red">&nbsp; *</span></label>
					</div>
					<div class="col-md-9" id="divname">
					 	<?php
					 		echo $this->form->input('desc', array( 'class' => 'required form-control', 'div' => false, 'label' => false, 'id' => 'desc', 'maxlength' => 700, 'placeholder' => 'Max length 700 character', 'cols' => 40, 'rows' => 5, 'required'));
					 	?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group" id="price_container">
					<div class="col-md-3">
						<label>Price<span style="color:red" class="star">&nbsp;*</span></label>
					</div>
					<div class="col-md-5">
						<div id="pc">
					 	<?php
					 		echo $this->form->input('price', array( 'class' => 'required form-control number', 'div' => false, 'label' => false, 'id' => 'price', 'maxlength' => 10, 'required', 'type' => 'number', 'autocomplete'=>'off', 'pattern' => '[0-9]{10,10}'));
					 	?>
					 </div>
					</div>
					<div class="col-md-4" id="negotiable_container">
						<div class="checkbox">
							<?php
					 		echo $this->form->input('negotiable', array('type' => 'checkbox', 'value' => 1));
					 		?>
						</div>

					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group" id="condition_container">
	           		<div class="col-md-3">
		            	<label>Condition<span style="color:red" class='condition_star'>&nbsp; *</span></label>
	          		</div>
		          <div class="col-md-9">
				  	<div>
						<table border="0" cellspacing="0" cellpadding="0" class="rediboxarea">
						<tr>
							<td><input type="radio" name="condition" value="used" class="ItemUsage" required="required" checked="checked"></td>
						  	<td><label>Used</label>
					  		<td><input type="radio" name="condition" value="new"  class="ItemUsage" required="required"></td>
					  		<td><label>New</label></td>
						   </td>
						</tr>
						</table>
		            </div>
		          </div>
		          <div class="clear"></div>
		        </div>

		        <div class="form-group" id="usage_container">
					<div class="col-md-3">
						<label>How Old/Usage (Optional)</label>
					</div>
					<div class="col-md-9">
						<?php
							echo $this->form->input('how_old', array('type'=> 'select', 'empty' => 'Select', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'usage_id', 'options' => array('Less than 1 month'=>'Less than 1 month', '1 month'=>'1 month', '2 months'=>'2 months', '6 months'=>'6 months', 'Less than 1 year'=>'Less than 1 year', '1 year'=>'1 year', '1 year+'=>'1 year+' ,'2 years'=>'2 years', '3 years'=>'3 years')));
						?>
					</div>
					<div class="clear"></div>
				</div>

				 <div id="div2">
		         <div class="row">

						<div class="col-md-12">
							<div class="headtitle">
								<h2>Personal Details</h2>
							</div>
						</div>

			<div class="col-md-12">
				<div class="form-group" >
	           		<div class="col-md-3">
		            	<label id="you_are_label">You are<span style="color:red">&nbsp;*</span></label>
		          	</div>
		          	<div class="col-md-9">
			            <div>
			              <table border="0" cellspacing="0" cellpadding="0" class="rediboxarea">
			                <tr>
								<td ><input type="radio" name="youare" checked value="Individual" id="you_are_1" required></td>
								<td><label id="you_are_text_1">Individual</label></td>
								<td><input type="radio" name="youare"  value="dealer" id="you_are_2" required></td>
								<td><label id="you_are_text_2">Dealer</label></td>
								<td><input type='radio' name='youare' value='Builder' class='you_are_last'></td>
								<td><label class='you_are_last'>Builder</label></td>
			                </tr>
			              </table>
			            </div>
		          	</div>
		          <div class="clear"></div>
		        </div>

				<div class="form-group">
					<div class="col-md-3">
						<label>Name<span style="color:red">&nbsp;*</span></label>
					</div>
					<div class="col-md-9">
					 	<?php
					 		echo $this->form->input('name', array( 'class' => 'required form-control', 'div' => false, 'label' => false, 'id' => 'name', 'value' => $fb_name, 'required','READONLY' => 'readonly'));
					 	?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group">
					<div class="col-md-3">
						<label>Mobile</label>
					</div>
					<div class="col-md-9">

					 	<?php
					 		echo $this->form->input('mobile', array( 'class' => 'required form-control number', 'div' => false, 'label' => false, 'id' => 'mobile', 'maxlength' => 10, 'value' => $fb_mobile,  'type' => 'tel', 'pattern' => '[0-9]{10,10}'));
					 	?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group">
					<div class="col-md-3">
						<label>Email<span style="color:red">&nbsp;*</span></label>
					</div>
					<div class="col-md-9">
					 	<?php
					 		echo $this->form->input('email', array( 'class' => 'required form-control email', 'div' => false, 'label' => false, 'id' => 'email', 'value' => $fb_email, 'required','READONLY' => 'readonly'));
					 	?>
					</div>
					<div class="clear"></div>
				</div>

				<!-- <div class="form-group">
					<div class="col-md-3">
						<label>State<span style="color:red">&nbsp;*</span></label>
					</div>
					<div class="col-md-9">
					 	<?php
					 		// echo $this->form->input('personal_state', array('type' => 'select', 'class' => 'required form-control personal_state', 'div' => false, 'label' => false, 'id' => 'personal_state', 'required', 'empty' => 'Select State'));
					 	?>
					</div>
					<div class="clear"></div>
				</div> -->

				<div class="form-group">
					<div class="col-md-3">
						<label>City<span style="color:red">&nbsp;*</span></label>
					</div>
					<div class="col-md-9">
					 	<?php
					 		echo $this->form->input('personal_city', array( 'class' => 'required form-control personal_city', 'div' => false, 'label' => false, 'id' => 'personal_city', 'required'));
					 	?>

					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group">
					<div class="col-md-3">
						<label>Area<span style="color:red">&nbsp;*</span></label>
					</div>
					<div class="col-md-9">
					 	<?php
					 		echo $this->form->input('personal_area', array( 'class' => 'required form-control personal_area', 'div' => false, 'label' => false, 'id' => 'personal_area', 'required'));
					 	?>
					</div>
					<div class="clear"></div>
				</div>

				<div class="form-group">
					<div class="col-md-9 col-md-offset-3">
	      				<?php
							echo $this->form->input('Submit', array('type' => 'submit', 'id'=>'submit_btn', 'class' => 'btn btn-success marright', 'value' => 'submit', 'label' => false, 'div' => false));
						?>
					</div>
					<div class="clear"></div>
    			</div>

    			<!-- popup modal for if user not logged in then open it -->
				<div class="modal fade" id = "ad_post_modal">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">Ad Post</h4>
				      </div>
				      <div class="modal-body">
				        <p>
				        	<h2>Login to post your ad.</h2><br>
				        	<div class="pull-right">

				        	</div>

				        </p>
				      </div>
				      <div class="modal-footer">
				      	<?php
							echo $this->Html->image('fb.jpg', array('id' => 'ad_post_login','style'=>array("cursor : pointer"), 'class' => 'fb_auth'));
		        		?>
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

					      </div>
					    </div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
	    			<!-- end of popup modal for if user not logged in -->

						</div> <!-- end of col-md-6 -->

					</div> <!-- end of row -->
				</div> <!-- end of div2 -->



			</div> <!-- end of col-md-6 -->

			<div class="col-md-6">
				<div class="form-group">
		        	<div class="headtitle">
						<h2>Photos</h2>
					</div>
					<div style="background:#efefef; width:200px; height:200px;">
						<?php echo $this -> Form -> input('image_files.', array('type'=>'file','div' => false, 'label' => false, 'title' => 'Image', 'id' => 'item-primary-photo', 'multiple')); ?>
						<!--<?php// echo $this->Html->image('/files/item_photo/image_file/558aff39-050c-404f-872c-255c52d40771/big_jhgjhgjhg (1).jpg',array('width'=>100,'height'=>100))?>-->
                    </div>
					<div class="table table-striped files" id="previews"></div>
					<div class="col-md-9">
					</div>
					<div class="clear"></div>
		        </div>
			</div> <!-- end of col-md-6 -->

		</div> <!-- end of row -->
	</div> <!-- end of div1 -->
</div> <!-- end of container -->

<?php $this->end('page-wrapper'); ?>