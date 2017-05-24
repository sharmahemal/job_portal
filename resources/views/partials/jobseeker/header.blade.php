<div class="@yield('top_class','top')">
	<div class="ui container">
		<div class="top-wrapper">
			<div class="upper">
				<div class="logo">
					<a href="{{ url('/') }}" class="full"><img src="{{ url('public/img/logo.png') }}" alt="MyStarJob" /></a>
					<a href="{{ url('/') }}" class="compact"><img src="{{ url('public/img/logo-compact.png') }}" alt="MyStarJob" /></a>
				</div>
				<div class="ad-banner">
					<div class="ui leaderboard test ad">
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
				
				@if ( Session::has('jobsekker_id') )
				<a class="item" href="{{route('jobsekker.myaccount')}}">My Account</a>
					@if (session('jobsekker_login') == 'linkdin')
					<a class="item red text" href="javascript:void(0);" onclick="LogoutLinkdin();">Logout</a>
					@elseif (session('jobsekker_login') == 'facebook')
					<a class="item red text" href="{{route('jobseeker.logout')}}" onclick="fbLogout();">Logout</a>
					@else
					<a class="item red text" href="{{route('jobseeker.logout')}}">Logout</a>
					@endif
				<a href="{{route('employer.home')}}" class="highlight item">Employer</a>
				@else
				<a class="item" data-toggle="modal" data-target="#modal-login">Sign in / Sign up</a>
				<a href="{{route('employer.home')}}" class="highlight item">Employer</a>
				@endif
			</div>
		</div>
	</div>
</div>