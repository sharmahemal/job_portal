@extends('layouts.main')
@section('body_class','gray')
@section('content')
			<div class="ui container">
				<div class="ui full width user-profile flex">
					@include('partials.jobseeker.profile_left')						
					<div class="right">
						<div class="box">
							<div class="text header">References</div>							
														
							<div class="ui form box">
								<form class="ui tabular form" action="{{ route('reference_update') }}" method="post" id="reference_edit" name="reference_edit" >									
									<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
									<input type="hidden" name="ref_id" value="<?php echo $references->ref_id; ?>">
									<div class="inline field">
										<label>Reference name</label>
										<input type="text" name="ref_name" size="35" placeholder="" value="<?php echo $references->ref_name; ?>" />
									</div>
									
									<div class="inline field">
										<label>Job title</label>
										<input type="text" name="ref_title" size="15" placeholder="" value="<?php echo $references->ref_title; ?>" />
									</div>
									
									<div class="inline field" id="end-date">
										<label>Company name</label>
										<input type="text" name="ref_company" size="35" placeholder="" value="<?php echo $references->ref_company; ?>" />
									</div>
									
									<div class="inline field" id="end-date">
										<label>Contact number</label>
										<input type="text" name="ref_contact" size="15" placeholder="" value="<?php echo $references->ref_contact; ?>" />
									</div>
									
									<div class="inline field" id="end-date">
										<label>Email address</label>
										<input type="text" name="ref_email" size="50" placeholder="" value="<?php echo $references->ref_email; ?>" />
									</div>					
									<div class="action">
										<button type="submit" id="btn-submit1" class="ui primary button"><i class="save icon"></i> Update</button>
										<button type="button" class="ui button red" onclick="goBack()"><i class="remove icon"></i> Cancel</button>
									</div>
								</form>
							</div>
							<!-- <a href class="add more" id="add_more"><i class="add icon"></i> Add more reference detail</a> -->
						</div>
						
					</div>
				</div>
			</div>
			
			@endsection

@section('script')
<script type="text/javascript">
  $(document).ready(function (e) {
      $('#reference_edit')
       .form({
         fields: {
         ref_name   : 'empty',
         ref_title  : 'empty',
         ref_company: 'empty',
         ref_contact: 'number',
         ref_email  : 'email'
         }
       });
    });
</script>
@endsection