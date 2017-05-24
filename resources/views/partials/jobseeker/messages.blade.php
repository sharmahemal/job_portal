@if(Session::has('access_denied')||Session::has('error')||Session::has('success'))
	<div class="v-margin-10">
		<div class="ui container">
		@if(Session::has('access_denied'))
		<p class="ui red  mini message" role="alert">
			<i class="minus icon"></i> {{ session('access_denied') }}
		</p>
		@endif
	
		@if(Session::has('error'))
		<p class="ui red  mini message" role="alert">
			<i class="minus icon"></i> {{ session('error') }}
		</p>
		@endif
	
	
		@if(session('success'))
		<p class="ui green mini message" role="alert">
			<i class="checkmark icon"></i> {{ session('success') }}
		</p>
		@endif
		</div>
	</div>
@endif