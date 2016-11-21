// onLoad
$(refresh());

// ajax Loading indicator

$('.ajax-loader').html('<a><img src="/images/ajax_loader.gif">Loading</a>');

$('.ajax-loader').bind('ajaxStart', function(){
	$(this).show();
}).bind('ajaxStop', function(){
	$(this).hide();
});

//Search

function searchItem() {
	//var term = $('#searchField').value;
	var term = document.getElementById('searchField').value;

	$.ajax({
		type: "get",
		url: "/preorder/search",
		data: "search="+term,
		success : function(data){
			var result='';

			for(var i=0;i<data.length;i++){
				result += '\
				<div class="col-lg-3">\
			    <div class="thumbnail">\
			      <img id="productImg" src="/images/'+data[i].temp_pic+'" onerror=\'if (this.src != "/images/img_placeholder.png") this.src = "/images/img_placeholder.png";\' style="height:266px;width266px;">\
			      <div class="caption">\
			        <h3>'+data[i].name+'</h3>\
			        <p>Price:<span class="badge"> $'+data[i].price+'</span></p>\
			        <p><a href="" class="btn btn-warning">Preview</a></p>\
			        <p><button id="btnOrder" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" data-id="'+data[i].id+'">Order</button></p>\
			      </div>\
			    </div>\
			  </div>';
			}

			if (result == '') {
				$("#searchResults").html('<div class="alert alert-danger">\
		 								No Templates available for this Name.\
		 							</div>');
			} else {
				$("#searchResults").html(result);
			}

		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError);
		}
	});
}

//Modal window

$('#modal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var id = button.data('id') // Extract info from data-* attributes
	var qty;
	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	$.ajax({
		type: "get",
		url: "/preorder/iteminfo",
		data: "id="+id,
		success : function(data){
			//alert(data[0].uvalue);
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

			$('#ModalHeading').text('Add '+ data[0].description +' to preorder');
			$('#qtyField').val(1);
			$('#unitCost').text(data[0].price);
			$('#unitCost').data('price', data[0].price);

			$('#totalCost').text(data[0].price);
			$('#qtyField').data('max', data[0].qtyindisplay)

			$('#productImg').attr('src', '/images/img_placeholder.png');

			qty = document.getElementById('qtyField').value;

			$('#btnAddItem').data('id', data[0].id);
			$('#btnAddItem').data('qty', 1);
			// Add item to order
			$("#btnAddItem").off('click');
			$("#btnAddItem").on('click', function(){addItem(id, qty)});
		}

	});

	// Update total on modal
	$('#qtyField').keyup(function() {
		$('#qtyGroup').removeClass('has-error');
		$('#lblQtyError').addClass('hidden');
		$('#btnAddItem').removeClass('disabled');
		qty = $('#qtyField').val();
		var price = parseInt($('#unitCost').data('price'));
		var total = qty * price;
		if (isNaN(qty) || qty<=0) {
			$('#qtyGroup').addClass('has-error');
			$('#lblQtyError').html('Enter valid amount');
			$('#lblQtyError').removeClass('hidden');
			$('#btnAddItem').addClass('disabled');
		} else if (qty>$('#qtyField').data('max')) {
			$('#qtyGroup').addClass('has-error');
			$('#lblQtyError').html('Exceeds available amount');
			$('#lblQtyError').removeClass('hidden');
			$('#btnAddItem').addClass('disabled');
		} else if (!(qty%1==0)) {
			$('#qtyGroup').addClass('has-error');
			$('#lblQtyError').html('Not a whole number');
			$('#lblQtyError').removeClass('hidden');
			$('#btnAddItem').addClass('disabled');
		}
		else {
			$('#totalCost').text(total.toFixed(2));
			$('#btnAddItem').data('qty', qty);
			// Add item to order
			$("#btnAddItem").off('click');
			$("#btnAddItem").on('click', function(){addItem(id, qty)});
		}
	});

});

