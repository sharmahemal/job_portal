@extends('layouts.main')
@section('body_class','gray')
@section('content')
<div class="ui featured company">
	<div class="ui container">
		<div data-toggle="slick" data-infinite="true" data-slides-to-show="4" data-autoplay="true" data-autoplay-speed="1000">
			<a class="item" href="#"><img src="{{ url('public/img/company/logo01.png') }}" /></a>
			<a class="item" href="#"><img src="{{ url('public/img/company/logo02.png') }}" /></a>
			<a class="item" href="#"><img src="{{ url('public/img/company/logo03.png') }}" /></a>
			<a class="item" href="#"><img src="{{ url('public/img/company/logo04.png') }}" /></a>
			<a class="item" href="#"><img src="{{ url('public/img/company/logo05.png') }}" /></a>
			<a class="item" href="#"><img src="{{ url('public/img/company/logo06.png') }}" /></a>
			<a class="item" href="#"><img src="{{ url('public/img/company/logo07.png') }}" /></a>
		</div>
	</div>
</div>

<div class="content">
	<div class="ui container">
		<div class="ui medrect grid">
			<div class="left column">
				<div class="box">
					<h3 class="header">Search criteria</h3>
					<form class="ui form" action="{{ route('jobsekker.job.search') }}" method="get" id="job_form" name="job_form">
						{{ csrf_field() }}
						<input type="hidden" name="sort" value="{{ Request::input('sort') }}" />
						<div class="field">
							<input type="text" name="keyword" value="{{ Request::input('keyword') }}" placeholder="Job title or keywords..." />
						</div>
						<div class="field">
							<div class="ui selection search dropdown">
								<input type="hidden" name="location" value="{{ Request::input('location') }}" />
								<i class="dropdown icon"></i>
								<div class="default text">Select a location</div>
								<div class="menu">
									<div class="item" data-value="">Select a location</div>
									<?php
									$states = DB::table('tbl_state')->get();
									
									if ( $states->count() ) {
										foreach ( $states as $state ) {
									?>
									<div class="item" data-value="<?php echo $state->state_name; ?>"><?php echo $state->state_name; ?></div>
									<?php
										}
									}
									?>
								</div>
							</div>
						</div>
						<div class="field">
							<div class="ui selection grow-1 search dropdown">
								<input type="hidden" value="{{ Request::input('post_category') }}" name="post_category" id="post_category">
								<i class="dropdown icon"></i>
								<div class="default text">Select a category</div>
								<div class="menu">
									<div class ="item" data-value="">Select a category</div>
									<div class ="item" data-value="Food">Food</div>
									<div class ="item" data-value="General Manufacturing">General Manufacturing</div>
									<div class ="item" data-value="Mechanical">Mechanical</div>
									<div class ="item" data-value="Medical">Medical</div>
									<div class ="item" data-value="Metal">Metal</div>
									<div class ="item" data-value="Petrochemical & Polymer">Petrochemical & Polymer</div>
									<div class ="item" data-value="Rubber">Rubber</div>
									<div class ="item" data-value="Textile">Textile</div>
									<div class ="item" data-value="Wood">Wood</div>
									
									<div class="header">Marketing</div >
									<div class ="item" data-value="Advertising">Advertising</div>
									<div class ="item" data-value="Brand Management">Brand Management</div>
									<div class ="item" data-value="Event">Event</div>
									<div class ="item" data-value="Market Research">Market Research</div>
									<div class ="item" data-value="Marketing">Marketing</div>
									<div class ="item" data-value="Public Relations">Public Relations</div>
									
									<div class="header">Media</div >
									<div class ="item" data-value="Broadcasting">Broadcasting</div>
									<div class ="item" data-value="Creative & Interactive Media">Creative & Interactive Media</div>
									<div class ="item" data-value="Journalism">Journalism</div>
									<div class ="item" data-value="New Media">New Media</div>
									<div class ="item" data-value="Publishing">Publishing</div>
									
									<div class="header">Plant & Animal</div >
									<div class ="item" data-value="Agriculture">Agriculture</div>
									<div class ="item" data-value="Animal Care">Animal Care</div>
									<div class ="item" data-value="Farming">Farming</div>
									
									<div class="header">Property</div >
									<div class ="item" data-value="Building Management">Building Management</div>
									<div class ="item" data-value="Real Estate Management">Real Estate Management</div>
									
									<div class="header">Retail</div >
									<div class ="item" data-value="Distribution Channels">Distribution Channels</div>
									<div class ="item" data-value="Merchandising">Merchandising</div>
									<div class ="item" data-value="Retail Buying">Retail Buying</div>
									<div class ="item" data-value="Store Operation">Store Operation</div>
									
									<div class="header">Sales </div >
									<div class ="item" data-value="Sales">Sales</div>
									
									<div class="header">Security & Defence</div >
									<div class ="item" data-value="Defence">Defence</div>
									<div class ="item" data-value="Security">Security</div>
									
									<div class="header">Services</div >
									<div class ="item" data-value="Beauty">Beauty</div>
									<div class ="item" data-value="Language">Language</div>
									<div class ="item" data-value="Other Services">Other Services</div>
									
									<div class="header">Sports</div >
									<div class ="item" data-value="Event">Event</div>
									<div class ="item" data-value="Facility">Facility</div>
									<div class ="item" data-value="Training/Coaching">Training/Coaching</div>
								</div>
							</div>
						</div>
						<div class="field">
							<input type="text" name="salary" value="{{ Request::input('salary') }}" placeholder="Minimum salary (MYR)" />
						</div>
						
						<div id="more-options" class="more options">
							<h3 class="header">Position</h3>
							<div class="field">
								<div class="ui checkbox">
									<input tabindex="0" class="hidden" name="position[]" value="1" type="checkbox">
									<label>Executive</label>
								</div>
							</div>
							<div class="field">
								<div class="ui checkbox">
									<input tabindex="0" class="hidden" name="position[]" value="2" type="checkbox">
									<label>Non executive</label>
								</div>
							</div>
							<div class="field">
								<div class="ui checkbox">
									<input tabindex="0" class="hidden" name="position[]" value="3" type="checkbox">
									<label>Manager</label>
								</div>
							</div>
							<div class="field">
								<div class="ui checkbox">
									<input tabindex="0" class="hidden" name="position[]" value="4" type="checkbox">
									<label>Senior manager</label>
								</div>
							</div>
							
							<h3 class="sub header">Job type</h3>
							<div class="field">
								<div class="ui checkbox">
									<input tabindex="0" class="hidden" name="type[]" value="1" type="checkbox">
									<label>Full time</label>
								</div>
							</div>
							<div class="field">
								<div class="ui checkbox">
									<input tabindex="0" class="hidden" name="type[]" value="2" type="checkbox">
									<label>Part time</label>
								</div>
							</div>
							<div class="field">
								<div class="ui checkbox">
									<input tabindex="0" class="hidden" name="type[]" value="3" type="checkbox">
									<label>Internship</label>
								</div>
							</div>
						</div>
						
						<a href="#" data-toggle="modal" data-target="#modal-map" class="ui map">
							<img src="{{ url('public/img/map.png') }}" />
						</a>
						
						<div class="field">
							<button type="submit" class="ui button fluid primary">Search</button>
						</div>
					</form>
					<div class="ui grid center aligned padded">
						<div class="sixteen wide column">
							<a href
								data-toggle="more"
								data-target="#more-options"
								data-expand-text="More options"
								data-collapse-text="Less options">More options <i class="caret down icon"></i></a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="center column">
				@if ( $posts && $posts->count() )
				<div class="box">
					<div class="ui grid">
						<div class="left middle aligned floated five eight wide column">
							Showing {{ ($posts->currentPage() - 1) * $posts->perPage() + 1 }} -
							@if ( $posts->currentPage() == $posts->lastPage() )
								{{ $posts->total() }}
							@else
								{{ $posts->currentPage() * $posts->perPage() }}
							@endif
							
							out of {{ $posts->count() }}
						</div>
						<div class="right aligned floated five eight wide column">
							<div id="sorting" class="ui selection dropdown">
								<input type="hidden" name="sort" />
								<i class="dropdown icon"></i>
								<div class="default text">Sorting</div>
								<div class="menu">
									<div class="item" data-value="publish_date">Published date</div>
									<div class="item" data-value="position">Job position</div>
									<div class="item" data-value="company">Company name</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="job-listing">
					@foreach ( $posts as $post )
					<div class="box">
						<div class="ui grid">
							<div class="row">
								<div class="eight wide column">
									<a href="{{ url('job/detail/' . $post->id) }}" class="title">{{ $post->post_title }}</a>
								</div>
								<div class="right aligned eight wide column">
									<span class="time">{{ $post->post_created_date }}</span>
									@if ( session('jobsekker_id') )
										@if ( $post->isBookmarked() )
										<a class="active bookmark" data-toggle="bookmark" data-value="{{ $post->id }}"><i class="star icon"></i></a>
										@else
										<a class="bookmark" data-toggle="bookmark" data-value="{{ $post->id }}"><i class="star icon"></i></a>
										@endif
									@else
									<a class="bookmark" data-toggle="popup" data-hoverable="true" data-html="Please <a href='#' data-toggle='modal' data-target='#modal-login'>login</a> as jobseeker first."><i class="star icon"></i></a>
									@endif
									
								</div>
							</div>
							
							<div class="row">
								<div class="four wide column">
									@if ( $post->employerUser->company_avatar )
									<img class="company logo" src="{{ url('public/uploads/employer/' . $post->employerUser->company_id . '/' . $post->employerUser->company_avatar) }}" alt />
									@else
									<img class="company logo" src="{{ url('public/img/company-building-icon.png') }}" alt />
									@endif
								</div>
								<div class="eight wide column">
									<a href="{{ url('company/' . $post->employerUser->slug()) }}" class="company title">{{ $post->employerUser->comapny_name }}</a>
									<div class="company location">{{ $post->employerUser->company_city }}</div>
									<div class="salary"><?php
									if ( session('jobsekker_id') ) {
										$salaries = explode('-', $post->post_salry);
										echo 'RM' . number_format($salaries[0]) . ' - ';
										echo 'RM' . number_format($salaries[1]);
									} else {
										echo 'Login to view salary';
									}
									?></div>
								</div>
								<div class="four wide column">
									<div class="ui social actions">
										<a href class="facebook link"><i class="facebook f icon"></i></a>
										<a href class="twitter link"><i class="twitter icon"></i></a>
										<a href class="linkedin link"><i class="linkedin icon"></i></a>
									</div>
								</div>
							</div>
							<div class="other info row">
								<div class="sixteen wide column">
									<div class="ui horizontal list">
										<a class="item">{{ $post->post_type }}</a>
										<a class="item">{{ $post->post_category }}</a>
										<a class="item">{{ $post->employerUser->industry->ind_title }}</a>
									</div>
									<!-- <div class="total views">410 views</div> -->
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				@else
				<div class="ui empty message">No result found.</div>
				@endif
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

