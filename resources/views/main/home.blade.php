@extends('layouts.main')

@section('top_class','top absolute')

@section('content')
<div data-toggle="fullscreen-section" class="fullscreen-section">
	<nav class="nav ui vertical menu" id="section-nav"></nav>
	
	<section class="section dimmed more background" data-background="{{ url('public/img/background-16.jpg') }}">
		<div data-centerid>
			<h2 class="text center">Find Your Dream Job</h2>
			<form class="ui form front-search" action="{{ url('/jobsekker/job/search') }}" method="get">
				<div class="fields">
					<div class="field">
						<div class="ui icon input">
							<i class="clock icon"></i>
							<input type="text" name="keyword" size="35" placeholder="Job Title, Company Name" />
						</div>
					</div>
					<div class="field">
						<div class="ui selection search dropdown">
							<input type="hidden" name="location" value="{{ Request::input('location') }}" />
							<i class="marker icon"></i>
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
						<button type="submit" class="ui primary icon button"><i class="search icon"></i></button>
					</div>
				</div>
				<div class="browse">Or browse more jobs by <a href="{{ url('jobsekker/job/search') }}" class="ui button large primary">category</a></div>
			</form>
		</div>
	</section>
	
	<section class="section dimmed background" data-background="{{ url('public/img/background-17.jpg') }}">
		<div class="ui container">
			<div data-centerid>
				<div class="ui grid lightbox">
					<div class="seven wide column">
						<h2 class="text">Career Test</h2>
						<div class="ui grid">
							<div class="six wide column">
								<img src="public/img/piechart.png" />
							</div>
							<div class="ten wide column">
								<strong style="font-size: 1.1rem;">Map out your climb to success</strong>
								<p class="normal">This career test gives you an insight into your personality, as well as the career options that would suit your unique characteristics best.</p>
								<a href="#" class="ui button primary">
									Start the test!
								</a>
							</div>
						</div>
					</div>
					<div class="right floated eight wide column">
						<h2 class="text">Salary Calculator</h2>
						<p>Find out how much you worth!</p>
						<form class="ui form">
							<div class="inline fields">
								<div class="four wide field white text">Job category</div>
								<div class="ten wide field">
									<div class="ui selection dropdown">
										<input type="hidden" name="category">
										<i class="dropdown icon"></i>
										<div class="default text">Select a job category</div>
										<div class="menu">
											<div class="item" data-value="1">Software engineer</div>
											<div class="item" data-value="2">Computer programmer</div>
										</div>
									</div>
								</div>
							</div>
							<div class="inline fields">
								<div class="four wide field white text">Position</div>
								<div class="ten wide field">
									<div class="ui selection dropdown">
										<input type="hidden" name="category">
										<i class="dropdown icon"></i>
										<div class="default text">Select a position</div>
										<div class="menu">
											<div class="item" data-value="1">Non executive</div>
											<div class="item" data-value="2">Executive</div>
										</div>
									</div>
								</div>
							</div>
							<div class="inline fields">
								<div class="four wide field white text">Year of experience</div>
								<div class="ten wide field">
									<div class="ui selection dropdown">
										<input type="hidden" name="category">
										<i class="dropdown icon"></i>
										<div class="default text">Select a year of working experiences</div>
										<div class="menu">
											<div class="item" data-value="1">Less than 1 year</div>
											<div class="item" data-value="2">1 - 3 years</div>
											<div class="item" data-value="3">3 - 5 years</div>
											<div class="item" data-value="4">5 - 10 years</div>
											<div class="item" data-value="5">More than 10 years</div>
										</div>
									</div>
								</div>
							</div>
							<div class="inline fields">
								<div class="four wide field white text">Qualification</div>
								<div class="ten wide field">
									<div class="ui selection dropdown">
										<input type="hidden" name="category">
										<i class="dropdown icon"></i>
										<div class="default text">Select a qualification</div>
										<div class="menu">
											<div class="item" data-value="1">Bachelor's degree</div>
											<div class="item" data-value="2">Degree</div>
										</div>
									</div>
								</div>
							</div>
							<div class="inline fields">
								<div class="four wide field"></div>
								<button class="ui primary button" type="button">Calculate</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="section parallex dimmed background" data-background="{{ url('public/img/background-18.jpg') }}">
		<div class="ui container">
			<h2 class="text center">ReadMe</h2>
			
			<div class="ui blogs">
				<div class="blog">
					<img src="public/img/blogs/item01.jpg" alt="Blog 1" />
					<div class="caption">
						<a href="#" class="title">TalentCorp organises Career Comeback Fair to attract women back to workforce</a>
						<span class="info">John Lim | 27/3/2017</span>
					</div>
				</div>
				<div class="blog">
					<img src="public/img/blogs/item02.jpg" alt="Blog 1" />
					<div class="caption">
						<a href="#" class="title">Cool offices: A workplace for the dynamic</a>
						<span class="info">John Lim | 27/3/2017</span>
					</div>
				</div>
				<div class="blog">
					<div class="ui medium rectangle test ad">
						<img src="{{ url('public/img/ad-medrect.jpg') }}" />
					</div>
				</div>
				<div class="blog">
					<img src="public/img/blogs/item04.jpg" alt="Blog 1" />
					<div class="caption">
						<a href="#" class="title">Together we gather 2017</a>
						<span class="info">John Lim | 27/3/2017</span>
					</div>
				</div>
				<div class="blog">
					<img src="public/img/blogs/item03.jpg" alt="Blog 1" />
					<div class="caption">
						<a href="#" class="title">What motherhood taught me about leadership</a>
						<span class="info">John Lim | 27/3/2017</span>
					</div>
				</div>
				<div class="blog read-more">
					<img src="public/img/blogs/item05.jpg" alt="Blog 1" />
					<a href="{{ route('readme') }}" class="full caption text">View More</a>
				</div>
			</div>
		</div>
	</section>
	
	<section class="section background" data-background="{{ url('public/img/background-19.jpg') }}">
		<div class="ui container">
			<div data-centerid>
				<h2 class="text center">Our Student Ambassador</h2>
				<p class="text center">Being a Student Ambassador is a deeply rewarding opportunity both on a personal level and also in terms of your career prospects</p>
				<p class="text center"><a class="ui primary big button">Apply now</a></p>
			</div>
		</div>
	</section>
	
	<section class="section parallex dimmed background" data-background="public/img/background-20.jpg">
		<div class="ui container">
			<div class="ui center aligned middle aligned grid">
				<div class="seven wide column right aligned">
					<div class="ui embed" data-source="youtube" data-id="iUKsi4f9xuc" data-placeholder="https://i.ytimg.com/vi/iUKsi4f9xuc/hqdefault.jpg?custom=true&w=246&h=138&stc=true&jpg444=true&jpgq=90&sp=68&sigh=PRQMFLQeQeVfSqjW5_ZQgANI6Eo"></div>
				</div>
				<div class="eight wide column left aligned top aligned">
					<h2 class="text white">2017 Jobs fair!</h2>
					<p>Event details</p>
					<p class="text white">Date: Sat, 21/5/2017</p>
					<p class="text white">Time: 9:00am</p>
					<p class="text white">Venue: KL Convention Centre</p>
					<div class="text">
						<a class="ui big button primary">
							Register now!
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="section parallex dimmed background" data-background="{{ url('public/img/background-21.jpg') }}">
		<div data-centerid>
			<div class="ui container">
				<h2 class="text upper center">Our Partners</h2>
				
				<div class="ui featured company big-margin no-background">
					<div data-toggle="slick" data-dots="true" data-arrows="false" data-infinite="true" data-slides-to-show="4" data-autoplay="true" data-autoplay-speed="1000">
						<a class="item" href="#"><img src="{{ url('public/img/company/logo01.png') }}" /></a>
						<a class="item" href="#"><img src="{{ url('public/img/company/logo02.png') }}" /></a>
						<a class="item" href="#"><img src="{{ url('public/img/company/logo03.png') }}" /></a>
						<a class="item" href="#"><img src="{{ url('public/img/company/logo04.png') }}" /></a>
						<a class="item" href="#"><img src="{{ url('public/img/company/logo05.png') }}" /></a>
						<a class="item" href="#"><img src="{{ url('public/img/company/logo06.png') }}" /></a>
						<a class="item" href="#"><img src="{{ url('public/img/company/logo07.png') }}" /></a>
					</div>
				</div>
				<div class="text center">
					<button class="ui primary button big">Join us as partner</button>
				</div>
			</div>
		</div>
	</section>
	
	<section class="section dimmed more background" data-background="{{ url('public/img/background-05.jpg') }}">
		<div data-centerid>
			<div class="ui container">
				<h2 class="text center upper white">About Us</h2>
				<p class="normal">A brand new myStarjob.com with revamped services is awaiting job seekers and employers, with the aim of becoming their ultimate career and talent resource. The new product offerings leverage on The Star media group's integrated media platform, ranging from print to digital and online solutions.</p>

				<p class="normal">The new myStarjob.com offers a variety of new features such as a revamped web portal, Visume services, a Career Guide in The Star newspaper as well as online, and trainings to enable employers to not only recruit quality talent, but also develop and retain them for the betterment of the company.</p>

				<p class="normal">One of the most prominent features is Malaysia's first video resume function called Visume. "Lifeless" resumes now come to life as talents can submit and upload their video resumes to apply for jobs. This new feature allows recruiters to better assess the talent and even conduct a live video interview with potential candidates. This helps cut costs and saves time for both parties.</p>

				<p class="normal">Along with the well-established recruitment ads print pullout, a weekly 12-page Career Guide will serve as a valuable resource for talents seeking professional advice and opportunities and for organisations to use this opportunity to profile their organisation to attract talent and build reputation. The Career Guide's contents, including all the articles and related videos, will be accessible via online too.</p>

				<p class="normal">Training services will be provided by myStarjob.com, in partnership with Leaderonomics Sdn Bhd, one of the subsidiaries of Star Publications. The training services encompass seminars, workshops, on-ground trainings, and talks by industry leaders, which will achieve the single-minded purpose of building better talents in the workforce community.</p>
				
				<div class="ui three white statistics">
					<div class="statistic">
						<div class="value">2,500</div>
						<div class="label text upper white">Resumes</div>
					</div>
					<div class="statistic">
						<div class="value">1,800</div>
						<div class="label text upper white">Candidates</div>
					</div>
					<div class="statistic">
						<div class="value">100</div>
						<div class="label text upper white">Event organized</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="section no-padding parallex dimmed background" data-background="{{ url('public/img/background-22.jpg') }}">
		<div class="ui container">
			<div class="ui bottom aligned grid">
				<div class="five wide right aligned bottom aligned column no-spacing">
					<img src="public/img/app-device.png" alt="" />
				</div>
				<div class="ten wide column right floated">
					<h2 class="text">Download myStarjob.com App</h2>
					<h3>Search for job vacancies while you are on the move</h3>
					<p>Searching for jobs never been that easy. Now you can find job matched your career expectation, apply for jobs and receive feedback right on your mobile. Get myStarJob mobile app and start your job search now!</p>
					<p>
						<a href="#"><img src="public/img/download-playstore.png" /></a>
						<a href="#"><img src="public/img/download-appstore.png" /></a>
					</p>
					<div class="ui leaderboard test ad" data-text="Leaderboard">
						<img src="{{ url('public/img/ad-leaderboard.jpg') }}" alt="" />
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullscreen.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('public/css/slick.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('public/css/slick-theme.css') }}" />
@endsection

@section('script')
<script type="text/javascript" src="{{ url('public/js/slick.min.js') }}"></script>
<script src="{{ url('public/js/blog.js') }}"></script>
<script>
(function($) {
	var sections = [];
	
	var optimizeSectionHeight = function() {
		var windowHeight = $(this).height();
		
		$("[data-toggle='fullscreen-section'] > .section").each(function() {
			var minSectionHeight = windowHeight;
			
			if ( $(this).parent().find(".section").index(this) == 0 ) {
				// minSectionHeight -= $("#container .top:first").height();
			} else if ( $(this).is(":last-child") ) {
				minSectionHeight -= $("#footer").height() + 150;
			}

			var contentHeight = $(this).height();

			if ( contentHeight < minSectionHeight ) {
				$(this).css("height", minSectionHeight + "px");
			}
		});
		
		// Optimize the navigation as well.
		var container = $(".ui.container");
		var navLeft = $(this).width() + 10;
		var navTop = ($(this).height() - $("#section-nav").height()) / 2;
		
		if ( container.length ) {
			navLeft = (($(this).width() - $(container).width()) / 2) - 30;
		}
		
		$("#section-nav").css("left", navLeft + "px");
		$("#section-nav").css("top", navTop + "px");
		
		// Save the sections position.
		$("[data-toggle='fullscreen-section'] > .section").each(function() {
			var position = $(this).position();
			
			sections.push([position.top, $(this).height() + position.top]);
		});
	};
	
	var onMove = function() {
		var top = $(document).scrollTop();
		
		for ( var i in sections ) {
			var position = sections[i];
			
			if ( top >= position[0] && top <= position[1] ) {
				$("#section-nav .item").removeClass("active");
				$("#section-nav .item:eq(" + i + ")").addClass("active");
				
				break ;
			}
		}
	};

	onMove.call(window);
	$(window).resize(optimizeSectionHeight);
	$(window).scroll(onMove);
	var sectionCount = 0;
	
	$(document).ready(function() {
		$("[data-centerid]").each(function() {
			var parent = $(this).parent();
			
			$(this).css("position", "absolute");
			
			$(this).css({
				"position": "absolute",
				"left": ($(parent).width() - $(this).width()) / 2,
				"top": ($(parent).height() - $(this).height()) / 2
			});
		});
	});

	$("[data-toggle='fullscreen-section'] > .section").each(function() {
		if ( $(this).data("background") ) {
			var div = $("<div></div>").addClass("bg-image").css("background-image", "url(" + $(this).data("background") + ")");
			var innerHTML = $(this).html();
			var content = $("<div></div>").html(innerHTML).addClass("bg-content");
			$(this).empty().append(div).append(content);
		}
		
		sectionCount ++;
		var item = $("<a></a>").text(sectionCount).data("index", sectionCount - 1).addClass("item");
		
		if ( !$("#section-nav .item").length ) {
			item.addClass("active");
		}
		
		$(item).on("click", function(e) {
			$(this).parent().find(".item").removeClass("active");
			$(this).addClass("active");
			
			var index = $(this).parent().find(".item").index(this);
			
			var selectedSection = $("[data-toggle='fullscreen-section'] > .section:eq(" + index + ")");
			
			if ( selectedSection.length ) {
				$("html, body").animate({
					scrollTop: $(selectedSection).offset().top
				}, 1000);
			}
		});
		
		$("#section-nav").append(item);
	});
	
	$("[data-toggle='slick']").each(function() {
		var data = $(this).data();
		delete data["toggle"];
		
		$(this).on("init", function() {
			optimizeSectionHeight.call(window);
		});
		$(this).slick(data);
		
	});
})(jQuery);
</script>
@endsection