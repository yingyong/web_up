// JavaScript Document
$(document).ready(function() {
    //alert('test');
	
	$('.clubans_bp').click(function(){
		//alert('test');
		$('#row_club').load('answer/answer-basic-physics.html');
	});
});

function clubmenu(){
	var testattr1 = '../images/stories/icon-club/club-answer_active.png';
	var testattr = $('.img_clubans').attr('src',testattr1);
	$('#row_club').load('club-answer.html');
	//$('.dvd_icon').append('<h1>TEST</h1>');
}