// Javascript for Order object
const order = {
	// Add and event listener when the DOM is loaded
	init : function() {
		document.addEventListener( 'DOMContentLoaded', this.ready, false);
	},
	// To be execute when the DOM is ready
	ready : function() {
		console.log( 'In order.init()');
		// Get the first form with id  in { #order_create, #order_update}
		let order = document.querySelector( '#order_create, #order_update');
		if ( ( order !== undefined) && ( order !== null) ) {
			console.log( ' Selected order : ' +  order.id);
			// Get all elements with class « auto_submit »
			let collection = document.getElementsByClassName( 'auto_submit');
			// Loop over the collection elements
			Array.from( collection).forEach( function( element) {
				// Submit the form on « change » event for all the elements
				element.addEventListener( 'change', () => {
					order.submit();
				});
				console.log( ' - ' + element.id);
			});
		}
		// Set a kind of « readonly » mode for #order_read and #order_delete
		// To do that set attribute disabled="disabled" for all fieldset elements
		let elements = document.querySelectorAll( '#order_read fieldset, #order_delete fieldset');
		if ( ( elements !== undefined) && ( elements !== null) ) {
			// Loop over the elements collection
			Array.from( elements).forEach( function( e) {
				// Set attribute disabled="disabled" for this elements
				e.setAttribute( 'disabled', 'disabled');
			});
		}
	}
}

// On DOM concent loaded initialization
order.init();
