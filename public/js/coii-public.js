(function( $ ) {
	'use strict';

    $(function() {

        $("#enable-tracking").click(function(){

        	// console.log('enable tracking');

            $("#coii-modal-dialogue").fadeOut( "slow", function() {});

            // createCookie('coii_allow_tracking_pixel', 'yes', 360);

            // location.reload();

        });

        $("#disable-tracking").click(function(){

            // console.log('disable tracking');

            $("#coii-dialogue").fadeOut( "slow", function() {});

            createCookie('coii_allow_tracking_pixel', 'no', 360);

            location.reload();

        });

    });

    /**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

function createCookie(name,value,days) {

    if (days) {

        var date = new Date();

        date.setTime(date.getTime()+(days*24*60*60*1000));

        var expires = "; expires="+date.toGMTString();

    } else {

        var expires = "";

    }

    document.cookie = name+"="+value+expires+"; path=/;";
}
