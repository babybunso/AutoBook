$(function() {
	
	$("#carownerslist_car_id").select2();
	$('#car_brands').change(function () {

		var selDpto = $('#car_brands').val(); // <-- change this line
		console.log(selDpto);
    
		$.ajax({
		    url: "carownerslists/change_dropdown/" +selDpto,
		    async: false,
		    type: "GET",
		    data: "filter="+selDpto,
		    dataType: "html",
    
		    success: function(data) {
			//$('#carownerslist_car_id').html(data);
			
			$('#carownerslist_car_id').html('');  

			var json = $.parseJSON(data);
			console.log(json.length)
			if(data.length > 0) {
				console.log(json)
				for (i = 0; i < json.length; i++) { 
					console.log(json[i])
					//$.each( data[i], function( key, value ) {
						$('#carownerslist_car_id').append('<option value="'  + json[i].car_id +  '">'+ json[i].car_model+'</option>');
					//})
				 }
			
			}
			//<option value="<?php echo $group->car_id?>"<?php echo (($group->car_id == $current_groups)) ? ' selected': ''; ?>><?php echo $group->car_model?></option>
		    }
		})
	    });
	
	// handles the submit action
	$('#submit').click(function(e){
		// change the button to loading state
		var $this = $(this);
		var loadingText = '<i class="fa fa-spinner fa-spin"></i> Loading...';
		if ($(this).html() !== loadingText) {
			$this.data('original-text', $(this).html());
			$this.html(loadingText);
		}

		// prevents a submit button from submitting a form
		e.preventDefault();

		// submits the data to the backend
		$.post(ajax_url, {
			carownerslist_carowner_id: $('#carownerslist_carowner_id').val(),
			carownerslist_car_id: $('#carownerslist_car_id').val(),
			carownerslist_plate_number: $('#carownerslist_plate_number').val(),
			carownerslist_rent_price: $('#carownerslist_rent_price').val(),
			carownerslist_status: $('#carownerslist_status').val(),
			car_brands	:$('#car_brands').val(),
			car_mileage: $('#car_mileage').val(),
			car_mileage_discount:$('#car_mileage_discount').val(),
			rent_milediscount:$('#rent_milediscount').val(),
			//carownerslist_car_id : $('#carownerslist_car_id').val(),
			car_idb : $('#car_idb').val(),
			[csrf_name]: $('input[name=' + csrf_name + ']').val(),
		},
		function(data, status){
			// handles the returned data
			var o = jQuery.parseJSON(data);
			if (o.success === false) {
				// reset the button
				$this.html($this.data('original-text'));
				
				// shows the error message
				alertify.error(o.message);

				// displays individual error messages
				if (o.errors) {
					for (var form_name in o.errors) {
						$('#error-' + form_name).html(o.errors[form_name]);
					}
				}
			} else {
				// refreshes the datatables
				$('#datatables').dataTable().fnDraw();

				// closes the modal
				$('#modal').modal('hide'); 

				// restores the modal content to loading state
				restore_modal(); 

				// shows the success message
				alertify.success(o.message); 
			}
		}).fail(function() {
			// shows the error message
			//alertify.alert('Error', unknown_form_error);

			// reset the button
			$this.html($this.data('original-text'));
		});
	});

	// disables the enter key
	$('form input').keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});

	$('#car_mileage').on('blur', function (e) {
		e.preventDefault();
		console.log("SAD")
		let mileage = $('#car_mileage').val();
		const flat = 5;

		/* switch(mileage) 
		{
			default: 
				mileage_discount = 5;
				break;
		} */

		let mileage_discount = (mileage / 1000) * flat;
		$('#car_mileage_discount').val(mileage_discount);
		let rent_price = $('#car_idb').val() * .0015;
		$('#carownerslist_rent_price').val(rent_price);
		let value = rent_price  - mileage_discount;
		$('#rent_milediscount').val(value); 

	});
});