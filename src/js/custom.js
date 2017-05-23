var width = jQuery(window).width();

//Mobile Nav button
jQuery('#nav-expander').on('click',function(){
	openNav();
});
jQuery('.nav-closer').on('click',function(){
	closeNav();
});
jQuery('.sidenav').prepend('<li class="menu-item nav-item text-center logo"><img width="250" height="75" src="/wp-content/uploads/2017/04/des_moines_logo-e1492620725464.png" class="img-responsive" title="Home" alt="logo" itemprop="logo"></li>');

//enable hover on desktop view
jQuery(document).ready(function(){
	hoverClose();

});
jQuery(window).load(function(){
	jQuery('body').addClass('loaded');
});

jQuery(window).on('resize', hoverClose());

//Bootstrap navbar Prevent Default override
jQuery('.navbar-desktop .menu-item-164 > a').attr('href','/restaurants/');
jQuery('.navbar-desktop a.nav-link.dropdown-toggle').removeAttr('data-toggle');


//responsive slides (header/images)
jQuery('.rslides').responsiveSlides({
	auto:true,
	speed:1000,
	timeout:8000,
	nav:true,
	pause: true,
	prevText: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
	nextText: '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
});

jQuery('.overlay').hover(function(){
	jQuery(this).next('.promo-image-text').css('opacity','1');
	jQuery(this).css('opacity','1');
}, function(){
	jQuery(this).next('.promo-image-text').css('opacity','0');
	jQuery(this).css('opacity','0');
});
jQuery('.promo-image-text').hover(function(){
	jQuery(this).prev('.overlay').css('opacity','1');
	jQuery(this).css('opacity','1');
}, function(){
	jQuery(this).prev('.overlay').css('opacity','0');
	jQuery(this).css('opacity','0');
});

//functions
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.body.style.backgroundColor = "white";
}
function hoverClose() {
	disableHover();
	hideClose();
}

function disableHover() {
	if(width > 992) {
	    jQuery('.navbar-desktop li.menu-item-has-children').mouseover(function(){
			jQuery(this).addClass('show');
	    });
	    jQuery('.navbar-desktop li.menu-item-has-children').mouseout(function(){
	    	jQuery(this).removeClass('show');
	    });
	}
}
function hideClose() {
	if(width > 992) {
		jQuery('.nav-closer').hide();
	} else if (width < 992) {
		jQuery('.nav-closer').show();
	}
}