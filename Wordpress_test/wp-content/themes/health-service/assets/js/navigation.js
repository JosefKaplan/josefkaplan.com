/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var gymnaz_container, gymnaz_button, gymnaz_menu, gymnaz_links, i, len;

	gymnaz_container = document.getElementById( 'site-navigation' );
	if ( ! gymnaz_container ) {
		return;
	}

	gymnaz_button = gymnaz_container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof gymnaz_button ) {
		return;
	}

	gymnaz_menu = gymnaz_container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof gymnaz_menu ) {
		gymnaz_button.style.display = 'none';
		return;
	}

	gymnaz_menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === gymnaz_menu.className.indexOf( 'nav-menu' ) ) {
		gymnaz_menu.className += ' nav-menu';
	}

	gymnaz_button.onclick = function() {
		if ( -1 !== gymnaz_container.className.indexOf( 'toggled' ) ) {
			gymnaz_container.className = gymnaz_container.className.replace( ' toggled', '' );
			gymnaz_button.setAttribute( 'aria-expanded', 'false' );
			gymnaz_menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			gymnaz_container.className += ' toggled';
			gymnaz_button.setAttribute( 'aria-expanded', 'true' );
			gymnaz_menu.setAttribute( 'aria-expanded', 'true' );
		}
	};


	gymnaz_button.onfocusin = function() {
		if ( -1 !== gymnaz_container.className.indexOf( 'toggled' ) ) {
			gymnaz_container.className = gymnaz_container.className.replace( ' toggled', '' );
			gymnaz_button.setAttribute( 'aria-expanded', 'false' );
			gymnaz_menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			gymnaz_container.className += ' toggled';
			gymnaz_button.setAttribute( 'aria-expanded', 'true' );
			gymnaz_menu.setAttribute( 'aria-expanded', 'true' );
		}
	};
	// Get all the link elements within the menu.
	gymnaz_links    = gymnaz_menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = gymnaz_links.length; i < len; i++ ) {
		gymnaz_links[i].addEventListener( 'focus', toggleFocus, true );
		gymnaz_links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

/**
	 * Toggles `focus` class to open Menu.
	 */
gymnaz_button.onfocus = function() {
		if ( -1 !== gymnaz_container.className.indexOf( 'toggled' ) ) {
			gymnaz_container.className = gymnaz_container.className.replace( ' toggled', '' );
			gymnaz_button.setAttribute( 'aria-expanded', 'false' );
			gymnaz_menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			gymnaz_container.className += ' toggled';
			gymnaz_button.setAttribute( 'aria-expanded', 'true' );
			gymnaz_menu.setAttribute( 'aria-expanded', 'true' );
		}
	};
	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( gymnaz_container ) {
		var touchStartFn, i,
			parentLink = gymnaz_container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( gymnaz_container ) );
} )();