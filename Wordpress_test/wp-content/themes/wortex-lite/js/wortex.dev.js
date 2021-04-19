/**
 * Wortex Lite WordPress Theme by Iceable Themes | https://www.iceablethemes.com
 * Copyright 2014-2020 Iceable Themes - https://www.iceablethemes.com
 * Javascripts
 *
 * Dependencies:
 * - Superfish
 */

$ = jQuery;

/* Adjust navbar on (window).load */

$(window).load(function() { navbarWidth(); });

/* --- Update navbar on window resize --- */

$(window).resize(function() { navbarWidth(); });

/* --- (document).ready function wrap --- */

$(document).ready(function($){

	navbarWidth();	// Calculate navbar max-width
	subMenuPos();	// Position submenus

	// Fields placeholders function
	$('input[data-placeholder], textarea[data-placeholder]').each(function() {
		$(this).click(function(){ if($(this).attr('value') == $placeholder) $(this).setCursorPosition(0); });
		var $placeholder = $(this).attr('data-placeholder');
		$(this).attr('value', $placeholder).addClass("notfilled");
		$(this).keydown(function(){ if( $(this).attr('value') == $placeholder ) $(this).attr('value', '').removeClass("notfilled"); });
		$(this).keyup(function(){
			if($(this).attr('value') === ''){ $(this).attr('value', $placeholder).addClass("notfilled").setCursorPosition(0); }
		});
	});

	// Navbar Search functions
	var menuwidth = 0;
	$("#navbar > div > ul > li").each(function() { menuwidth += $(this).outerWidth(); });
	$("#navbar .search-field").width(menuwidth-35);
	$("#nav-search .nav-search-toggle").click(function(e) {
		$("#navbar .search-form").toggle();
		$("i", this).toggleClass("fa-search").toggleClass("fa-close");
		$("#navbar .search-field").focus();
		var $placeholder = $('#navbar .search-field').attr('data-placeholder');
		if($('#navbar .search-field').attr('value') == $placeholder) $('#navbar .search-field').setCursorPosition(0);
		e.preventDefault();
	});

	/*--- Responsive Dropdown Menu ---*/

	$('#dropdown-menu').change( function () {
		var url = $('#dropdown-menu').val();
		$(location).attr('href',url);
	});

	/*--- Hookup Superfish ---*/

	$('ul.sf-menu').superfish({
		delay:	700,	// the delay in milliseconds that the mouse can remain outside a submenu without it closing
		animation:	{opacity:'show',height:'show'},	// an object equivalent to first parameter of jQuery’s .animate() method
		speed:	'normal',	// speed of the animation. Equivalent to second parameter of jQuery’s .animate() method
		autoArrows:	false,	// if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance
		dropShadows:	false,	// completely disable drop shadows by setting this to false
	});

	/* Remove empty comment reply link wrappers */
	$('div.reply').filter(function() {return $.trim($(this).text()) === '';}).remove();

}); /*--- End of $(document).ready(function() ---*/

/*--- Helper functions ---*/

$.fn.setCursorPosition = function(position){
	    if(this.lengh === 0) return this;
	    input = this[0];
	    if (input.createTextRange) {
	        var range = input.createTextRange();
	        range.collapse(true);
	        range.moveEnd('character', position);
	        range.moveStart('character', position);
	        range.select();
	    } else if (input.setSelectionRange) {
	        input.focus();
	        input.setSelectionRange(position, position);
	    }
	    return this;
	};

// Position sub-menus depending on navbar height and header padding
function subMenuPos() {
	var submenuTop = $('#navbar ul.menu').height() + parseInt( $('#header').css('padding-bottom') );
	$('#navbar ul.menu > li > ul').each(function(){ $(this).css('top', submenuTop + 'px'); });
}

// Define max-width for navbar (depending on container and logo size)
function navbarWidth() {
	var menuMinWidth = 30;
	$("#navbar ul.menu > li").each(function() { menuMinWidth += $(this).outerWidth(true); } );
	var menuWidth = Math.max(menuMinWidth, $("#header .container").width() - $("#logo").width() );
	console.log(menuWidth);
	$("#navbar").css("width", menuWidth + 'px' );
}


