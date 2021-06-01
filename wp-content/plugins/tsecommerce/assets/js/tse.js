jQuery(document).ready(function(){
	jQuery('.add_to_cart_btn').click(function(e){
		e.preventDefault();
		var prod_id = jQuery(this).data('prod_id');
		alert(prod_id);

		jQuery.ajax({
		type : "post",
		url : myAjax.ajaxurl,
		cache: false,
		data : {action: "add_product_in_cart", prod_id : prod_id},
		success: function(response) {
			debugger;
		if(response.type == "success") {
			jQuery("#like_counter").html(response.like_count);
		}
		else {
			alert("Your like could not be added");
		}
		}
	  });
	});
});