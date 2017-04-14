
var temp = 0;

function createObservedAdvertisement(advertisementId){

	$.get('/observedAdvertisement/store/'+advertisementId)
		.done(function(data){
			$('#addToObserveButton').hide();
			$('#removeFromObserveButton').show();
			temp = data;
			console.log(data);
		});
}

function deleteObservedAdvertisement(observedAdvertisementId){
	if(temp !=0){
		observedAdvertisementId = temp;
	}

	$.get('/observedAdvertisement/delete/'+observedAdvertisementId)
		.done(function(data){
			$('#removeFromObserveButton').hide();
			$('#addToObserveButton').show();

			console.log(data);
		});
}