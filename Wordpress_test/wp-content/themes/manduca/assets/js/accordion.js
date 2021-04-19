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

(function($){$(manducaAccordionArgs.selector).each(function(){$(this).nextUntil(manducaAccordionArgs.selector).wrapAll('<div class="accordion-body" />')});$(".accordion-body").addClass("collapsed");$(manducaAccordionArgs.selector).addClass("collapsed").prepend(manducaAccordionArgs.icon);$(manducaAccordionArgs.selector).click(function(){if(event.target.tagName.toLowerCase()==='svg'){accordionHeader=$(event.target).parent()}
if(event.target.tagName.toLowerCase()===manducaAccordionArgs.header){accordionHeader=$(event.target)}
var accordionBody=accordionHeader.next();if(accordionBody.hasClass('collapsed')){accordionBody.addClass('expanded');accordionBody.removeClass('collapsed');accordionHeader.addClass('expanded');accordionHeader.removeClass('collapsed')}
else{accordionBody.addClass('collapsed');accordionBody.removeClass('expanded');accordionHeader.addClass('collapsed');accordionHeader.removeClass('expanded')}
event.preventDefault()})})(jQuery)