@extends('layouts.main')
@section('body_class','gray')

@section('content')
<div class="ui container">
	<div class="ui full width flex employer content">
		@include('partials.employer.emp-left')	

		<div class="center">
			<div class="box">
				<h2 class="text upper">Dashboard</h2>
				<div class="ui bottom aligned grid">
					<div class="eight wide column">
						<h3 class="title">{{ $emp_details->comapny_name }}</h3>
						<div class="ui business-logo image caption" data-position="bottom">
							@if ( $emp_details->company_avatar )
							<img src="{{ url('public/uploads/employer/' . $emp_details->company_id . '/' . $emp_details->company_avatar) }}" alt="" id="photo-preview" />
							@else
							<img src="{{ url('public/img/company-building-icon.png') }}" alt="" id="photo-preview" />
							@endif
							<form name="photo" data-photo-upload data-preview="#photo-preview" enctype="multipart/form-data" action="{{route('employer.update.profilepic')}}" method="post">
								<input type="hidden" name="_token" value="{{ Session::token() }}">
								<input type="file" name="signFile" style="display:none" accept="image/*">
								<input type="submit" name="jobseeker_profile_upload" value="Upload" style="display: none;" />
								<a class="caption" data-toggle="upload"><i class="photo icon"></i> Upload photo</a>
							</form>
						</div>
					</div>
					<div class="five wide column right floated center aligned">
						<img src="{{ url('public/img/qrcode.png') }}" alt="" />Scan me</div>
				</div>

				<div class="user-profile">
					<div class="ui longer-label detail">
						<div class="row">
							<div class="label">Business registration number</div>
							<div class="text">{{$emp_details->company_reg_num}}</div>
						</div>
						<div class="row">
							<div class="label">Industry</div>
							<div class="text"><!--{{$emp_details->company_industry_id}} --> Information Technology</div>
						</div>
						<div class="row">
							<div class="label">Company size</div>
							<div class="text"><!--{{$emp_details->company_size_id}}--> 10 - 20</div>
						</div>
						<div class="row">
							<div class="label">Telephone</div>
							<div class="text">{{$emp_details->company_tel_number}}</div>
						</div>
						<div class="row">
							<div class="label">Fax</div>
							<div class="text">{{$emp_details->company_fax}}</div>
						</div>
						<div class="row">
							<div class="label">Description</div>
							<div class="text">
								<div class="ui hide text">
									<div class="content">
										<p>{{$emp_details->company_description}}</p>										
									</div>
									<a class="show-more" data-less-text="Show less" data-more-text="Show more">Show more</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="label">Address</div>
							<div class="text">
								{{$emp_details->company_address}}
							</div>
						</div>
						<div class="row">
							<div class="label">City</div>
							<div class="text">
								{{$emp_details->company_city}}
							</div>
						</div>
						<div class="row">
							<div class="label">State</div>
							<div class="text">
								{{$emp_details->company_state_id}}
							</div>
						</div>
						<div class="ui map">
							<?php  $ompany_lat = $emp_details->company_lat; 
							$company_long = $emp_details->company_long;
							$company_address = $emp_details->company_address;?>
							<iframe width="100%" height="120" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $ompany_lat ?>,<?php echo $ompany_lang; ?> <?php echo $company_address; ?>&amp;output=embed"></iframe>
							<!--<iframe
							width="100%"
							height="120"
							frameborder="0" style="border:0"
							src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAKFcfsp5EDchadYiYGxjOCfC6CV-P0-4g
							&q=Space+Needle,Seattle+WA" allowfullscreen>
						</iframe>-->
					</div>

					<div class="ui two statistics">
						<div class="statistic">
							<div class="value">{{ $employer->posts()->count() }}</div>
							<div class="label">Job posts</div>
						</div>
						<div class="statistic">
							<div class="value">0</div>
							<div class="label">Applicants</div>
						</div>
						<!-- 
						<div class="statistic">
							<div class="value">n/a</div>
							<div class="label">Job views</div>
						</div>
						<div class="statistic">
							<div class="value">n/a</div>
							<div class="label">Credits</div>
						</div>
						-->
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="right">
		<div class="ui medium rectangle test ad" data-text="Medium Rectangle"></div>
	</div>
</div>
</div>
</div>
@endsection

@section('script')
<script src="{{ url('public/js//blog.js') }}"></script>
<script type='text/javascript' src="{{ url('public/js/jquery.sticky.js') }}"></script>
<script type="text/javascript" src="{{ url('public/js/slick.min.js') }}"></script>
<script>
(function($) {
	$("[data-photo-upload]").each(function() {
		var fileInput = $(this).find("input[type='file']");
		var form = this;
		var previewer = $(this).data("preview");
		var preview = $(previewer);
		
		$(this).on("submit", function(e) {
			e.preventDefault();
	        var formData = new FormData(this);
	        var imgclean = $('#ImageBrowse');
	        var imgname  =  $(fileInput).val();
	        var size  =  $(fileInput)[0].files[0].size;
	        var ext =  imgname.substr( (imgname.lastIndexOf('.') +1) ).toLowerCase();
	        
	        if($.inArray(ext,["jpg", "jpeg", "png", "gif"])===-1)
	        {   
	            alert('Sorry Only you can uplaod JPEG|JPG|PNG|GIF file type ');
	            return false;
	        }else if(size >= 1000000){ //less then 1MB
	            alert('Sorry File size exceeding from 1 Mb');
	            return false;
	        }
	        
	        $.ajax({
	            type:'POST',
	            url: $(this).attr('action'),
	            data:formData,
	            cache:false,
	            contentType: false,
	            processData: false,
	            beforeSend: function(){
	                var loader_url = "{{ url('public/uploads/clock-loading.gif') }}";
	                $(preview).attr('src',loader_url);
	            },
	            success: function(response){
	            	$(preview).attr('src',response.profileImage);
	            },
	            error: function(jqXHR, exception){
	               
	            }
	        });
		});

		$(this).find("[data-toggle='upload']").css("cursor", "pointer");
		$(this).on("click", "[data-toggle='upload']", function(e) {
			e.preventDefault();

			$(fileInput).trigger("click");
		});
		$(fileInput).on("change", function(e) {
			$(form).submit();
		});
	});
	
	$("[data-toggle='slick']").each(function() {
		var data = $(this).data();
		delete data["toggle"];
		
		$(this).slick(data);
	});
		
	$("[data-toggle='sticky']").each(function() {
		$(this).sticky({
			topSpacing: $(this).data("topSpacing"),
			bottomSpacing: 100
		});
		
		$(this).on("sticky-start", function(e) {
			$("#container").addClass("sticky");
		});
		
		$(this).on("sticky-end", function(e) {
			$("#container").removeClass("sticky");
		});
	});
})(jQuery);
</script>
@endsection