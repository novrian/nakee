/**
 * Main Javascript
 */
/*
* Inspired by:
* http://designedbythomas.co.uk/blog/how-detect-width-web-browser-using-jquery
*
* This script is ideal for getting specific class depending on device width
* for enhanced theming. Media queries are fine in most cases but sometimes
* you want to target a specific JQuery call based on width. This will work
* for that. Be sure to put it first in your script file. Note that you could
* also target the body class instead of 'html' as well.
* Modify as needed
*/
var current_width = $(window).width();
//do something with the width value here!
if(current_width < 481)
$('html').addClass("m320").removeClass("m768").removeClass("desktop").removeClass("m480");

else if(current_width < 739)
$('html').addClass("m768").removeClass("desktop").removeClass("m320").removeClass("tablet");

else if (current_width < 970)
$('html').addClass("tablet").removeClass("desktop").removeClass("m320").removeClass("m768");

else if (current_width > 971)
$('html').addClass("desktop").removeClass("m320").removeClass("m768").removeClass("tablet");

if(current_width < 650)
    $('html').addClass("mobile-menu").removeClass("desktop-menu");

if(current_width > 651)
    $('html').addClass("desktop-menu").removeClass("mobile-menu");

//update the width value when the browser is resized (useful for devices which switch from portrait to landscape)
$(window).resize(function(){
    var current_width = $(window).width();
    //do something with the width value here!
    if(current_width < 481)
    $('html').addClass("m320").removeClass("m768").removeClass("desktop").removeClass("tablet");

    else if(current_width < 669)
    $('html').addClass("m768").removeClass("desktop").removeClass("m320").removeClass("tablet");

    else if (current_width < 970)
    $('html').addClass("tablet").removeClass("desktop").removeClass("m320").removeClass("m768");

    else if (current_width > 971)
    $('html').addClass("desktop").removeClass("m320").removeClass("m768").removeClass("tablet");

if(current_width < 650)
    $('html').addClass("mobile-menu").removeClass("desktop-menu");

if(current_width > 651)
    $('html').addClass("desktop-menu").removeClass("mobile-menu");

});

jQuery(document).ready(function($) {

    /**
     * Init Tweaks
     */
	$('#no-script').hide();
    $('<div id="top" />').prependTo('body').css({
        "position"  : "absolute",
        "top"       : 0
    });

    // Localscroll Init
    $.localScroll({
        target      : $(window),
        queue       : true,
        duration    : 1000,
        hash        : false
    });

    /**
     * Tooltip Init
     */
    $('[rel~="tooltip"]').tooltip();

    /**
     * Magnific Popup Init
     */
    $('.nakee-portfolio-popup').magnificPopup({
        image : {
            verticalFit : false
        },
        type : "image"
    });


    if ($('.desktop').is('*') && $('.navbar-fixed-top').is('*')) {
        $('body').css({
            "padding-top" : $('.navbar-fixed-top').height() + "px"
        });
    }

});
