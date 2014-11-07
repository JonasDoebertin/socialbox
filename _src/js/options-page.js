//= include options-page/smooth-scroll-4.5.js





/*------------------------------------*\
	$SMOOTH SCROLLING
\*------------------------------------*/
smoothScroll.init();





/*------------------------------------*\
	$HELP TOC
\*------------------------------------*/
jQuery(function($) {

	var $tocItems = $('.js-socialbox-toc-item');

	$tocItems.each(function() {

		var $this = $(this);

		$this.tooltipster({
			animation: 'fade',
			content: $this.attr('data-tooltip'),
			delay: 0,
			maxWidth: 400,
			position: 'top',
			theme: 'tooltipster-socialbox'
		});

	});

});






/*------------------------------------*\
	$LOG CONTEXTS
\*------------------------------------*/
jQuery(function($) {

	var $contextIcons = $('.js-socialbox-context');


    $contextIcons.each(function() {

		var $this = $(this);

		$this.tooltipster({
			content: $this.attr('data-message'),
			maxWidth: 700,
			position: 'top-right',
			theme: 'tooltipster-socialbox'
		});

	});


});





/*------------------------------------*\
	$AJAX ACTIONS
\*------------------------------------*/
jQuery(function($) {

	var showAnchor = $('.js-socialbox-cache-show'),
		clearAnchor = $('.js-socialbox-cache-clear'),
		refreshAnchor = $('.js-socialbox-cache-refresh');

	/**
	 * Cache clear anchor
	 */
	clearAnchor.on('click', function(e) {
		e.preventDefault();

		/* Show loading indicator */
		var icon = $(this).prev('i').addClass('socialbox-icon-loading');

		/* Build data */
		data = {
				action: Socialbox.action.clear,
				nonce: Socialbox.nonce.clear
			};

		/* Send post request */
		$.post(ajaxurl, data, function(response) {

			/* Hide loading indicator */
			icon.removeClass('socialbox-icon-loading');

			/* Show message */
			alert(response);
		});
	});

	/**
	 * Cache refresh anchor
	 */
	refreshAnchor.on('click', function(e) {
		e.preventDefault();

		/* Show loading indicator */
		var icon = $(this).prev('i').addClass('socialbox-icon-loading');

		/* Build data */
		data = {
				action: Socialbox.action.refresh,
				nonce: Socialbox.nonce.refresh
			};

		/* Send post request */
		$.post(ajaxurl, data, function(response) {

			/* Hide loading indicator */
			icon.removeClass('socialbox-icon-loading');

			/* Show message */
			alert(response);
		});
	});

	/**
	 * Cache show anchor
	 */
	showAnchor.on('click', function(e) {
		e.preventDefault();

		/* Show loading indicator */
		var icon = $(this).prev('i').addClass('socialbox-icon-loading');

		/* Build data */
		data = {
				action: Socialbox.action.show,
				nonce: Socialbox.nonce.show
			};

		/* Send post request */
		$.post(ajaxurl, data, function(response) {

			/* Hide loading indicator */
			icon.removeClass('socialbox-icon-loading');

			/* Show message */
			alert(response);
		});
	});

});
