@extends('layouts.main')
@section('body_class','gray')
@section('content')			
<div class="ui container">
	<div class="ui full width user-profile flex">
		@include('partials.jobseeker.profile_left')
		<div class="right">
			<div class="box">
				<div class="text header">Skills</div>
				
				<form class="ui tabular form" action="{{ route('skilladd') }}" method="post" id="skill_add" name="skill_add">
					<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
					<div class="ui form box">
						<div class="title">Technical skills</div>
						@if (count($tech_skills) > 0)
						<div class="ui repeating group tech">
							@foreach ($tech_skills as $i => $tech_skill)
									
										<div class="inline field tech">
											<label>Skill #<span class="number">{{$i + 1}}</span></label>
											<select name="tech[]" class="ui selection dropdown">
												<?php $skill_title = $tech_skill->skill_title; ?>
												<option value="">Select a job skill</option>
												<option value="Audit Software" {{(trim($skill_title) == 'Audit Software') ? 'selected="selected"' : ''}} >Audit Software</option>
												<option value="External Audit" {{(trim($skill_title) == 'External Audit') ? 'selected="selected"' : ''}} >External Audit</option>
												<option value="Handle Full Set Auditing Process" {{(trim($skill_title) == 'Handle Full Set Auditing Process') ? 'selected="selected"' : ''}} >Handle Full Set Auditing Process</option>
												<option value="Internal Audit" {{(trim($skill_title) == 'Internal Audit') ? 'selected="selected"' : ''}} >Internal Audit</option>
												<option value="Projected Cash Flow" {{(trim($skill_title) == 5) ? 'selected="selected"' : ''}} >Projected Cash Flow</option>
										   </select>
										   <select name="tech_val[]" class="ui selection dropdown">
											   <?php $skill_val = $tech_skill->skill_val; ?>
												<option value=">1" {{(trim($skill_val) =='>1') ? 'selected="selected"' : ''}} >&lt; 1</option>
												<option value="1-2" {{(trim($skill_val) == '1-2') ? 'selected="selected"' : ''}} >1 - 2</option>
												<option value="2-5" {{(trim($skill_val) == '2-5') ? 'selected="selected"' : ''}} >2 - 5</option>
												<option value=">5" {{(trim($skill_val) == '>5') ? 'selected="selected"' : ''}} >&gt; 5</option>
										   </select>		
											
											<!--<a href class="text red tech_remove"><i class="remove icon"></i></a>-->
											<a href class="text red" data-toggle="modal" data-target="#modal-skill-delete"  onclick='return DeleteSkill("{{ route("skill_delete",$tech_skill->skill_id) }}");'><i class="remove icon"></i></a>
										</div>
										<?php //echo count($tech_skills); echo $i+1;?>
										<?php if(($i + 1) == count($tech_skills) && count($tech_skills) < 5 ){ ?>
										<div class="action add_tech_skill">
											<a href=""><i class="plus icon"></i> Add more skill</a>
										</div>
										<?php } ?>
									
							@endforeach	
								</div>
							<!--</div>-->
						
					@else
						<div class="ui repeating group tech">
							<div class="inline field tech">
								<label>Skill #<span class="number"></span></label>
								<select name="tech[]" class="ui selection dropdown">
									<option value="">Select a job skill</option>
									<option value="Audit Software">Audit Software</option>
									<option value="External Audit">External Audit</option>
									<option value="Handle Full Set Auditing Process">Handle Full Set Auditing Process</option>
									<option value="Internal Audit">Internal Audit</option>
									<option value="Projected Cash Flow">Projected Cash Flow</option>
							   </select>
							   <select name="tech_val[]" class="ui selection dropdown">
									<option value="< 1"> < 1</option>
									<option value="1 - 2">1 - 2</option>
									<option value="2 - 5">2 - 5</option>
									<option value="> 5">> 5</option>
							   </select>		
								
								<a href class="text red tech_remove"><i class="remove icon"></i></a>
							</div>
							<div class="action add_tech_skill">
								<a href=""><i class="plus icon"></i> Add more skill</a>
							</div>
						</div>
						@endif
					</div>
					<div class="ui form box">
						<div class="title">Soft skills</div>
						@if (count($soft_skills) > 0)
							<div class="ui repeating group soft">
								@foreach ($soft_skills as $s => $soft_skill)
									
										<div class="inline field soft">
											<label>Skill #<span class="number">{{$s + 1 }}</span></label>
											<select name=soft[]" class="ui selection dropdown">
												<?php $soft_skill_title = $soft_skill->skill_title; ?>
												<option value="">Select a soft skill</option>
												<option value="Analytical / research skills" {{(trim($soft_skill_title) == 'Analytical / research skills') ? 'selected="selected"' : ''}}>Analytical / research skills</option>
												<option value="Computer literacy" {{(trim($soft_skill_title) == 'Computer literacy') ? 'selected="selected"' : ''}} >Computer literacy</option>
										   </select>
										   <select name="soft_val[]" class="ui selection dropdown">
											   <?php $soft_skill_val = $soft_skill->skill_val; ?>
												<option value="Beginner" {{(trim($soft_skill_val) == 'Beginner') ? 'selected="selected"' : ''}} >Beginner</option>
												<option value="Intermediate" {{(trim($soft_skill_val) == 'Intermediate') ? 'selected="selected"' : ''}} >Intermediate</option>
												<option value="Advanced" {{(trim($soft_skill_val) == 'Advanced') ? 'selected="selected"' : ''}} >Advanced</option>
										   </select>
											<a href class="text red" data-toggle="modal" data-target="#modal-skill-delete"  onclick='return DeleteSkill("{{ route("skill_delete",$soft_skill->skill_id) }}");'><i class="remove icon"></i></a>
										</div>
										<?php if(($s + 1) == count($soft_skills) && count($soft_skills) < 3 ){ ?>
										<div class="action add_soft_skill">
											<a href><i class="plus icon"></i> Add more skill</a>
										</div>
										<?php } ?>
									
								@endforeach	
							</div>					
								
						@else
						<div class="ui repeating group soft">
							<div class="inline field soft">
								<label>Skill #<span class="number"></span></label>
								<select name=soft[]" class="ui selection dropdown">
									<option value="">Select a soft skill</option>
									<option value="Analytical / research skills">Analytical / research skills</option>
									<option value="Computer literacy">Computer literacy</option>
							   </select>
							   <select name="soft_val[]" class="ui selection dropdown">
									<option value="Beginner">Beginner</option>
									<option value="Intermediate">Intermediate</option>
									<option value="Advanced">Advanced</option>
							   </select>
								<a href class="text red soft_remove" id="soft_remove"><i class="remove icon"></i></a>
							</div>
							<div class="action add_soft_skill">
								<a href><i class="plus icon"></i> Add more skill</a>
							</div>
						</div>
					
						@endif
					</div>
					<div class="action">
						<button type="submit" class="ui button primary"><i class="save icon"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@section('modal')
	<div class="ui basic modal" id="modal-skill-delete">
	<div class="ui icon header text red">
		<i class="checkmark icon"></i>
		Delete the Skill
	</div>
	<div class="content">
		<p>Do you wish to delete the skill?</p>
	</div>
	<div class="actions">
		<div class="ui basic cancel inverted button">
			<i class="remove icon"></i>
			No
		</div>
		<div class="ui red ok inverted button">
			<i class="checkmark icon"></i>
			<a href="" id="del_skill">Yes</a>
		</div>
	</div>
	</div>
