@extends('layouts.main')
@section('body_class','gray')
@section('content')
			<div class="ui container">
				<div class="ui full width user-profile flex">
					@include('partials.jobseeker.profile_left')				
					<div class="right">
						<div class="box">
							<div class="text header">Employments</div>							
							<div class="ui form box">
								<form class="ui tabular form" action="{{ route('employment_update') }}" method="post" id="employment_edit" name="employment_edit" >									
									<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
									<input type="hidden" name="emp_id" value="<?php echo $employments->emp_id; ?>">
									<div class="inline field">
										<label>Employer's name</label>
										<input type="text" name="emp_name" size="35" placeholder="Enter the employer name." value="<?php echo $employments->emp_name; ?>" />
									</div>
									<?php
									$emp_date_from = $employments->emp_date_from;
									$tsEmpDatefrom = strtotime($emp_date_from);
									
									$emp_date_to = $employments->emp_date_to;
									
									if ( $emp_date_to ) {
										$tsEmpDateTo = strtotime($emp_date_to);
									} else {
										$tsEmpDateTo = null;
									}
									
									//print_r($emp_date_from_month); ?>
									<div class="inline field">
										<label>Joined date</label>					
										<select name="emp_date_from_month" class="ui dropdown">
											<option value="">Select a month</option>
											<?php
												
												for ($i = 1; $i <= 12; $i++)
												{
													$month_name = date('F', mktime(0, 0, 0, $i, 1, 2011));
													if($i == date('n', $tsEmpDatefrom)){$selected = 'selected="selected"';
														echo '<option value="'.$i.'"'.$selected.' >'.$month_name.'</option>';
													}else{
														echo '<option value="'.$i.'" >'.$month_name.'</option>';
													}
												}
											?>
										</select>										
										<select name="emp_date_from_year" class="ui dropdown">
											<option value="">Select a year</option>
											<?php
											//echo $emp_date_from_year;							
												for($year=1950;$year<=date('Y');$year++)
												{
													if($year == date('Y', $tsEmpDatefrom)){$selected = 'selected="selected"';
														echo '<option value="'.$year.'"'.$selected.'>'.$year.'</option>';
													}else{
														echo '<option value="'.$year.'">'.$year.'</option>';
													}
													if($year == date('Y')){break;}
												}
											?>
										</select>						
									</div>
									
									<div class="inline field" id="emp_date_to">
										<label>Ends date</label>										
										<select id="emp_date_to_month" name="emp_date_to_month" class="ui dropdown">
											<option value="">Select a month</option>
											<?php
												for ($i = 1; $i <= 12; $i++)
												{	
													$month_name = date('F', mktime(0, 0, 0, $i, 1, 2011));												
													if($tsEmpDateTo && $i == date('n', $tsEmpDateTo)){$selected = 'selected="selected"';
														echo '<option value="'.$i.'"'.$selected.' >'.$month_name.'</option>';
													}else{
														echo '<option value="'.$i.'" >'.$month_name.'</option>';
													}
												}
											?>
										</select>										
										<select id="emp_date_to_year" name="emp_date_to_year" class="ui dropdown">
											<option value="">Select a year</option>
											<?php									
												for($year=1950;$year<=date('Y');$year++)
												{
													if($tsEmpDateTo && $year == date('Y', $tsEmpDateTo)){$selected = 'selected="selected"';
														echo '<option value="'.$year.'"'.$selected.'>'.$year.'</option>';
													}else{
														echo '<option value="'.$year.'">'.$year.'</option>';
													}
													if($year == date('Y')){break;}
												}
											?>
										</select>&nbsp;
										<div class="ui checkbox" id="chk-present">											
											<input name="emp_date_to_present" value="1" type="checkbox" <?php if( !$tsEmpDateTo ){echo 'checked'; }?> >
											<label>Present</label>
										</div>
									</div>
									
									<div class="inline field ui flex">
										<label>Industry</label>
										<select name="emp_industry" class="ui dropdown">
											<?php $emp_industry = trim($employments->emp_industry); ?>
											<option value="">Select an industry</option>
											<option value="Software" {{(trim($emp_industry) == 'Software') ? 'selected="selected"' : '' }} >Software</option>
											<option value="Hardware" {{(trim($emp_industry) == 'Hardware') ? 'selected="selected"' : '' }} >Hardware</option>
											<option value="Security" {{(trim($emp_industry) == 'Security') ? 'selected="selected"' : '' }} >Security</option>
											<option value="Network" {{(trim($emp_industry) == 'Network') ? 'selected="selected"' : '' }} >Network</option>
                                       </select>
									</div>
									
									<div class="inline field">
										<label>Position</label>
										<input type="text" name="emp_postion" size="35" placeholder="Eg: International sales executive" value="<?php echo $employments->emp_postion; ?>" />
									</div>
									
									<div class="inline field ui flex">
										<label>Job category</label>
										<select name="emp_category" class="ui dropdown">
											<?php $emp_category = $employments->emp_category; ?>
											<option value="">Select an industry</option>
											<option value="Information technology" {{(trim($emp_category) == 'Information technology') ? 'selected="selected"' : '' }} >Information technology</option>
											<option value="Software development" {{(trim($emp_category) == 'Software development') ? 'selected="selected"' : '' }} >Software development</option>
											<option value="Hardware house" {{(trim($emp_category) == 'Hardware house') ? 'selected="selected"' : '' }} >Hardware house</option>
											<option value="Database administration" {{(trim($emp_category) == 'Database administration') ? 'selected="selected"' : '' }} >Database administration</option>
                                       </select>
									</div>
									
									<div class="inline field">
										<label>Job Type</label>										
										<select name="emp_type" class="ui dropdown">
											<?php $emp_type = $employments->emp_type; ?>
											<option value="">Select an type</option>
											<option value="Full time" {{(trim($emp_type) == 'Full time') ? 'selected="selected"' : '' }} >Full time</option>
											<option value="Part time" {{(trim($emp_type) == 'Part time') ? 'selected="selected"' : '' }} >Part time</option>
											<option value="Internship" {{(trim($emp_type) == 'Internship') ? 'selected="selected"' : '' }} >Internship</option>
											<option value="Freelancer" {{(trim($emp_type) == 'Freelancer') ? 'selected="selected"' : '' }} >Freelancer</option>
                                       </select>
									</div>
									
									<div class="inline field">
										<label>Job level</label>
										<select name="emp_level" class="ui dropdown">
											<?php $emp_level = $employments->emp_level; ?>
											<option value="">Select an level</option>
											<option value="Fresh graduated" {{(trim($emp_level) == 'Fresh graduated') ? 'selected="selected"' : '' }} >Fresh graduated</option>
											<option value="Executive" {{(trim($emp_level) == 'Executive') ? 'selected="selected"' : '' }} >Executive</option>
                                       </select>
									</div>
									
									<div class="inline field">
										<label>Responsibilities</label>
										<textarea name="emp_responsibilities" cols="50"><?php echo $employments->emp_responsibilities; ?></textarea>
									</div>
									
									<div class="inline field">
										<label>Monthly salary (RM)</label>
										<input type="text" name="emp_salary" value="<?php echo $employments->emp_salary; ?>" />
									</div>
									
									<div class="inline field">
										<label>Achievements</label>
										<textarea name="emp_achivement" cols="50"><?php echo $employments->emp_achivement; ?></textarea>
									</div>
									
									<div class="action">
										<!--<input type="submit" value="Save" class="ui primary button">-->
										<button type="submit" id="btn-submit1" class="ui primary button"><i class="save icon"></i> Update</button>
										<button type="button" class="ui button red" onclick="goBack()"><i class="remove icon"></i> Cancel</button>
										<!--<button type="reset" id="btn-reset" class="ui default button"><i class="refresh icon"></i> Clear</button>-->
									</div>
								</form>
							</div>
							<!-- <a href class="add more" id="add_more"><i class="add icon"></i> Add more employment detail</a> -->
						</div>
						
					</div>
				</div>
			</div>
			
