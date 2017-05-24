<?php if(!Session::has('jobsekker_id')): ?>
	<!-- Login Modal Box -->
	<div class="ui tiny modal" id="modal-login">
		<i class="close icon" onclick="ResetLoginForm();"></i>
		<div class="header">Job seeker's sign in</div>
		<div class="content">
			<div class="ui grid">
				<div class="eight wide column">
					<a href="javascript:void(0);" onclick="fbLogin()" class="ui button facebook">
						<i class="facebook icon"></i> Login with Facebook
					</a>
				</div>
				<div class="eight wide column right aligned">
					<a href="javascript:void(0);" class="ui button linkedin" onclick="LogoutLinkdin();">
						<!-- <i class="linkedin icon"></i> Login with LinkedIn -->
						<script type="in/Login"></script>
					</a>
				</div>
			</div>
			
			<div class="ui horizontal divider"> OR </div>
			
			<span id="validate-login"></span><img src="{{ url('public/img/loading.gif') }}" id="loader_login" style="display:none"/ >
			<form class="ui form" name="login-form" id="login-form" onsubmit="return false;">
				<table class="ui form-table">
					<tr>
						<th>Email</th>
						<td>
							<input type="text" name="email" id="login_email" data-validation="email" data-validation-error-msg="Please enter a valid email address"/>
						</td>
					</tr>
					<tr>
						<th>Password</th>
						<td>
							<input type="password" name="password" id="login_password" data-validation="length" data-validation-length="min6" data-validation-error-msg="Password must be at least 6 characters"/>
						</td>
					</tr>
					<tr>
						<th></th>
						<td>
							<div class="ui checkbox">
								<input tabindex="0" class="hidden" name="remember" id="remember" type="checkbox">
								<label>Remember me</label>
							</div>
						</td>
					</tr>
					<tr>
						<th></th>
						<td>
							<button type="submit" class="ui button primary" id="login-submit" onclick="return onLogin();">Login</button> &nbsp; <a href="javascript:void(0);" id="login_to_forgot" data-toggle="modal" data-target="#modal-forgotpass">Forgot password</a>	
						</td>
					</tr>
				</table>
			</form>
			
			<div class="text center upper" style="margin: 1rem 0px;"><a href="#" class="close" data-toggle="modal" data-target="#modal-register">Not yet member? Register now!</a></div>
			<p>By connecting to Facebook, I have read and agreed to myStarjob.com <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</p>
		</div>
	</div>
	
	<!-- Registration Modal Box -->
	<div class="ui tiny modal" id="modal-register">
		<i class="close icon" onclick="ResetSignUpForm();"></i>
		<div class="header">Job seeker's sign in</div>
		<div class="content">
			<div class="ui grid">
				<div class="eight wide column">
					<a href="javascript:void(0);" onclick="fbLogin()" class="ui button facebook">
						<i class="facebook icon"></i> Register with Facebook

					</a>
				</div>
				<div class="eight wide column right aligned">
					<a href="#" class="ui button linkedin">
						<!-- <i class="linkedin icon"></i> Register with LinkedIn -->
						<script type="in/Login"></script>
					</a>
				</div>
			</div>
			<div class="ui horizontal divider"> OR </div>
			
			<span id="validate-signup"></span><img src="{{ url('public/img/loading.gif') }}" id="loader_signup" style="display:none"/ >
			<form class="ui form" role="form" method="POST" onsubmit="return false;" id="signup-form">
				<table class="ui form-table">
					<tr>
						<th>Name:</th>
						<td>
							<input type="text" name="name" data-validation="required"  data-validation-error-msg="Please enter a name."/>
						</td>
					</tr>
					<tr>
						<th>Email:</th>
						<td>
							<input type="text" name="email" id="email" data-validation="email" data-validation-error-msg="Please enter a valid email address"/>
							<span id="validate-email" style="color:red" class="font-14x">
							</span>
						</td>
					</tr>
					<tr>
						<th>Password</th>
						<td>
							<input type="password" name="pass_confirmation"  data-validation="length" data-validation-length="min6" data-validation-error-msg="Password must be at least 6 characters"/>
						</td>
					</tr>
					<tr>
						<th>Retype password</th>
						<td>
							<input type="password" id="rpassword" name="pass"  data-validation="confirmation" data-validation-error-msg="Password do not match"/>
						</td>
					</tr>
					<tr>
						<th>Spam protection</th>
						<td>
							<div id="captcha-1" class="g-recaptcha"></div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="ui checkbox">
								<input tabindex="0" class="hidden" name="agreement" type="checkbox" id="checkout-verf" data-validation="required" data-validation-error-msg="Please select our terms of use and privacy policy agreement">
								<label>By checking this, you are agreed with our terms of use and privacy policy agreement.</label>
							</div>
						</td>
					</tr>
					<tr>
						<th></th>
						<td>
							<button type="submit" class="ui button primary" id="signup-btn" disabled="">Register</button> &nbsp; <a href class="close" data-toggle="modal" data-target="#modal-login">Already member?</a>	
						</td>
					</tr>
				</table>
			</form>
			
			
		</div>
	</div>

	<!-- Forgot Modal Box -->
	<div class="ui tiny modal" id="modal-forgotpass">
		<i class="close icon" onclick="ResetForgotPassForm();"></i>
		<div class="header">Job seeker's forgot password</div>
		<div class="content">
			<span id="validate-forgotpass"></span><img src="{{ url('public/img/loading.gif') }}" id="loader_forgotpass" style="display:none"/ >
			<form class="ui form" name="forgotpass-form" id="forgotpass-form" onsubmit="return false;">
				<table class="ui form-table">
					<tr>
						<th>Email</th>
						<td>
							<input type="text" name="email" id="forgotpass_email" data-validation="email" data-validation-error-msg="Please enter a valid email address"/>
						</td>
					</tr>
					
					<tr>
						<th></th>
						<td>
							<button type="submit" class="ui button primary" id="forgotpass-submit" onclick="return onForgotPassword();">Submit</button> &nbsp; <a href="javascript:void(0);" id="forgot_to_login" data-toggle="modal" data-target="#modal-login">Login</a>	
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
<?php endif; ?>