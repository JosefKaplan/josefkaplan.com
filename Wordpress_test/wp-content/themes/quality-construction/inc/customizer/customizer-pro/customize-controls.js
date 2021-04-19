( function( api ) {

	// Extends our custom "quality-construction" section.
	api.sectionConstructor['quality-construction'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
