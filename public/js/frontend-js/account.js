$(document).ready(function(){
	$('.recover-form-block').hide();

	$('#forgot-pass-btn').click(function(){
		$('.recover-form-block').show();
    	$('.login-form-block').hide();
	});

	$('#login-link-btn').click(function(){
	   $('.recover-form-block').hide();
     $('.login-form-block').show();
	});
});
