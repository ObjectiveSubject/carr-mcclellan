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
	}
};

jQuery(function ($) {
	window.$ = $;

	// Find a body class to make sure this only gets setup there
	Carr.setupFirmHistory();
});