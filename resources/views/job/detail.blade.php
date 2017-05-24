@extends('layouts.main')

@section('body_class','gray')

@section('content')
<div class="content margin-top">
	<div class="ui container">
		<div class="ui medrect grid">
			<div class="left column">
				@if ( $post->employerUser->company_avatar )
				<div class="box">
					<img src="{{ url('public/uploads/employer/' . $post->employerUser->company_id . '/' . $post->employerUser->company_avatar) }}" />
				</div>
				@endif
				
				<div class="box">
					<h3 class="header">Employer's Info</h3>
					
					<div class="ui info">
						<div class="label">Business registration number</div>
						<div class="value">{{ $post->employerUser->company_reg_num }}</div>
					</div>
					
					<div class="ui info">
						<div class="label">Industry</div>
						<div class="value">{{ $post->employerUser->industry->ind_title }}</div>
						
					</div>
				</div>
				
				<div class="box">
					<h3 class="header">Company Overview</h3>
					
					<p>
						{!! nl2br($post->employerUser->company_description) !!}
					</p>
				</div>
			</div>
			<div class="center column">
				<div class="box">
					<div class="ui grid">
						<div class="eight wide column">
							<h3 class="header">{{ $post->post_title }}</h3>
							<div><a href="{{ url('/company/' . $post->employerUser->slug()) }}">{{ $post->employerUser->comapny_name }}</a></div><br />
							<div class="ui horizontal list">
								<div class="item">{{ $post->post_type }}</div>
								<div class="item">{{ $post->post_category }}</div>
							</div>
						</div>
						<div class="eight wide column right aligned">
							@if ( session('jobsekker_id') )
								@if ( $post->isBookmarked() )
								<a class="active bookmark" data-toggle="bookmark" data-value="{{ $post->id }}"><i class="star icon"></i></a>
								@else
								<a class="bookmark" data-toggle="bookmark" data-value="{{ $post->id }}"><i class="star icon"></i></a>
								@endif
							@else
							<a class="bookmark" data-toggle="popup" data-hoverable="true" data-html="Please <a href='#' data-toggle='modal' data-target='#modal-login'>login</a> as jobseeker first."><i class="star icon"></i></a>
							@endif
							<span class="time">{{ date('j/n/Y', strtotime($post->post_created_date)) }}</span>
							<br /><br />
							<div class="ui social actions">
								<a href class="facebook link"><i class="facebook f icon"></i></a>
								<a href class="twitter link"><i class="twitter icon"></i></a>
								<a href class="linkedin link"><i class="linkedin icon"></i></a>
							</div>
						</div>
					</div>
					<br /><br />
					@if ( $exists )
					<p class="text green center">You've already applied this job! Wait for the news!</p>
					@else
					<button class="ui button fluid primary big" data-toggle="modal" data-target="#modal-apply">Apply Now!</button>
					@endif
					<h3 class="header">Job Description</h3>
					<p>{!! nl2br($post->post_desc) !!}</p>
					<div class="ui divider"></div>
					
					@if ( $post->post_lat && $post->post_long )
					<div id="map" class="ui map" data-lat="{{ $post->post_lat }}" data-long="{{ $post->post_long }}"></div>
					@endif
					
					<div class="ui detail">
						<div class="row">
							<div class="label">Salary</div>
							<div class="text green">
								@if ( session('jobsekker_id') ):
									{{ $post->getSalaryText() }}
								@else
									Login to view salary
								@endif
							</div>
						</div>
						<div class="row">
							<div class="label">Qualification</div>
							<div class="text">
								{{ $post->post_education }}
							</div>
						</div>
						<div class="row">
							<div class="label">Skills</div>
							<div class="text">
								{{ $post->post_soft_skill }}
							</div>
						</div>
						<div class="row">
							<div class="label">Location</div>
							<div class="text">
								{{ $post->getLocation() }}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="right column">
				<div class="ui medium rectangle test ad" data-text="Medium Rectangle">
					<img src="{{ url('public/img/ad-medrect.jpg') }}" />
				</div>
				
				<div class="box">
					<h3 class="header">Featured jobs</h3>
					<div class="ui featured jobs">
						<div class="job">
							<a class="title" href="#">PHP Programmer</a>
							<a href class="company name">Silverlake Sdn. Bhd.</a>
							@if ( session('jobsekker_id') )
							<div class="salary">RM3,500 - RM5,000</div>
							@else
							<div class="salary">Login to view salary</div>
							@endif
							<div class="location">Sri Damansara, WP Kuala Lumpur</div>
						</div>
						<div class="job">
							<a href class="title">Database administrator</a>
							<a href class="company name">Datasoft Sdn. Bhd.</a>
							@if ( session('jobsekker_id') )
							<div class="salary">RM3,500 - RM5,000</div>
							@else
							<div class="salary">Login to view salary</div>
							@endif
							<div><i class="location"></i> Petaling Jaya, Selangor</div>
						</div>
						<div class="job">
							<a href class="title">System Admin</a>
							<a href class="company name">Saito College</a>
							@if ( session('jobsekker_id') )
							<div class="salary">RM3,500 - RM5,000</div>
							@else
							<div class="salary">Login to view salary</div>
							@endif
							<div><i class="location"></i> Puchong, Selangor</div>
						</div>
						<div class="job">
							<a href class="title">Sharepoint Designer</a>
							<a href class="company name">HP (M) Sdn. Bhd.</a>
							@if ( session('jobsekker_id') )
							<div class="salary">RM3,500 - RM5,000</div>
							@else
							<div class="salary">Login to view salary</div>
							@endif
							<div><i class="location"></i> Cyberjaya, Selangor</div>
						</div>
						<div class="job">
							<a class="title">AWS Administrator</a>
							<a href class="company name">All Things IT Sdn. Bhd.</a>
							@if ( session('jobsekker_id') )
							<div class="salary">RM3,500 - RM5,000</div>
							@else
							<div class="salary">Login to view salary</div>
							@endif
							<div><i class="location"></i> Klang, Selangor</div>
						</div>
					</div>
				</div>
				
				<div class="box">
					<h3 class="header">Walk-in interviews</h3>
					<div class="ui featured jobs">
						<div class="job">
							<a href class="title">Accountant</a>
							<a href class="company name">Saito College</a>
							<div class="ui no padded grid">
								<div class="row">
									<div class="two wide column"><i class="calendar icon"></i></div>
									<div class="fourteen wide column">Mon, 2/5/2017</div>
								</div>
								<div class="row">
									<div class="two wide column"><i class="clock icon"></i></div>
									<div class="fourteen wide column">10:00am</div>
								</div>
								<div class="row">
									<div class="two wide column"><i class="street view icon"></i></div>
									<div class="fourteen wide column">18, Jalan Tengah, PJ New Town, 45200, Petaling Jaya, Selangor, Malaysia</div>
								</div>
							</div>
						</div>
						<div class="job">
							<a href class="title">Admin</a>
							<a href class="company name">Datasoft Sdn. Bhd.</a>
							<div class="ui no padded grid">
								<div class="row">
									<div class="two wide column"><i class="calendar icon"></i></div>
									<div class="fourteen wide column">Tue, 3/5/2017</div>
								</div>
								<div class="row">
									<div class="two wide column"><i class="clock icon"></i></div>
									<div class="fourteen wide column">11:00am</div>
								</div>
								<div class="row">
									<div class="two wide column"><i class="street view icon"></i></div>
									<div class="fourteen wide column">Block A-3, Business Centre Park PJ, Jalan Panglima 3, 45200, Petaling Jaya, Selangor, Malaysia</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="box">
					<h3 class="header">ReadMe</h3>
					<div data-toggle="slick" data-autoplay="true" data-autoplay-speed="2000" data-arrows="false" data-bullet="true">
						<div class="ui blogs column">
							<a href="#" class="blog">
								<img src="{{ url('public/img/blogs/item01.jpg') }}" alt="" />
								<div class="caption">
									<div class="title">Why you should attend job fairs?</div>
									<span class="info">John Lim | 27/3/2017</span>
								</div>
							</a>
						</div>
						<div class="ui blogs column">
							<a href="#" class="blog">
								<img src="{{ url('public/img/blogs/item01.jpg') }}" alt="" />
								<div class="caption">
									<div class="title">Why you should attend job fairs?</div>
									<span class="info">John Lim | 27/3/2017</span>
								</div>
							</a>
						</div>
					</div>
				</div>
				
				<div class="box">
					<h3 class="header">Recommend videos</h3>
					<div class="ui embed" data-source="youtube" data-id="iUKsi4f9xuc" data-placeholder="https://i.ytimg.com/vi/iUKsi4f9xuc/hqdefault.jpg?custom=true&w=246&h=138&stc=true&jpg444=true&jpgq=90&sp=68&sigh=PRQMFLQeQeVfSqjW5_ZQgANI6Eo"></div>
					<br />
					<div class="ui embed" data-source="youtube" data-id="upP3g7TzjNQ" data-placeholder="https://i.ytimg.com/vi/upP3g7TzjNQ/hqdefault.jpg?custom=true&w=246&h=138&stc=true&jpg444=true&jpgq=90&sp=68&sigh=r3wIGVMXLNmGug7bcoJX77K-UBE"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal-apply" class="ui small modal">
	<i class="close icon"></i>
	<div class="header">Apply the job!</div>
	<div class="content">
		<div class="ui grid">
			<div class="four wide column">
				<img src="{{ $post->employerUser->getAvatar() }}" />
			</div>
			<div class="eight wide column">
				<h4>{{ $post->post_title }}</h4>
				<p>{{ $post->employerUser->comapny_name }}</p>
				<p class="text green">{{ $post->getSalaryText() }}</p>
			</div>
			<div class="four wide column right aligned">
				{{ $post->post_type }}<br />
				{{ $post->post_category }}
			</div>
		</div>
		<div class="ui divider"></div>
		<form id="form-apply" class="ui tabular longer-label form" method="post" action="{{ url('job/apply') }}">
			{{ csrf_field() }}
			<input type="hidden" name="post_id" value="{{ $post->id }}" />
			
			<div class="inline field">
				<label>Select a resume to apply this job:</label>
				@if ( $jobseeker->resumes && !$jobseeker->resumes->count() )
				<div class="field">
					You don't have any resume yet. Please upload first before applying this job.
				</div>
				@else
				<div class="ui selection search dropdown">
					<input type="hidden" name="resume" value="" />
					<i class="dropdown icon"></i>
					<div class="default text">Select a resume</div>
					<div class="menu">
						@foreach ( $jobseeker->resumes as $resume )
						<div class="item" data-value="{{ $resume->id }}">{{ $resume->default_filename }}</div>
						@endforeach
					</div>
				</div>
				@endif
			</div>
			<div class="inline field">
				<label>Enter your desired monthly salary (RM):</label>
				<input type="text" name="salary" value="" placeholder="{{ $post->getSalaryText() }}" />
			</div>
		</form>
	</div>
	<div class="actions">
		<button type="button" id="btn-apply" class="ui primary button">Submit</button>
		<button type="button" class="ui close button">Close</button>
	</div>
