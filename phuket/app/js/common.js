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
			autoplay: true,
			navText : ["",""],
	});
		$("#owl-2").owlCarousel({
				items: 1,
				loop: true,
				nav: true,
				navText : ["",""],
		});

// burger
  var menu = $('#primary');
  var menulink = $('.menu-link');

  menulink.click(function() {
    menulink.toggleClass('active');
    menu.toggleClass('active');
    return false;
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
	imgs1[0] = "img/private-gal-1.png";
	imgs1[1] = "img/private-gal-2.png";
	imgs1[2] = "img/private-gal-3.png";
	imgs1[3] = "img/private-gal-4.png";
	imgs1[4] = "img/private-gal-5.png";

	thumbs1.click(function(){
	 var num = $(this).index();
	 img1.attr("src", imgs1[num]);
	});

	// galery2
	var thumbs2 = $('#thumbs2 img');
	var img2 = $('#img2 img');

	var imgs2 = Array();
	imgs2[0] = "img/villa-gal-1.png";
	imgs2[1] = "img/villa-gal-2.png";
	imgs2[2] = "img/villa-gal-3.png";
	imgs2[3] = "img/villa-gal-4.png";
	imgs2[4] = "img/villa-gal-5.png";

	thumbs2.click(function(){
	 var num = $(this).index();
	 img2.attr("src", imgs2[num]);
	});

	// galery3
	var thumbs3 = $('#thumbs3 img');
	var img3 = $('#img3 img');

	var imgs3 = Array();
	imgs3[0] = "img/kamala-gal-1.png";
	imgs3[1] = "img/kamala-gal-2.png";
	imgs3[2] = "img/kamala-gal-3.png";
	imgs3[3] = "img/kamala-gal-4.png";
	imgs3[4] = "img/kamala-gal-5.png";

	thumbs3.click(function(){
	 var num = $(this).index();
	 img3.attr("src", imgs3[num]);
	});

	// galery4
	var thumbs4 = $('#thumbs4 img');
	var img4 = $('#img4 img');

	var imgs4 = Array();
	imgs4[0] = "img/seafront-gal-1.png";
	imgs4[1] = "img/seafront-gal-2.png";
	imgs4[2] = "img/seafront-gal-3.png";
	imgs4[3] = "img/seafront-gal-4.png";
	imgs4[4] = "img/seafront-gal-5.png";

	thumbs4.click(function(){
	 var num = $(this).index();
	 img4.attr("src", imgs4[num]);
	});

	// galery5
	var thumbs5 = $('#thumbs5 img');
	var img5 = $('#img5 img');

	var imgs5 = Array();
	imgs5[0] = "img/heights-gal-1.png";
	imgs5[1] = "img/heights-gal-2.png";
	imgs5[2] = "img/heights-gal-3.png";
	imgs5[3] = "img/heights-gal-4.png";
	imgs5[4] = "img/heights-gal-5.png";

	thumbs5.click(function(){
	var num = $(this).index();
	img5.attr("src", imgs5[num]);
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
