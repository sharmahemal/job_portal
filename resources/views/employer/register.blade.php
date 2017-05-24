@extends('layouts.main')
@section('body_class','gray')
@section('content')
<link rel="stylesheet" type="text/css" href="http://www.jqueryscript.net/demo/Simple-Clean-jQuery-Html-Text-Editor-Plugin-ClassyEdit/css/jquery.classyedit.css" />
<style type="text/css">
	.help-block.form-error {
  display: none;
}
.classyedit {
    border: 1px solid #eee!important;
    border-radius: 3px;
    margin-left: 25%!important;
    margin-top: -35px;
    width: 440px!important;
}
</style>
<div class="content">
	<div class="ui container">
		<div class="ui grid margin-top margin-bottom white-boxes">
			<div class="box">
				<h2 class="text upper center">Employer registration form</h2>
				<form class="ui tabular longer-label form" id="employer_register" name="employer_register" method="post" action="{{route('employer.store.signup')}}">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="ui horizontal divider">Login information</div>
					<div class="inline field">
						<label>Email (Login ID):</label>
						<input type="text" id="company_email" name="company_email" value="" placeholder="Enter your email address." size="50" data-validation="email" data-validation-error-msg="Please enter a valid email address"/>
						<span id="validate-emp-email" style="color:red" class="font-14x"></span>
					</div>
					<div class="inline field">
						<label>Password:</label>
						<input type="password" name="company_password_confirmation" id="company_password" value="" placeholder="Enter password" size="20" maxlength="12" data-validation="length" data-validation-length="6-12" data-validation="alphanumeric" data-validation-error-msg="Password must be at least 6 characters"/>
						<div class="tips">Must between 6 to 12 characters long and must consist of alpha numerical value.</div>
					</div>
					<div class="inline field">
						<label>Retype password:</label>
						<input type="password" name="company_password" data-validation="confirmation" data-validation-error-msg="Password do not match" value="" placeholder="" size="20" maxlength="12"/>
					</div>
	
					<div class="ui horizontal divider">Company profile</div>
	
					<div class="inline field">
						<label>Company name:</label>
						<input type="text" name="company_name" id="company_name" value="" placeholder="" size="35" data-validation="required" data-validation-error-msg="Please enter a company name"/>
					</div>
					<div class="inline field">
						<label>Company profile URL</label>
						{{url('employer/profile')}}/<input type="text" name="company_alias" id="company_alias" size="25" placeholder="Must be unique and no space."  data-validation="length alphanumeric" data-validation-length="3-12" data-validation-error-msg="Company alias has to be an alphanumeric value (3-12 chars)" maxlength="10"  />
						<span id="validate-code" style="color: red"></span>
					</div>
					<div class="inline field">
						<label>Business registration number:</label>
						<input type="text" name="company_reg_num"  id="company_reg_num" value="" placeholder="" size="15" data-validation="required" maxlength="15" data-validation-error-msg="Please enter your business registration number."/>
					</div>
					<div class="inline field">
						<label>Industry:</label>
						<div class="ui selection search dropdown">
							<input type="hidden" name="company_industry_id" id="company_industry_id" value="" data-validation="required" data-validation-error-msg="Please select industry"/>
							<div class="default text">Select your industry</div>
							<i class="dropdown icon"></i>
							<div class="menu" data-numberized>
								<div class="header">Agriculture/Farming/Forestry</div >
								<div class ="item" data-value="Animal Feed">Animal Feed</div>
								<div class ="item" data-value="Dairy">Dairy</div>
								<div class ="item" data-value="Farming">Farming</div>
								<div class ="item" data-value="Fishery">Fishery</div>
								<div class ="item" data-value="Forestry">Forestry</div>
								<div class ="item" data-value="Plantation">Plantation</div>
								<div class ="item" data-value="Poultry">Poultry</div>
								<div class="header">Business & Finance</div >
								<div class ="item" data-value="Accounting/Audit/Taxation">Accounting/Audit/Taxation</div>
								<div class ="item" data-value="Banking">Banking</div>
								<div class ="item" data-value="Business Consulting">Business Consulting</div>
								<div class ="item" data-value="Credit Collection">Credit Collection</div>
								<div class ="item" data-value="Finance">Finance</div>
								<div class ="item" data-value="Insurance">Insurance</div>
								<div class ="item" data-value="Investment">Investment</div>
								<div class ="item" data-value="Market Research">Market Research</div>
								<div class ="item" data-value="Marketing">Marketing</div>
								<div class ="item" data-value="Procurement">Procurement</div>
								<div class ="item" data-value="Stock Broking">Stock Broking</div>
								<div class ="item" data-value="Trading">Trading</div>
								<div class="header">Communication</div >
								<div class ="item" data-value="Advertising">Advertising</div>
								<div class ="item" data-value="Branding">Branding</div>
								<div class ="item" data-value="Public Relations">Public Relations</div>
								<div class="header">Compliance</div >
								<div class ="item" data-value="Health & Safety">Health & Safety</div>
								<div class ="item" data-value="ISO">ISO</div>
								<div class ="item" data-value="Quality Assurance">Quality Assurance</div>
								<div class ="item" data-value="Quality Control">Quality Control</div>
								<div class="header">Computing & IT</div >
								<div class ="item" data-value="Data Management">Data Management</div>
								<div class ="item" data-value="Hardware">Hardware</div>
								<div class ="item" data-value="Networking">Networking</div>
								<div class ="item" data-value="Security">Security</div>
								<div class ="item" data-value="Software">Software</div>
								<div class="header">Construction & Property</div >
								<div class ="item" data-value="Architecture">Architecture</div>
								<div class ="item" data-value="Construction">Construction</div>
								<div class ="item" data-value="Maintenance & Repair">Maintenance & Repair</div>
								<div class ="item" data-value="Property Development">Property Development</div>
								<div class ="item" data-value="Quantity Surveying">Quantity Surveying</div>
								<div class ="item" data-value="Real Estate">Real Estate</div>
								<div class ="item" data-value="Fashion Design">Fashion Design</div>
								<div class ="item" data-value="Graphic Design">Graphic Design</div>
								<div class ="item" data-value="Industrial Design">Industrial Design</div>
								<div class ="item" data-value="Interior Design">Interior Design</div>
								<div class="header">Education</div >
								<div class ="item" data-value="Colleges/Universities">Colleges/Universities</div>
								<div class ="item" data-value="Early Childhood Education">Early Childhood Education</div>
								<div class ="item" data-value="Polytechnics">Polytechnics</div>
								<div class ="item" data-value="Primary Education">Primary Education</div>
								<div class="header">Engineering</div >
								<div class ="item" data-value="Aerospace">Aerospace</div>
								<div class ="item" data-value="Chemical">Chemical</div>
								<div class ="item" data-value="Civil">Civil</div>
								<div class ="item" data-value="Electrical/Electronic">Electrical/Electronic</div>
								<div class ="item" data-value="Environment">Environment</div>
								<div class ="item" data-value="Mechanical">Mechanical</div>
								<div class ="item" data-value="Materials">Materials</div>
								<div class ="item" data-value="Nuclear">Nuclear</div>
								<div class ="item" data-value="Petroleum">Petroleum</div>
								<div class="header">Entertainment</div >
								<div class ="item" data-value="Cinema">Cinema</div>
								<div class ="item" data-value="Distribution">Distribution</div>
								<div class ="item" data-value="Game & Toys">Game & Toys</div>
								<div class ="item" data-value="Music">Music</div>
								<div class ="item" data-value="Production">Production</div>
								<div class="header">Fine Arts</div >
								<div class ="item" data-value="Handicraft">Handicraft</div>
								<div class ="item" data-value="Painting">Painting</div>
								<div class="header">Food & Beverage</div >
								<div class ="item" data-value="Beverage Manufacturing">Beverage Manufacturing</div>
								<div class ="item" data-value="Catering">Catering</div>
								<div class ="item" data-value="Food Manufacturing">Food Manufacturing</div>
								<div class ="item" data-value="Food Processing">Food Processing</div>
								<div class ="item" data-value="Restaurant/Dining">Restaurant/Dining</div>
								<div class="header">Global Business Service</div >
								<div class ="item" data-value="Customer Service">Customer Service</div>
								<div class ="item" data-value="Engineering Services">Engineering Services</div>
								<div class ="item" data-value="Finance & Accounting">Finance & Accounting</div>
								<div class ="item" data-value="Heathcare Services">Heathcare Services</div>
								<div class ="item" data-value="Human Resources">Human Resources</div>
								<div class ="item" data-value="Information Technology">Information Technology</div>
								<div class ="item" data-value="Legal Services">Legal Services</div>
								<div class="header">Health Care</div >
								<div class ="item" data-value="Clinical">Clinical</div>
								<div class ="item" data-value="Dentistry">Dentistry</div>
								<div class ="item" data-value="Fitness & SPA">Fitness & SPA</div>
								<div class ="item" data-value="Health Equipment">Health Equipment</div>
								<div class ="item" data-value="Hospital">Hospital</div>
								<div class ="item" data-value="Nutrition">Nutrition</div>
								<div class ="item" data-value="Optical">Optical</div>
								<div class ="item" data-value="Pharmaceutical">Pharmaceutical</div>
								<div class ="item" data-value="Psychiatric">Psychiatric</div>
								<div class ="item" data-value="Radiology & Diagnostic Imaging">Radiology & Diagnostic Imaging</div>
								<div class ="item" data-value="Rehabilitation & Therapy">Rehabilitation & Therapy</div>
								<div class ="item" data-value="Veterinary">Veterinary</div>
								<div class="header">Hospitality</div >
								<div class ="item" data-value="Hotel/Resort">Hotel/Resort</div>
								<div class ="item" data-value="Travel">Travel</div>
								<div class="header">Human Resources</div >
								<div class ="item" data-value="Compensation & Benefit">Compensation & Benefit</div>
								<div class ="item" data-value="HR Consultancy">HR Consultancy</div>
								<div class ="item" data-value="HR Generalist">HR Generalist</div>
								<div class ="item" data-value="Industrial Relasionist">Industrial Relasionist</div>
								<div class ="item" data-value="Recruitment">Recruitment</div>
								<div class ="item" data-value="Training & Development">Training & Development</div>
								<div class="header">Industrial</div >
								<div class ="item" data-value="Mining">Mining</div>
								<div class ="item" data-value="Oil & Gas">Oil & Gas</div>
								<div class ="item" data-value="Oleochemical">Oleochemical</div>
								<div class="header">Logistic</div >
								<div class ="item" data-value="Airport Management">Airport Management</div>
								<div class ="item" data-value="Courier">Courier</div>
								<div class ="item" data-value="Distribution">Distribution</div>
								<div class ="item" data-value="Freight Forwarding">Freight Forwarding</div>
								<div class ="item" data-value="Port Management">Port Management</div>
								<div class ="item" data-value="Supply Chain">Supply Chain</div>
								<div class ="item" data-value="Warehousing">Warehousing</div>
								<div class="header">Manufacuring</div >
								<div class ="item" data-value="Food">Food</div>
								<div class ="item" data-value="Footware">Footware</div>
								<div class ="item" data-value="Furniture">Furniture</div>
								<div class ="item" data-value="Glass">Glass</div>
								<div class ="item" data-value="Metal">Metal</div>
								<div class ="item" data-value="Packaging">Packaging</div>
								<div class ="item" data-value="Plastic">Plastic</div>
								<div class ="item" data-value="Rubber">Rubber</div>
								<div class ="item" data-value="Textile">Textile</div>
								<div class="header">Media</div >
								<div class ="item" data-value="Broadcasting">Broadcasting</div>
								<div class ="item" data-value="Internet">Internet</div>
								<div class ="item" data-value="Newspaper">Newspaper</div>
								<div class ="item" data-value="Radio">Radio</div>
								<div class ="item" data-value="TV">TV</div>
								<div class="header">Printing & Publishing</div >
								<div class ="item" data-value="Books">Books</div>
								<div class ="item" data-value="Magazine">Magazine</div>
								<div class ="item" data-value="Marketing & Promotion Materials">Marketing & Promotion Materials</div>
								<div class="header">Retail</div >
								<div class ="item" data-value="Distributors">Distributors</div>
								<div class ="item" data-value="Hypermarket">Hypermarket</div>
								<div class ="item" data-value="Retail Store">Retail Store</div>
								<div class ="item" data-value="Wholesale">Wholesale</div>
								<div class="header">Science & Technology</div >
								<div class ="item" data-value="Biotechnology">Biotechnology</div>
								<div class ="item" data-value="Food Technology">Food Technology</div>
								<div class ="item" data-value="Geology">Geology</div>
								<div class ="item" data-value="Laboratory">Laboratory</div>
								<div class="header">Services</div >
								<div class ="item" data-value="Administration">Administration</div>
								<div class ="item" data-value="Beauty & Spa">Beauty & Spa</div>
								<div class ="item" data-value="Child Care/Day Care">Child Care/Day Care</div>
								<div class ="item" data-value="Cleaning">Cleaning</div>
								<div class ="item" data-value="Counseling">Counseling</div>
								<div class ="item" data-value="Funeral">Funeral</div>
								<div class ="item" data-value="Help Desk">Help Desk</div>
								<div class ="item" data-value="Legal">Legal</div>
								<div class ="item" data-value="Library">Library</div>
								<div class ="item" data-value="Security/Armed Forces">Security/Armed Forces</div>
								<div class ="item" data-value="Social Services">Social Services</div>
								<div class ="item" data-value="Translation/Interpretation">Translation/Interpretation</div>
								<div class="header">Transportation</div >
								<div class ="item" data-value="Automotive">Automotive</div>
								<div class ="item" data-value="Aviation">Aviation</div>
								<div class ="item" data-value="Marine">Marine</div>
								<div class ="item" data-value="Rail">Rail</div>
								<div class="header">Utilities</div >
								<div class ="item" data-value="Eletricyties">Eletricyties</div>
								<div class ="item" data-value="Telecommunication">Telecommunication</div>
								<div class ="item" data-value="Waste Management">Waste Management</div>
								<div class ="item" data-value="Water">Water</div>
							</div>
						</div>
					</div>
					<div class="inline field">
						<label>Company size:</label>
						<div class="ui selection dropdown">
							<input type="hidden" name="company_size_id" id="company_size_id" value="" data-validation="required" data-validation-error-msg="Please select company size"/>
							<div class="default text">Select your company size</div>
							<i class="dropdown icon"></i>
							<div class="menu">
								<div class="item" data-value="1">1 - 5</div>
								<div class="item" data-value="2">5 - 10</div>
								<div class="item" data-value="3">10 - 20</div>
								<div class="item" data-value="4">20 - 50</div>
								<div class="item" data-value="5">50 - 100</div>
								<div class="item" data-value="6">above 100</div>
							</div>
						</div>
					</div>
					<div class="inline field">
						<label>Type of organization:</label>
						<div class="ui selection dropdown">
							<input type="hidden" name="company_type_org_id" id="company_type_org_id" value="" data-validation="required" data-validation-error-msg="Please select organization"  />
							<div class="default text">Tell us your organization type</div>
							<i class="dropdown icon"></i>
							<div class="menu">
								<div class="item" data-value="1">Recruitment agency</div>
								<div class="item" data-value="2">Small-medium enterprise</div>
								<div class="item" data-value="3">Multinational (MNC)</div>
								<div class="item" data-value="4">Non-profit organization</div>
								<div class="item" data-value="5">Government</div>
							</div>
						</div>
					</div>
					<div class="inline field">
						<label>Company description:</label>
						<textarea name="company_description" class="company-description" cols="50" rows="5"  data-validation-error-msg="Please enter a company description"></textarea>
					</div>
					<div class="inline field">
						<label>Website address:</label>
						<input type="text" name="company_url" id="company_url" value="" data-validation="url" placeholder="http://" size="50" />
					</div>
					<div class="inline field">
						<label>Telephone number:</label>
						<input type="text" name="company_tel_number" id="company_tel_number" value="" placeholder="" size="10" maxlength="10" data-validation="number" data-validation-error-msg="Please enter valid number"/>
					</div>
					<div class="inline field">
						<label>Fax number:</label>
						<input type="text" name="company_fax" id="company_fax" value="" placeholder="" size="20" maxlength="10" data-validation="number" data-validation-error-msg="Please enter valid fax number"/>
					</div>
	
					<div class="inline field">
						<div class="wrapper">
							<div id="map" class="ui tall map"></div>
						</div>
					<p>(Click on anywhere on the map to mark your business location)</p>
				</div>
	
				
				<div class="inline field">
					<label>Select country</label>
					<select class="ui dropdown"  name="company_country_id" id="company_country_id" value="" data-validation="required" data-validation-error-msg="Please select country">
						<option value="">Select a country</option>
						<option value="Malaysia">Malaysia</option>
					</select>
				</div>
	
				<div class="inline field">
					<label>Address:</label>
					<textarea name="company_address" id="company_address" cols="50" rows="3" data-validation="required" data-validation-error-msg="Please enter address"></textarea>
					<input type="hidden" name="company_lat" id="company_lat" /></label>
					<input type="hidden" name="company_long" id="company_long" /></label>
				</div>
				<div class="inline field">
					<label>Postcode:</label>
					<input type="text" name="company_postcode" id="company_postcode" value="" placeholder="" size="10" maxlength="5" data-validation="number" data-validation-error-msg="Please enter  postcode"/>
				</div>
				<div class="inline field">
					<label>City:</label>
					<input type="text" name="company_city" id="company_city" value="" placeholder="" size="20" data-validation="required" data-validation-error-msg="Please enter city"/>
				</div>
				<div class="inline field"  >
					<label>Select state</label>
					<select class="ui dropdown" name="company_state_id" id="company_state_id" data-validation="required" data-validation-error-msg="Please select state" >
						<option value="">Select a state</option>
						<?php foreach($state as $stateName){ ?>
						<option value="{{$stateName->state_name}}" >{{$stateName->state_name}}</option>
						<?php } ?>
					</select>
				</div>
	
				<div class="ui horizontal divider">Contact person</div>
	
				<div class="inline field">
					<label>Name:</label>
					<input type="text" name="company_contact_person_name" id="company_contact_person_name" value="" placeholder="" size="35" data-validation="required" data-validation-error-msg="Please enter contact name"/>
				</div>
				<div class="inline field">
					<label>Email:</label>
					<input type="email" name="company_cont_person_email" id="company_cont_person_email" value="" placeholder="" size="50" data-validation="email" data-validation-error-msg="Please enter valid contact email"/>
				</div>
				<div class="inline field">
					<label>Position:</label>
					<input type="text" name="company_cont_person_position" id="company_cont_person_position" value="" placeholder="" size="35" data-validation="required" data-validation-error-msg="Please enter position"/>
				</div>
				<div class="inline field">
					<label>Telephone:</label>
					<input type="text" name="company_cont_per_tel" id="company_cont_per_tel" value="" placeholder="" size="20" maxlength="10" data-validation="number" data-validation-error-msg="Please enter telephone"/>
				</div>
				<br /><br /><br />
				<div class="inline captcha field">
					<label>Security check:</label>
					<div class="inline">
						<div id="captcha-2" class="g-recaptcha"></div>
					</div>
				</div>
				<div class="field">
					<div class="ui checkbox">
						<input type="checkbox" name="agreement" value="1" data-validation="required" data-validation-error-msg="Please select our terms of use and privacy policy agreement"/>
						<label>By registering an employer account, you are agreed with our <a href="#">terms of use</a>.
						</div>
					</div>
	
					<div class="actions">
						<button type="submit" class="ui primary submit button" id="emp_reg_submit" >Submit</button> <!-- disabled="disabled" -->
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="http://www.jqueryscript.net/demo/Simple-Clean-jQuery-Html-Text-Editor-Plugin-ClassyEdit/js/jquery.classyedit.js"></script>
<script>
function initMap() {
	var mapContainer = $("#map");
	var myLatLng = {lat: 3.134047, lng: 101.679090};
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 10,
		center: myLatLng
	});

	var geocoder = new google.maps.Geocoder();
	var marker;
	
	google.maps.event.addListener(map, 'click', function(event) {
		if ( marker ) {
			marker.setPosition(event.latLng);
		} else {
			marker = new google.maps.Marker({
		        position: event.latLng, 
		        map: map
		    });
		}

		$("#company_lat").val(event.latLng.lat());
		$("#company_long").val(event.latLng.lng());
		
		geocoder.geocode({
			'latLng': event.latLng
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				if (results[0]) {
					var fullAddress = results[0].formatted_address;
					$("#company_address").val(fullAddress);
				}
			}
		});
	});
}
$(document).ready(function() {
	$(".company-description").ClassyEdit();
});
</script>
<script type="text/javascript">

      $(document).on('change', '#company_alias', function(){
        var token = '{{ Session::token() }}';
        var url = "{{route('employer.register.companyalias')}}",
        message = $('#validate-code');

        $.ajax({
          type: 'POST',
          url: url,
          data: {
            code: $('#company_alias').val(),
            _token: token
          },
          beforeSend: function(){
            $('#emp_reg_submit').attr('disabled','disabled');
            message.html('')
            //message.addClass('ui loader');

          },
          success: function(response){
            //message.removeClass('ui loader');
            $('#emp_reg_submit').removeAttr('disabled');
          },
          error: function(jqXHR, exception){
            var error = getErrorMessage(jqXHR, exception);
            message.html(error);
          }
        });
      }); 
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFcfsp5EDchadYiYGxjOCfC6CV-P0-4g&callback=initMap"></script>
@endsection



