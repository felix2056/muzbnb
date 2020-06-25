
        /* --- Testimonial --- */
        $('.testimonials').slick({
          dots: true,
          speed: 300,
          slidesToShow: 3,
          slidesToScroll: 3,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
              }
            }
          ]
        });

        /* --- Travel Revolution --- */
        $('.slider-for').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '.travel-revolution'
        });
        $('.travel-revolution').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          asNavFor: '.slider-for',
          dots: false,
          centerMode: !1,
          focusOnSelect: true,
          autoplay: true,
          autoplaySpeed: 3000,
          responsive: [{
            breakpoint: 1199,
                settings: {
                    slidesToShow: 2
                }
            }]
        });
        $('.press-slider').slick({
          slidesToShow: 4,
          slidesToScroll: 1,
          dots: false,
          centerMode: true,
          variableWidth: true,
          autoplay: true,
          autoplaySpeed: 3000,
          // responsive: [{
          //   breakpoint: 1199,
          //       settings: {
          //           slidesToShow: 2
          //       }
          //   }]
        });

        /* --- Select --- */
        $('.single_select_box').click(function(){
		     $('.single_select_box').not(this).each(function(){
		         $(this).removeClass("active-input");
		     });
		     $(this).addClass("active-input");
		});


        /* --- Input --- */
        $(".input-button input").click(function(){
            $(".input-button li").toggleClass("active");
        });
        $('[data-toggle="datepicker"]').datepicker({
            format: 'yyyy-mm-dd',
            startDate: new Date()
        });
        