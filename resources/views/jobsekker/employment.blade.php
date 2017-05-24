@extends('layouts.main')
@section('body_class','gray')
@section('content')
<div class="ui container">
	<div class="ui full width user-profile flex">	
		@include('partials.jobseeker.profile_left')				
		<div class="right">
			<div class="box">
				<div class="text header">Employments</div>
				@if (count($employements) > 0)
				<div class="ui form box">
					@foreach ($employements as $employement)
					<div class="ui flex">
						<div class="info grow-1">
							<div class="detail">
								<div class="row">
									<div class="label">Employer's name</div>
									<div class="text">{{ $employement->emp_name }}</div>
								</div>
								<div class="row">
									<div class="label">Working period</div>
									<div class="text">
										@if ( $employement->emp_date_from )
											{{ date('F Y', strtotime($employement->emp_date_from)) }}
										@endif
										until
										@if ( $employement->emp_date_to )
											{{ date('F Y', strtotime($employement->emp_date_to)) }}
										@else
											present
										@endif
									</div>
								</div>
								<div class="row">
									<div class="label">Industry</div>
									<div class="text">{{ $employement->emp_industry }}</div>
								</div>
								<div class="row">
									<div class="label">Position</div>
									<div class="text">{{ $employement->emp_postion }}</div>
								</div>
								<div class="row">
									<div class="label">Job category</div>
									<div class="text">{{ $employement->emp_category }}</div>
								</div>
								<div class="row">
									<div class="label">Job type</div>
									<div class="text">{{ $employement->emp_type }}</div>
								</div>
								<div class="row">
									<div class="label">Job level</div>
									<div class="text">{{ $employement->emp_level }}</div>
								</div>
								<div class="row">
									<div class="label">Responsibilities</div>
									<div class="text">
										{!! nl2br($employement->emp_responsibilities) !!}
									</div>
								</div>
								<div class="row">
									<div class="label">Monthly salary</div>
									<div class="text green">RM{{ $employement->emp_salary }}</div>
								</div>
								<div class="row">
									<div class="label">Achievements</div>
									<div class="text">
										<div class="ui hide text">
											<div class="content">
												<p>{!! nl2br($employement->emp_achivement) !!}</p>															
											</div>
											<a class="show-more" data-less-text="Show less" data-more-text="Show more">Show more</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="actions">
										<!--<button class="ui primary button"><i class="edit icon"></i> Edit</button>
										<button class="ui red button"><i class="trash icon"></i> Delete</button>-->
										<a class="ui primary button" href="{{ route('employment_edit',$employement->emp_id) }}"><i class="edit icon"></i> Edit</a>
										<a class="ui red button" data-toggle="modal" data-target="#modal-employment-delete"  onclick='return DeleteEmployment("{{ route("employment_delete",$employement->emp_id) }}");'><i class="trash icon"></i> Delete</a>
										
									</div>
								</div>
								@endforeach							
							</div>
							@else
							<p class="add more no-data-found">No information provided. Please add information.</p>								
							@endif
							<div class="ui form box">
								<form class="ui tabular form" action="{{ route('employmentadd') }}" method="post" id="employment_add" name="employment_add" style="display:none;">									
									<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">									
									<div class="inline field">
										<label>Employer's name</label>
										<input type="text" name="emp_name" size="35" placeholder="Enter the company name." />
									</div>
									
									<div class="inline field">
										<label>Joined date</label>					
										<select name="emp_date_from_month" class="ui dropdown">
											<option value="">Select a month</option>
											<?php
											for ($i = 1; $i <= 12; $i++)
											{
												$month_name = date('F', mktime(0, 0, 0, $i, 1, 2011));
												echo '<option value="'. $i .'">'.$month_name.'</option>';
											}
											?>
										</select>										
										<select name="emp_date_from_year" class="ui dropdown">
											<option value="">Select a year</option>
											<?php									
											for($i=1950;$i<=date('Y');$i++)
											{
												echo '<option value='.$i.'>'.$i.'</option>';
												if($i == date('Y')){break;}
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
												echo '<option value="'.$i.'">'.$month_name.'</option>';
											}
											?>
										</select>										
										<select id="emp_date_to_year" name="emp_date_to_year" class="ui dropdown">
											<option value="">Select a year</option>
											<?php									
											for($i=1950;$i<=date('Y');$i++)
											{
												echo '<option value='.$i.'>'.$i.'</option>';
												if($i == date('Y')){break;}
											}
											?>
										</select>&nbsp;
										<div class="ui checkbox" id="chk-present">
											<input name="emp_date_to_present" type="checkbox">
											<label>Present</label>
										</div>
									</div>
									
									<div class="inline field ui flex">
										<label>Industry</label>
										<select name="emp_industry" class="ui dropdown">
											<option value="">Select an industry</option>
											<option value="Software">Software</option>
											<option value="Hardware">Hardware</option>
											<option value="Security">Security</option>
											<option value="Network">Network</option>
										</select>
									</div>
									
									<div class="inline field">
										<label>Position</label>
										<input type="text" name="emp_postion" size="35" placeholder="Eg: International sales executive" />
									</div>
									
									<div class="inline field ui flex">
										<label>Job category</label>
										<select name="emp_category" class="ui dropdown">
											<option value="">Select an industry</option>
											<option value="Information technology">Information technology</option>
											<option value="Software development">Software development</option>
											<option value="Hardware house">Hardware house</option>
											<option value="Database administration">Database administration</option>
										</select>
									</div>
									
									<div class="inline field">
										<label>Job Type</label>										
										<select name="emp_type" class="ui dropdown">
											<option value="">Select an type</option>
											<option value="Full time">Full time</option>
											<option value="Part time">Part time</option>
											<option value="Internship">Internship</option>
											<option value="Freelancer">Freelancer</option>
										</select>
									</div>
									
									<div class="inline field">
										<label>Job level</label>
										<select name="emp_level" class="ui dropdown">
											<option value="">Select an level</option>
											<option value="Fresh graduated">Fresh graduated</option>
											<option value="Executive">Executive</option>
										</select>
									</div>
									
									<div class="inline field">
										<label>Responsibilities</label>
										<textarea name="emp_responsibilities" cols="50"></textarea>
									</div>
									
									<div class="inline field">
										<label>Monthly salary (RM)</label>
										<input type="text" name="emp_salary" />
									</div>
									
									<div class="inline field">
										<label>Achievements</label>
										<textarea name="emp_achivement" cols="50"></textarea>
									</div>
									
									<div class="action">
										<!--<input type="submit" value="Save" class="ui primary button">-->
										<button type="submit" id="btn-submit1" class="ui primary button"><i class="save icon"></i> Save</button>
										<button type="reset" id="btn-reset" class="ui default button"><i class="refresh icon"></i> Clear</button>
									</div>
								</form>
							</div>
							<a href class="add more" id="add_more"><i class="add icon"></i> Add more employment detail</a>
						</div>
						
					</div>
				</div>