@endsection		
@section('script')
		<script>
			function DeleteSkill(data){
				$(this).closest('.inline.field').hide();
				$('#del_skill').attr('href',data);
			}
		(function($) {
						
			$("#btn-reset").click(function(e) {
				e.preventDefault();
				
				var form = $(this).closest("form");
				$(form).find(".field.error").removeClass("error");
			});
			
			$(".group.tech").find(".tech_remove").click(function(e) {
				e.preventDefault();				
				var skill = $(this).closest(".group.tech");
				$(skill).hide();
			});
						
			$(".add_soft_skill").find("a").click(function(e) {
				e.preventDefault();
				var numItemsSoft = $('.inline.field.soft').length;
				var repeatingGroup = $(this).closest(".group.soft");
				var field = $(repeatingGroup).find(".inline.field:first");
				var action = $(this).closest(".action");
				//$('.inline.field.soft').find('.numbers').append(numItemsSoft + 1);
				if ( field.length ) {
					var field = $(field).clone().insertBefore(action);
					$(field).find(".ui.dropdown").dropdown();
				}
				if(numItemsSoft >= 2){
					$(this).hide();
				}
			});
			
			$(".add_tech_skill").find("a").click(function(e) {
				e.preventDefault();
				var numItemsTech = $('.inline.field.tech').length;
				var repeatingGroup = $(this).closest(".group.tech");
				var field = $(repeatingGroup).find(".inline.field:first");
				var action = $(this).closest(".action");
				if ( field.length ) {
					var field = $(field).clone().insertBefore(action);
					$(field).find(".ui.dropdown").dropdown();
				}
				
				if(numItemsTech >= 4){
					$(this).hide();
				}
			});			
			
		})(jQuery);
		</script>
	@endsection
@endsection
