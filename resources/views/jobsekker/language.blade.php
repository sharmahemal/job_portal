@extends('layouts.main')
@section('body_class','gray')
@section('content')			
<div class="ui container">
	<div class="ui full width user-profile flex">
		@include('partials.jobseeker.profile_left')
		<div class="right">
			<div class="box">
				<div class="text header">Skills</div>
				
				<form class="ui tabular form" action="{{ route('languageadd') }}" method="post" id="language_add" name="language_add">
					<input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
					<div class="ui form box">
						<div class="title">Languages</div>
						@if (count($languages) > 0)
						<div class="ui repeating group lang">
							@foreach ($languages as $i => $language)									
										<div class="inline field lang">
											<label>Language #<span class="number">{{$i + 1}}</span></label>
											<select name="lang_title[]" class="ui selection dropdown">
												<?php echo $lang_title = $language->lang_title; ?>
												<option value="">Select a language</option>
												<option value="English" {{(trim($lang_title) =='English') ? 'selected="selected"' : ''}} >English</option>
												<option value="Chinese" {{(trim($lang_title) =='Chinese') ? 'selected="selected"' : ''}} >Chinese</option>
												<option value="Malay" {{(trim($lang_title) =='Malay') ? 'selected="selected"' : ''}} >Malay</option>
												<option value="Tamil" {{(trim($lang_title) =='Tamil') ? 'selected="selected"' : ''}} >Tamil</option>
										   </select>
										   <select name="lang_speak[]" class="ui selection dropdown">
											   <?php $lang_speak = $language->lang_speak; ?>
												<option value="">Select your spoken level</option>
												<option value="Fair" {{(trim($lang_speak) =='Fair') ? 'selected="selected"' : ''}} >Fair</option>
												<option value="Good" {{(trim($lang_speak) =='Good') ? 'selected="selected"' : ''}} >Good</option>
												<option value="Excellent" {{(trim($lang_speak) =='Excellent') ? 'selected="selected"' : ''}} >Excellent</option>
										   </select>
										   <select name="lang_write[]" class="ui selection dropdown">
												<option value="">Select your written level</option>
												<?php $lang_write = $language->lang_write; ?>
												<option value="Fair" {{(trim($lang_write) =='Fair') ? 'selected="selected"' : ''}} >Fair</option>
												<option value="Good" {{(trim($lang_write) =='Good') ? 'selected="selected"' : ''}} >Good</option>
												<option value="Excellent" {{(trim($lang_write) =='Excellent') ? 'selected="selected"' : ''}} >Excellent</option>
										   </select>
										   </select>
											<a href class="text red" data-toggle="modal" data-target="#modal-language-delete"  onclick='return DeleteLanguage("{{ route("language_delete",$language->lang_id) }}");'><i class="remove icon"></i></a>
										</div>
										<?php //echo count($languages); echo $i+1;?>
										<?php if(($i + 1) == count($languages) && count($languages) < 4 ){ ?>
										<div class="action add_lang">
											<a href=""><i class="plus icon"></i> Add more language</a>
										</div>
										<?php } ?>									
							@endforeach	
								</div>
							<!--</div>-->
						
					@else
						<div class="ui repeating group lang">
							<div class="inline field lang">
								<label>Language #<span class="number">1</span></label>
								<select name="lang_title[]" class="ui selection dropdown">
									<option value="">Select a language</option>
									<option value="English">English</option>
									<option value="Chinese">Chinese</option>
									<option value="Malay">Malay</option>
									<option value="Tamil">Tamil</option>
							   </select>
							   <select name="lang_speak[]" class="ui selection dropdown">
									<option value="Fair">Fair</option>
									<option value="Good">Good</option>
									<option value="Excellent">Excellent</option>
							   </select>
							   <select name="lang_write[]" class="ui selection dropdown">
									<option value="Fair">Fair</option>
									<option value="Good">Good</option>
									<option value="Excellent">Excellent</option>
							   </select>		
								
								<a href class="text red lang_remove"><i class="remove icon"></i></a>
							</div>
							<div class="action add_lang">
								<a href=""><i class="plus icon"></i> Add more language</a>
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
	<div class="ui basic modal" id="modal-language-delete">
	<div class="ui icon header text red">
		<i class="checkmark icon"></i>
		Delete the language
	</div>
	<div class="content">
		<p>Do you wish to delete the language?</p>
	</div>
	<div class="actions">
		<div class="ui basic cancel inverted button">
			<i class="remove icon"></i>
			No
		</div>
		<div class="ui red ok inverted button">
			<i class="checkmark icon"></i>
			<a href="" id="del_lang">Yes</a>
		</div>
	</div>
	</div>
@endsection		
@section('script')
		<script>
			function DeleteLanguage(data){
				$(this).closest('.inline.field.lang').hide();
				$('#del_lang').attr('href',data);
				
			}
		(function($) {
						
			$("#btn-reset").click(function(e) {
				e.preventDefault();
				
				var form = $(this).closest("form");
				$(form).find(".field.error").removeClass("error");
			});
			
			$(".group.lang").find(".lang_remove").click(function(e) {
				e.preventDefault();				
				var language = $(this).closest(".group.lang");
				$(language).hide();
			});
			
			$(".add_lang").find("a").click(function(e) {
				e.preventDefault();
				var numItemsSoft = $('.inline.field.lang').length;
				//alert(numItemsSoft);
				var repeatingGroup = $(this).closest(".group.lang");
				var field = $(repeatingGroup).find(".inline.field:first");
				var action = $(this).closest(".action");
				//$('.inline.field.soft').find('.numbers').append(numItemsSoft + 1);
				if ( field.length ) {
					var field = $(field).clone().insertBefore(action);
					
					// Reinitialize the dropdown UI.
					$(field).find(".ui.dropdown").dropdown();
					
					// Please correct the index and add the remove button event also.
				}
				if(numItemsSoft >= 3){
					$(this).hide();
				}
			});			
					
			
		})(jQuery);
		</script>
	@endsection
@endsection