</div>

@section('modal')
<div class="ui basic modal" id="modal-employment-delete">
	<div class="ui icon header text red">
		<i class="checkmark icon"></i>
		Delete the Employement
	</div>
	<div class="content">
		<p>Do you wish to delete the employment?</p>
	</div>
	<div class="actions">
		<div class="ui basic cancel inverted button">
			<i class="remove icon"></i>
			No
		</div>
		<div class="ui red ok inverted button">
			<i class="checkmark icon"></i>
			<a href="" id="del_emp">Yes</a>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
    (function($) {
      $("#chk-present input[type='checkbox']").change(function() {
        if ( $(this).is(":checked") ) {
          $("#emp_date_to .ui.dropdown").dropdown("restore defaults").addClass("disabled");
        } else {
          $("#emp_date_to .ui.dropdown").dropdown("restore defaults").removeClass("disabled");
        }
      });
      }); 
    
      
      $("#add_more").click(function(e) {
        e.preventDefault();       
        $('#employment_add').show();
        $(this).hide();
        $('.no-data-found').hide();
      });
      

    function DeleteEmployment(data){
        $('#del_emp').attr('href',data);
      }
    $(document).ready(function (e) {
      $('#employment_add')
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
    });
    (function($) {
      $("#chk-present input[type='checkbox']").change(function() {
        if ( $(this).is(":checked") ) {
          $("#emp_date_to .ui.dropdown").dropdown("restore defaults").addClass("disabled");
          $('#emp_date_to_month').val('');
          $('#emp_date_to_year').val('');
        } else {
          $("#emp_date_to .ui.dropdown").dropdown("restore defaults").removeClass("disabled");
        }
      });
      
    })(jQuery);
    
    </script>
@endsection

@endsection
			
		
