@extends('layouts.main')
@section('body_class','gray')
@section('content')
<div class="ui container">
	<div class="ui full width flex employer content">
		@include('partials.employer.emp-left')		
		<div class="right full">
			<div class="box">
				<h2 class="text upper">Job posts</h2>
				<form class="ui form">
					<div class="fields">
						<div class="inline field">
							<input type="text" name="keyword" placeholder="Enter any keywords here..." size="25" />
						</div>
						<div class="inline field">
							<div class="ui selection dropdown">
								<input type="hidden" name="status">
								<i class="dropdown icon"></i>
								<div class="default text">Show all posts</div>
								<div class="menu">
									<div class="item" data-value="1">Active only</div>
									<div class="item" data-value="2">Inactive</div>
								</div>
							</div>
						</div>
						<div class="inline field">
							<button type="submit" class="ui primary button"><i class="search icon"></i> Search</button>
						</div>
					</div>
				</form>
				
				<div class="ui data table">
					<div class="ui header grid">
						<div class="three wide column">Job title</div>
						<div class="two wide column">Job type</div>
						<div class="two wide column">Job category</div>
						<div class="two wide column">Job level</div>
						<div class="two wide column">Posted date</div>
						<div class="two wide column">Status</div>
						<div class="three wide column">Action</div>
					</div>
					<div class="data">
						<?php foreach($post_data as $post) {?>
						<div class="ui grid">
							<div class="three wide column"><a href="{{ url('employer/post/' . $post->id) }}">{{$post->post_title}}</a></div>
							<div class="two wide column">{{$post->post_type}}</div>
							<div class="two wide column">{{$post->post_category}}</div>
							<div class="two wide column">{{$post->post_level}}</div>
							<div class="two wide column">{{$post->post_created_date}}</div>
							<div class="two wide column">{{$post->post_status}}</div>
							<div class="three wide column">
								<a href="{{ route('update_status',$post->id) }}" onclick="return confirm('Are you sure update post status?');" class="ui mini {{($post->post_status == 'Active') ? 'red' : 'green'}} button">{{($post->post_status == "Active") ? 'Unpublish' : 'Publish'}}</a>							
								
							</div>
						</div>
						<?php } ?>
						
					</div>
				</div>
				
				<div class="ui pagination menu">
						{{ $post_data->links() }}
					<!-- <a class="active item">1</a>
					<a href="#" class="item">2</a>
					<a href="#" class="item">3</a>
					<a href="#" class="item">4</a>
					<a href="#" class="item">5</a> -->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

