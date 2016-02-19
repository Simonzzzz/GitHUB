$(function() {

	//SVG Fallback
	if(!Modernizr.svg) {
		$("img[src*='svg']").attr("src", function() {
			return $(this).attr("src").replace(".svg", ".png");
		});
	};

	//E-mail Ajax Send
	//Documentation & Example: https://github.com/agragregra/uniMail
	$("form").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function() {
			alert("Thank you!");
			setTimeout(function() {
				// Done Functions
				th.trigger("reset");
			}, 1000);
		});
		return false;
	});

	//Chrome Smooth Scroll
	try {
		$.browserSelector();
		if($("html").hasClass("chrome")) {
			$.smoothScroll();
		}
	} catch(err) {

	};

	$("img, a").on("dragstart", function(event) { event.preventDefault(); });

	// owl-slider
	$("#owl-demo").owlCarousel({

			navigation : true, // Show next and prev buttons
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem: true,
			pagination: false,
			navigationText : ["",""],

			// "singleItem:true" is a shortcut for:
			// items : 1,
			// itemsDesktop : false,
			// itemsDesktopSmall : false,
			// itemsTablet: false,
			// itemsMobile : false

	});

	// tabs
	$('.__js-tabs-i').click(function() {
		$('.__js-tabs-i').removeClass('__active').eq($(this).index()).addClass('__active');
		$(".__js-tabs-cnt").hide().eq($(this).index()).fadeIn()
	}).eq(0).addClass('__active');
	$(".__js-tabs-cnt").eq(0).show();

});
