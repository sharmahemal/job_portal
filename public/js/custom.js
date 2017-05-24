/*Register Section*/
var recaptchaCallback = function(response) {
	c_flag = true; check_flags();
	//$('#signup-btn').removeAttr('disabled');
};
var recaptchaCallback1 = function(response) {
	ec_flag = true; check_employer_flags();
	//$('#signup-btn').removeAttr('disabled');
};
var widgetId1;
var widgetId2;
var onloadCallback = function() {
	widgetId1 = grecaptcha.render('captcha-1', {
		'sitekey' : captchaKey,
		'theme' : 'light',
		'callback' : recaptchaCallback
	});
	widgetId2 = grecaptcha.render('captcha-2', {
		'sitekey' : captchaKey,
		'theme' : 'light',
		'callback' : recaptchaCallback1
	});

};
/*validation*/
$.validate({ modules : 'security',validateHiddenInputs : true,ignore: ""});

/*Reset register form*/
function ResetSignUpForm(){
	$('#signup-form')[0].reset();
	grecaptcha.reset();
}

/*check valid email*/
function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

/*get js error messages*/
function getErrorMessage(jqXHR, exception)
{
	var msg = '';
	if (jqXHR.responseJSON) {
		var errors = (jqXHR.responseJSON.errors);
		$.each(errors, function(key, value){
			msg = value[0];
		})
	} else if(jqXHR['errors']) {
		msg = jqXHR['errors'];
	} else if (jqXHR.status === 0) {
		msg = 'Not connect.\n Verify Network. <br>Please Contact Support Team.';
	} else if (jqXHR.status == 404) {
		msg = 'Requested page not found. [404]. <br>Please Contact Support Team.';
	} else if (jqXHR.status == 500) {
		msg = 'Internal Server Error [500]. <br>Please Contact Support Team.\n' + jqXHR.responseText;
	} else if (exception === 'parsererror') {
		msg = 'Requested JSON parse failed. <br>Please Contact Support Team.';
	} else if (exception === 'timeout') {
		msg = 'Time out error';
	} else if (exception === 'abort') {
		msg = 'Request aborted.';
	} else {
		msg = 'Uncaught Error.\n' + jqXHR.responseText;
	}
	return msg;
}

/*Edit Profile Show Hide*/
function editProfile(){
    $("#edit_profile_show_hide").show();
    $("#profile_show_hide").hide();
    $("#btn-cancel").on("click", function() {
            $("#edit_profile_show_hide").hide();
            $("#profile_show_hide").show();
    });
}

/*Edit Other Info Show Hide*/
function editOtherInfo(){
    $("#edit_other_info_show_hide").show();
    $("#other_info_show_hide").hide();
    $("#btn-cancel").on("click", function() {
            $("#edit_other_info_show_hide").hide();
            $("#other_info_show_hide").show();
    });
}


/*Edit Profile Show Hide*/
function editPreferences(){
    $("#edit_pre_show_hide").show();
    $("#pre_show_hide").hide();
    $("#btn-cancel").on("click", function() {
            $("#edit_pre_show_hide").hide();
            $("#pre_show_hide").show();
    });
}


