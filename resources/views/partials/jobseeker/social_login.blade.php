<script type="text/javascript" src="//platform.linkedin.com/in.js">
			api_key: {{ env('LINKDIN_API_KEY') }}
			authorize: true
			onLoad: OnLinkedInFrameworkLoad
		</script>
		<script type="text/javascript">
			function OnLinkedInFrameworkLoad() {
				  IN.Event.on(IN, "auth", OnLinkedInAuth);

			}
			function OnLinkedInAuth() {
			IN.API.Profile("me").fields("id","first-name", "last-name", "email-address","picture-urls::(original)").result(ShowProfileData);
			}
			function ShowProfileData(profiles) {
				var id = profiles.values[0].id;
			    var firstName = profiles.values[0].firstName;
	            var emailAddress = profiles.values[0].emailAddress;
	            <?php if(!Session::has('jobsekker_id')): ?>
	            	StoreSocialSignup(firstName,emailAddress,id,"linkdin");
	            <?php endif; ?>
	            return false;
			}
			function LogoutLinkdin(){
				IN.User.logout(function(){
					 window.location = "{{route('jobseeker.logout')}}";
				});
							
			}

			/*########## SOCIAL LOGIN ########################*/

			function StoreSocialSignup(fname,email,social_id,is_login){
				var token = '{{ Session::token() }}';
				var url = "{{route('jobseeker.store.social')}}",
				message = $('#validate-signup');
				$.ajax({
					type: 'POST',
					url: url,
					data: {
						first_name: fname,
						user_email: email,
						social_id: social_id,
						is_login: is_login,
						_token: token
					},
					beforeSend: function(){
						
					},
					success: function(response){
						message.html('<p class="green">'+response.succes.msg+"</p>");
						window.location.href = "{{route('jobsekker.job.search')}}";
					},
					error: function(jqXHR, exception){
						var error = getErrorMessage(jqXHR, exception);
						//message.html('<p class="red">'+error+"</p>");
						alert(error);
						window.location.href = "{{route('jobsekker.job.search')}}";
						//LogoutLinkdin();
					}
				});
			}
		
		</script>
		
		<script>
			window.fbAsyncInit = function() {
				FB.init({
					appId      : '{{ env("FACEBOK_API_KEY") }}',
					cookie     : true,
					xfbml      : true,
					version    : 'v2.8'
				});
				FB.AppEvents.logPageView();   
			};

			function checkLoginState() {
				FB.getLoginStatus(function(response) {
					statusChangeCallback(response);
				});
			}

			// Facebook login with JavaScript SDK
			function fbLogin() {
			    FB.login(function (response) {
			        if (response.authResponse) {
			            // Get and display the user profile data
			            getFbUserData();
			        } else {
			            
			        }
			    }, {scope: 'email'});
			}

			// Fetch the user profile data from facebook
			function getFbUserData(){
			    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
			    function (response) {
			    	var firstName = response.first_name;
			    	var emailAddress = response.email;
			    	var id = response.id;
			        StoreSocialSignup(firstName,emailAddress,id,"facebook");
			    });
			}

			// Logout from facebook
			function fbLogout() {
				FB.logout(function() {
					//FB.Auth.setAuthResponse(null, 'unknown');
			    	window.location = "{{route('jobseeker.logout')}}";
			    });
			}

			(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>