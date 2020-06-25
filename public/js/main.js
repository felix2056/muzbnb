 (function ($) {
	"use strict";
  
  
  
	$('.carousel').carousel({
		  interval: 3000
		}); 
		 
	
	 $("#owl-demo").owlCarousel({
 
		  autoPlay: 3000, //Set AutoPlay to 3 seconds
		  navigation : true, // Show next and prev buttons
	  // navigationText: ["prev","next"], 
		 navigationText: [
			  "<i class='fa fa-long-arrow-left'></i>",
			  "<i class='fa fa-long-arrow-right'></i>"
			  ],
		  pagination: false,
		  items : 1,
		  itemsDesktop : [1199,1],
		  itemsDesktopSmall : [979,1],
		  itemsTablet: [768,1],
		itemsTabletSmall: false,
		itemsMobile : [479,1],
		singleItem : false,
		itemsScaleUp : false,
		 
	  });
		
	 $("#owl-demo-mentioned").owlCarousel({
 
		  autoPlay: 3000, //Set AutoPlay to 3 seconds 
		  pagination: false,
		  items : 5,
		  itemsDesktop : [1199,3],
		  itemsDesktopSmall : [979,3]
	 
	  });
	  
	  
	   $("#owl-saying").owlCarousel({
 
		   autoPlay: 3000, //Set AutoPlay to 3 seconds
		   
		  items : 3,
		  itemsDesktop : [1199,3],
		  itemsDesktopSmall : [979,3]
	 
	  });
	  
	  
	  
		
	  $(".video").click(function () {
      var theModal = $(this).data("target"),
      videoSRC = $(this).attr("data-video"),
      videoSRCauto = videoSRC + "?modestbranding=1&rel=0&controls=0&showinfo=0&html5=1&autoplay=1";
      $(theModal + ' iframe').attr('src', videoSRCauto);
      $(theModal + ' button.close').click(function () {
        $(theModal + ' iframe').attr('src', videoSRC);
      });
    });
	 
	 
	 
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		startDate: '-3d'
	});
	 
	 
	 
	 
	 
	 
})(jQuery);