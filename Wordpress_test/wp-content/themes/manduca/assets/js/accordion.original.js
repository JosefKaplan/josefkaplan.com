/**
 * Add accordion - collapsed paragraph to page
 *
 * Accessible - of course
 * and also good for SEO
 * 
 * @ Theme: Manduca - focus on accessibility
 * @ Since 17.10.3
 
 */


(function($) {
    
        //Wrap all elements to be preparing for accordion
        $( manducaAccordionArgs.selector ).each(function(){ 
         $(this).nextUntil( manducaAccordionArgs.selector ).wrapAll('<div class="accordion-body" />');
        });
        
        // Inital values of the collapsed items.
        $(".accordion-body").addClass( "collapsed" );
        $( manducaAccordionArgs.selector ).addClass( "collapsed" )
                                .prepend( manducaAccordionArgs.icon );
        
        
        // Click 
         $(  manducaAccordionArgs.selector ).click(function(){
            
            // If svg or use is clicked, the clas should be added alwayst to h2
            if( event.target.tagName.toLowerCase() === 'svg' ) {
                accordionHeader = $( event.target ).parent();
            }
            
            if( event.target.tagName.toLowerCase() ===  manducaAccordionArgs.header) {
                accordionHeader = $( event.target );
            }
            var accordionBody = accordionHeader.next();
                
            if ( accordionBody.hasClass( 'collapsed') ) {
                accordionBody.addClass('expanded');
                accordionBody.removeClass('collapsed');
                accordionHeader.addClass('expanded');
                accordionHeader.removeClass('collapsed');
            }
            else {
                accordionBody.addClass('collapsed');
                accordionBody.removeClass('expanded');
                accordionHeader.addClass('collapsed');
                accordionHeader.removeClass('expanded');
            }
            
            event.preventDefault();
         });
  
})(jQuery);

