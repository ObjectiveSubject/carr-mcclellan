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

	},

	// Only show sidebar fields if page-sidebars template is selected
	setupPageSidebars: function() {
		var templateName = 'page-sidebars.php',
			currentTemplate = $( '#page_template'),
			metabox = $( '#carr_page_sidebars' );

		// Check if page template is selected
		if ( currentTemplate.val() === templateName ) {
			metabox.show();
		}

		// Bind a change event to make sure we show or hide the metabox based on user selection of a template
		currentTemplate.change( function() {
			if ( currentTemplate.val() === templateName ) {
				metabox.show();
			}
			else {
				metabox.hide();
			}
		});
	},

	// Only show News Options for In the News
	setupPostNewsOptions: function() {
		var newsCategory = $('#in-category-29'),
			metabox = $( '#carr_post_news_options' );

		if ( newsCategory.is(':checked') ) {
			metabox.show();
		} else {
			metabox.hide();
		}
		
		newsCategory.click( function() {
			metabox.toggle( this.checked );
		});
	},

	setupPDFUpload: function() {
		var attorney_pdf = true,
			orig_send_attachment = wp.media.editor.send.attachment;

		$('.pdf-uploader .button').click(function() {
			//var send_attachment_bkp = wp.media.editor.send.attachment;
			var button = $(this);
			var id = button.attr('id').replace('_button', '');
			attorney_pdf = true;

			wp.media.editor.send.attachment = function(props, attachment){
				if ( attorney_pdf ) {
					$("#"+id).val(attachment.url);
				} else {
					return orig_send_attachment.apply( this, [props, attachment] );
				}
			};

			wp.media.editor.open(button);
			return false;
		});

		$('.add_media').on('click', function(){
			attorney_pdf = false;
		});
	}
};

jQuery(function ($) {
	window.$ = $;

	// @todo Find a body class to make sure this only gets setup there
	CarrAdmin.setupDisplayDate();

	CarrAdmin.setupPageSidebars();

	CarrAdmin.setupPostNewsOptions();

	CarrAdmin.setupPDFUpload();

});