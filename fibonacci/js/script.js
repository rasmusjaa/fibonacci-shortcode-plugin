jQuery(document).ready( function() {
	jQuery(".fibonacci_sequence").click( function(e) {

		jQuery(".fib_selected").removeClass("fib_selected");
		jQuery(this).addClass("fib_selected");

		action = jQuery(this).attr("data-action");
		post_id = jQuery(this).attr("data-post_id");
		nonce = jQuery(this).attr("data-nonce");
		content = jQuery(this).attr("data-content");
		meta_key = jQuery(this).attr("data-meta_key");

		jQuery.ajax({
			type : "post",
			dataType : "json",
			url : myAjax.ajaxurl,
			data : {
				action: action,
				post_id : post_id,
				nonce: nonce,
				content: content,
				meta_key: meta_key
			},
			success: function(response) {
				if(response.type != "success") {
					alert(response.status);
				}
			}
		});
	});
});