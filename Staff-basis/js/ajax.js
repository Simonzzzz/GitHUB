$(document).ready(function(){

$("form").submit(function() {
	$.ajax({
		type: "GET",
		url: "mail.php",
		data: $("form").serialize()
	}).done(function() {
		alert("Спасибо за заявку!");
		setTimeout(function() {
			$.arcticmodal('close');
		}, 500);
	});
	return false;
});

$('.start-header').click(function() {
	$('#exampleModal1').arcticmodal();
});

$("#phone").mask("+7 (999) 999-9999");


});
