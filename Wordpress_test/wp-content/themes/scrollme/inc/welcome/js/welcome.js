/**
 *
 * Welcome Page Scripts
 *
 */
 jQuery(document).ready(function ($) {

 	"use strict";

 	$(window).load(function(){
 		var hash = window.location.hash;
 		if ( hash !== null ) {
 			var clsr = hash.split('#');
 			var clas = clsr[1];
 			if(typeof(clas)!== 'undefined' && clas!==null){
 				jQuery('.nav-tab').removeClass('nav-tab-active');
 				jQuery('.welcome-section').removeClass('nav-tab-active').addClass('nav-tab-inactive');
 				jQuery('.nav-tab.'+clas).removeClass('nav-tab-inactive').addClass('nav-tab-active');
 				jQuery('.welcome-section.'+clas).addClass('nav-tab-active').removeClass('nav-tab-inactive');

 				$('.welcome-section-wrapper-loader').removeClass('import-php');
 				$('.welcome-section-wrapper').removeClass('is_loading');
 				$('.notice-sidebar').removeClass('is_loading');
 			}else {
 				var clas = 'getting_started';
 				$('.welcome-section-wrapper-loader').removeClass('import-php');
 				$('.welcome-section-wrapper').removeClass('is_loading');
 				$('.notice-sidebar').removeClass('is_loading');
 				jQuery('.nav-tab.'+clas).removeClass('nav-tab-inactive').addClass('nav-tab-active');
 				jQuery('.welcome-section.'+clas).addClass('nav-tab-active').removeClass('nav-tab-inactive');
 			}
 		}
 	});

 	jQuery('.nav-tab').click(function(){
 		jQuery('.nav-tab').removeClass('nav-tab-active');
 		jQuery('.welcome-section').removeClass('nav-tab-active').addClass('nav-tab-inactive');
 		var tab = jQuery(this);		
 		var cls = tab.attr('class');
 		var clsr = cls.split(' ');
 		var clas = clsr[1];
 		jQuery('.nav-tab.'+clas).removeClass('nav-tab-inactive').addClass('nav-tab-active');
 		jQuery('.welcome-section.'+clas).addClass('nav-tab-active').removeClass('nav-tab-inactive');
 	});

 	/** Ajax Plugin Installation **/
 	$(".install").on('click', function (e) {
 		e.preventDefault();
 		var el = $(this);

 		var is_loading = true;
 		el.addClass('installing');
 		var plugin = $(el).attr('data-slug');
 		var plugin_file = $(el).attr('data-file');
 		var ajaxurl = SmWelcomeObject.ajaxurl;
 		var download_link = $(el).attr('href');

 		$.ajax({
 			type: 'POST',
 			url: ajaxurl,
 			data: {
 				action: 'plugin_installer',
 				plugin: plugin,
 				plugin_file: plugin_file,
 				download_link:download_link,
 				nonce: SmWelcomeObject.admin_nonce,
 			},
 			success: function(response) {

 				if(response == 'success'){

 					el.attr('class', 'installed button');
 					el.html(SmWelcomeObject.installed_btn);

 				}

 				el.removeClass('installing');
 				is_loading = false;
 				location.reload();
 			},
 			error: function(xhr, status, error) {
 				console.log(status);
 				el.removeClass('installing');
 				is_loading = false;
 			}
 		});
 	});

 	/** Ajax Plugin Installation (Offlines) **/
 	$('.install-offline').on('click', function (e) {
 		e.preventDefault();
 		var el = $(this);

 		var is_loading = true;
 		el.addClass('installing');

 		var file_location = el.attr('href');
 		var file = el.attr('data-file');
 		var host_type = (el.attr('data-host-type') === undefined) ? 'remote' : el.attr('data-host-type');
 		var class_name = el.attr('data-class');
 		var slug = el.attr('data-slug');
 		$.ajax({
 			type: 'POST',
 			url: ajaxurl,
 			data: {
 				action: 'plugin_offline_installer',
 				file_location: file_location,
 				file: file,
 				host_type: host_type,
 				class_name: class_name,
 				slug: slug,
 				dataType: 'json'
 			},
 			success: function(response) {

 				if(response == 'success'){
 					
 					el.attr('class', 'installed button');
 					el.html(SmWelcomeObject.installed_btn);

 				}

 				is_loading = false;
 				location.reload();
 			},
 			error: function(xhr, status, error) {
 				el.removeClass('installing');
 				is_loading = false;
 			}
 		});
 	});

 	/** Ajax Plugin Activation **/
 	$(".plugin-action-btn .activate").on('click', function (e) {
 		e.preventDefault();
 		var el = $(this);
 		el.addClass('installing');
 		var el = $(this);
 		var plugin = $(el).attr('data-slug');
 		var plugin_file = $(el).attr('data-file');

 		var ajaxurl = SmWelcomeObject.ajaxurl;

 		$.ajax({
 			type: 'POST',
 			url: ajaxurl,
 			data: {
 				action: 'plugin_activation',
 				plugin: plugin,
 				plugin_file: plugin_file,
 				nonce: SmWelcomeObject.activate_nonce,
 				dataType: 'json'
 			},
 			success: function(response) {
 				el.removeClass('installing');
 				if(response == 'success'){
 					el.attr('class', 'installed button');
 					el.html(SmWelcomeObject.installed_btn);
 				}
 				location.reload();
 			},
 		});
 	});

 	/** Ajax Plugin Deactivation **/
 	$(".plugin-action-btn .deactivate").on('click', function (e) {
 		e.preventDefault();
 		var el = $(this);
 		el.addClass('installing');
 		var el = $(this);
 		var plugin = $(el).attr('data-slug');
 		var plugin_file = $(el).attr('data-file');

 		var ajaxurl = SmWelcomeObject.ajaxurl;

 		$.ajax({
 			type: 'POST',
 			url: ajaxurl,
 			data: {
 				action: 'plugin_deactivation',
 				plugin: plugin,
 				plugin_file: plugin_file,
 				nonce: SmWelcomeObject.deactivate_nonce,
 				dataType: 'json'
 			},
 			success: function(response) {
 				el.removeClass('installing');
 				if(response == 'success'){
 					el.attr('class', 'installed button');
 					el.html(SmWelcomeObject.installed_btn);
 				}
 				location.reload();
 			},
 		});
 	});

 });