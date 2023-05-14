 AOS.init({
 	duration: 800,
 	easing: 'slide'
 });

(function($) {

	"use strict";

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};


	$(window).stellar({
    responsive: true,
    parallaxBackgrounds: true,
    parallaxElements: true,
    horizontalScrolling: false,
    hideDistantElements: false,
    scrollProperty: 'scroll'
  });


	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	// loader
	var loader = function() {
		setTimeout(function() { 
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

	// Scrollax
   $.Scrollax();

	var carousel = function() {
		$('.carousel-testimony').owlCarousel({
			center: true,
			loop: true,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 3
				},
				1000:{
					items: 3
				}
			}
		});

	};
	carousel();

	$('nav .dropdown').hover(function(){
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			// timer;
		// timer = setTimeout(function(){
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
			$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
	  console.log('show');
	});

	// scroll
	var scrollWindow = function() {
		$(window).scroll(function(){
			var $w = $(this),
					st = $w.scrollTop(),
					navbar = $('.ftco_navbar'),
					sd = $('.js-scroll-wrap');

			if (st > 150) {
				if ( !navbar.hasClass('scrolled') ) {
					navbar.addClass('scrolled');	
				}
			} 
			if (st < 150) {
				if ( navbar.hasClass('scrolled') ) {
					navbar.removeClass('scrolled sleep');
				}
			} 
			if ( st > 350 ) {
				if ( !navbar.hasClass('awake') ) {
					navbar.addClass('awake');	
				}
				
				if(sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if ( st < 350 ) {
				if ( navbar.hasClass('awake') ) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if(sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
		});
	};
	scrollWindow();

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	var counter = function() {
		
		$('#section-counter, .hero-wrap, .ftco-counter').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function(){
					var $this = $(this),
						num = $this.data('number');
						console.log(num);
					$this.animateNumber(
					  {
					    number: num,
					    numberStep: comma_separator_number_step
					  }, 7000
					);
				});
				
			}

		} , { offset: '95%' } );

	}
	counter();


	var contentWayPoint = function() {
		var i = 0;
		$('.ftco-animate').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .ftco-animate.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '95%' } );
	};
	contentWayPoint();


	// navigation
	var OnePageNav = function() {
		$(".smoothscroll[href^='#'], #ftco-nav ul li a[href^='#']").on('click', function(e) {
		 	e.preventDefault();

		 	var hash = this.hash,
		 			navToggler = $('.navbar-toggler');
		 	$('html, body').animate({
		    scrollTop: $(hash).offset().top
		  }, 700, 'easeInOutExpo', function(){
		    window.location.hash = hash;
		  });


		  if ( navToggler.is(':visible') ) {
		  	navToggler.click();
		  }
		});
		$('body').on('activate.bs.scrollspy', function () {
		  console.log('nice');
		})
	};
	OnePageNav();


	// magnific popup
	$('.image-popup').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    fixedContentPos: true,
    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
     gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      verticalFit: true
    },
    zoom: {
      enabled: true,
      duration: 300 // don't foget to change the duration also in CSS
    }
  });

  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,

    fixedContentPos: false
  });


  $('.checkin_date, .checkout_date').datepicker({
	  'format': 'm/d/yyyy',
	  'autoclose': true
	});
})(jQuery);

//brand slider
$(document).ready(function(){

	if($('.brands_slider').length)
	{
		var brandsSlider = $('.brands_slider');
		
		brandsSlider.owlCarousel(
		{
			loop:true,
			autoplay:true,
			autoplayTimeout:5000,
			nav:false,
			dots:false,
			autoWidth:true,
			items:8,
			margin:42
		});
		
		if($('.brands_prev').length)
		{
			var prev = $('.brands_prev');
			prev.on('click', function()
			{
			brandsSlider.trigger('prev.owl.carousel');
			});
		}
		
		if($('.brands_next').length)
		{
			var next = $('.brands_next');
			next.on('click', function()
			{
			brandsSlider.trigger('next.owl.carousel');
			});
		}
	}
	
	
});

