@extends('layouts.main')

@section('body_class','gray')

@section('content')
<div class="content">
	
	<h2 class="text center" style="margin: 1.5rem 0px;">ReadMe</h2>
	
	<div class="ui fluid container">
		
		<div class="ui blogs">
			<div class="blog">
				<img src="public/img/blogs/item01.jpg" alt="Blog 1" />
				<div class="caption">
					<a href="#" class="title">Article title here</a>
					<span class="info">John Lim | 27/3/2017</span>
				</div>
			</div>
			<div class="blog">
				<img src="public/img/blogs/item02.jpg" alt="Blog 1" />
				<div class="caption">
					<a href="#" class="title">Article title here</a>
					<span class="info">John Lim | 27/3/2017</span>
				</div>
			</div>
			<div class="blog">
				<img src="public/img/blogs/item03.jpg" alt="Blog 1" />
				<div class="caption">
					<a href="#" class="title">Article title here</a>
					<span class="info">John Lim | 27/3/2017</span>
				</div>
			</div>
			<div class="blog">
				<img src="public/img/blogs/item04.jpg" alt="Blog 1" />
				<div class="caption">
					<a href="#" class="title">Article title here</a>
					<span class="info">John Lim | 27/3/2017</span>
				</div>
			</div>
			<div class="blog">
				<img src="public/img/blogs/item03.jpg" alt="Blog 1" />
				<div class="caption">
					<a href="#" class="title">Article title here</a>
					<span class="info">John Lim | 27/3/2017</span>
				</div>
			</div>
			<div class="blog read-more">
				<img src="public/img/blogs/item02.jpg" alt="Blog 1" />
				<div class="caption">
					<a href="#" class="title">Article title here</a>
					<span class="info">John Lim | 27/3/2017</span>
				</div>
			</div>
			<div class="blog">
				<img src="public/img/blogs/item01.jpg" alt="Blog 1" />
				<div class="caption">
					<a href="#" class="title">Article title here</a>
					<span class="info">John Lim | 27/3/2017</span>
				</div>
			</div>
			<div class="blog">
				<img src="public/img/blogs/item04.jpg" alt="Blog 1" />
				<div class="caption">
					<a href="#" class="title">Article title here</a>
					<span class="info">John Lim | 27/3/2017</span>
				</div>
			</div>
			<div class="blog">
				<img src="public/img/blogs/item01.jpg" alt="Blog 1" />
				<div class="caption">
					<a href="#" class="title">Article title here</a>
					<span class="info">John Lim | 27/3/2017</span>
				</div>
			</div>
			<div class="blog">
				<img src="public/img/blogs/item02.jpg" alt="Blog 1" />
				<div class="caption">
					<a href="#" class="title">Article title here</a>
					<span class="info">John Lim | 27/3/2017</span>
				</div>
			</div>
			<div class="blog">
				<img src="public/img/blogs/item03.jpg" alt="Blog 1" />
				<div class="caption">
					<a href="#" class="title">Article title here</a>
					<span class="info">John Lim | 27/3/2017</span>
				</div>
			</div>
			<div class="blog">
				<img src="public/img/blogs/item04.jpg" alt="Blog 1" />
				<div class="caption">
					<a href="#" class="title">Article title here</a>
					<span class="info">John Lim | 27/3/2017</span>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@section('script')
<script src="{{ url('public/js/blog.js') }}"></script>
@endsection