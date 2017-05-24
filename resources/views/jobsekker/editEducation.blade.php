@extends('layouts.main')
@section('body_class','gray')
@section('content')
<div class="ui container">
	<div class="ui full width user-profile flex">	
		@include('partials.jobseeker.profile_left')	
		<div class="right">
			<div class="box">
				<div class="text header">Educations</div>							
										
			<div class="ui form box">
				<form class="ui tabular form" action="{{ route('education_update') }}" method="post" id="education_edit" name="education_edit" >									
					<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
					<input type="hidden" name="edu_id" value="<?php echo $educations->edu_id; ?>">
					<div class="inline field">
						<label>Education level</label>					
						<select name="edu_edu_level">
							<?php $edu_edu_level = $educations->edu_edu_level;?>
							<option value="">Select an education level</option>
							<option value="Diploma" {{(trim($edu_edu_level) == 'Diploma') ? 'selected="selected"' : ''}} >Diploma</option>
							<option value="Advanced Diploma" {{(trim($edu_edu_level) == 'Advanced Diploma') ? 'selected="selected"' : ''}} >Advanced Diploma</option>
							<option value="Degree" {{(trim($edu_edu_level) == 'Degree') ? 'selected="selected"' : ''}} >Degree</option>											
						</select>						
					</div>
					<div class="inline field">
						<label>Course</label>					
						<select name="edu_course">
							<option value="">Select a course</option>
							<?php echo $edu_course = $educations->edu_course;?>
							<option value="Agriculture" {{(trim($edu_course) == 'Agriculture') ? 'selected="selected"' : ''}} >Agriculture</option>
							<option value="Accounting" {{(trim($edu_course) == 'Accounting') ? 'selected="selected"' : ''}} >Accounting</option>
							<option value="Business administration" {{(trim($edu_course) == 'Business administration') ? 'selected="selected"' : ''}} >Business administration</option>											
						</select>						
					</div>									
					<div class="inline field">
						<label>Major</label>
						<input type="text" name="edu_major" size="35" placeholder="Eg: Mathematics" value="<?php echo $educations->edu_major; ?>" />
					</div>							
					<div class="inline field">
						<label>Schoo / Institute / University</label>
						<input type="text" name="edu_university" size="45" placeholder="Name of the University / School / Institute" value="<?php echo $educations->edu_university; ?>" />
					</div>
					<div class="inline field">
						<label>Year of completion</label>											
						<select name="edu_completion">
							<option value="">Select a year</option>
							<?php	
							echo $edu_completion = $educations->edu_completion;																		
							for($year=1990;$year<=date('Y');$year++)
							{		
								
								echo '<option value="'.$year. '" '. ($educations->edu_completion == $year ? 'selected="selected"' :  '' ). '>'.$year.'</option>';
								if($year == date('Y')){break;}
							}
							?>
						</select>						
					</div>
					<div class="inline field">
						<label>Result</label>
						<input type="text" name="edu_result" value="<?php echo $educations->edu_result; ?>" />
						<div class="tips">
							SPM: 8A1 2B2<br />
							STPM: 4A<br />
							A-Level: 3.0CGPA<br />
							BSc (Hons) Food Science: 3.3 CGPA or Pass or Fail
						</div>
					</div>
					
					<div class="inline field">
						<label>Additional information</label>
						<textarea name="edu_add_info" cols="50"><?php echo $educations->edu_add_info; ?></textarea>
					</div>									
					<div class="action">
						<button type="submit" id="btn-submit1" class="ui primary button"><i class="save icon"></i> Update</button>
						<button type="button" class="ui button red" onclick="goBack()"><i class="remove icon"></i> Cancel</button>
					</div>
				</form>
			</div>
			<!-- <a href class="add more" id="add_more"><i class="add icon"></i> Add more education detail</a> -->
		</div>
		
	</div>
</div>
@section('script')
<script type="text/javascript">

    $(document).ready(function (e) {
      $('#education_edit')
       .form({
         fields: {
         edu_edu_level  : 'empty',
         edu_course   : 'empty',
         edu_major    : 'empty',
         edu_university : 'empty',
         edu_completion : 'empty',
         edu_result     : 'empty',
         edu_add_info   : 'empty'
         }
       });
    });
    function goBack() {
		window.history.back();
	}
</script>
@endsection
@endsection

