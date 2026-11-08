/**
 * HasibShah News - Navigation & Interactivity Engine
 *
 * Handles mobile off-canvas drawer navigation, search dropdown toggle,
 * breaking news ticker pause/play controls, and keyboard accessibility (WCAG 2.1 AA).
 * Pure vanilla JavaScript with zero external dependencies and Elementor compatibility.
 *
 * @package HasibShah_News
 * @since 1.0.0
 */

( function() {
	'use strict';

	/**
	 * Guard against executing during Elementor editing mode
	 * to prevent interfering with Elementor canvas panels and controls.
	 */
	function isElementorEditor() {
		return document.body.classList.contains( 'elementor-editor-active' ) ||
			document.body.classList.contains( 'hasibshah-news-elementor-editor' ) ||
			( typeof window.hasibshahNewsEditorMode !== 'undefined' && window.hasibshahNewsEditorMode.isElementorEditor );
	}

	/**
	 * Initialize header navigation and interactive components.
	 */
	function initNavigation() {
		// ---------------------------------------------------------------------
		// 1. Mobile Off-Canvas Drawer Navigation
		// ---------------------------------------------------------------------
		var menuToggle   = document.getElementById( 'mobile-menu-toggle' );
		var menuClose    = document.getElementById( 'mobile-menu-close' );
		var drawer       = document.getElementById( 'mobile-navigation-drawer' );
		var backdrop     = document.getElementById( 'mobile-drawer-backdrop' );

		if ( menuToggle && drawer && backdrop ) {
			/**
			 * Open the mobile navigation drawer.
			 */
			function openDrawer() {
				if ( isElementorEditor() ) {
					return;
				}
				drawer.classList.add( 'is-open' );
				backdrop.classList.add( 'is-visible' );
				document.body.classList.add( 'mobile-drawer-open' );

				menuToggle.setAttribute( 'aria-expanded', 'true' );
				drawer.setAttribute( 'aria-hidden', 'false' );
				backdrop.setAttribute( 'aria-hidden', 'false' );

				// Move focus into the drawer for accessibility.
				if ( menuClose ) {
					menuClose.focus();
				}
			}

			/**
			 * Close the mobile navigation drawer.
			 */
			function closeDrawer() {
				if ( ! drawer.classList.contains( 'is-open' ) ) {
					return;
				}
				drawer.classList.remove( 'is-open' );
				backdrop.classList.remove( 'is-visible' );
				document.body.classList.remove( 'mobile-drawer-open' );

				menuToggle.setAttribute( 'aria-expanded', 'false' );
				drawer.setAttribute( 'aria-hidden', 'true' );
				backdrop.setAttribute( 'aria-hidden', 'true' );

				// Restore focus back to the menu toggle button.
				menuToggle.focus();
			}

			// Event listeners for open / close actions.
			menuToggle.addEventListener( 'click', function( e ) {
				e.preventDefault();
				if ( drawer.classList.contains( 'is-open' ) ) {
					closeDrawer();
				} else {
					openDrawer();
				}
			} );

			if ( menuClose ) {
				menuClose.addEventListener( 'click', function( e ) {
					e.preventDefault();
					closeDrawer();
				} );
			}

			backdrop.addEventListener( 'click', function( e ) {
				e.preventDefault();
				closeDrawer();
			} );

			// Trap focus inside the drawer while open.
			drawer.addEventListener( 'keydown', function( e ) {
				if ( ! drawer.classList.contains( 'is-open' ) || isElementorEditor() ) {
					return;
				}

				if ( e.key === 'Tab' || e.keyCode === 9 ) {
					var focusableElements = drawer.querySelectorAll(
						'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
					);

					if ( focusableElements.length === 0 ) {
						return;
					}

					var firstElement = focusableElements[0];
					var lastElement  = focusableElements[ focusableElements.length - 1 ];

					if ( e.shiftKey ) {
						// Shift + Tab: moving backwards.
						if ( document.activeElement === firstElement ) {
							e.preventDefault();
							lastElement.focus();
						}
					} else {
						// Tab: moving forwards.
						if ( document.activeElement === lastElement ) {
							e.preventDefault();
							firstElement.focus();
						}
					}
				}
			} );
		}

		// ---------------------------------------------------------------------
		// 2. Header Search Dropdown Toggle
		// ---------------------------------------------------------------------
		var searchToggle   = document.getElementById( 'header-search-toggle' );
		var searchDropdown = document.getElementById( 'header-search-dropdown' );

		if ( searchToggle && searchDropdown ) {
			/**
			 * Open the search dropdown bar.
			 */
			function openSearch() {
				searchDropdown.classList.add( 'is-active' );
				searchToggle.setAttribute( 'aria-expanded', 'true' );
				searchDropdown.setAttribute( 'aria-hidden', 'false' );

				var searchInput = searchDropdown.querySelector( 'input[type="search"]' );
				if ( searchInput ) {
					setTimeout( function() {
						searchInput.focus();
					}, 50 );
				}
			}

			/**
			 * Close the search dropdown bar.
			 */
			function closeSearch() {
				if ( ! searchDropdown.classList.contains( 'is-active' ) ) {
					return;
				}
				searchDropdown.classList.remove( 'is-active' );
				searchToggle.setAttribute( 'aria-expanded', 'false' );
				searchDropdown.setAttribute( 'aria-hidden', 'true' );
				searchToggle.focus();
			}

			searchToggle.addEventListener( 'click', function( e ) {
				e.preventDefault();
				if ( searchDropdown.classList.contains( 'is-active' ) ) {
					closeSearch();
				} else {
					openSearch();
				}
			} );

			// Close search when clicking outside.
			document.addEventListener( 'click', function( e ) {
				if ( searchDropdown.classList.contains( 'is-active' ) ) {
					if ( ! searchDropdown.contains( e.target ) && ! searchToggle.contains( e.target ) ) {
						closeSearch();
					}
				}
			} );
		}

		// ---------------------------------------------------------------------
		// 3. Global Escape Key Handler (Closes Drawer & Search)
		// ---------------------------------------------------------------------
		document.addEventListener( 'keydown', function( e ) {
			if ( e.key === 'Escape' || e.keyCode === 27 ) {
				if ( drawer && drawer.classList.contains( 'is-open' ) ) {
					closeDrawer();
				}
				if ( searchDropdown && searchDropdown.classList.contains( 'is-active' ) ) {
					closeSearch();
				}
			}
		} );

		// ---------------------------------------------------------------------
		// 4. Breaking News Ticker Controls (Pause / Play)
		// ---------------------------------------------------------------------
		var tickerPauseToggle = document.getElementById( 'ticker-pause-toggle' );
		var tickerTrack       = document.getElementById( 'ticker-track' );

		if ( tickerPauseToggle && tickerTrack ) {
			var iconPause = tickerPauseToggle.querySelector( '.icon-pause' );
			var iconPlay  = tickerPauseToggle.querySelector( '.icon-play' );

			tickerPauseToggle.addEventListener( 'click', function( e ) {
				e.preventDefault();
				var isPaused = tickerTrack.classList.toggle( 'is-paused' );

				if ( isPaused ) {
					if ( iconPause ) {
						iconPause.style.display = 'none';
					}
					if ( iconPlay ) {
						iconPlay.style.display = 'inline-block';
					}
					tickerPauseToggle.setAttribute( 'aria-pressed', 'true' );
				} else {
					if ( iconPause ) {
						iconPause.style.display = 'inline-block';
					}
					if ( iconPlay ) {
						iconPlay.style.display = 'none';
					}
					tickerPauseToggle.setAttribute( 'aria-pressed', 'false' );
				}
			} );
		}

		// ---------------------------------------------------------------------
		// 5. Accessible Keyboard Focus for Desktop Multi-Level Dropdowns
		// ---------------------------------------------------------------------
		var primaryMenu = document.getElementById( 'primary-menu' );
		if ( primaryMenu ) {
			var links = primaryMenu.getElementsByTagName( 'a' );

			for ( var i = 0; i < links.length; i++ ) {
				links[i].addEventListener( 'focus', toggleFocus, true );
				links[i].addEventListener( 'blur', toggleFocus, true );
			}

			/**
			 * Sets or removes the .focus class on an element and its ancestors.
			 */
			function toggleFocus() {
				var self = this;
				while ( self && self !== primaryMenu ) {
					if ( self.tagName.toLowerCase() === 'li' ) {
						self.classList.toggle( 'focus' );
					}
					self = self.parentElement;
				}
			}
		}
	}

	// Run when the DOM is ready.
	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', initNavigation );
	} else {
		initNavigation();
	}
} )();

