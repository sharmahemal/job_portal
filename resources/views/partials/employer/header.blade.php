<div class="@yield('top_class','top')">
	<div class="ui container">
		<div class="top-wrapper">
			<div class="upper">
				<div class="logo">
					<a href="{{ url('/') }}" class="full"><img src="{{ url('public/img/logo.png') }}" alt="MyStarJob" /></a>
					<a href="{{ url('/') }}" class="compact"><img src="{{ url('public/img/logo-compact.png') }}" alt="MyStarJob" /></a>
				</div>
				<div class="ad-banner">
					<div class="ui leaderboard test ad" data-text="Leaderboard">
						<img src="{{ url('public/img/ad-leaderboard.jpg') }}" />
					</div>
				</div>
			</div>
			<div class="ui secondary menu">
				<a href="{{route('jobsekker.job.search')}}" class="item">
					Job Search
				</a>
				<a href="{{ route('readme') }}" class="item">
					ReadMe
				</a>
				<a href="{{ route('event') }}" class="item">
					Event
				</a>
				<a href="{{ route('careerTest') }}" class="item">
					Career Test
				</a>
				<div class="ui dropdown item">
					More
					<i class="dropdown icon"></i>
					<div class="menu">
						<a class="item">Salary Calculator</a>
						<a class="item">Student Ambassador</a>
					</div>
				</div>
				
				@if ( Session::has('employer_id') )
				<div class="header item"><?php echo e(session('employer_name')); ?></div>
				<a class="item" href="{{route('employer.dashboard')}}">Dashboard</a>
				<a class="item red text" href="{{route('employer.logout')}}">Logout</a>
				@else
				<a class="item" data-toggle="modal" data-target="#modal-login">Sign in / Sign up</a>
				<a class="item highlight"  href="{{route('employer.home')}}">Employer</a>
				@endif
			</div>
		</div>
	</div>
</div>