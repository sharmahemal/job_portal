@extends('layouts.main')

@section('body_class','gray')

@section('content')
<div class="user-profile">
	<div class="ui container">
		<div class="box">
			<h2 class="text center">Events</h2>
			
			<div class="ui event listing">
				<div class="item">
					<div class="ui jumbotron" data-background="{{ url('public/img/event/event01.jpg') }}" data-dim="0.6">
						<div class="title">2017 Jobs Fair on June</div>
						<div class="sub title">Over 300 employers available in this grand event! Participate and get gift worth RM500!</div>
					</div>
					<br /><br />
					<div class="ui grid">
						<div class="row">
							<div class="two wide column right aligned">
								<strong>Location:</strong>
							</div>
							<div class="fourteen wide column">
								Mid Valley Convention Centre Hall, Level 5<br />
								<a href="#"><i class="marker icon"></i> Get direction</a>
							</div>
						</div>
						<div class="row">
							<div class="two wide column right aligned">
								<strong>Date/time:</strong>
							</div>
							<div class="fourteen wide column">
								1/5/2017 12PM - 10PM
							</div>
						</div>
						<div class="row">
							<div class="two wide column right aligned">
								<strong>Registered at:</strong>
							</div>
							<div class="fourteen wide column">
								12/4/2017 6:15PM
							</div>
						</div>
					</div>
					<div class="actions">
						<button type="button" class="ui button primary">Register now</button>
					</div>
				</div>
				
				<div class="item">
					<div class="ui jumbotron" data-background="{{ url('public/img/event/event01.jpg') }}" data-dim="0.6">
						<div class="title">2017 Jobs Fair on June</div>
						<div class="sub title">Over 300 employers available in this grand event! Participate and get gift worth RM500!</div>
					</div>
					<br /><br />
					<div class="ui grid">
						<div class="row">
							<div class="two wide column right aligned">
								<strong>Location:</strong>
							</div>
							<div class="fourteen wide column">
								Mid Valley Convention Centre Hall, Level 5<br />
								<a href="#"><i class="marker icon"></i> Get direction</a>
							</div>
						</div>
						<div class="row">
							<div class="two wide column right aligned">
								<strong>Date/time:</strong>
							</div>
							<div class="fourteen wide column">
								1/5/2017 12PM - 10PM
							</div>
						</div>
						<div class="row">
							<div class="two wide column right aligned">
								<strong>Registered at:</strong>
							</div>
							<div class="fourteen wide column">
								12/4/2017 6:15PM
							</div>
						</div>
					</div>
					<div class="actions">
						<button type="button" class="ui button primary">Register now</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('script')
<script src="{{ url('public/js/blog.js') }}"></script>
@endsection