$(function() {

	$('#toggle-text').click(function() {
		if($('.hidden-box').hasClass('toggle-txt')){
			$('.hidden-box').removeClass('toggle-txt');
			$('#toggle-text').html("Читать полностью");
		} else{
			$('.hidden-box').addClass('toggle-txt');
			$('#toggle-text').html("Скрыть");
		}
	});

	$('.button-hidden-active').click(function() {
		if($('.hidden-row').hasClass('__dn')){
			$('.hidden-row').removeClass('__dn');
			$('.button-hidden-active').html("Скрыть");
		} else{
			$('.hidden-row').addClass('__dn');
			$('.button-hidden-active').html("Показать ещё дела");
		}
	});



	//SVG Fallback
	if(!Modernizr.svg) {
		$("img[src*='svg']").attr("src", function() {
			return $(this).attr("src").replace(".svg", ".png");
		});
	};

	$('.call').click(function(event) {
		$('#exampleModal').arcticmodal();
	});
	

	$(".phone").mask("+7 (999) 999-9999");
	//E-mail Ajax Send
	//Documentation & Example: https://github.com/agragregra/uniMail
	$(".form-modal").submit(function() {
		$.ajax({
			type: "GET",
			url: "mail.php",
			data: $(".form-modal").serialize()
		}).done(function() {
			alert("Спасибо за заявку!");
			setTimeout(function() {
				$.arcticmodal('close');
			}, 500);
		});
		return false;
	});

	$(".form-tel").submit(function() {
		$.ajax({
			type: "GET",
			url: "mail2.php",
			data: $(".form-tel").serialize()
		}).done(function() {
			alert("Спасибо за заявку!");
			
		});
		return false;
	});
});
