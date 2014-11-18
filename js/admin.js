/**
 * JavaScript for the wp-admin area
 */

var CarrAdmin = {

	// Toggle the Display Date Sections
	setupDisplayDate: function () {
		var area = $('#carr_post_options'),
			sections = area.find('.display-date-group'),
			displayDate = area.find('.display-date'),
			displayDateManual = area.find('.display-date-manual'),
			datePickerToggle = area.find('.datepicker-toggle');

		// If Manual date field is set, show it
		if ( displayDateManual.children('#display_date_manual').val() === '' ) {
			displayDateManual.hide();
		} else {
			displayDate.hide();
		}

		// Toggle the date group sections
		datePickerToggle.on('click', function () {
			// tried fadeToggle, but a bit ugly...
			// probably ned more complex logic for a transition effect
			sections.toggle();
		});

	}
};

jQuery(function ($) {
	window.$ = $;

	// @todo Find a body class to make sure this only gets setup there
	CarrAdmin.setupDisplayDate();

});