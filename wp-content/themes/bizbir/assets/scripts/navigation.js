function initMainNavigation(container) {
	// Add dropdown toggle that displays child menu items.
	var dropdownToggle = jQuery('<button />', {
			'class': 'dropdown-toggle',
			'aria-expanded': false
		})
		.append(bizbirScreenReaderText.icon)
		.append(jQuery('<span />', {
			'class': 'screen-reader-text',
			text: bizbirScreenReaderText.expand
		}));

	container.find('.menu-item-has-children > a, .page_item_has_children > a').after(dropdownToggle);

	// Set the active submenu dropdown toggle button initial state.
	container.find('.current-menu-ancestor > button')
		.addClass('toggled-on')
		.attr('aria-expanded', 'true')
		.find('.screen-reader-text')
		.text(bizbirScreenReaderText.collapse);
	// Set the active submenu initial state.
	container.find('.current-menu-ancestor > .sub-menu').addClass('toggled-on');

	// Add menu items with submenus to aria-haspopup="true".
	container.find('.menu-item-has-children').attr('aria-haspopup', 'true');

	container.find('.dropdown-toggle').click(function(e) {
		var _this = jQuery(this),
			screenReaderSpan = _this.find('.screen-reader-text');

		e.preventDefault();
		_this.toggleClass('toggled-on');
		_this.next('.children, .sub-menu').toggleClass('toggled-on');

		// jscs:disable
		_this.attr('aria-expanded', _this.attr('aria-expanded') === 'false' ? 'true' : 'false');
		// jscs:enable
		screenReaderSpan.text(screenReaderSpan.text() === bizbirScreenReaderText.expand ? bizbirScreenReaderText.collapse : bizbirScreenReaderText.expand);
	});
}

menuToggle = jQuery('#primary-menu-toggle');
siteHeaderMenu = jQuery('#site-header-menu');
siteNavigation = jQuery('#site-primary-navigation');
searchNavigation = jQuery('#search-container');
initMainNavigation(siteNavigation);

// Enable menuToggle.
(function() {

	// Return early if menuToggle is missing.
	if (!menuToggle.length) {
		return;
	}

	// Add an initial values for the attribute.
	menuToggle.add(siteNavigation).add(searchNavigation).attr('aria-expanded', 'false');

	menuToggle.on('click.bizbir', function() {
		jQuery(this).add(siteHeaderMenu).toggleClass('toggled-on');

		// jscs:disable
		jQuery(this).add(siteNavigation).add(searchNavigation).attr('aria-expanded', jQuery(this).add(siteNavigation).add(searchNavigation).attr('aria-expanded') === 'false' ? 'true' : 'false');
		// jscs:enable
	});
})();

// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
(function() {
	if (!siteNavigation.length || !siteNavigation.children().length) {
		return;
	}

	// Toggle `focus` class to allow submenu access on tablets.
	function toggleFocusClassTouchScreen() {
		if (window.innerWidth >= 910) {
			jQuery(document.body).on('touchstart.bizbir', function(e) {
				if (!jQuery(e.target).closest('.main-navigation li').length) {
					jQuery('.main-navigation li').removeClass('focus');
				}
			});
			siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).on( 'touchstart.bizbir', function( e ) {
				var el = jQuery( this ).parent( 'li' );

				if ( ! el.hasClass( 'focus' ) ) {
					e.preventDefault();
					el.toggleClass( 'focus' );
					el.siblings( '.focus' ).removeClass( 'focus' );
				}
			} );
		} else {
			siteNavigation.find('.menu-item-has-children > a').unbind('touchstart.bizbir');
		}
	}

	if ('ontouchstart' in window) {
		jQuery(window).on('resize.bizbir', toggleFocusClassTouchScreen);
		toggleFocusClassTouchScreen();
	}

	siteNavigation.find('a').on('focus.bizbir blur.bizbir', function() {
		jQuery(this).parents('.menu-item, .page_item').toggleClass('focus');
	});
})();