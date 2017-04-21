
function changeNumberOfCopies(){
	$('#buttonConvert').show();
	$('#buttonOrder').hide();
	console.log('true');
	
}


$('.radio').change(function(){
	var transportCost = $('#transportCostHeading span').text();
	var totalCost = $('#hiddenTotalCost').val();
	var newTransportCost = $(this).find('span').text();
	var newTotalCost = parseFloat(totalCost) + parseInt(newTransportCost);

	$('#totalCostHeading span').text(parseFloat(newTotalCost, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ").replace(".", ",").toString()+ ' zł');
	$('#transportCostHeading span').text(parseFloat(newTransportCost, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ").replace(".", ",").toString());


});

function changeDeliveryMethod(deliveryMethodId){
	$('#delivery_method_id').val(deliveryMethodId);
}