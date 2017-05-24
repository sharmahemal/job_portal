<div class="left">
	<div data-toggle="sticky" data-top-spacing="60">
		<div class="box">
			<div class="welcome"><?php echo e(session('employer_name')); ?><br />Credit left: 10</div>
		</div>
		<div class="ui vertical menu">
			<a href="{{route('employer.dashboard')}}" class="active item">
				<i class="dashboard icon"></i> Dashboard
			</a>
			<a href="#" class="item">
				<i class="search icon"></i> Search resumes
			</a>
			<a href="#" class="item">
				<i class="flag icon"></i> Events
			</a>
			<div class="item">
				<div class="header">Job posts</div>
				<div class="menu">
					<a href="{{route('employer.post.list')}}" class="item"><i class="list icon"></i> View all posts</a>
					<a href="{{route('employer.post.add')}}" class="item"><i class="plus icon"></i> Create new post</a>
					<a href="#" class="item"><i class="users icon"></i> View all applicants</a>
				</div>
			</div>
			<div class="item">
				<div class="header">Company</div>
				<div class="menu">
					<a href="{{ url('employer/profile') }}" class="item"><i class="building icon"></i> Main company profile</a>
					<a href="#" class="item"><i class="child icon"></i> Subsidiaries</a>
					<a href="#" class="item"><i class="plus icon"></i> Add subsidiary</a>
					<a href="#" class="item"><i class="tags icon"></i> Subscription plan</a>
					<a href="#" class="item"><i class="history icon"></i> Payment history</a>
				</div>
			</div>
			<div class="item">
				<div class="header">Account</div>
				<div class="menu">
					<a href="#" class="item"><i class="user icon"></i> User account</a>
					<a href="#" class="item"><i class="add user icon"></i> Add user account</a>
				</div>
			</div>
		</div>
	</div>
</div>