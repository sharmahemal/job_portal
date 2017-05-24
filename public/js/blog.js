(function($) {
	$(document).ready(function() {
		$(".ui.blogs .blog").mouseenter(function() {
			$(this).addClass("hover");
		}).mouseleave(function() {
			$(this).removeClass("hover");
		});
	});
})(jQuery);