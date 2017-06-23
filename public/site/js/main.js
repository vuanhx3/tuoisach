$(document).ready(function(){

	/*phan hieu ung cho menu top-bar*/
	    var contador = 1;
		$('.menu_top_bar span').click(function(){
			if(contador == 1){
				$('#top_bar_left').stop().animate({
					left : '0'
				});
				contador = 0;
			}else {
				contador = 1;
				$('#top_bar_left').stop().animate({
					left : '-100%' 
				});
			}
		});


	/*phan hieu ung menu nav*/
		var contador1 = 1;
		$('.menu_bar span').click(function(){
			if(contador1 == 1){
				$('nav').stop().animate({
					left : '0'
				});
				contador1 = 0;
			}else {
				contador1 = 1;
				$('nav').stop().animate({
					left : '-100%' 
				});
			}
		});

		


})