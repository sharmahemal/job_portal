(function($) {
	$(window).ready(function() {
		// Initialize the UI.
		$(".ui.dropdown").dropdown();
		$(".ui.checkbox").checkbox();
		$(".ui.modal").modal({
			selector: {
				close: ".close"
			}
		});
		$(".ui.embed").embed();  // Youtube embed.
		$(".ui.tabbed .item").tab();
		
		$(".ui.image.caption").each(function() {
			var caption = $(this).find(".caption");
			
			if ( caption.length ) {
				var position = $(this).data("position");
				var captionHeight = $(caption).outerHeight();
				var imageHeight = $(this).outerHeight();
				
				if ( !position ) {
					position = "bottom";
				}
				
				$(caption).css("bottom", "-" + captionHeight + "px").css("display", "block");
				
				$(this).on("mouseenter", function(e) {
					if ( position == "bottom" ) {
						$(caption).css("bottom", "0px");
					} else if ( position == "middle" ) {
						$(caption).css("bottom", ((imageHeight - captionHeight) / 2) + "px");
					} else if ( position == "top" ) {
						$(caption).css("bottom", "100%");
					}
				}).on("mouseleave", function(e) {
					$(caption).css("bottom", "-" + captionHeight + "px");
				});
			}
		});
		
		$(".ui.jumbotron").each(function() {
			var backgroundImage = $(this).data("background");
			
			if ( backgroundImage ) {
				var dim = $(this).data("dim");
				
				if ( dim ) {
					$(this).css("background", "linear-gradient(rgba(0,0,0," + dim + "), rgba(0,0,0," + dim + ")), url(" + backgroundImage + ")").addClass("image");
				} else {
					$(this).css("background-image", "url(" + backgroundImage + ")").addClass("image");
				}
			}
		});
		
		$(".ui.text.hide").each(function() {
			var gradientBlock = $("<div></div>").addClass("gradient");
			var contentHeight = $(this).find(".content").outerHeight();
			var maxHeight = $(this).data("max-height");
			
			if ( !maxHeight ) {
				maxHeight = "50";
			}
			
			$(this).find(".content").data("max-height", maxHeight);
			
			if ( maxHeight > contentHeight ) {
				$(this).find(".show-more").remove();
				return true;
			}
			
			$(this).find(".content").append(gradientBlock);
			
			$(this).find(".content").css("max-height", maxHeight + "px");
			
			
			$(this).find(".show-more").click(function(e) {
				e.preventDefault();
				
				var content = $(this).closest(".ui.text.hide").find(".content");
				
				if ( content ) {
					content.toggleClass("expand");
					if ( $(content).hasClass("expand") ) {
						$(content).css("max-height", "none");
						$(this).text($(this).data("less-text"));
					} else {
						$(content).css("max-height", maxHeight + "px");
						$(this).text($(this).data("more-text"));
					}
				}
			});
		});
		
		$(".ui.circular.image").each(function() {
			var imageUrl = $(this).data("image");
			
			if ( imageUrl ) {
				var size = $(this).data("size");
				
				if ( !size ) {
					size = 200;
				}
				
				$(this).css({
					"background-image": "url(" + imageUrl + ")",
					"width": size + "px",
					"height": size + "px",
					"border-radius": size / 2 + "px"
				});
			}
		});
	});
	
	$("[data-numberized]").each(function() {
		var id = 1;
		$(this).find(".item[data-value]").each(function() {
			$(this).attr("data-value", id ++);
		});
	});
	
	$("[data-toggle='popup']").each(function() {
		var data = $(this).data();
		
		$(this).popup(data);
	});
	
	// Toggle modal.
	$("body").on("click", "[data-toggle='modal']", function(e) {
		e.preventDefault();
		
		var target = $(this).data("target");
		
		$(target).modal("show");
	});
})(jQuery);