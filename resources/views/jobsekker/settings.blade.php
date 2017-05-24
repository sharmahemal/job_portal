@extends('layouts.main')
@section('body_class','gray')
@section('content')

	<div class="ui container">
				<div class="ui full width user-profile flex">
					@include('partials.jobseeker.profile_left')
					<div class="right">
						<div class="box" >
                            <div class="text header">Settings</div>
                            <div class="ui form box">
								<form class="ui tabular form" id="setting_form" method="post" action="{{route('jobsekker.settings.update')}}">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<div class="inline field">
										<label>Profile URL</label>
										{{url('profile')}}/<input type="text" name="setting_profile_code" id="setting_profile_code" size="25" placeholder="Must be unique and no space."  value="{{($jobseeker_details->setting_profile_code != '') ? $jobseeker_details->setting_profile_code : ''}}" maxlength="10" {{($jobseeker_details->setting_profile_code != '') ? 'disabled="disabled"' : ''}} />
										<span id="validate-code" style="color: red"></span>
									</div>
									
									<div class="inline fields">
										<div class="field">
											<label>Resume visibility</label>
											<div class="ui radio checkbox">
												<input type="radio" name="setting_resume_visibility" value="1" {{($jobseeker_details->setting_resume_visibility == '1') ? 'checked="checked"' : ''}}/>
												<label>Visible</label>
											</div>
										</div>
										<div class="field">
											<div class="ui radio checkbox">
												<input type="radio" name="setting_resume_visibility" value="0" {{($jobseeker_details->setting_resume_visibility == '0') ? 'checked="checked"' : ''}}/>
												<label>Hidden</label>
											</div>
										</div>
									</div>
									
									<div class="inline fields">
										<div class="field">
											<label>Profile visibility</label>
											<div class="ui radio checkbox">
												<input type="radio" name="setting_profile_visibility" value="1" {{($jobseeker_details->setting_profile_visibility == '1') ? 'checked="checked"' : ''}}/>
												<label>Visible</label>
											</div>
										</div>
										<div class="field">
											<div class="ui radio checkbox">
												<input type="radio" name="setting_profile_visibility" value="0" {{($jobseeker_details->setting_profile_visibility == '0') ? 'checked="checked"' : ''}}/>
												<label>Hidden</label>
											</div>
										</div>
									</div>
									
									<div class="inline fields">
										<div class="field">
											<label>Job email alert</label>
											<div class="ui radio checkbox">
												<input type="radio" name="setting_email_alert" value="1" {{($jobseeker_details->setting_email_alert == '1') ? 'checked="checked"' : ''}}/>
												<label>Yes</label>
											</div>
										</div>
										<div class="field">
											<div class="ui radio checkbox">
												<input type="radio" name="setting_email_alert" value="0" {{($jobseeker_details->setting_email_alert == '0') ? 'checked="checked"' : ''}}/>
												<label>No</label>
											</div>
										</div>
									</div>
									
									<div class="inline fields">
										<div class="field">
											<label>Alert frequency</label>
											<div class="ui radio checkbox">
												<input type="radio" name="setting_alert_freq" value="daily" {{($jobseeker_details->setting_alert_freq == 'daily') ? 'checked="checked"' : ''}}/>
												<label>Everyday</label>
											</div>
										</div>
										<div class="field">
											<div class="ui radio checkbox">
												<input type="radio" name="setting_alert_freq" value="weekly" {{($jobseeker_details->setting_alert_freq == 'weekly') ? 'checked="checked"' : ''}}/>
												<label>Everyweek</label>
											</div>
										</div>
									</div>
									
									<div class="inline fields">
										<div class="field">
											<label>Newsletter</label>
											<div class="ui radio checkbox">
												<input type="radio" name="setting_newsletter" value="1" {{($jobseeker_details->setting_newsletter == '1') ? 'checked="checked"' : ''}}/>
												<label>Yes</label>
											</div>
										</div>
										<div class="field">
											<div class="ui radio checkbox">
												<input type="radio" name="setting_newsletter" value="0" {{($jobseeker_details->setting_newsletter == '0') ? 'checked="checked"' : ''}}/>
												<label>No</label>
											</div>
										</div>
									</div>
									
									<div class="action">
										<button type="submit" id="btn-submit" class="ui primary submit button" id="settings_submit"><i class="save icon"></i> Save</button>
									</div>
								</form>
							</div>
                        </div>

					</div>
				</div>
			</div>
@section('modal')
@endsection
@section('script')
<script type="text/javascript">

      $(document).on('change', '#setting_profile_code', function(){
        var token = '{{ Session::token() }}';
        var url = "{{route('jobsekker.settings.profilecode')}}",
        message = $('#validate-code');

        $.ajax({
          type: 'POST',
          url: url,
          data: {
            code: $('#setting_profile_code').val(),
            _token: token
          },
          beforeSend: function(){
            $('#btn-submit').attr('disabled','disabled');
            message.html('')
            //message.addClass('ui loader');

          },
          success: function(response){
            //message.removeClass('ui loader');
            $('#btn-submit').removeAttr('disabled');
          },
          error: function(jqXHR, exception){
            var error = getErrorMessage(jqXHR, exception);
            message.html(error);
          }
        });
      }); 

$(function() {
    $( '#setting_profile_code' ).on( 'keydown', function( e ) {
        if( !$( this ).data( "value" ) )
             $( this ).data( "value", this.value );
    });
    $( '#setting_profile_code' ).on( 'keyup', function( e ) {
        if (!/^[_0-9a-z]*$/i.test(this.value))
            this.value = $( this ).data( "value" );
        else
            $( this ).data( "value", null );
    });
});

</script>
@endsection
@endsection