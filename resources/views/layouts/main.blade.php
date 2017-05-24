<!doctype html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0">
		<meta name="description" content="@yield('meta_description', 'Malaysia number 1 jobs portal.')">
		<meta name="keyword" content="@yield('meta_keyword', 'find job, malaysia job')">
		<meta charset="utf-8">
		<title>@yield('title', 'myStarjob.com')</title>
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" type="text/css" href="{{ url('public/semantic-ui/semantic.min.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ url('public/css/slick.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ url('public/css/slick-theme.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ url('public/css/styles.css') }}" />
		<link rel="stylesheet" type="text/css" href="{{ url('public/css/custom.css') }}" />
		@yield('css')
		<script>
		var captchaKey = "{{ env('RECAPTCHA_PUBLIC_KEY', '') }}";
		</script>
		@include('partials.jobseeker.social_login')
		
	</head>
	<body class="@yield('body_class')">
		<div id="container" class="container">
			<!-- HEDER HERE -->
			<?php 
				$getRouteName = Route::currentRouteName();
				if ( $getRouteName ) {
					$arryRoute = explode(".", $getRouteName);
					$getDir = $arryRoute[0];
				} else {
					$fullUrl = url()->full();
					
					if ( preg_match('/\/employer\/?/', $fullUrl) ) {
						$getDir = 'employer';
					} else {
						$getDir = 'jobseeker';
					}
				}
			?>
			
			<?php if($getDir == 'employer'){ ?>
			@include('partials.employer.header')
			<?php } else { ?>
			@include('partials.jobseeker.header')
			<?php } ?>
			<!-- MESSAGES SHOW HERE -->
			@include('partials.jobseeker.messages')

			<!-- MIDDLE SECTION CONTENT WILL POPULATE HERE -->
			@yield('content')	

			<!-- FOOTER HERE -->
			@include('partials.jobseeker.footer')

		</div>

		<!-- MODAL HERE -->
		@include('partials.jobseeker.modal')

		<!-- ALL MODAL HERE -->
		@yield('modal')
		
		<script src="{{ url('public/js/jquery-3.2.1.min.js') }}"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
		<script src="{{ url('public/js/jquery.validate.js') }}"></script>
		<script src="{{ url('public/semantic-ui/semantic.min.js') }}"></script>
		<script src="{{ url('public/js/bootstrap-datepicker.min.js') }}"></script>
		<script src="{{ url('public/js/init.js') }}"></script>
		<script src="{{ url('public/js/float-menu.js') }}"></script>
		<script src="{{ url('public/js/custom.js') }}"></script>
		<?php if(!Session::has('jobsekker_id')): ?>
		<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
		<script type="text/javascript">
			$( document ).ready(function() {
				/*var mapOptions = {
				    center: new google.maps.LatLng(3.1347763, 101.6811903),
				    zoom: 8
				},
				map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions),
				marker = new google.maps.Marker({
				    position: map.getCenter(),
				    map: map,
				    title: 'Drag to set position',
				    draggable: true,
				    flat: false
				});
				google.maps.event.addListener(marker, 'dragend', function() {
			    	latlng = marker.getPosition();
			    	url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+ latlng.lat() + ',' + latlng.lng() + '&sensor=false';
			    	$.get(url, function(data) {
			    		if (data.status == 'OK') {
			    			map.setCenter(data.results[0].geometry.location);
			    			var i=0;
			    			for(i; i < data.results.length; i++){
			    				for(var j=0;j < data.results[i].address_components.length; j++){
			    					for(var k=0; k < data.results[i].address_components[j].types.length; k++){
			    						if(data.results[i].address_components[j].types[k] == "postal_code"){
			    							zipcode = data.results[i].address_components[j].short_name;
			    						}
			    						if(data.results[i].address_components[j].types[k] == "locality"){
			    							city = data.results[i].address_components[j].short_name;
			    						}
			    						if(data.results[i].address_components[j].types[k] == "administrative_area_level_1"){
			    							state = data.results[i].address_components[j].short_name;
			    						}
			    						if(data.results[i].address_components[j].types[k] == "country"){
			    							country = data.results[i].address_components[j].long_name;
			    						}
			    					}
			    				}
			    			}                
			    			if (confirm('Do you also want to change location text to ' + data.results[0].formatted_address) === true) {
			    				$('#company_address').val(data.results[0].formatted_address);
			    				$('#company_postcode').val(zipcode);
			    				$('#company_city').val(city);
			    				$('#company_country_id').dropdown('set selected',[country]);
			    				$('#company_state_id').dropdown('set selected',[state]);
			    				$('#company_lat').val(data.results[0].geometry.location.lat);
			    				$('#company_long').val(data.results[0].geometry.location.lng);
			    			}
			    		}
			    	});
			    });*/
		    });
			var token = '{{ Session::token() }}';
			var error_icon = '<i class="fa fa-times mr5"></i>';
			var e_flag = false;
			var c_flag = false;
			/*#FOR EMPLOYER*/
			var ee_flag = false;
			var ec_flag = false;
			function check_flags()
			{
				if(e_flag && c_flag){
					$('#signup-btn').removeAttr('disabled');
				} else {
					$('#signup-btn').attr('disabled',true);
				}
			}
			function check_employer_flags()
			{
				if(ee_flag && ec_flag){
					$('#emp_reg_submit').removeAttr('disabled');
				} else {
					$('#emp_reg_submit').attr('disabled',true);
				}
			}
			/*check jobseeker register email*/
			$(document).on('focusout', '#email', function(){
				if( !validateEmail($('#email').val())) {
					return false;
				}
				var url = "{{route('jobseeker.check.email')}}",
				message = $('#validate-email');

				$.ajax({
					type: 'POST',
					url: url,
					data: {
						email: $('#email').val(),
						_token: token
					},
					beforeSend: function(){
						message.html('');
					},
					success: function(response){
						if($('#email').val().length > 0){ e_flag = true; check_flags(); }
					},
					error: function(jqXHR, exception){
						e_flag = false;
						check_flags();
						var error = getErrorMessage(jqXHR, exception);
						message.html(error_icon + error);
					}
				});
			});	
			/*check jobseeker register email*/
			$(document).on('focusout', '#company_email', function(){
				if( !validateEmail($('#company_email').val())) {
					return false;
				}

				@if ( session('employer_id') )
				var url = "{{route('employer.check.email')}}?exclude={{ session('employer_id') }}",
				@else
				var url = "{{route('employer.check.email')}}",
				@endif
				
				message = $('#validate-emp-email');

				$.ajax({
					type: 'POST',
					url: url,
					data: {
						email: $('#company_email').val(),
						_token: token
					},
					beforeSend: function(){
						message.html('');
					},
					success: function(response){
						if($('#company_email').val().length > 0){ ee_flag = true; check_employer_flags(); }
					},
					error: function(jqXHR, exception){
						ee_flag = false;
						check_employer_flags();
						var error = getErrorMessage(jqXHR, exception);
						message.html(error_icon + error);
					}
				});
			});	
			$('#signup-btn').on('click', function() {
				if( !$('#signup-form').isValid() ) {
			      
			   } else {
			   	  return StoreSignup(token);
			   }
			});
			function StoreSignup(token){
				var url = "{{route('jobseeker.store.signup')}}",
				message = $('#validate-signup');
				var datastring = $("#signup-form").serialize();
				$.ajax({
					type: 'POST',
					url: url,
					data: {
						signup_form: datastring,
						_token: token
					},
					beforeSend: function(){
						message.html('');
						$('#loader_signup').show();
						$('#signup-btn').attr('disabled','disabled');
					},
					success: function(response){
						$('#loader_signup').hide();
						$('#signup-btn').removeAttr('disabled');
						message.html('<p class="green">'+response.succes.msg+"</p>");
						ResetSignUpForm();
						grecaptcha.reset();
						$('#signup-btn').attr('disabled','disabled');
					},
					error: function(jqXHR, exception){
						$('#loader_signup').hide();
						$('#signup-btn').removeAttr('disabled');
						var error = getErrorMessage(jqXHR, exception);
						message.html('<p class="red">'+error+"</p>");
					}
				});
			}
			function onLogin(){
				if( !$('#login-form').isValid() ) {
				      console.log('Invalid login validation');
				} else {
				   	  return CheckLogin(token);
				}
			}
			function onEmployerLogin(){
				if( !$('#emp-login-form').isValid() ) {
				      console.log('Invalid login validation');
				} else {
				   	  return CheckEmployerLogin(token);
				}
			}
			function onForgotPassword(){
				if( !$('#forgotpass-form').isValid() ) {
				      console.log('Invalid forgotpass validation');
				} else {
				   	  return CheckForgotpass(token);
				}
			}
			function CheckLogin(token){
				var url = "{{route('jobseeker.login')}}",
				message = $('#validate-login');
				var datastring = $("#login-form").serialize();
				$.ajax({
					type: 'POST',
					url: url,
					data: {
						login_form: datastring,
						_token: token
					},
					beforeSend: function(){
						message.html('');
						$('#loader_login').show();
						$('#login-submit').attr('disabled','disabled');
					},
					success: function(response){
						$('#loader_login').hide();
						$('#login-submit').removeAttr('disabled');
						message.html('<p class="green">'+response.msg+"</p>");
						window.location.href = response.redir;
					
					},
					error: function(jqXHR, exception){
						$('#loader_login').hide();
						$('#login-submit').removeAttr('disabled');
						var error = getErrorMessage(jqXHR, exception);
						message.html('<p class="red">'+error+"</p>");
					}
				});
			}
			function CheckEmployerLogin(token){
				var url = "{{route('employer.login')}}",
				message = $('#emp-validate-login');
				var datastring = $("#emp-login-form").serialize();
				$.ajax({
					type: 'POST',
					url: url,
					data: {
						login_form: datastring,
						_token: token
					},
					beforeSend: function(){
						message.html('');
						$('#emp_loader_login').show();
						$('#emp-login-submit').attr('disabled','disabled');
					},
					success: function(response){
						$('#emp_loader_login').hide();
						$('#emp-login-submit').removeAttr('disabled');
						message.html('<p class="green">'+response.msg+"</p>");
						window.location.href = response.redir;
					
					},
					error: function(jqXHR, exception){
						$('#emp_loader_login').hide();
						$('#emp-login-submit').removeAttr('disabled');
						var error = getErrorMessage(jqXHR, exception);
						message.html('<p class="red">'+error+"</p>");
					}
				});
			}
			function CheckForgotpass(token){
				var url = "{{route('jobseeker.forgotpassword')}}",
				message = $('#validate-forgotpass');
				var datastring = $("#forgotpass-form").serialize();
				$.ajax({
					type: 'POST',
					url: url,
					data: {
						forgotpass_form: datastring,
						_token: token
					},
					beforeSend: function(){
						message.html('');
						$('#loader_forgotpass').show();
						$('#forgotpass-submit').attr('disabled','disabled');
					},
					success: function(response){
						$('#loader_forgotpass').hide();
						$('#forgotpass-submit').removeAttr('disabled');
						message.html('<p class="green">'+response.succes.msg+"</p>");
						$('#forgotpass-form')[0].reset();
					},
					error: function(jqXHR, exception){
						$('#loader_forgotpass').hide();
						$('#forgotpass-submit').removeAttr('disabled');
						$('#forgotpass-form')[0].reset();
						var error = getErrorMessage(jqXHR, exception);
						message.html('<p class="red">'+error+"</p>");
					}
				});
			}
			$('#login_to_forgot').click(function(){
				$('#login-form')[0].reset();
			});
			$('#forgot_to_login').click(function(){
				$('#forgotpass-form')[0].reset();
			});
			
		</script>
		<?php endif; ?>
		
		<?php if(Session::has('jobsekker_id')): ?>
		<script type="text/javascript">
		$(document).ready(function (e) {
		    $('#jobseeker_profile_action').on('submit',(function(e) {
		        e.preventDefault();
		        var formData = new FormData(this);
		        var imgclean = $('#ImageBrowse');
		        var imgname  =  $('#ImageBrowse').val();
		        var size  =  $('#ImageBrowse')[0].files[0].size;
		        var ext =  imgname.substr( (imgname.lastIndexOf('.') +1) ).toLowerCase();
		        if($.inArray(ext,['jpg','jpeg','gif'])===-1)
		        {   
		            alert('Sorry Only you can uplaod JPEG|JPG|PNG|GIF file type ');
		            return false;
		        }else if(size >= 1000000){ //less then 1MB
		            alert('Sorry File size exceeding from 1 Mb');
		            return false;
		        }
		        $.ajax({
		            type:'POST',
		            url: $(this).attr('action'),
		            data:formData,
		            cache:false,
		            contentType: false,
		            processData: false,
		            beforeSend: function(){
		                var loader_url = "{{url('public/uploads/clock-loading.gif')}}";
		                $('#jobsekker_profile_image').attr('src',loader_url);
		            },
		            success: function(response){
		                $('#jobsekker_profile_image').attr('src',response.profileImage);
		            },
		            error: function(jqXHR, exception){
		               
		            }
		        });
		    }));

		    $("#ImageBrowse").on("change", function() {
		        $("#jobseeker_profile_action").submit();
		    });
		});
		</script>
		<?php endif; ?>

		@yield('script')
		
		<!-- BEGIN JIVOSITE CODE {literal} -->
		<!-- <script type='text/javascript'>
		(function(){ var widget_id = '9DSuupfqUz';var d=document;var w=window;function l(){
		var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script> -->
		<!-- {/literal} END JIVOSITE CODE -->
	</body>

</html>
<?php 
Session::forget('access_denied');
Session::forget('error');
Session::forget('success');
?>