// blog carousel
$(document).ready(function () {
    var itemsMainDiv = ('.MultiCarousel');
    var itemsDiv = ('.MultiCarousel-inner');
    var itemWidth = "";

    $('.leftLst, .rightLst').click(function () {
        var condition = $(this).hasClass("leftLst");
        if (condition)
            click(0, this);
        else
            click(1, this)
    });

    ResCarouselSize();




    $(window).resize(function () {
        ResCarouselSize();
    });

    //this function define the size of the items
    function ResCarouselSize() {
        var incno = 0;
        var dataItems = ("data-items");
        var itemClass = ('.item');
        var id = 0;
        var btnParentSb = '';
        var itemsSplit = '';
        var sampwidth = $(itemsMainDiv).width();
        var bodyWidth = $('body').width();
        $(itemsDiv).each(function () {
            id = id + 1;
            var itemNumbers = $(this).find(itemClass).length;
            btnParentSb = $(this).parent().attr(dataItems);
            itemsSplit = btnParentSb.split(',');
            $(this).parent().attr("id", "MultiCarousel" + id);


            if (bodyWidth >= 1400) {
				incno = itemsSplit[3];
				console.log(incno);
                itemWidth = sampwidth / 4;
			}
			else if (bodyWidth >= 1200) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / 3;
            }
            else if (bodyWidth >= 992) {
                incno = itemsSplit[2];
                itemWidth = sampwidth / 2;
            }
            else if (bodyWidth >= 768) {
                incno = itemsSplit[1];
                itemWidth = sampwidth / 2;
            }
            else {
                incno = itemsSplit[0];
                itemWidth = sampwidth / incno;
            }
            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
            $(this).find(itemClass).each(function () {
                $(this).outerWidth(itemWidth);
            });

            $(".leftLst").addClass("over");
            $(".rightLst").removeClass("over");

        });
    }


    //this function used to move the items
    function ResCarousel(e, el, s) {
        var leftBtn = ('.leftLst');
        var rightBtn = ('.rightLst');
        var translateXval = '';
        var divStyle = $(el + ' ' + itemsDiv).css('transform');
        var values = divStyle.match(/-?[\d\.]+/g);
        var xds = Math.abs(values[4]);
        if (e == 0) {
            translateXval = parseInt(xds) - parseInt(itemWidth * s);
            $(el + ' ' + rightBtn).removeClass("over");

            if (translateXval <= itemWidth / 2) {
                translateXval = 0;
                $(el + ' ' + leftBtn).addClass("over");
            }
        }
        else if (e == 1) {
            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
            translateXval = parseInt(xds) + parseInt(itemWidth * s);
            $(el + ' ' + leftBtn).removeClass("over");

            if (translateXval >= itemsCondition - itemWidth / 2) {
                translateXval = itemsCondition;
                $(el + ' ' + rightBtn).addClass("over");
            }
        }
        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
    }

    //It is used to get some elements from btn
    function click(ell, ee) {
        var Parent = "#" + $(ee).parent().attr("id");
        var slide = $(Parent).attr("data-slide");
        ResCarousel(ell, Parent, slide);
    }

});


