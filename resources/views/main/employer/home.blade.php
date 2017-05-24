@extends('layouts.main')

@section('top_class', 'top absolute')

@section('content')
<div data-toggle="fullscreen-section" class="fullscreen-section">
	<nav class="nav ui vertical menu" id="section-nav"></nav>
	
	<section class="dimmed more background section" data-background="{{ url('public/img/background-06.jpg') }}">
		<div data-centerid>
			<div class="ui container big-top-padding">
				<div class="ui equal width grid">
					<div class="column">
						<h2 class="text upper white">Why join us?</h2>
						<div class="ui list">
							<div class="item">Pre-qualified candidates</div>
							<div class="item">Over 10,000 resumes available in our database</div>
							<div class="item">Exclusive to attend our event</div>
							<div class="item">Easy to use backend</div>
						</div>
					</div>
					<div class="column">
						<h2 class="text upper white">Employer's login</h2>
						<span id="emp-validate-login"></span><img src="{{ url('public/img/loading.gif') }}" id="emp_loader_login" style="display:none"/ >
						<form class="ui form" id="emp-login-form" name="emp-login-form" onsubmit="return false;">
							<div class="field">
								<input type="text" placeholder="Email address" name="email" id="login_email" data-validation="email" data-validation-error-msg="Please enter a valid email address"/>
							</div>
							<div class="field">
								<input type="password" placeholder="Password" data-validation="length" data-validation-length="min6" data-validation-error-msg="Password must be at least 6 characters" name="password" id="login_password"/>
							</div>
							<div class="field">
								<a href="javascript:void(0);" type="submit" class="ui primary button" onclick="return onEmployerLogin();" type="submit" class="ui primary button">Login</button>
								<a href="{{route('employer.register')}}" class="ui green button">Sign up</button>
								<a href="employer-forgot.html">Forgot password</a>
							</div>
						</form>
						<br /><br /><br />
					</div>
					<div class="column">
						<div class="ui medium rectangle test ad" data-text="Medium rectangle">
							<img src="{{ url('public/img/ad-medrect.jpg') }}" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="section dimmed more background" data-background="{{ url('public/img/background-07.jpg') }}">
		<div class="ui container">
			<div class="ui top aligned grid">
				<div class="eight wide column">
					<h2 class="text upper white">Employer's testimonials</h2>
					<div class="ui grid">
						<div class="row">
							<div class="six wide column">
								<div class="ui circular image" data-image="{{ url('public/img/business-man.png') }}" data-size="200"></div>
							</div>
							<div class="ten wide column">
								<h3>Martin Garrix</h3>
								<h4>HR Manager of TNT Sdn. Bhd.</h4>
								<p class="normal">
									"myStarjob.com constantly informs me about vacancies updates of jobs that are related to my qualification and work via emails. It saves me time from browsing the job list. Apart from that, it works!"
								</p>
							</div>
						</div>
						<div class="row">
							<div class="six wide column">
								<div class="ui circular image" data-image="{{ url('public/img/businesswomen.jpg') }}" data-size="200"></div>
							</div>
							<div class="ten wide column">
								<h3>Alice</h3>
								<h4>Managing Director of AliciaOnline Sdn. Bhd.</h4>
								<p class="normal">"I like myStarjob.com because it has given me the chance to prove to myself and to others via showcasing my skills and past top performance. It has helped me grow my career from the bottom to new heights I would have never imagined . It has also helped the productivity of our country too."</p>
							</div>
						</div>
					</div>
				</div>
				
				<div class="eight wide column subscription-plan">
					<h2 class="text upper white">Subscription plans</h2>
					<div class="ui middle aligned grid">
						<div class="row">
							<div class="five wide column">
								<div class="symbol">Credit</div>
							</div>
							<div class="ten wide column">
								<h4 class="title">On demand basis (Credit basis)</h4>
								<div class="text">
									You pay for what you use for. 1 credit equals to 1 post.
									Depending on how many post you want, we sell you by credits.
								</div>
							</div>
						</div>
						<div class="row">
							<div class="five wide column">
								<div class="symbol"><img src="{{ url('public/img/infinity.png') }}" alt="Infinity" /></div>
							</div>
							<div class="ten wide column">
								<h4 class="title">Unlimited plan</h4>
								<div class="text">
									Don't want to restrict yourself by credit limit? Go for unlimited!
								</div>
							</div>
						</div>
						<div class="row">
							<div class="sixteen wide column right aligned">
								<a href="#" class="pull right">Find out more</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="section parallex dimmed background" data-background="{{ url('public/img/background-20.jpg') }}">
		<div class="ui container">
			<div class="ui center aligned middle aligned grid">
				<div class="five wide column right aligned">
					<div class="ui embed" data-source="youtube" data-id="27dR_sLaM74" data-placeholder="https://i.ytimg.com/vi/27dR_sLaM74/hqdefault.jpg?custom=true&w=246&h=138&stc=true&jpg444=true&jpgq=90&sp=68&sigh=JNI_GOiR-gFNemSZZmAxWM5m-zM"></div>
				</div>
				<div class="eight wide column left aligned top aligned">
					<h2 class="text white upper">2017 Jobs fair!</h2>
					<h3 class="text white">Sat, 21/5/2017 - 9:00am, KL Convention Centre</h3>
					<div class="text">
						<a class="ui big button primary">
							Register now!
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="section background dimmed more bottom" data-background="{{ url('public/img/background-08.jpg') }}">
		<div data-centerid>
			<div class="ui container">
				<h2 class="text center upper">Register today!</h2>
				<p class="text center">Prequalified candidates and over 100,000 resumes available for you!</p>
				<div class="text center">
					<a href="employer-register.html" class="ui primary button big">Register now!</a>
				</div>
			</div>
		</div>
	</section>
	
	<section class="section parallex dimmed background" data-background="{{ url('public/img/background-21.jpg') }}">
		<div data-centerid>
			<div class="ui container">
				<h2 class="text upper center">Partners</h2>
				<h3 class="text center">Be our exclusive partners and get latest news from us!</h3>
				<div class="ui featured company big-margin">
					<div data-toggle="slick" data-dots="true" data-arrows="false" data-infinite="true" data-slides-to-show="4" data-autoplay="true" data-autoplay-speed="1000">
						<a class="item" href="#"><img src="public/img/company/logo01.png" /></a>
						<a class="item" href="#"><img src="public/img/company/logo02.png" /></a>
						<a class="item" href="#"><img src="public/img/company/logo03.png" /></a>
						<a class="item" href="#"><img src="public/img/company/logo04.png" /></a>
						<a class="item" href="#"><img src="public/img/company/logo05.png" /></a>
						<a class="item" href="#"><img src="public/img/company/logo06.png" /></a>
						<a class="item" href="#"><img src="public/img/company/logo07.png" /></a>
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
<script type="text/javascript" src="public/js/slick.min.js"></script>
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
				minSectionHeight -= $("#footer").height();
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
