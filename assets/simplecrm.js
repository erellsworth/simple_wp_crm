(function( $ ) {

	$('body').on('submit', '.simple_crm_form', function(e){
		e.preventDefault();
		var formData = $( this ).serializeArray();
		var url = $(this).attr('action');
		var outputElem = $('.simple_crm_form_response', this);
		var button = $('button', this);
		var success_message = $(this).data('success_message');
		
		button.hide();
		outputElem.html('<div class="simple_cms_spinner"></div>');
		
		var post_data = {
			'action': 'simple_cms_form',
		}
	
		formData.map((data, index)=>{
			post_data[data.name] = data.value;
			return data;
		});

		$.post(url, post_data, function(response) {
			console.log('Got this from the server: ', response);
			if(response.success){
				outputElem.html('<p>' + success_message + '</p>');
			} else {
				var errors = '<h3>Opps... something went wrong</h3>';
				
				response.data.map((error, index)=>{
					errors += '<p>' + error + '</p>';
					return error;
				});

				outputElem.addClass('simple_cms_error').html(errors);
				button.show();
			}
		});		
	});

})( jQuery );