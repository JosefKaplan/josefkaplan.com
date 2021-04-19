/*  This file is part of WordPress theme named Manduca - focus on accessibility.
 *
	Copyright (C) 2015-2020  Zsolt Edelényi (ezs@web25.hu)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    in /assets/docs/licence.txt.  If not, see <https://www.gnu.org/licenses/>.
*/
(function($){$.fn.extend({getUniqueId:function(p,q,r){if(r===undefined){r=''}else{r='-'+r}
return p+q+r},accessibleTabs:function(config){var accessibleTabsDefaults={wrapperClass:'entry-content',currentClass:'current',tabhead:'h4',tabheadClass:'tabhead',tabbody:'.tabbody',fx:'show',fxspeed:'normal',currentInfoText:'current tab: ',currentInfoPosition:'prepend',currentInfoClass:'current-info',tabsListClass:'tabs-list',syncheights:!1,syncHeightMethodName:'syncHeight',cssClassAvailable:!1,saveState:!1,autoAnchor:!1,pagination:!1,position:'top',wrapInnerNavLinks:'',firstNavItemClass:'first',lastNavItemClass:'last',clearfixClass:'clearfix'};var keyCodes={37:-1,38:-1,39:+1,40:+1};var positions={top:'prepend',bottom:'append'};this.options=$.extend(accessibleTabsDefaults,config);var tabsCount=0;if($("body").data('accessibleTabsCount')!==undefined){tabsCount=$("body").data('accessibleTabsCount')}
$("body").data('accessibleTabsCount',this.size()+tabsCount);var o=this;return this.each(function(t){var el=$(this);var list='';var tabCount=0;var ids=[];$(el).wrapInner('<div class="'+o.options.wrapperClass+'"></div>');$(el).find(o.options.tabhead).each(function(i){var id='';var elId=$(this).attr('id');if(elId){if(elId.indexOf('accessibletabscontent')===0){return}
id=' id="'+elId+'"'}
var tabId=o.getUniqueId('accessibletabscontent',tabsCount+t,i);var navItemId=o.getUniqueId('accessibletabsnavigation',tabsCount+t,i);ids.push(tabId);if(o.options.cssClassAvailable===!0){var cssClass='';if($(this).attr('class')){cssClass=$(this).attr('class');cssClass=' class="'+cssClass+'"'}
list+='<li id="'+navItemId+'"><a'+id+''+cssClass+' href="#'+tabId+'">'+$(this).html()+'</a></li>'}else{list+='<li id="'+navItemId+'"><a'+id+' href="#'+tabId+'">'+$(this).html()+'</a></li>'}
$(this).attr({"id":tabId,"class":o.options.tabheadClass,"tabindex":"-1"});tabCount++});if(o.options.syncheights&&$.fn[o.options.syncHeightMethodName]){$(el).find(o.options.tabbody)[o.options.syncHeightMethodName]();$(window).resize(function(){$(el).find(o.options.tabbody)[o.options.syncHeightMethodName]()})}
var tabs_selector='.'+o.options.tabsListClass;if(!$(el).find(tabs_selector).length){$(el)[positions[o.options.position]]('<ul class="'+o.options.clearfixClass+' '+o.options.tabsListClass+' tabamount'+tabCount+'"></ul>')}
$(el).find(tabs_selector).append(list);var content=$(el).find(o.options.tabbody);if(content.length>0){$(content).hide();$(content[0]).show()}
$(el).find("ul."+o.options.tabsListClass+">li:first").addClass(o.options.currentClass).addClass(o.options.firstNavItemClass).find('a')[o.options.currentInfoPosition]('<span class="'+o.options.currentInfoClass+'">'+o.options.currentInfoText+'</span>').parents("ul."+o.options.tabsListClass).children('li:last').addClass(o.options.lastNavItemClass);if(o.options.wrapInnerNavLinks){$(el).find('ul.'+o.options.tabsListClass+'>li>a').wrapInner(o.options.wrapInnerNavLinks)}
$(el).find('ul.'+o.options.tabsListClass+'>li>a').each(function(i){$(this).click(function(event){event.preventDefault();el.trigger("showTab.accessibleTabs",[$(event.target)]);if(o.options.saveState&&$.cookie){$.cookie('accessibletab_'+el.attr('id')+'_active',i)}
$(el).find('ul.'+o.options.tabsListClass+'>li.'+o.options.currentClass).removeClass(o.options.currentClass).find("span."+o.options.currentInfoClass).remove();$(this).blur();$(el).find(o.options.tabbody+':visible').hide();$(el).find(o.options.tabbody).eq(i)[o.options.fx](o.options.fxspeed);$(this)[o.options.currentInfoPosition]('<span class="'+o.options.currentInfoClass+'">'+o.options.currentInfoText+'</span>').parent().addClass(o.options.currentClass);$($(this).attr("href")).focus().keyup(function(event){if(keyCodes[event.keyCode]){o.showAccessibleTab(i+keyCodes[event.keyCode]);$(this).unbind("keyup")}})});$(this).focus(function(){$(document).keyup(function(event){if(keyCodes[event.keyCode]){o.showAccessibleTab(i+keyCodes[event.keyCode])}})});$(this).blur(function(){$(document).unbind("keyup")})});if(o.options.saveState&&$.cookie){var savedState=$.cookie('accessibletab_'+el.attr('id')+'_active');if(savedState!==null){o.showAccessibleTab(savedState,el.attr('id'))}}
if(o.options.autoAnchor&&window.location.hash){var anchorTab=$('.'+o.options.tabsListClass).find(window.location.hash);if(anchorTab.size()){anchorTab.click()}}
if(o.options.pagination){var m='<ul class="pagination">';m+='    <li class="previous"><a href="#{previousAnchor}"><span>{previousHeadline}</span></a></li>';m+='    <li class="next"><a href="#{nextAnchor}"><span>{nextHeadline}</span></a></li>';m+='</ul>';var tabs=$(el).find('.tabbody');var tabcount=tabs.size();tabs.each(function(idx){$(this).append(m);var next=idx+1;if(next>=tabcount){next=0}
var previous=idx-1;if(previous<0){previous=tabcount-1}
var p=$(this).find('.pagination');var previousEl=p.find('.previous');previousEl.find('span').text($('#'+ids[previous]).text());previousEl.find('a').attr('href','#'+ids[previous]).click(function(event){event.preventDefault();$(el).find('.tabs-list a').eq(previous).click()});var nextEl=p.find('.next');nextEl.find('span').text($('#'+ids[next]).text());nextEl.find('a').attr('href','#'+ids[next]).click(function(event){event.preventDefault();$(el).find('.tabs-list a').eq(next).click()})})}})},showAccessibleTab:function(index,id){var o=this;if(id){var el=$('#'+id);var links=el.find('ul.'+o.options.tabsListClass+'>li>a');el.trigger("showTab.accessibleTabs",[links.eq(index)]);links.eq(index).click()}else{return this.each(function(){var el=$(this);el.trigger("showTab.accessibleTabs");var links=el.find('ul.'+o.options.tabsListClass+'>li>a');el.trigger("showTab.accessibleTabs",[links.eq(index)]);links.eq(index).click()})}},showAccessibleTabSelector:function(selector){var el=$(selector);if(el){if(el.get(0).nodeName.toLowerCase()==='a'){el.click()}}}})})(jQuery)