//registration form for busines partner
function subcheck() {
	console.log('milesh');
	document.getElementById('company_information').style.display='none';
	document.getElementById('hr_2').style.display='none';
	document.getElementById('a_registered_name').style.display='none';
	document.getElementById('a_registred_no').style.display='none';
	document.getElementById('a_license_no').style.display='none';
	document.getElementById('a_country').style.display='none';
	document.getElementById('a_state').style.display='none';
	document.getElementById('a_city').style.display='none';
	document.getElementById('a_address').style.display='none';
	document.getElementById('a_phone').style.display='none';
	document.getElementById('a_email').style.display='none';
	document.getElementById('p_contact_no_2').style.display='block';
	document.getElementById('p_country').style.display='block';
	document.getElementById('p_state').style.display='block';
	document.getElementById('p_city').style.display='block';
	document.getElementById('p_passport').style.display='block';
	document.getElementById('p_email').style.display='block';
	document.getElementById('p_address').style.display='block';
	document.getElementById("agency_registered_name").removeAttribute("required");
	document.getElementById("agency_registration_no").removeAttribute("required");
	document.getElementById("license_no").removeAttribute("required");
	document.getElementById("company_country").removeAttribute("required");
	document.getElementById("company_state").removeAttribute("required");
	document.getElementById("company_city").removeAttribute("required");
	document.getElementById("agency_phone").removeAttribute("required");
	document.getElementById("agency_email").removeAttribute("required");
	document.getElementById("person_country").setAttribute("required", "");
	document.getElementById("person_state").setAttribute("required", "");
	document.getElementById("person_city").setAttribute("required", "");
	document.getElementById("passport").setAttribute("required", "");
	document.getElementById("per_email").setAttribute("required", "");

	var element = document.getElementById("authorize-person-h2");
   	element.classList.add("authorize-person");
}
function partnercheck() {
	console.log('partnercheck');
	document.getElementById('company_information').style.display='block';
	document.getElementById('hr_2').style.display='block';
	document.getElementById('a_registered_name').style.display='block';
	document.getElementById('a_registred_no').style.display='block';
	document.getElementById('a_license_no').style.display='block';
	document.getElementById('a_country').style.display='block';
	document.getElementById('a_state').style.display='block';
	document.getElementById('a_city').style.display='block';
	document.getElementById('a_address').style.display='block';
	document.getElementById('a_phone').style.display='block';
	document.getElementById('a_email').style.display='block';
	document.getElementById('p_contact_no_2').style.display='none';
	document.getElementById('p_country').style.display='none';
	document.getElementById('p_state').style.display='none';
	document.getElementById('p_city').style.display='none';
	document.getElementById('p_passport').style.display='none';
	document.getElementById('p_email').style.display='none';
	document.getElementById('p_address').style.display='none';
	document.getElementById("agency_registered_name").setAttribute("required", "");
	document.getElementById("agency_registration_no").setAttribute("required", "");
	document.getElementById("license_no").setAttribute("required", "");
	document.getElementById("company_country").setAttribute("required", "");
	document.getElementById("company_state").setAttribute("required", "");
	document.getElementById("company_city").setAttribute("required", "");
	document.getElementById("agency_phone").setAttribute("required", "");
	document.getElementById("agency_email").setAttribute("required", "");
	document.getElementById("person_country").removeAttribute("required");
	document.getElementById("person_state").removeAttribute("required");
	document.getElementById("person_city").removeAttribute("required");
	document.getElementById("passport").removeAttribute("required");
	document.getElementById("per_email").removeAttribute("required");	

	var element = document.getElementById("authorize-person-h2");
	element.classList.remove("authorize-person");
}