/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */

;(function($){
	$.fn.superfish = function(op){

		var sf = $.fn.superfish,
			c = sf.c,
			$arrow = $(['<span class="',c.arrowClass,'"> &#187;</span>'].join('')),
			over = function(){
				var $$ = $(this), menu = getMenu($$);
				clearTimeout(menu.sfTimer);
				$$.showSuperfishUl().siblings().hideSuperfishUl();
			},
			out = function(){
				var $$ = $(this), menu = getMenu($$), o = sf.op;
				clearTimeout(menu.sfTimer);
				menu.sfTimer=setTimeout(function(){
					o.retainPath=($.inArray($$[0],o.$path)>-1);
					$$.hideSuperfishUl();
					if (o.$path.length && $$.parents(['li.',o.hoverClass].join('')).length<1){over.call(o.$path);}
				},o.delay);
			},
			getMenu = function($menu){
				var menu = $menu.parents(['ul.',c.menuClass,':first'].join(''))[0];
				sf.op = sf.o[menu.serial];
				return menu;
			},
			addArrow = function($a){ $a.addClass(c.anchorClass).append($arrow.clone()); };

		return this.each(function() {
			var s = this.serial = sf.o.length;
			var o = $.extend({},sf.defaults,op);
			o.$path = $('li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){
				$(this).addClass([o.hoverClass,c.bcClass].join(' '))
					.filter('li:has(ul)').removeClass(o.pathClass);
			});
			sf.o[s] = sf.op = o;

			$('li:has(ul)',this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over,out).each(function() {
				if (o.autoArrows) addArrow( $('>a:first-child',this) );
			})
			.not('.'+c.bcClass)
				.hideSuperfishUl();

			var $a = $('a',this);
			$a.each(function(i){
				var $li = $a.eq(i).parents('li');
				$a.eq(i).focus(function(){over.call($li);}).blur(function(){out.call($li);});
			});
			o.onInit.call(this);

		}).each(function() {
			var menuClasses = [c.menuClass];
			if (sf.op.dropShadows  && !($.browser.msie && $.browser.version < 7)) menuClasses.push(c.shadowClass);
			$(this).addClass(menuClasses.join(' '));
		});
	};

	var sf = $.fn.superfish;
	sf.o = [];
	sf.op = {};
	sf.IE7fix = function(){
		var o = sf.op;
		if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity!=undefined)
			this.toggleClass(sf.c.shadowClass+'-off');
		};
	sf.c = {
		bcClass     : 'sf-breadcrumb',
		menuClass   : 'sf-js-enabled',
		anchorClass : 'sf-with-ul',
		arrowClass  : 'sf-sub-indicator',
		shadowClass : 'sf-shadow'
	};
	sf.defaults = {
		hoverClass	: 'sfHover',
		pathClass	: 'overideThisToUse',
		pathLevels	: 1,
		delay		: 800,
		animation	: {opacity:'show'},
		speed		: 'normal',
		autoArrows	: true,
		dropShadows : true,
		disableHI	: false,		// true disables hoverIntent detection
		onInit		: function(){}, // callback functions
		onBeforeShow: function(){},
		onShow		: function(){},
		onHide		: function(){}
	};
	$.fn.extend({
		hideSuperfishUl : function(){
			var o = sf.op,
				not = (o.retainPath===true) ? o.$path : '';
			o.retainPath = false;
			var $ul = $(['li.',o.hoverClass].join(''),this).add(this).not(not).removeClass(o.hoverClass)
					.find('>ul').hide().css('visibility','hidden');
			o.onHide.call($ul);
			return this;
		},
		showSuperfishUl : function(){
			var o = sf.op,
				sh = sf.c.shadowClass+'-off',
				$ul = this.addClass(o.hoverClass)
					.find('>ul:hidden').css('visibility','visible');
			sf.IE7fix.call($ul);
			o.onBeforeShow.call($ul);
			$ul.animate(o.animation,o.speed,function(){ sf.IE7fix.call($ul); o.onShow.call($ul); });
			return this;
		}
	});

})(jQuery);
