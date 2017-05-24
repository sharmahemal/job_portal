@extends('layouts.main')
@section('body_class','gray')
@section('content')
<div class="ui container">
                <div class="ui full width user-profile flex">
                    @include('partials.jobseeker.profile_left')
                    <div class="right">
                        <div class="box" id="pre_show_hide">
                            <div class="text header">Preferences</div>

                            <div class="ui form box">
                                <div class="ui flex">
                                    <div class="info grow-1">
                                        <div class="detail long-label">
                                            <div class="row">
                                                <div class="label">Own transport</div>
                                                <div class="text">{{($jobseeker_details->pre_transport != '') ? $jobseeker_details->pre_transport : 'Not set'}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Willing to relocate</div>
                                                <div class="text">{{($jobseeker_details->pre_relocate != '') ? $jobseeker_details->pre_relocate : 'Not set'}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Willing to travel</div>
                                                <div class="text">{{($jobseeker_details->pre_travel != '') ? $jobseeker_details->pre_travel : 'Not set'}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Preferred job industry</div>
                                                <div class="text">
                                                    {{($jobseeker_details->pre_industry != '') ? implode(', ', explode(',', $jobseeker_details->pre_industry)) : 'Not set'}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Preferred job function</div>
                                                <div class="text">
                                                    {{($jobseeker_details->pre_function != '') ? implode(', ', explode(',', $jobseeker_details->pre_function)) : 'Not set'}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Preferred job location</div>
                                                <div class="text">
                                                    {{($jobseeker_details->pre_location != '') ? implode(', ', explode(',', $jobseeker_details->pre_location)) : 'Not set'}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Preferred job type</div>
                                                <div class="text"> {{($jobseeker_details->pre_type != '') ? implode(', ', explode(',', $jobseeker_details->pre_type)) : 'Not set'}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Preferred job level</div>
                                                <div class="text">{{($jobseeker_details->pre_level != '') ? implode(', ', explode(',', $jobseeker_details->pre_level)) : 'Not set'}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Expected monthly salary</div>
                                                <div class="text green">RM{{($jobseeker_details->pre_salary != '') ? number_format($jobseeker_details->pre_salary) : 'Not set'}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="label">Notice period</div>
                                                <div class="text">{{($jobseeker_details->pre_period != '') ? $jobseeker_details->pre_period : 'Not set'}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="actions">
                                        <a href="javascript:void(0);" class="ui primary button"  onclick="return editPreferences();"><i class="edit icon"></i> Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box" id="edit_pre_show_hide" style="display:none">
                            <div class="text header">Preferences</div>
                            <div class="ui form box">
                                <form class="ui tabular form" id="pre_form" method="post" action="{{route('jobsekker.preferences.update')}}">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="inline fields">
                                        <div class="field">
                                            <label>Own transport</label>
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="pre_transport" value="Yes" {{($jobseeker_details->pre_transport == 'Yes') ? 'checked="checked"' : ''}}/>
                                                <label>Yes</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="pre_transport" value="No" {{($jobseeker_details->pre_transport == 'No') ? 'checked="checked"' : ''}}/>
                                                <label>No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inline fields">
                                        <div class="field">
                                            <label>Willing to relocate</label>
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="pre_relocate" value="Yes" {{($jobseeker_details->pre_relocate == 'Yes') ? 'checked="checked"' : ''}}/>
                                                <label>Yes</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="pre_relocate" value="No" {{($jobseeker_details->pre_relocate == 'No') ? 'checked="checked"' : ''}}/>
                                                <label>No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inline fields">
                                        <div class="field">
                                            <label>Willing to travel</label>
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="pre_travel" value="Yes" {{($jobseeker_details->pre_travel == 'Yes') ? 'checked="checked"' : ''}}/>
                                                <label>Yes</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="travel" value="No" {{($jobseeker_details->pre_travel == 'No') ? 'checked="checked"' : ''}}/>
                                                <label>No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inline field ui flex">
                                        <label>Preferred job industries</label>
                                        <div class="ui multiple selection search dropdown">
											<input type="hidden" name="pre_industry[]" value="{{ $jobseeker_details->pre_industry }}" />
											<i class="dropdown icon"></i>
											<div class="default text">Select a job industry</div>
											<div class="menu">
												<?php foreach($industry as $industryName){ ?>
		                                         <div class="item" data-value="{{$industryName->ind_title}}">{{$industryName->ind_title}}</div>
		                                        <?php } ?>
											</div>
										</div>
                                    </div>
                                    <div class="inline field ui flex">
                                        <label>Preferred job functions</label>
                                        <div class="ui multiple selection search dropdown">
											<input type="hidden" name="pre_function[]" value="{{ $jobseeker_details->pre_function }}" />
											<i class="dropdown icon"></i>
											<div class="default text">Select job function</div>
											<div class="menu">
												<div class ="item" data-value="Food">Food</div>
												<div class ="item" data-value="General Manufacturing">General Manufacturing</div>
												<div class ="item" data-value="Mechanical">Mechanical</div>
												<div class ="item" data-value="Medical">Medical</div>
												<div class ="item" data-value="Metal">Metal</div>
												<div class ="item" data-value="Petrochemical & Polymer">Petrochemical & Polymer</div>
												<div class ="item" data-value="Rubber">Rubber</div>
												<div class ="item" data-value="Textile">Textile</div>
												<div class ="item" data-value="Wood">Wood</div>
												
												<div class="header">Marketing</div >
												<div class ="item" data-value="Advertising">Advertising</div>
												<div class ="item" data-value="Brand Management">Brand Management</div>
												<div class ="item" data-value="Event">Event</div>
												<div class ="item" data-value="Market Research">Market Research</div>
												<div class ="item" data-value="Marketing">Marketing</div>
												<div class ="item" data-value="Public Relations">Public Relations</div>
												
												<div class="header">Media</div >
												<div class ="item" data-value="Broadcasting">Broadcasting</div>
												<div class ="item" data-value="Creative & Interactive Media">Creative & Interactive Media</div>
												<div class ="item" data-value="Journalism">Journalism</div>
												<div class ="item" data-value="New Media">New Media</div>
												<div class ="item" data-value="Publishing">Publishing</div>
												
												<div class="header">Plant & Animal</div >
												<div class ="item" data-value="Agriculture">Agriculture</div>
												<div class ="item" data-value="Animal Care">Animal Care</div>
												<div class ="item" data-value="Farming">Farming</div>
												
												<div class="header">Property</div >
												<div class ="item" data-value="Building Management">Building Management</div>
												<div class ="item" data-value="Real Estate Management">Real Estate Management</div>
												
												<div class="header">Retail</div >
												<div class ="item" data-value="Distribution Channels">Distribution Channels</div>
												<div class ="item" data-value="Merchandising">Merchandising</div>
												<div class ="item" data-value="Retail Buying">Retail Buying</div>
												<div class ="item" data-value="Store Operation">Store Operation</div>
												
												<div class="header">Sales </div >
												<div class ="item" data-value="Sales">Sales</div>
												
												<div class="header">Security & Defence</div >
												<div class ="item" data-value="Defence">Defence</div>
												<div class ="item" data-value="Security">Security</div>
												
												<div class="header">Services</div >
												<div class ="item" data-value="Beauty">Beauty</div>
												<div class ="item" data-value="Language">Language</div>
												<div class ="item" data-value="Other Services">Other Services</div>
												
												<div class="header">Sports</div >
												<div class ="item" data-value="Event">Event</div>
												<div class ="item" data-value="Facility">Facility</div>
												<div class ="item" data-value="Training/Coaching">Training/Coaching</div>
											</div>
										</div>
                                    </div>
                                    <div class="inline field ui flex">
                                        <label>Preferred job locations</label>
                                        	<div class="ui multiple selection search dropdown">
												<input type="hidden" name="pre_location[]" value="{{ $jobseeker_details->pre_location }}" />
												<i class="dropdown icon"></i>
												<div class="default text">Location</div>
												<div class="menu">
		                                          <?php
													$states = DB::table('tbl_state')->get();
													
													if ( $states->count() ) {
														foreach ( $states as $state ) {
													?>
													<div class="item" data-value="<?php echo $state->state_name; ?>"><?php echo $state->state_name; ?></div>
													<?php
														}
													}
												  ?>
												</div>
											</div>
                                    </div>
                                    <div class="inline field ui flex">
                                        <label>Preferred job types</label>
                                        	<div class="ui multiple selection search dropdown">
												<input type="hidden" name="pre_type[]" value="{{ $jobseeker_details->pre_type }}" />
												<i class="dropdown icon"></i>
												<div class="default text">Job type</div>
												<div class="menu">
		                                          <div class="item" data-value="Full time">Full time</div>
		                                          <div class="item" data-value="Part time">Part time</div>
		                                          <div class="item" data-value="Internship">Internship</div>
		                                          <div class="item" data-value="Freelancer">Freelancer</div>
												</div>
											</div>
                                    </div>
                                    <div class="inline field ui flex">
                                        <label>Preferred job level</label>
                                        	<div class="ui multiple selection search dropdown">
												<input type="hidden" name="pre_level[]" value="{{ $jobseeker_details->pre_level }}" />
												<i class="dropdown icon"></i>
												<div class="default text">Select a job level</div>
												<div class="menu">
												  <div class="item" data-value="Fresh graduate">Fresh graduate</div>
		                                          <div class="item" data-value="Non-executive / Clerical">Non-executive / Clerical</div>
		                                          <div class="item" data-value="Executive">Executive</div>
		                                          <div class="item" data-value="Senior Executive">Senior Executive</div>
												</div>
											</div>
                                    </div>
                                    <div class="inline field ui flex">
                                        <label>Expected salary (RM)</label>
                                        <input type="text" name="pre_salary" id="pre_salary" size="25" placeholder="Enter expected salary (RM)" maxlength="10" value="{{$jobseeker_details->pre_salary}}" />
                                    </div>
                                    <div class="inline field ui flex">
                                        <label>Notice period</label>
                                        	<div class="ui selection dropdown">
												<input type="hidden" name="pre_period" value="{{ $jobseeker_details->pre_period }}" />
												<i class="dropdown icon"></i>
												<div class="default text">Select a notice period</div>
												<div class="menu">
													  <div class="item" data-value="immediate">immediate</div>
			                                          <div class="item" data-value="1 month">1 month</div>
			                                          <div class="item" data-value="2 months">2 months</div>
			                                          <div class="item" data-value="3 months">3 months</div>
												</div>
											</div>
                                        
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
$('#pre_form')
  .form({
    fields: {
      pre_industry     : 'empty',
      pre_function     : 'empty',
      pre_type     : 'empty',
      pre_level     : 'empty',
      pre_type     : 'empty',
      pre_location  : 'empty',
      pre_period   : 'empty'
    }
  });
  
});

<?php 
//For Prefrance data
$preIndustryResult = getCommaToString($jobseeker_details->pre_industry);
$preFunctionResult = getCommaToString($jobseeker_details->pre_function);
$preTypeResult = getCommaToString($jobseeker_details->pre_type);
$preLevelResult = getCommaToString($jobseeker_details->pre_level);
$prePeriodResult = getCommaToString($jobseeker_details->pre_period);
$preLocationResult = getCommaToString($jobseeker_details->pre_location);
?>
//Sete slected
$('#pre_industry').dropdown('set selected',[<?php echo $preIndustryResult; ?>]);
$('#pre_function').dropdown('set selected',[<?php echo $preFunctionResult; ?>]);
$('#pre_type').dropdown('set selected',[<?php echo $preTypeResult; ?>]);
$('#pre_level').dropdown('set selected',[<?php echo $preLevelResult; ?>]);
$('#pre_period').dropdown('set selected',[<?php echo $prePeriodResult; ?>]);
$('#pre_location').dropdown('set selected',[<?php echo $preLocationResult; ?>]);
</script>
@endsection
@endsection