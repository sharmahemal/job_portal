@extends('layouts.main')
@section('body_class','gray')
@section('content')
<div class="ui container">
                <div class="ui full width user-profile flex">
                    @include('partials.jobseeker.profile_left')
                    <div class="right">
                        <div class="box" id="profile_show_hide">
                            <div class="text header">Personal info</div>

                            <div class="ui form box">
                            	<?php
                            	?>
                                <div class="ui flex">
                                    <div class="info grow-1">
                                        <div class="detail">
                                            <div class="row">
                                                <div class="label">Name</div>
                                                <div class="text">{{$jobseeker_details->first_name}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Email</div>
                                                <div class="text">{{$jobseeker_details->user_email}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Mobile</div>
                                                <div class="text">{{$jobseeker_details->ud_mobile}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Phone</div>
                                                <div class="text">{{$jobseeker_details->ud_phone}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Nationality</div>
                                                <div class="text">{{$jobseeker_details->ud_nationality}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Date of birth</div>
                                                <div class="text">{{$jobseeker_details->ud_dob}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Gender</div>
                                                <div class="text">{{$jobseeker_details->ud_gender}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Race</div>
                                                <div class="text">
                                                    {{$jobseeker_details->ud_race}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Marital status</div>
                                                <div class="text">{{$jobseeker_details->ud_marital}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Address</div>
                                                <div class="text">
                                                   {{$jobseeker_details->ud_address}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="label">City</div>
                                                <div class="text">
                                                   {{$jobseeker_details->ud_city}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="label">State</div>
                                                <div class="text">
                                                   {{($jobseeker_details->ud_country != "other") ? $jobseeker_details->ud_state : $jobseeker_details->ud_other_state}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Country</div>
                                                <div class="text">
                                                   {{$jobseeker_details->ud_country}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Zipcode</div>
                                                <div class="text">
                                                   {{$jobseeker_details->ud_postalcode}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Current residing country</div>
                                                <div class="text">
                                                    {{$jobseeker_details->ud_residining_country}}
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="label">Reffreal</div>
                                                <div class="text">
                                                    {{$jobseeker_details->ud_reffreal}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="actions">
                                        <button class="ui primary button" id="edit_profile" onclick="return editProfile();"><i class="edit icon"></i> Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box" id="edit_profile_show_hide" style="display:none">
                            <div class="text header">Personal info</div>
                            <div class="ui form box">
                                <form class="ui tabular form" id="profile_form" method="post" action="{{route('jobsekker.profile.update')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="inline field">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" size="35" class="required" placeholder="Enter the name." value="{{$jobseeker_details->first_name}}" />
                                    </div>
                                   <!--  <div class="inline field">
                                        <label>Last name</label>
                                        <input type="text" name="last_name" size="35" class="required" placeholder="Enter the last name."  value="{{$jobseeker_details->last_name}}"/>
                                    </div> -->
                                    <div class="inline field">
                                        <label>Mobile</label>
                                        <input type="text" name="ud_mobile" size="35" class="required" placeholder="Enter the mobile no." value="{{$jobseeker_details->ud_mobile}}"/>
                                    </div>
                                    <div class="inline field">
                                        <label>Phone</label>
                                        <input type="text" name="ud_phone" size="35" placeholder="Enter the phone." value="{{$jobseeker_details->ud_phone}}"/>
                                    </div>
                                    <div class="inline field">
                                        <label>Date of birth</label>
                                        
                                        <input type="text" name="ud_dob" title="Date of birth should be MM/DD/YYYY format" size="35" class="required"  placeholder="Enter the date of birth [MM/DD/YYYY]" value="{{$jobseeker_details->ud_dob}}"/>
                                        
                                    </div>
                                    
                                    <div class="inline field">
                                        <label>Gender</label>
                                        <select class="ui dropdown" name="ud_gender" id="ud_gender" class="required">
                                          <option value="">Select a gender</option>
                                          <option value="Male" <?php echo ($jobseeker_details->ud_gender == 'Male') ? 'selected="selected"' : '' ?>>Male</option>
                                          <option value="Female" {{($jobseeker_details->ud_gender == 'Female') ? 'selected="selected"' : ''}}>Female</option>
                                        </select>
                                    </div>
                                    <div class="inline field">
                                        <label>Select country</label>
                                        <select class="ui dropdown" name="ud_country" id="ud_country" class="required">
                                          <option value="">Select a country</option>
                                          <?php foreach($country as $countryName){ ?>
                                          <option value="{{$countryName->country_name}}" {{($jobseeker_details->ud_country == $countryName->country_name) ? 'selected="selected"' : ''}}>{{$countryName->country_name}}</option>
                                          <?php } ?>
                                          <!-- <option value="other" {{($jobseeker_details->ud_country == 'other') ? 'selected="selected"' : ''}}>Other</option> -->
                                        </select>
                                    </div>
                                    <div class="inline field" id="dropdown_state" <?php if($jobseeker_details->ud_country == 'other') {?>style='display:none !important'<?php } ?>>
                                        <label>Select state</label>
                                        <select class="ui dropdown" name="ud_state" id="ud_state" class="required" >
                                          <option value="">Select a state</option>
                                          <?php foreach($state as $stateName){ ?>
                                          <option value="{{$stateName->state_name}}" {{($jobseeker_details->ud_state == $stateName->state_name) ? 'selected="selected"' : ''}}>{{$stateName->state_name}}</option>
                                          <?php } ?>

                                        </select>
                                    </div>
                                     <div class="inline field" id="other_state" @if($jobseeker_details->ud_country == 'other')style='display:block !important'@endif>
                                        <label>State</label>
                                        <input type="text" name="ud_other_state" data-validate="ud_other_state" id="ud_other_state" class="empty" size="35" placeholder="Enter the state." value="{{$jobseeker_details->ud_other_state}}"/>
                                    </div>
                                    <div class="inline field">
                                        <label>City</label>
                                        <input type="text" name="ud_city" size="35" placeholder="Enter the city." class="required" value="{{$jobseeker_details->ud_city}}"/>
                                    </div>

                                    <div class="inline field">
                                        <label>Address</label>
                                        <textarea name="ud_address" cols="50" id="ud_address"  class="required">{{$jobseeker_details->ud_address}}</textarea>
                                    </div>
                                    <div class="inline field">
                                        <label>Postal code</label>
                                        <input type="text" name="ud_postalcode" size="35" placeholder="Enter the postal code." value="{{$jobseeker_details->ud_postalcode}}" />
                                    </div>
                                    <div class="inline field">
                                        <label>Current residing country</label>
                                        <select class="ui dropdown" name="ud_residining_country" class="required" id="ud_residining_country">
                                          <option value="">Select a residing country</option>
                                          <?php foreach($country as $countryName){ ?>
                                          <option value="{{$countryName->country_name}}" {{($jobseeker_details->ud_residining_country == $countryName->country_name) ? 'selected="selected"' : ''}}>{{$countryName->country_name}}</option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                     <div class="inline field">
                                        <label>Race</label>
                                        <select class="ui dropdown" name="ud_race" id="ud_race" class="required">
                                          <option value="">Select a race</option>
                                          <?php foreach($race as $raceName){ ?>
                                          <option value="{{$raceName->race_name}}" {{($jobseeker_details->ud_race == $raceName->race_name) ? 'selected="selected"' : ''}}>{{$raceName->race_name}}</option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                    <div class="inline field">
                                        <label>Nationality</label>
                                        <input type="text" name="ud_nationality" size="35" placeholder="Enter the nationality." value="{{$jobseeker_details->ud_nationality}}" />
                                    </div>
                                     <div class="inline field">
                                        <label>Reffreal</label>
                                        <input type="text" name="ud_reffreal" size="35" placeholder="Enter the reffreal."  value="{{$jobseeker_details->ud_reffreal}}"/>
                                    </div>
                                     <div class="inline field">
                                        <label>Intro video</label>
                                        <input type="text" name="ud_intro_vid" size="35" placeholder="Enter the intro video." value="{{$jobseeker_details->ud_intro_vid}}" />
                                    </div>
                                    <div class="inline field">
                                        <label>Marital status</label>
                                        <select class="ui dropdown" name="ud_marital" id="ud_marital">
                                          <option value="">Select a marital status</option>
                                          <option value="Married"  {{($jobseeker_details->ud_marital == 'Married') ? 'selected="selected"' : ''}}>Married</option>
                                          <option value="Unmarried" {{($jobseeker_details->ud_marital == 'Unmarried') ? 'selected="selected"' : ''}}>Unmarried</option>
                                          <option value="Divorced" {{($jobseeker_details->ud_marital == 'Divorced') ? 'selected="selected"' : ''}}>Divorced</option>
                                          <option value="Widowed" {{($jobseeker_details->ud_marital == 'Widowed') ? 'selected="selected"' : ''}}>Widowed</option>
                                        </select>
                                    </div>
                                    <div class="action">
                                        <button type="submit" id="btn-submit" class="ui primary submit button"><i class="save icon"></i> Save</button>
                                        <!-- <button type="reset" id="btn-reset" class="ui default clear button"><i class="refresh icon"></i> Clear</button> -->
                                        <button type="button" id="btn-cancel" class="ui default  button"><i class="remove icon"></i> Cancel</button>
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
$(document).ready(function (e) {
$('#profile_form')
  .form({
    fields: {
      first_name     : 'empty',
      last_name     : 'empty',
      ud_mobile     : 'empty',
      ud_dob        : 'regExp[/^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\\d\\d$/]',
      ud_gender     : 'empty',
      ud_race       : 'empty',
      ud_country     : 'empty',
      ud_state     : 'empty',
      ud_other_state  : 'empty',
      ud_city     : 'empty',
      ud_address     : 'empty',
      ud_residining_country     : 'empty'
    }
  });
});
$(function() {
    $('#other_state').hide();
    $('#ud_other_state').val('other_state'); 
    $('#ud_country').change(function(){
        if($('#ud_country').val() == 'other') {
            $('#dropdown_state').hide();
            $('#other_state').show(); 
            $('#ud_state').val('Johor');
            $('#ud_other_state').val('');
        } else {
            $('#dropdown_state').show();
            $('#other_state').hide(); 
            $('#ud_state').val('');
            $('#ud_other_state').val('other_state');

        } 
    });
       
});
</script>
@endsection
@endsection