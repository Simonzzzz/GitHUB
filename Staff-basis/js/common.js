$(function(){
	$('.theme-1').mouseover(function(event){
		$('.button-theme1').toggleClass('hide');
	});
	$('.theme-1').mouseout(function(event){
		$('.button-theme1').toggleClass('hide');
	});

	$('.theme-2').mouseover(function(event){
		$('.button-theme2').toggleClass('hide');
	});
	$('.theme-2').mouseout(function(event){
		$('.button-theme2').toggleClass('hide');
	});

	$('.theme-3').mouseover(function(event){
		$('.button-theme3').toggleClass('hide');
	});
	$('.theme-3').mouseout(function(event){
		$('.button-theme3').toggleClass('hide');
	});

	$('.theme-4').mouseover(function(event){
		$('.button-theme4').toggleClass('hide');
	});
	$('.theme-4').mouseout(function(event){
		$('.button-theme4').toggleClass('hide');
	});

	$('.personal').mouseover(function(event){
		$('.button-personal').toggleClass('hide');
	});
	$('.personal').mouseout(function(event){
		$('.button-personal').toggleClass('hide');
	});

});

$(".form-mod2").submit(function() {
        $.ajax({
            type: "GET",
            url: "mail.php",
            data: $("form").serialize()
        }).done(function() {
            alert("Спасибо за заявку!");
            setTimeout(function() {
                $.fancybox.close();
            }, 1000);
        });
        return false;
});
