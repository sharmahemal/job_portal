@extends('layouts.main')
@section('body_class','gray')
@section('content')
<div class="ui container">
				<div class="ui full width user-profile flex">	
					@include('partials.jobseeker.profile_left')					
					<div class="right">
						<div class="box">
							<div class="text header">Educations</div>
							@if (count($educations) > 0)
							<div class="ui form box">
								@foreach ($educations as $education)
								<div class="ui flex">
									<div class="info grow-1">
										<div class="detail">
											<div class="row">
												<div class="label">Education level</div>
												<div class="text">{{ $education->edu_edu_level }}</div>
											</div>
											<div class="row">
												<div class="label">Course</div>
												<div class="text">{{ $education->edu_course }}</div>
											</div>
											<div class="row">
												<div class="label">Major</div>
												<div class="text">{{ $education->edu_major }}</div>
											</div>
											<div class="row">
												<div class="label">Schoo / Institute / University</div>
												<div class="text">{{ $education->edu_university }}</div>
											</div>
											<div class="row">
												<div class="label">Year of completion</div>
												<div class="text">{{ $education->edu_completion }}</div>
											</div>
											<div class="row">
												<div class="label">Result</div>
												<div class="text">{{ $education->edu_result }}</div>
											</div>
											<div class="row">
												<div class="label">Additional information</div>
												<div class="text">
													<div class="ui hide text">
														<div class="content">
															<p>{!! nl2br($education->edu_add_info) !!}</p>
														</div>
														<a class="show-more" data-less-text="Show less" data-more-text="Show more">Show more</a>
													</div>
												</div>
											</div>
										</div>
									</div>								
									<div class="actions">
										<a class="ui primary button" href="{{ route('education_edit',$education->edu_id) }}"><i class="edit icon"></i> Edit</a>
										<a class="ui red button" data-toggle="modal" data-target="#modal-education-delete"  onclick='return DeleteEducation("{{ route("education_delete",$education->edu_id) }}");'><i class="trash icon"></i> Delete</a>
										
									</div>
								</div>
								@endforeach							
							</div>
							@else
							<p class="add more no-data-found">No information provided. Please add information.</p>								
							@endif
							<div class="ui form box">
								<form class="ui tabular form" action="{{ route('educationadd') }}" method="post" id="education_add" name="education_add" style="display:none;">									
									<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">	
									
									
									<div class="inline field">
										<label>Education level</label>					
										<select name="edu_edu_level" class="ui dropdown">
											<option value="">Select an education level</option>
											<option value="Diploma">Diploma</option>
											<option value="Advanced Diploma">Advanced Diploma</option>
											<option value="Degree">Degree</option>											
										</select>						
									</div>
									<div class="inline field">
										<label>Course</label>					
										<select name="edu_course" class="ui dropdown">
											<option value="">Select a course</option>
											<option value="Diploma">Agriculture</option>
											<option value="Advanced Diploma">Accounting</option>
											<option value="Degree">Business administration</option>											
										</select>						
									</div>									
									<div class="inline field">
										<label>Major</label>
										<input type="text" name="edu_major" size="35" placeholder="Eg: Mathematics" />
									</div>							
									<div class="inline field">
										<label>Schoo / Institute / University</label>
										<input type="text" name="edu_university" size="45" placeholder="Name of the University / School / Institute" />
									</div>
									<div class="inline field">
										<label>Year of completion</label>											
										<select name="edu_completion" class="ui dropdown">
											<option value="">Select a year</option>
											<?php									
												for($i=1990;$i<=date('Y');$i++)
												{
													echo '<option value='.$i.'>'.$i.'</option>';
													if($i == date('Y')){break;}
												}
											?>
										</select>						
									</div>
									<div class="inline field">
										<label>Result</label>
										<input type="text" name="edu_result" />
										<div class="tips">
											SPM: 8A1 2B2<br />
											STPM: 4A<br />
											A-Level: 3.0CGPA<br />
											BSc (Hons) Food Science: 3.3 CGPA or Pass or Fail
										</div>
									</div>
									
									<div class="inline field">
										<label>Additional information</label>
										<textarea name="edu_add_info" cols="50"></textarea>
									</div>
									
									<div class="action">
										<button type="submit" id="btn-submit1" class="ui primary button"><i class="save icon"></i> Save</button>
										<button type="reset" id="btn-reset" class="ui default button"><i class="refresh icon"></i> Clear</button>
									</div>
								</form>
							</div>
							<a href class="add more" id="add_more"><i class="add icon"></i> Add more education detail</a>
						</div>
						
					</div>
				</div>
</div>

		
@section('modal')
<div class="ui basic modal" id="modal-education-delete">
			<div class="ui icon header text red">
				<i class="checkmark icon"></i>
				Delete the Education
			</div>
			<div class="content">
				<p>Do you wish to delete the education ?</p>
			</div>
			<div class="actions">
				<div class="ui basic cancel inverted button">
					<i class="remove icon"></i>
					No
				</div>
				<div class="ui red ok inverted button">
					<i class="checkmark icon"></i>
					<a href="" id="del_edu">Yes</a>
				</div>
			</div>
		</div>
@endsection

@section('script')
<script type="text/javascript">
$("#add_more").click(function(e) {
        e.preventDefault();       
        $('#education_add').show();
        $(this).hide();
        $('.no-data-found').hide();
      });
function DeleteEducation(data){
        $('#del_edu').attr('href',data);
      }
    $(document).ready(function (e) {
      $('#education_add')
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
</script>
@endsection


@endsection