$('#checkoutModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget); // Button that triggered the modal

	$.ajax({
		type: "get",
		url: "/preorder/sessionitems",
		data: "",
		success : function(data){
			var body = "";
			var subtotal = 0.0;
			$('#btnCheckout').removeClass('disabled');
			if (data.length==0) {
				body ='<tr><td><h4><span class="bg-warning">No items added</span><h4></td</tr>';
				$('#checkoutBody').html(body);
				$('#btnCheckout').addClass('disabled');
				return;
			}

			for(var i=0;i<data.length;i++) {
				body +='<tr>\
      				<td>'+data[i].description+'</td>\
	      			<td>'+data[i].qty+'</td>\
	      			<td>'+data[i].price+'</td>\
	      			<td>'+(parseInt(data[i].qty)*(data[i].price))+'</td>\
	      		</tr>';
				subtotal += (parseInt(data[i].qty)*(data[i].price));
			}
			body +='<tr>\
      				<td> </td>\
	      			<td> </td>\
	      			<td><h4>Sub Total<h4></td>\
	      			<td><h3><b>'+subtotal+'<h3></b></td>\
	      		</tr>';
			$('#checkoutBody').html(body);


		}});

});

// Change category

function changeCategory(category) {
	$("#categoryName").text(category);

	refresh(category);
	//refresh();
}

// Refresh

function refresh(category) {
	category = typeof category !== 'undefined' ? category : 'All';


	$.ajax({
		type: "get",
		url: "/preorder/items",
		data: "category="+category,
		success : function(data){
			var result='';

			for(var i=0;i<data.length;i++){
				result += '\
		 	<div class="col-lg-3">\
			    <div class="thumbnail">\
			      <img id="productImg" src="/images/'+data[i].temp_pic+'" onerror=\'if (this.src != "/images/img_placeholder.png") this.src = "/images/img_placeholder.png";\' style="height:266px;width266px;">\
			      <div class="caption">\
			        <h3>'+data[i].name+'</h3>\
			        <p>Price:<span class="badge"> $'+data[i].price+'</span></p>\
			        <p><a href="" class="btn btn-warning">Preview</a></p>\
			        <p><button id="btnOrder" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal" data-id="'+data[i].id+'">Order</button></p>\
			      </div>\
			    </div>\
			  </div>';
			}

			if (result == '') {
				$("#searchResults").html('<div class="alert alert-danger">\
		 								No Templates available for this category.\
		 							</div>');
			} else {
				$("#searchResults").html(result);
			}

		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError);
		}
	});
}

// Add Item
function addItem(id, qty) {
	if ( qtyValidation() ) {
		$.ajax({
			type: "get",
			url: "/preorder/additem",
			data: "id="+id+"&qty="+qty,
			success : function(data){
				var result='';

				$('#modal').modal('hide');
				location.reload();


			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError);
			}
		});
	}

}

// Checkout

$('#btnCheckout').click(function(){
	var self = $(this);
	swal({
			title: "Confirm",
			text: "Finish the Order ?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Finish it!",
			closeOnConfirm: false
		},
		function(isConfirm){
			if(isConfirm){
				swal("Finish !","Your have palced and order", "success");
				setTimeout(function() {
					var description = $('#description').val();

					$.ajax({
						type: "get",
						url: "/preorder/checkout",
						data: {description : description},
						success : function(data){
							$('#checkoutModal').modal('hide');
							$('#description').val('No remarks.');
							window.location.href = '/preorder/pending';

						}});
				}, 2000);
			}
			else{
				// swal("Cancelled","Your Cart will remain same", "error");
			}
		});

});

// Clear session_items

$('#btnClear').click(function(){
	var self = $(this);
	swal({
			title: "Are you sure?",
			text: "Your Cart will be Cleared!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Clear it!",
			closeOnConfirm: false
		},
		function(isConfirm){
			if(isConfirm){
				swal("Clear!","Your cart items are cleared", "success");
				setTimeout(function() {
					$.ajax({
						type: "get",
						url: "/preorder/emptycart",
						data: "",
						success : function(data){
							$('#checkoutModal').modal('hide');
							$('#description').val('No remarks.');
							location.reload();

						}});
				}, 2000);
			}
			else{
				swal("Cancelled","Your Cart will remain same", "error");
			}
		});
});

// Add description to preorder

// Validation
// validate after lost focus
function qtyValidation() {
	var qty = $('#qtyField').val();
	$('#lblQtyError').addClass('hidden');
	if ( qty<=0 || qty == null || qty == "" || qty == "undefined" || isNaN(qty)) {
		$('#qtyGroup').attr('class', 'form-group has-error');
		$('#lblQtyError').removeClass('hidden');
		$('#qtyField').focus();
		return false;
	} else if (qty > 999999){
		return false;
	} else
	{
		return true;
	}

}