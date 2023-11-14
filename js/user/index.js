// Javascript for user object
const user = {
	// Add and event listener when the DOM is loaded
	init : function() {
		document.addEventListener( 'DOMContentLoaded', this.ready, false);
	},
	// To be execute when the DOM is ready
	ready : function() {
		console.log( 'In user.init()');
		// Get the first form with id  in { #user_create, #user_update}
		let user = document.querySelector( '#user_create, #user_update');
		if ( ( user !== undefined) && ( user !== null) ) {
			console.log( ' Selected user : ' +  user.id);
			// Get all elements with class « auto_submit »
			let collection = document.getElementsByClassName( 'auto_submit');
			// Loop over the collection elements
			Array.from( collection).forEach( function( element) {
				// Submit the form on « change » event for all the elements
				element.addEventListener( 'change', () => {
					user.submit();
				});
				console.log( ' - ' + element.id);
			});
		}
		// Set a kind of « readonly » mode for #user_read and #user_delete
		// To do that set attribute disabled="disabled" for all fieldset elements
		let elements = document.querySelectorAll( '#user_read fieldset, #user_delete fieldset');
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
user.init();