function showHide(){
	if(document.getElementById('looking_for_job_seeker').checked || document.getElementById('looking_for_foreign_worker').checked || document.getElementById('looking_for_retired_person').checked )
	{
		document.getElementById('per_country').style.display='none';
		document.getElementById('per_state').style.display='none';
		document.getElementById('per_city').style.display='none';
		document.getElementById('per_email').style.display='none';
		document.getElementById('company_information').style.display='block';
		document.getElementById('company_name').style.display='block';
		
		document.getElementById('registration_number').style.display='block';
		document.getElementById('telephone_number').style.display='block';
		document.getElementById('com_country').style.display='block';
		document.getElementById('company_email').style.display='block';
		document.getElementById('com_website').style.display='block';
		document.getElementById('com_state').style.display='block';
		document.getElementById('com_city').style.display='block';
		document.getElementById('hr_1').style.display='block';
		document.getElementById('hr_2').style.display='block';
		document.getElementById('hr_3').style.display='block';
		document.getElementById('com_address').style.display='block';
		document.getElementById("com_name").setAttribute("required", "");
		document.getElementById("com_registration").setAttribute("required", "");
		document.getElementById("com_number").setAttribute("required", "");
		document.getElementById("company_country").setAttribute("required", "");
		document.getElementById("com_email").setAttribute("required", "");
		document.getElementById("company_state").setAttribute("required", "");
		document.getElementById("company_city").setAttribute("required", "");
		document.getElementById("cont_email").removeAttribute("required");
		

	}
	else if(document.getElementById('looking_for_job_seeker').checked ==false && document.getElementById('looking_for_foreign_worker').checked ==false && document.getElementById('looking_for_retired_person').checked==false){
		if(document.getElementById('looking_for_domestic_maid').checked){
			document.getElementById('per_country').style.display='block';
			document.getElementById('per_state').style.display='block';
			document.getElementById('per_city').style.display='block';
			document.getElementById('per_email').style.display='block';
			document.getElementById('company_information').style.display='none';
			document.getElementById('company_name').style.display='none';
			
			document.getElementById('registration_number').style.display='none';
			document.getElementById('telephone_number').style.display='none';
			document.getElementById('com_country').style.display='none';
			document.getElementById('company_email').style.display='none';
			document.getElementById('com_website').style.display='none';
			document.getElementById('com_state').style.display='none';
			document.getElementById('com_city').style.display='none';
			document.getElementById('hr_1').style.display='none';
			document.getElementById('hr_2').style.display='none';
			document.getElementById('hr_3').style.display='none';
			document.getElementById('com_address').style.display='none';
			document.getElementById("com_name").removeAttribute("required");
			document.getElementById("com_registration").removeAttribute("required");
			document.getElementById("com_number").removeAttribute("required");
			document.getElementById("company_country").removeAttribute("required");
			// document.getElementById("com_email").removeAttribute("required");
			document.getElementById("company_state").removeAttribute("required");
			document.getElementById("company_city").removeAttribute("required");
			document.getElementById("cont_email").setAttribute("required", "");
			
		}
		else{
			document.getElementById('per_country').style.display='none';
			document.getElementById('per_state').style.display='none';
			document.getElementById('per_city').style.display='none';
			document.getElementById('per_email').style.display='none';
			document.getElementById('company_information').style.display='block';
			document.getElementById('company_name').style.display='block';
			
			document.getElementById('registration_number').style.display='block';
			document.getElementById('telephone_number').style.display='block';
			document.getElementById('com_country').style.display='block';
			document.getElementById('company_email').style.display='block';
			document.getElementById('com_website').style.display='block';
			document.getElementById('com_state').style.display='block';
			document.getElementById('com_city').style.display='block';
			document.getElementById('hr_1').style.display='block';
			document.getElementById('hr_2').style.display='block';
			document.getElementById('hr_3').style.display='block';
			document.getElementById('com_address').style.display='block';
			document.getElementById("com_name").setAttribute("required", "");
			document.getElementById("com_registration").setAttribute("required", "");
			document.getElementById("com_number").setAttribute("required", "");
			document.getElementById("company_country").setAttribute("required", "");
			// document.getElementById("com_email").setAttribute("required", "");
			document.getElementById("company_state").setAttribute("required", "");
			document.getElementById("company_city").setAttribute("required", "");
			document.getElementById("cont_email").removeAttribute("required");
		}
	}
	else
	{
		document.getElementById('per_country').style.display='none';
		document.getElementById('per_state').style.display='none';
		document.getElementById('per_city').style.display='none';
		document.getElementById('per_email').style.display='none';
		document.getElementById('company_information').style.display='block';
		document.getElementById('company_name').style.display='block';
		
		document.getElementById('registration_number').style.display='block';
		document.getElementById('telephone_number').style.display='block';
		document.getElementById('com_country').style.display='block';
		document.getElementById('company_email').style.display='block';
		document.getElementById('com_website').style.display='block';
		document.getElementById('com_state').style.display='block';
		document.getElementById('com_city').style.display='block';
		document.getElementById('hr_1').style.display='block';
		document.getElementById('hr_2').style.display='block';
		document.getElementById('hr_3').style.display='block';
		document.getElementById('com_address').style.display='block';
		document.getElementById("com_name").setAttribute("required", "");
		document.getElementById("com_registration").setAttribute("required", "");
		document.getElementById("com_number").setAttribute("required", "");
		document.getElementById("company_country").setAttribute("required", "");
		// document.getElementById("com_email").setAttribute("required", "");
		document.getElementById("company_state").setAttribute("required", "");
		document.getElementById("company_city").setAttribute("required", "");
		document.getElementById("cont_email").removeAttribute("required");
	}
}