<div class="ui modal" id="modal-map">
	<i class="close icon"></i>
	<div class="content">
		<div class="ui large map" id="map"></div>
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
	$(".job-listing").on("click", ".bookmark", function(e) {
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

	$(document).ready(function() {
		$("#sorting").dropdown("setting", "onChange", function(e) {
			var value = $(this).dropdown("get value");

			$("#job_form input[name='sort']").val(value);
			$("#job_form").submit();
		});
	});
})(jQuery);
</script>

<script>
$(document).ready(function() {
	var map;
	var loading = false;
	var markers = [];
	var query = function() {
		if ( loading ) {
			return ;
		}
		
		var position = map.getCenter();
		var formData = $("#job_form").serialize();
		formData += "&lat=" + position.lat() + "&lon=" + position.lng();

		loading = true;
		
		$.ajax({
			url: "{{ url('/jobsekker/job/search') }}?" + formData,
			type: "get",
			dataType: "json",
			success: function(data) {
				drawMarker(data);
			},
			complete: function() {
				loading = false;
			}
		});
	};
	var drawMarker = function(data) {
		removeMarkers();
		
		if ( data.length ) {
			for ( var i = 0; i < data.length; i ++ ) {
				var post = data[i];

				var marker = new google.maps.Marker({
					position: {
						lat: post.lat,
						lng: post.lon
					},
					map: map,
					title: post.title
				});

				var infoWindow = new google.maps.InfoWindow({
					content: ""
				});

				(function(p, m) {
					m.addListener("click", function() {
						var html = "<div class='info-window'>";
						html += "<div><strong><a href='{{ url('/job/detail') }}/" + p.id + "'>" + p.title + "</a></strong></div>";
						html += "<div class='sub title'>" + p.company + "</div>";
						html += "</div>";
						
						infoWindow.setContent(html);
						
						infoWindow.open(map, m);
					});
				})(post, marker);

				markers.push(marker);
			}
		}
	};
	var removeMarkers = function() {
		if ( markers.length ) {
			for ( var i in markers ) {
				markers[i].setMap(null);
			}

			markers = [];
		}
	};
	
	$("#modal-map").modal({
		onShow: function() {
			if ( !map ) {
				var mapContainer = $("#map").get(0);
				var myLatLng = {lat: 3.134047, lng: 101.679090};
				map = new google.maps.Map(mapContainer, {
					zoom: 15,
					center: myLatLng
				});
	
				google.maps.event.addListener(map, "dragend", query);

				query();
			}
		}
	});
});
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFcfsp5EDchadYiYGxjOCfC6CV-P0-4g"></script>
@endsection
