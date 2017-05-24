@extends('layouts.main')

@section('body_class', 'gray')

@section('content')
<div class="content">
	<div class="ui container">
		
		@if ( $company->company_banner )
		<div class="ui banner">
			<img src="{{ url('public/uploads/employer/' . $company->company_id . '/' . $company->company_banner) }}" />
		</div>
		@endif
		
		<div class="ui medrect grid">
			<div class="center column">
				<div class="box">
					<div class="ui grid">
						<div class="four wide column">
							@if ( $company->company_avatar )
							<img src="{{ url('public/uploads/employer/' . $company->company_id . '/' . $company->company_avatar) }}" alt="" />
							@else
							<img src="{{ url('public/img/company-building-icon.png') }}" alt="" />
							@endif
						</div>
						<div class="eight wide column">
							<h3 class="header">{{ $company->comapny_name }}</h3>
							@if ( $company->company_description )
							{{ $company->company_description }}
							@endif
							<div class="ui detail">
								<div class="row">
									<div class="label">Company size:</div>
									<div class="text">{{ $company->companySize->comapny_size_title }}</div>
								</div>
								<div class="row">
									<div class="label">Industry:</div>
									<div class="text">{{ $company->industry->ind_title }}</div>
								</div>
								<div class="row">
									<div class="label">Website:</div>
									<div class="text">
										@if ( $company->company_url )
										<a href="{{ $company->company_url }}" target="_blank">{{ $company->company_url }}</a>
										@else
										n/a
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="four wide column">
							<img src="{{ url('public/img/qrcode.png') }}" />
						</div>
					</div>
					<div class="ui divider"></div>
					
					@if ( $company->company_lat && $company->company_long )
					<div id="map" class="ui map" data-title="{{ $company->comapny_name }}" data-text="{{ $company->company_address }}" data-lat="{{ $company->company_lat }}" data-lon="{{ $company->company_long }}"></div>
					@endif
					<br />
					<div class="ui very-long-label detail">
						<div class="row">
							<div class="label">Business registration number:</div>
							<div class="text">{{ $company->company_reg_num }}</div>
						</div>
						<div class="row">
							<div class="label">Industry:</div>
							<div class="text">{{ $company->industry->ind_title }}</div>
						</div>
						<div class="row">
							<div class="label">Telephone number:</div>
							<div class="text">{{ $company->company_tel_number }}</div>
						</div>
						<div class="row">
							<div class="label">Fax number:</div>
							<div class="text">{{ $company->company_fax }}</div>
						</div>
						<div class="row">
							<div class="label">Address:</div>
							<div class="text">{{ $company->company_address }}</div>
						</div>
						<div class="row">
							<div class="label">Postcode:</div>
							<div class="text">{{ $company->company_postcode }}</div>
						</div>
						<div class="row">
							<div class="label">City:</div>
							<div class="text">{{ $company->company_city }}</div>
						</div>
						<div class="row">
							<div class="label">State:</div>
							<div class="text">{{ $company->state->state_name }}</div>
						</div>
						<div class="row">
							<div class="label">Country:</div>
							<div class="text">{{ $company->country->country_name }}</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="right column">
				<div class="ui medium rectangle test ad" data-text="Medium Rectangle">
					<img src="{{ url('public/img/ad-medrect.jpg') }}" />
				</div>
				
				<div class="box">
					<h3 class="header">Available Vacancies</h3>
					@if ( $company->posts->count() )
					<div class="ui featured jobs">
						@foreach ( $company->posts as $post )
						<div class="job">
							<a class="title" href="{{ url('job/detail/' . $post->id) }}">{{ $post->post_title }}</a>
							<a href class="company name">{{ $post->employerUser->comapny_name }}</a>
							@if ( session('jobsekker_id') )
							<div class="salary">{{ $post->getSalaryText() }}</div>
							@else
							<div class="salary">Login to view salary</div>
							@endif
							<div class="location">{{ $post->post_city }}, {{ $post->post_state }}</div>
						</div>
						@endforeach
					</div>
					@else
					<p class="text gray">There no vacancies available.</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
function initMap() {
	var mapContainer = $("#map");
	var myLatLng = {lat: mapContainer.data("lat"), lng: mapContainer.data("lon")};

	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 15,
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