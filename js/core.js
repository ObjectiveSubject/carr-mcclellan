var Carr = {

	// Avoid <img title> tooltips.
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
			}
		}

		milestones.on('click', function () {
			var target_class = $(this).attr("class").split(' ')[0];
			updateActive(target_class);
		});
	},

	// Avoid <img title> tooltips.
	setupAttorneys: function () {
		var practiceList = $('.practice-list'),
			attorneyList = $('.attorneys'),
			practices = practiceList.find('.practice'),
			attorneys = attorneyList.find('.attorney');

		function updateActive(target) {
			var targetPractice = practices.filter('.' + target),
				targetAttorney = attorneys.filter('.' + target);

			if (targetAttorney.length > 0) {
				practices.removeClass('active');
				attorneys.removeClass('active');
				targetPractice.addClass('active');
				targetAttorney.addClass('active');
			}
		}

		practices.on('click', function () {
			var target_class = $(this).attr("class").split(' ')[1];
			updateActive(target_class);
		});
	},

	// Setup bottom matter on Practices and Attorneys
	setupBottomMatter: function () {
		var area = $('.bottom-matter'),
			menuItems = area.find('.menu-item'),
			sections = area.find('.bottom-section');

		function updateActive(target) {
			var targetSection = sections.filter('.' + target),
				targetMenuItem = menuItems.filter('.' + target);

			if (targetSection.length > 0) {
				sections.removeClass('active');
				menuItems.removeClass('active');
				targetSection.addClass('active');
				targetMenuItem.addClass('active');
			}
		}

		menuItems.on('click', function () {
			var target_class = $(this).attr("class").split(' ')[0];
			updateActive(target_class);
			console.log('!!!');
		});
	}
};

jQuery(function ($) {
	window.$ = $;

	// Find a body class to make sure this only gets setup there
	Carr.setupFirmHistory();

	// Find a body class to make sure this only gets setup there
	Carr.setupAttorneys();

	// Find a body class to make sure this only gets setup there
	Carr.setupBottomMatter();
});