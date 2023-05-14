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
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
})

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