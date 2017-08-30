$(document).ready(function($) {
  //=================================== Simple slide  ==================================//
  $('#simple-slide').owlCarousel({
      loop:true,
      margin:50,
      animateOut: 'bounceOutRight',
      animateIn: 'bounceInLeft',
      autoplay: true,
      autoplayTimeout:3500,
      nav:true,
      items:1,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:1
          },
          1000:{
              items:1
          }
      }
  });

  //=================================== Carousel Boxes  ==================================//
   $('#boxes-carousel').owlCarousel({
      loop:true,
      margin:0,
      autoplay: true,
      autoplayTimeout:3500,
      nav:false,
      items:4,
      responsive:{
          0:{
              items:1
          },
          520:{
              items:2
          },
          769:{
              items:3
          },
          999:{
              items:4
          }
      }
  });

  //=================================== Carousel Sponsors =====================================//
  $('#carousel-sponsors').owlCarousel({
      loop:true,
      margin:50,
      autoplay: true,
      autoplayTimeout:3500,
      nav:true,
      items:5,
      responsive:{
          0:{
              items:2
          },
          480:{
              items:3
          },
          600:{
              items:4
          },
          1000:{
              items:5
          }
      }
  });

  //=================================== Carousel Testimonials  ============================//
  $('#testimonials').owlCarousel({
      loop:true,
      margin:20,
      animateOut: 'bounceOutRight',
      animateIn: 'bounceInLeft',
      autoplay: true,
      autoplayTimeout:3500,
      nav:false,
      items:3,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:2
          },
          1000:{
              items:3
          }
      }
  });

  //=================================== Carousel Gallery  ==================================//
  $('#carousel-gallery').owlCarousel({
      loop:true,
      margin:20,
      animateOut: 'bounceOutRight',
      animateIn: 'bounceInLeft',
      autoplay: true,
      autoplayTimeout:3500,
      nav:false,
      items:5,
      responsive:{
          0:{
              items:2
          },
          600:{
              items:3
          },
          1000:{
              items:5
          }
      }
  })

  //=================================== Loader =====================================//
  $(".status").fadeOut();
  $(".preloader").delay(1000).fadeOut("slow");


	//=================================== Subtmit Form  ===================================//
	$('#form-contact').submit(function(event) {  
	     event.preventDefault();  
	     var url = $(this).attr('action');  
	     var datos = $(this).serialize();  
	     	$.get(url, datos, function(resultado) {  
	     	$('#result').html(resultado);  
		});  
 	});

  //=================================== Form Newslleter  =================================//
  $('#newsletterForm').submit(function(event) {  
       event.preventDefault();  
       var url = $(this).attr('action');  
       var datos = $(this).serialize();  
        $.get(url, datos, function(resultado) {  
        $('#result-newsletter').html(resultado);  
    });  
  });  

	//=============================  tooltip demo ===========================================//
  $('.tooltip-hover').tooltip({
      selector: "[data-toggle=tooltip]",
      container: "body"
   });

	//=================================== Totop  ============================================//
  $().UItoTop({
		scrollSpeed:500,
		easingType:'linear'
	});	

  //=================================== parallax  ==============================//

  $('.parallax-window').parallax();

});	