@section('modal')
@endsection

@section('script')
<script>
    $(document).ready(function (e) {
      $('#employment_edit')
       .form({
         fields: {
         emp_name           : 'empty',
         emp_date_from_month  : 'empty',
         emp_date_from_year   : 'empty',
         //emp_date_to_month      : 'empty',
         //emp_date_to_year       : 'empty',
         //emp_date_to_present  : 'empty',
         emp_industry         : 'empty',
         emp_postion        : 'empty',
         emp_category         : 'empty',
         emp_type           : 'empty',
         emp_level          : 'empty'
         }
       });
      
      $("#chk-present").checkbox("setting", "onChecked", function(e) {
          $("#emp_date_to_month").dropdown("restore defaults").addClass("disabled");
          $("#emp_date_to_year").dropdown("restore defaults").addClass("disabled");
      });
      $("#chk-present").checkbox("setting", "onUnchecked", function(e) {
          console.log($("#emp_date_to_month"));
          $("#emp_date_to_month").dropdown().removeClass("disabled");
          $("#emp_date_to_year").dropdown().removeClass("disabled");
      });

      $("#emp_date_to_month").change(function() {
          $("#chk-present").checkbox("set unchecked");
      });

      $("#emp_date_to_year").change(function() {
          $("#chk-present").checkbox("set unchecked");
      });
    });
    function goBack() {
      window.history.back();
    }
    </script>
@endsection

@endsection