</div>
@endsection



@section('script')
<script src="{{ url('public/js/blog.js') }}"></script>
<script type="text/javascript" src="{{ url('public/js/slick.min.js') }}"></script>
<script>
(function($) {
	$("[data-toggle='slick']").each(function() {
		var data = $(this).data();
		delete data["toggle"];
		
		$(this).slick(data);
	});
	
	@if ( session('jobsekker_id') )
	$("body").on("click", ".bookmark", function(e) {
		e.preventDefault();

		if ( $(this).data("bookmarking") ) {
			return ;
		}
		
		var isActive = $(this).hasClass("active");
		var id = $(this).data("value");
		var data = {
			status: (isActive ? false : true),
			id: id,
			"_token": "{{ csrf_token() }}"
		};

		$(this).data("bookmarking", true);
			
		$.ajax({
			url: "{{ url('jobseeker/post/bookmark') }}",
			type: "post",
			dataType: "json",
			data: data,
			context: this,
			success: function(data) {
				if ( data.success ) {
					$(this).toggleClass("active");
				}
			},
			complete: function() {
				$(this).data("bookmarking", false);
			}
		});
	});
	@endif
	
	$(".ui.pagination .item[href]").click(function(e) {
		e.preventDefault();
		$(this).parent().find("> .item").removeClass("active");
		$(this).addClass("active");
	});
	
	$("body").on("click", "[data-toggle='more']", function(e) {
		e.preventDefault();
		
		var target = $(this).data("target");
		var element = $(target);
		
		if ( element.length ) {
			var	html = "";
			if ( !$(element).is(":visible") ) {
				html = $(this).data("collapse-text") + " <i class=\"caret up icon\"></i>";
			} else {
				html = $(this).data("expand-text") + " <i class=\"caret down icon\"></i>";
			}
			
			$(this).html(html);
			
			$(element).slideToggle();
		}
	});

	$("#btn-apply").click(function(e) {
		e.preventDefault();

		var form = $("#form-apply");

		$(form).find(".ui.dropdown").each(function() {
			var value = $(this).dropdown("get value");

			if ( !value ) {
				$(this).closest(".field").addClass("error");
			} else {
				$(this).closest(".field").removeClass("error");
			}
		});

		var text = $(form).find("input[type='text']");

		if ( !text.val() ) {
			$(text).closest(".field").addClass("error");
		} else {
			$(text).closest(".field").removeClass("error");
		}

		if ( !$(form).find(".error").length ) {
			var formData = $(form).serialize();

			$.ajax({
				url: $(form).attr("action"),
				type: $(form).attr("method"),
				dataType: "json",
				data: formData,
				context: form,
				success: function(data) {
					if ( data.success ) {
						alert("You have successfully applied!");
						window.location.reload(true);
					} else {
						alert("Unable to apply now. Please try again later.");
					}
				},
				error: function(xhr, error, status) {
					var responseText = xhr.responseText;
					var data = $.parseJSON(responseText);
					var message = "";

					for ( var name in data ) {
						var messages = data[name];

						for ( var i = 0; i < messages.length; i ++ ) {
							var text = messages[i];
							message += text + "\n";
						}
					}

					alert("Error\n" + message);
				}
			});
		}
	});
})(jQuery);
</script>
<script>
function initMap() {
	var mapContainer = $("#map");
	var myLatLng = {lat: mapContainer.data("lat"), lng: mapContainer.data("long")};
	
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 17,
		center: myLatLng
	});

	var marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		title: 'Hello World!'
	});

	if ( mapContainer.data("title") ) {
		var content = "<h3>" + mapContainer.data("title") + "</h3>";

		if ( mapContainer.data("text") ) {
			content += "<p>" + mapContainer.data("text") + "</p>";
		}
		
		var infowindow = new google.maps.InfoWindow({
			content: content
		});

		marker.addListener('click', function() {
			infowindow.open(map, marker);
		});
	}
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFcfsp5EDchadYiYGxjOCfC6CV-P0-4g&callback=initMap"></script>
@endsection