(function($) {
	var onScroll = function() {
		var scrollTop = $(this).scrollTop();
		var topMenu = $(".top:first");
		
		if ( topMenu ) {
			var topMenuHeight = $(topMenu).height();
			
			if ( scrollTop > topMenuHeight && $(topMenu).data("mode") != "compact" ) {
				$("#container").addClass("compact");
				$(topMenu).css("top", "-" + topMenuHeight + "px");
				$(topMenu).animate({
					top: 0
				}, 500);
				
				$(topMenu).data("mode", "compact");
			} else if ( scrollTop <= topMenuHeight && $(topMenu).data("mode") != "expand" ) {
				$("#container").removeClass("compact").css("padding-top", "0px");
				$(topMenu).data("mode", "expand");
			}
		}
	};
	
	onScroll.call(window);
	
	$(window).scroll(onScroll);
})(jQuery);