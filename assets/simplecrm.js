(function( $ ) {

	$('body').on('submit', '.simple_crm_form', function(e){
		e.preventDefault();
		var formData = $( this ).serializeArray();
	});

})( jQuery );