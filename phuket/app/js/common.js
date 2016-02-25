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

	// galery1
	var thumbs1 = $('#thumbs1 img');
	var img1 = $('#img1 img');

	var imgs1 = Array();
	imgs1[0] = "/img/private-gal-1.png";
	imgs1[1] = "/img/private-gal-2.png";
	imgs1[2] = "/img/private-gal-3.png";
	imgs1[3] = "/img/private-gal-4.png";
	imgs1[4] = "/img/private-gal-5.png";

	thumbs1.click(function(){
	 var num = $(this).index();
	 img1.attr("src", imgs1[num]);
	});

	// galery2
	var thumbs2 = $('#thumbs2 img');
	var img2 = $('#img2 img');

	var imgs2 = Array();
	imgs2[0] = "/img/villa-gal-1.png";
	imgs2[1] = "/img/villa-gal-2.png";
	imgs2[2] = "/img/villa-gal-3.png";
	imgs2[3] = "/img/villa-gal-4.png";
	imgs2[4] = "/img/villa-gal-5.png";

	thumbs2.click(function(){
	 var num = $(this).index();
	 img2.attr("src", imgs2[num]);
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
