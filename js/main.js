
$(document).ready(function() {

	// Setting Up Our Variables

	var $filter;
	var $container;
	var $containerClone;
	var $filterLink;
	var $filteredItems
	
	$filter = $('.filter li.active a').attr('class');
	$filterLink = $('#filter li a');
	$container = $('ul.filterable-grid');
	$containerClone = $container.clone();
	
	$('ul.filter>li a').click(function(e) 
	{
		$('ul.filter li').removeClass('active');
		$filter = $(this).attr('class').split(' ');
		
		$(this).parent().addClass('active');
		
		if ($filter == 'all') {
			$filteredItems = $containerClone.find('li'); 
		}
		else {
			$filteredItems = $containerClone.find('li[data-type~=' + $filter + ']'); 
		}
		
		$('ul.filterable-grid').quicksand($filteredItems, 
			function () { 
				lightbox();
				$('#parallax_5').parallax('50%',.4);
			 	$('#parallax_6').parallax('50%',.4);
			}
		);
				
	});


	function lightbox() {
		
		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			animationSpeed:'fast',
			slideshow:5000,
			theme:'pp_default',
			show_title:false,
			overlay_gallery: false,
			social_tools: false
		});
	}
	
	if(jQuery().prettyPhoto) {
		lightbox();
	}


	/* =====  Backstretch Slider ===== */
	var width = $(window).width();
	var height = $(window).height();
	$('#banner').css('height',height);

	$('#banner').backstretch([
		"images/bg_images.jpg",
		"images/bg_images_2.jpg"
		], {duration: 3000, fade: 750});

	/* =====  Accordion Function ===== */

	$('.toggle-title a').click(function(event){

		event.isDefaultPrevented()

		var name = $(this).attr('name');
		var allTab = $('.skill-desc-box .toggole-content').hide();

		allTab.slideUp('slow');
		$('.toggle-title').removeClass('change-image');

		$('#'+name).slideDown('slow');
		$(this).parent().toggleClass('change-image');

		return false;
	});

	/* =====  Progress Bar ===== */

	$('.progress-bar').each(function(){
	 	var data_left = $(this).data('value');
	 	$(this).css('left',data_left+'%');
	 });

	/* ====== Service tab ======= */

	$('ul.tabs').each(function(){
	  // For each set of tabs, we want to keep track of
	  // which tab is active and it's associated content
	  var $active, $content, $links = $(this).find('a');

	  var width = $(window).width();

	  // If the location.hash matches one of the links, use that as the active tab.
	  // If no match is found, use the first link as the initial active tab.
	  $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);

	  if(width > 767){
	  	$active.addClass('active');
	  }else{

	  }
	  $content = $($active.attr('href'));

	  // Hide the remaining content
	  $links.not($active).each(function () {
	    $($(this).attr('href')).hide();
	  });

	  // Bind the click event handler
	  $(this).on('click', 'a', function(e){
	    // Make the old tab inactive.
	    if(width > 767){
	   		$active.removeClass('active');
		}else{
			$active.removeClass('activec');
		}
	    $content.hide();

	    // Update the variables with the new link and content
	    $active = $(this);
	    $content = $($(this).attr('href'));

	    // Make the tab active.
	    if(width > 767){
		    $active.addClass('active');
		}else{
			$active.addClass('activec');
		}
	    $content.show();

	    // Prevent the anchor's default click action
	    e.preventDefault();
	  });
	});

 	/* ======= Testimonial ====== */

 	if(width > 480 && width < 750 ){
 		$('.sl-testimonial').bxSlider({
		  minSlides: 1,
		  maxSlides: 1,
		  slideWidth: 480,
		  slideMargin: 0,
		  pager:false
		});
 	}

 	if(width < 481){
	 	$('.sl-testimonial').bxSlider({
			minSlides: 1,
			maxSlides: 1,
			slideWidth: 265,
			slideMargin: 15,
			pager:false
		});
 	}
 	if(width > 750 && width < 935){
 		$('.sl-testimonial').bxSlider({
			minSlides: 1,
			maxSlides: 2,
			slideWidth: 355,
			slideMargin: 0,
			pager:false
		});
 	}

 	if(width > 935){
 		$('.sl-testimonial').bxSlider({
			minSlides: 1,
			maxSlides: 3,
			slideWidth: 300,
			slideMargin: 20,
			pager:false
		});
 	}

		

		if(width > 935){

			$('.team-slider').bxSlider({
			  minSlides: 2,
			  maxSlides: 5,
			  slideWidth: 140,
			  slideMargin: 20,
			  pager:false
			});
		}

		if (width > 750 && width < 935) {
			$('.team-slider').bxSlider({
			  minSlides: 2,
			  maxSlides: 4,
			  slideWidth: 140,
			  slideMargin: 37,
			  pager:false
			});
		};

		if(width < 750){

			$('.team-slider').bxSlider({
			  minSlides: 2,
			  maxSlides: 3,
			  slideWidth: 140,
			  slideMargin: 10,
			  pager:false
			});
		}

	/* ============== Navigation ========= */

	$(".navigation .scroll").click(function(event){

		event.preventDefault();

		var full_url = this.href;
		var parts = full_url.split("#");
		var trgt = parts[1];
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top;
		$('html, body').animate({scrollTop:target_top}, 900);
	});


	$(".scroll.siteLogo").click(function(event){

		event.preventDefault();

		var full_url = this.href;
		var parts = full_url.split("#");
		var trgt = parts[1];
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top;
		$('html, body').animate({scrollTop:target_top}, 900);
	});


	$(".phone-menu .scroll").click(function(event){

		event.preventDefault();
		$('.phone-menu').slideToggle(600);
		var full_url = this.href;
		var parts = full_url.split("#");
		var trgt = parts[1];
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top;
		$('html, body').animate({scrollTop:target_top}, 900);
	});


	// grab the initial top offset of the navigation 
   	var stickyNavTop = $('#main-nav').offset().top;
   	
   	// our function that decides weather the navigation bar should have "fixed" css position or not.
   	var stickyNav = function(){
	    var scrollTop = $(window).scrollTop(); // our current vertical position from the top
	         
	    // if we've scrolled more than the navigation, change its position to fixed to stick to top,
	    // otherwise change it back to relative
	    if (scrollTop > stickyNavTop) { 
	        $('#main-nav').addClass('sticky');
	    } else {
	        $('#main-nav').removeClass('sticky'); 
	    }
	};

	stickyNav();
	// and run it again every time you scroll
	$(window).scroll(function() {
		stickyNav();
	});


	$('.navigation').onePageNav();

	$('.nav-toggole').click(function(){
		$('.phone-menu').slideToggle(600);
	});

	/* ========  Parallax Options ===== */
	$(window).load(function(){
		$('#parallax_1').parallax('50%',.4);
	 	$('#parallax_2').parallax('50%',.4);
	 	$('#parallax_3').parallax('50%',.4);
	 	$('#parallax_4').parallax('50%',.4);
	 	$('#parallax_5').parallax('50%',.4);
	 	$('#parallax_6').parallax('50%',.4);

 	});

 	$(window).resize(function(){
		// update some things on resize (and after 200 milliseconds of that)
		if ( !$('html').hasClass('lt-ie9') ){
			$.doTimeout('resize', 200, function(){
								
				$('#parallax_1').parallax('50%',.4);
			 	$('#parallax_2').parallax('50%',.4);
			 	$('#parallax_3').parallax('50%',.4);
			 	$('#parallax_4').parallax('50%',.4);
			 	$('#parallax_5').parallax('50%',.4);
			 	$('#parallax_6').parallax('50%',.4);

			 	var width = $(window).width();

			 	if(width > 480 && width < 750 ){
			 		$('.sl-testimonial').bxSlider({
					  minSlides: 1,
					  maxSlides: 1,
					  slideWidth: 480,
					  slideMargin: 0,
					  pager:false
					});

			 	}

			 	if(width < 481){
				 	$('.sl-testimonial').bxSlider({
						minSlides: 1,
						maxSlides: 1,
						slideWidth: 265,
						slideMargin: 15,
						pager:false
					});
			 	}

			 	if(width > 750 && width < 935){
			 		$('.sl-testimonial').bxSlider({
						minSlides: 1,
						maxSlides: 2,
						slideWidth: 355,
						slideMargin: 0,
						pager:false
					});
			 	}

			 	if(width > 935){
			 		$('.sl-testimonial').bxSlider({
						minSlides: 1,
						maxSlides: 3,
						slideWidth: 300,
						slideMargin: 20,
						pager:false
					});
			 	}
			});
		}
	});
	
});


$(document).ready(function ($) {
		$('#formSubmit').click(function(){ 
			var error = false;

			var name = $('input#formName').val(); 
			if(name == "" || name == " ") {
				$('#error-name').fadeIn('slow');
				error = true;
			}else{
				$('#error-name').fadeOut('slow');
			}

			var email_compare = /^([a-z0-9_.-]+)@([da-z.-]+).([a-z.]{2,6})$/;
			var email = $('input#formEmail').val();
			if (email == "" || email == " ") {
				$('#error-email').fadeIn('slow');
				error = true;
			}else if (!email_compare.test(email)) {
				$('#error-email').fadeIn('slow');
				error = true;
			}else{
				$('#error-email').fadeOut('slow');
			}

			var message = $('textarea#message').val();
			if(message == "" || message == " ") {
				$('#error-sms').fadeIn('slow');
				error = true;
			}else{
				$('#error-sms').fadeOut('slow');
			}

			if(error == false){
				$.post("mail.php", $("#contactForm").serialize(),function(result){
					if(result == 'sent'){
						$('#contactForm').slideUp('slow');
						$('#success').slideDown('slow');
					}else{
						$('#failed').fadeIn('slow');
					}
				});
			}

			return false;
		});
	});





