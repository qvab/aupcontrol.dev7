$(window).load(function(){

	"use strict";
	
	
	/* ========================================================== */
	/*   LayerSlider                                              */
	/* ========================================================== */
	$(function(){
	
		// Calling LayerSlider on the target element with adding custom slider options
		$('#layerslider, #layerslider2').layerSlider({
			autoStart: true,
			pauseOnHover: true,
			navPrevNext: false,
			navButtons: true,
			navStartStop: true,
			thumbnailNavigation: false,
			autoPlayVideos: false,
			firstLayer: 1,
			skin: 'v5',
			skinsPath: 'include/layerslider/skins/'
 
			// Please make sure that you didn't forget to add a comma to the line endings
			// except the last line!
		});
	
	});
 
	
	/* ========================================================== */
	/*   Popup-Gallery                                            */
	/* ========================================================== */
	$('.popup-gallery').find('a.popup1').magnificPopup({
		type: 'image',
		gallery: {
		  enabled:true
		}
	}); 
	
	$('.popup-gallery').find('a.popup2').magnificPopup({
		type: 'image',
		gallery: {
		  enabled:true
		}
	}); 
 
	$('.popup-gallery').find('a.popup3').magnificPopup({
		type: 'image',
		gallery: {
		  enabled:true
		}
	}); 
 
	$('.popup-gallery').find('a.popup4').magnificPopup({
		type: 'iframe',
		gallery: {
		  enabled:false
		}
	});  
 
 
	/* ========================================================== */
	/*   Navigation Background Color                              */
	/* ========================================================== */
	
	$(window).scroll(function() {
		if($(this).scrollTop() > 100) {
			$('.navbar-fixed-top').addClass('opaque');
		} else {
			$('.navbar-fixed-top').removeClass('opaque');
		}
	});
 
	
	/* ========================================================== */
	/*   Navigation Color                                         */
	/* ========================================================== */
	
	$('#navbar-collapse-02').onePageNav({
		filter: ':not(.external)'
	});


	/* ========================================================== */
	/*   SmoothScroll                                             */
	/* ========================================================== */
	
	$(".nav li a, a.scrool").click(function(e){
		
		var full_url = this.href;
		var parts = full_url.split("#");
		var trgt = parts[1];
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top;
		
		$('html,body').animate({scrollTop:target_top -69}, 1000);
			return false;
		
	});

	
});
	
	
	/* ========================================================== */
	/*   Page Loader                                              */
	/* ========================================================== */
	  $('#loader').fadeOut(100);