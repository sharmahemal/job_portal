@extends('layouts.main')
@section('body_class','gray')
@section('content')
<div class="ui container">
	<div class="ui full width user-profile flex">	
		@include('partials.jobseeker.profile_left')				
		<div class="right">
			<div class="box">
				<div class="text header">References</div>
				@if (count($references) > 0)

				<div class="ui form box">
					@foreach ($references as $reference)
					<div class="ui flex">
						<div class="info grow-1">
							<div class="detail">
								<div class="row">
									<div class="label">Reference name</div>
									<div class="text">{{ $reference->ref_name }}</div>
								</div>
								<div class="row">
									<div class="label">Job title</div>
									<div class="text">{{ $reference->ref_title }}</div>
								</div>
								<div class="row">
									<div class="label">Company name</div>
									<div class="text">{{ $reference->ref_company }}</div>
								</div>
								<div class="row">
									<div class="label">Contact number</div>
									<div class="text">{{ $reference->ref_contact }}</div>
								</div>
								<div class="row">
									<div class="label">Email</div>
									<div class="text">{{ $reference->ref_email }}</div>
								</div>
							</div>
						</div>
									<!--<div class="actions">
										<button class="ui primary button"><i class="edit icon"></i> Edit</button>
										<button class="ui red button"><i class="trash icon"></i> Delete</button>
									</div>
								</div>-->								
								<div class="actions">
									<a class="ui primary button" href="{{ route('reference_edit',$reference->ref_id) }}"><i class="edit icon"></i> Edit</a>
									<a class="ui red button" data-toggle="modal" data-target="#modal-reference-delete"  onclick='return DeleteReference("{{ route("reference_delete",$reference->ref_id) }}");'><i class="trash icon"></i> Delete</a>

								</div>
							</div>
							@endforeach
						</div>

						@else
						<p class="add more no-data-found">No information provided. Please add information.</p>								
						@endif
						<div class="ui form box">
							<form class="ui tabular form" action="{{ route('referenceadd') }}" method="post" id="reference_add" name="reference_add" style="display:none;">									
								<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">									
								<div class="inline field">
									<label>Reference name</label>
									<input type="text" name="ref_name" size="35" placeholder="" />
								</div>

								<div class="inline field">
									<label>Job title</label>
									<input type="text" name="ref_title" size="15" placeholder="" />
								</div>

								<div class="inline field" id="end-date">
									<label>Company name</label>
									<input type="text" name="ref_company" size="35" placeholder="" />
								</div>

								<div class="inline field" id="end-date">
									<label>Contact number</label>
									<input type="text" name="ref_contact" size="15" placeholder="" />
								</div>

								<div class="inline field" id="end-date">
									<label>Email address</label>
									<input type="text" name="ref_email" size="50" placeholder="" />
								</div>

								<div class="action">
									<button type="submit" id="btn-submit1" class="ui primary button"><i class="save icon"></i> Save</button>
									<button type="reset" id="btn-reset" class="ui default button"><i class="refresh icon"></i> Clear</button>
								</div>
							</form>
						</div>
						<a href class="add more" id="add_more"><i class="add icon"></i> Add more reference detail</a>
					</div>

				</div>
			</div>
		</div>


		@section('modal')
		<div class="ui basic modal" id="modal-reference-delete">
			<div class="ui icon header text red">
				<i class="checkmark icon"></i>
				Delete the Employement
			</div>
			<div class="content">
				<p>Do you wish to delete the reference?</p>
			</div>
			<div class="actions">
				<div class="ui basic cancel inverted button">
					<i class="remove icon"></i>
					No
				</div>
				<div class="ui red ok inverted button">
					<i class="checkmark icon"></i>
					<a href="" id="del_ref">Yes</a>
				</div>
			</div>
		</div>
		@endsection

@section('script')
<script type="text/javascript">
  $("#add_more").click(function(e) {
        e.preventDefault();       
        $('#reference_add').show();
        $(this).hide();
        $('.no-data-found').hide();
      });
  function DeleteReference(data){
        $('#del_ref').attr('href',data);
      }
    $(document).ready(function (e) {
      $('#reference_add')
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

@endsection

