var Carr = {

	// Setup menu and sections in Our Firm History
	setupFirmHistory: function () {
		var area = $('.history'),
			milestones = area.find('.year'),
			sections = area.find('.milestone');

		function updateActive(target) {
			var targetSection = sections.filter('.' + target),
				targetMilestone = milestones.filter('.' + target);

			if (targetSection.length > 0) {
				sections.removeClass('active');
				milestones.removeClass('active');
				targetSection.addClass('active');
				targetMilestone.addClass('active');
				sections.hide();
				targetSection.fadeIn('850');
			}
		}

		milestones.on('click', function () {
			var target_class = $(this).attr("class").split(' ')[0];
			updateActive(target_class);
		});
	},

	// Practice filter for Attorney page
	setupAttorneys: function () {
		var practiceList = $('.practice-list'),
			industryList = $('.industry-list'),
			attorneyList = $('.attorneys'),
			practices = practiceList.find('.practice'),
			industries = industryList.find('.industry'),
			attorneys = attorneyList.find('.attorney');

		function updateActive(target) {
			var targetPractice = practices.filter('.' + target),
				targetIndustry = industries.filter('.' + target),
				targetAttorney = attorneys.filter('.' + target);

			if (targetAttorney.length > 0) {
				practices.removeClass('active');
				industries.removeClass('active');
				attorneys.removeClass('active');
				attorneyList.hide();
				targetPractice.addClass('active');
				targetIndustry.addClass('active');
				targetAttorney.addClass('active');
				attorneyList.fadeIn('850');
			}
		}

		practices.on('click', function () {
			var target_class = $(this).attr("class").split(' ')[1];
			updateActive(target_class);
		});

		industries.on('click', function () {
			var target_class = $(this).attr("class").split(' ')[1];
			updateActive(target_class);
		});
	},

	// Setup bottom matter on Practices and Attorneys
	setupBottomMatter: function () {
		var area = $('.bottom-matter'),
			menuItems = area.find('.menu-item'),
			sections = area.find('.bottom-section'),
			sectionTitles = area.find('.section-title');

		function updateActive(target) {
			var targetSection = sections.filter('.' + target),
				targetMenuItem = menuItems.filter('.' + target);

			if (targetSection.length > 0) {
				sections.removeClass('active');
				menuItems.removeClass('active');
				targetSection.addClass('active');
				targetMenuItem.addClass('active');
				sections.hide();
				targetSection.fadeIn('850');
			}
		}

		function mobileCheck() {
			if ( $('.section-title').css('display') === 'block' ) {
				sections.removeClass('active');
				sectionTitles.removeClass('active');
			}
		}

		menuItems.on('click', function () {
			var target_class = $(this).attr("class").split(' ')[0];
			updateActive(target_class);
		});

		sectionTitles.on('click', function () {
			var targetClass = $(this).attr("class").split(' ')[0],
				targetSection = sections.filter('.' + targetClass );

			if ( ( $(this).hasClass('active') && targetSection.hasClass('active') ) ) {
				$(this).removeClass('active');
				targetSection.removeClass('active');
			} else {
				$(this).addClass('active');
				targetSection.addClass('active');
			}
		});

		$(document).ready(function () {
			$(window).resize(function() {
				mobileCheck();
			});
			mobileCheck();
		});
	},
	
	// Handles toggling the navigation menu for small screens.
	mobileMenuToggle: function() {
		var container, button, menu;
	
		container = document.getElementById( 'site-navigation' );
		if ( ! container ) {
			return;
		}
	
		button = container.getElementsByTagName( 'button' )[0];
		if ( 'undefined' === typeof button ) {
			return;
		}
	
		menu = container.getElementsByTagName( 'ul' )[0];
	
		// Hide menu toggle button if menu is empty and return early.
		if ( 'undefined' === typeof menu ) {
			button.style.display = 'none';
			return;
		}
	
		menu.setAttribute( 'aria-expanded', 'false' );
	
		if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
			menu.className += ' nav-menu';
		}
	
		button.onclick = function() {
			if ( -1 !== container.className.indexOf( 'toggled' ) ) {
				container.className = container.className.replace( ' toggled', '' );
				button.setAttribute( 'aria-expanded', 'false' );
				$(button).text('Menu');
				menu.setAttribute( 'aria-expanded', 'false' );
			} else {
				container.className += ' toggled';
				button.setAttribute( 'aria-expanded', 'true' );
				$(button).text('Close');
				menu.setAttribute( 'aria-expanded', 'true' );
			}
		};
	},

	// Setup social sharing icons
	setupSocialShare: function() {
		$('.social-share a').on( 'click', function() {
			var $this = $( this ),
				dimensions = 'width=500, height=350',
				popup;

			if ( $this.hasClass( 'icon-facebook' ) ) {
				dimensions = 'width=500, height=300';
				console.log('!');
			} else if ( $this.hasClass( 'icon-twitter' ) ) {
				dimensions = 'width=400, height=230';
			}

			popup = window.open( $this.attr( 'href' ), 'popup', dimensions );

			if (window.focus) { popup.focus(); }

			return false;
		});
	},

	// Setup social sharing icons
	setupSearch: function() {
		var searchLink = $('.search-link');

		searchLink.on( 'click', function() {
			var searchDiv = $('.site-header > .search'),
				searchField = searchDiv.find('.search-field');

			searchLink.toggleClass('icon-search icon-close');
			
			if ( searchDiv.hasClass('open') ) {
				searchDiv.removeClass('open');
			} else {
				searchDiv.addClass('open');
				searchField.focus();
			}

		});
	},

	setupMobileSidebars: function() {
		var area = $('.aside'),
			sidebarMenusHeaders = area.find('.sidebar-menu-header'),
			sidebarMenus = area.find('.sidebar-menu');

		sidebarMenusHeaders.on( 'click', function() {
			var currentMenu = $(this).next('.sidebar-menu');

			currentMenu.fadeToggle();
		});

	},
	
	setupHomeVideo: function() {
	 var video = $('#bgvideo')[0];
		 if (video.canPlayType('video/mp4') !== "" || video.canPlayType('video/webm') !== "") {
			 video.play();
			 $('.page-header').addClass('video-playing');			 
		 }
	},
	
}; // Carr object


jQuery(function ($) {
	window.$ = $;

	if($('body.home').index() > -1) {
		Carr.setupHomeVideo();		
	}

	if ($('.history').index() > -1) {		
		Carr.setupFirmHistory();
	}

	if ($('.practice-list').index() > -1) {
		Carr.setupAttorneys();	
	}

	if ($('.bottom-matter').index() > -1) {
		Carr.setupBottomMatter();		
	}

	if ($('.social-share a').index() > -1) {
		Carr.setupSocialShare();		
	}
	
	Carr.mobileMenuToggle();

	Carr.setupSearch();

	Carr.setupMobileSidebars();
	
});