/**
* Template Name: Company - v4.6.1
* Template URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
	"use strict";
  
  
	/**Easy selector helper function
	 */
	const select = (el, all = false) => {
	  el = el.trim()
	  if (all) {
		return [...document.querySelectorAll(el)]
	  } else {
		return document.querySelector(el)
	  }
	}
  
	/**
	 * Easy event listener function
	 */
	const on = (type, el, listener, all = false) => {
	  let selectEl = select(el, all)
	  if (selectEl) {
		if (all) {
		  selectEl.forEach(e => e.addEventListener(type, listener))
		} else {
		  selectEl.addEventListener(type, listener)
		}
	  }
	}
  
	/**
	 * Easy on scroll event listener 
	 */
	const onscroll = (el, listener) => {
	  el.addEventListener('scroll', listener)
	}
  
	/**
	 * Back to top button
	 */
	let backtotop = select('.back-to-top')
	if (backtotop) {
	  const toggleBacktotop = () => {
		if (window.scrollY > 100) {
		  backtotop.classList.add('active')
		} else {
		  backtotop.classList.remove('active')
		}
	  }
	  window.addEventListener('load', toggleBacktotop)
	  onscroll(document, toggleBacktotop)
	}
  
	/**
	 * Mobile nav toggle
	 */
	on('click', '.mobile-nav-toggle', function(e) {
	  select('#navbar').classList.toggle('navbar-mobile')
	  this.classList.toggle('bi-list')
	  this.classList.toggle('bi-x')
	})
  
	/**
	 * Mobile nav dropdowns activate
	 */
	on('click', '.navbar .dropdown > a', function(e) {
	  if (select('#navbar').classList.contains('navbar-mobile')) {
		e.preventDefault()
		this.nextElementSibling.classList.toggle('dropdown-active')
	  }
	}, true)
  
	/**
	 * Hero carousel indicators
	 */
	let heroCarouselIndicators = select("#hero-carousel-indicators")
	let heroCarouselItems = select('#heroCarousel .carousel-item', true)
  
	heroCarouselItems.forEach((item, index) => {
	  (index === 0) ?
	  heroCarouselIndicators.innerHTML += "<li data-bs-target='#heroCarousel' data-bs-slide-to='" + index + "' class='active'></li>":
		heroCarouselIndicators.innerHTML += "<li data-bs-target='#heroCarousel' data-bs-slide-to='" + index + "'></li>"
	});
  
	/**
	 * Porfolio isotope and filter
	 */
	window.addEventListener('load', () => {
	  let portfolioContainer = select('.portfolio-container');
	  if (portfolioContainer) {
		let portfolioIsotope = new Isotope(portfolioContainer, {
		  itemSelector: '.portfolio-item'
		});
  
		let portfolioFilters = select('#portfolio-flters li', true);
  
		on('click', '#portfolio-flters li', function(e) {
		  e.preventDefault();
		  portfolioFilters.forEach(function(el) {
			el.classList.remove('filter-active');
		  });
		  this.classList.add('filter-active');
  
		  portfolioIsotope.arrange({
			filter: this.getAttribute('data-filter')
		  });
		  portfolioIsotope.on('arrangeComplete', function() {
			AOS.refresh()
		  });
		}, true);
	  }
  
	});
  
	/**
	 * Initiate portfolio lightbox 
	 */
	const portfolioLightbox = GLightbox({
	  selector: '.portfolio-lightbox'
	});
  
	/**
	 * Portfolio details slider
	 */
	new Swiper('.portfolio-details-slider', {
	  speed: 400,
	  loop: true,
	  autoplay: {
		delay: 5000,
		disableOnInteraction: false
	  },
	  pagination: {
		el: '.swiper-pagination',
		type: 'bullets',
		clickable: true
	  }
	});
  
	/**
	 * Skills animation
	 */
	let skilsContent = select('.skills-content');
	if (skilsContent) {
	  new Waypoint({
		element: skilsContent,
		offset: '80%',
		handler: function(direction) {
		  let progress = select('.progress .progress-bar', true);
		  progress.forEach((el) => {
			el.style.width = el.getAttribute('aria-valuenow') + '%'
		  });
		}
	  })
	}
  
	/**
	 * Animation on scroll
	 */
	window.addEventListener('load', () => {
	  AOS.init({
		duration: 1000,
		easing: 'ease-in-out',
		once: true,
		mirror: false
	  })
	});
  
  })()
  /*     */ 
  
  $('.owl-carousel').owlCarousel({
	  loop: true,
	  margin: 10,
	  nav: true,
	  navText: [
		  "<i class='fa fa-caret-left'></i>",
		  "<i class='fa fa-caret-right'></i>"
	  ],
	  autoplay: true,
	  autoplayHoverPause: true,
	  responsive: {
		  0: {
			  items: 1
		  },
		  300: {
			  items: 3
		  },
		  900: {
			  items: 5
		  }
	  }
  })

