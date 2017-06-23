$(document).ready(function(){
	/*phan hieu ung cho menutop bar */
	var contador = 1;
	$('.topmenu a span').click(function(){
		if(contador == 1){
			$('#top_bar').stop().animate({
				left : '0'
			});
			contador = 0;
		}else {
			contador = 1;
			$('#top_bar').stop().animate({
				left : '-100%' 
			});
		}
	});

	/*phan hieu ung menu danh muc*/
		var contador1 = 1;
		$('.menu_bar a').click(function(){
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

		// hieu ung hover
		$('.submenu1').hover(function() {
			$(this).children('.children1').stop().slideDown();	
		}, function() {
			$(this).children('.children1').stop().slideUp();
		});






});