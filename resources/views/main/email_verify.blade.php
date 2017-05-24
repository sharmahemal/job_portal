@extends('layouts.main')

@section('content')
<div data-toggle="fullscreen-section" class="fullscreen-section">

	<section class="section gray bottom">
		<div class="ui container">
			<div class="ui flex full height align center">
				<div class="grow-1">
				<div class="title">Email Verification</div>
					<p>{{$verification_text}}</p>
				</div>
			</div>
		</div>
	</section>


</div>
@section('script')
@endsection
@endsection