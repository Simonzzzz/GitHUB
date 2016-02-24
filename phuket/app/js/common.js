$(function() {

	//SVG Fallback
	if(!Modernizr.svg) {
		$("img[src*='svg']").attr("src", function() {
			return $(this).attr("src").replace(".svg", ".png");
		});
	};

	// owl-slider
	$("#owl-demo").owlCarousel({
			items: 1,
			loop: true,
			nav: true,
			navText : ["",""],
	});
		$("#owl-2").owlCarousel({
				items: 1,
				loop: true,
				nav: true,
				navText : ["",""],
		});

	//E-mail Ajax Send
	//Documentation & Example: https://github.com/agragregra/uniMail
	$("form").submit(function() { //Change
		var th = $(this);
		$.ajax({
			type: "GET",
			url: "mail.php", //Change
			data: th.serialize()
		}).done(function() {
			alert("Заявка отправлена!");
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


	// tabs
	$('.__js-tabs-i').click(function() {
		$('.__js-tabs-i').removeClass('__active').eq($(this).index()).addClass('__active');
		$(".__js-tabs-cnt").hide().eq($(this).index()).fadeIn()
	}).eq(0).addClass('__active');
	$(".__js-tabs-cnt").eq(0).show();

	// galery
	var thumbs = $('#thumbs img');
	var img = $('#img img');

	var imgs = Array();
	imgs[0] = "/img/private-gal-1.png";
	imgs[1] = "http://lorempixel.com/400/200/sports/2/";

	thumbs.click(function(){
	 var num = $(this).index();
	 img.attr("src", imgs[num]);
	});


	// якоря
	$('.section-1').on('click', function(e){
  $('html,body').stop().animate({ scrollTop: $('#section-1').offset().top }, 1000);
  e.preventDefault();
	});
	$('.section-2').on('click', function(e){
  $('html,body').stop().animate({ scrollTop: $('#section-2').offset().top }, 1000);
  e.preventDefault();
	});
	$('.section-3').on('click', function(e){
  $('html,body').stop().animate({ scrollTop: $('#section-3').offset().top }, 1000);
  e.preventDefault();
	});
	$('.section-4').on('click', function(e){
  $('html,body').stop().animate({ scrollTop: $('#section-4').offset().top }, 1000);
  e.preventDefault();
	});
	$('.section-5').on('click', function(e){
  $('html,body').stop().animate({ scrollTop: $('#section-5').offset().top }, 1000);
  e.preventDefault();
	});




});
