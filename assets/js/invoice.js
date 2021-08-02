//Block characters for the number fields
var inputNumberBox = [document.getElementById("discount-id"), document.getElementById("quantity"), document.getElementById("price")];
var invalidChars = [
  	"-",
  	"+",
  	"e",
];

for(var i=0; i<inputNumberBox.length ; i++) {
	inputNumberBox[i].addEventListener("keydown", function(e) {
	  	if (invalidChars.includes(e.key)) {
	    	e.preventDefault();
	  	}
	});
}

//Call method to calculate total amt on keyup event of discount
$('#discount-id').keyup(function() {
 	calculateTotalAmt();
});

//Call method to calculate total amt on change event of discount-in 
$('#discount-in').change(function() {
 	calculateTotalAmt();
});
// calculate total amt on discount
function calculateTotalAmt (){
	var discountIn = $('#discount-in').val();
 	var discount = $('#discount-id').val();
 	var subTotalWithoutTaxAmt = $('#sub-total-without-tax').val();
 	var subTotalWithTaxAmt = $('#sub-total-with-tax').val();
 	var totalAmt = subTotalWithTaxAmt;
 	if(discountIn == '%'){ 
 		totalAmt = subTotalWithTaxAmt - (subTotalWithTaxAmt*discount/100)
 	} else { // discount in $
 		totalAmt = subTotalWithTaxAmt - discount;
 	}
 	totalAmt = totalAmt.toFixed(2);
 	$('#total-amt').html(totalAmt);
 	var data = {'discount' : discount, 'discount_in' : discountIn, 'sub_total' : subTotalWithoutTaxAmt, 'sub_total_with_tax' : subTotalWithTaxAmt, 'flag' : 'order-updates', 'total_with_discount' : totalAmt}
 	$.ajax({
 		url: 'Invoice.php',
	    type: 'POST',
	    data: data,
	    success: function(response) { 
	    	if(response) {
	    		return;
	    	} 
	    }
 	});
}

// Ajax - backend call to save Items
$('#item-save').click(function() {
	var name = $('#item-name').val();
	var quantity = $('#quantity').val();
	var price = $('#price').val();
	var tax = $('#tax').val();
	var data = { 'item_name': name, 'quantity' : quantity, 'unit_price': price, 'tax' : tax,'flag' : 'item-save'}

	$.ajax({
	    url: 'Invoice.php',
	    type: 'POST',
	    data: data,
	    success: function(response) { 
	    	if(response) {
	    		$('#close-modal').trigger('click');
	    		location.reload();
	    	} 
	    }
	});
});

