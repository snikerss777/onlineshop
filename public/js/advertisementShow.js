
var photoCounter = 0;

function changePhoto (index) {
	$('.item').removeClass('active');
	$('#photoCarouselId'+index).addClass('active');
}

function getNextPhotos(count_of_photos) {
	if(photoCounter+3 < count_of_photos){
		photoCounter = photoCounter + 3;

		$('.onePhotoContainer').addClass('myItem');
		$('#onePhotoContainerId'+photoCounter).removeClass('myItem');
		$('#onePhotoContainerId'+(photoCounter+1)).removeClass('myItem');
		$('#onePhotoContainerId'+(photoCounter+2)).removeClass('myItem');
	}
}

function getPreviousPhotos() {
	if(photoCounter > 0){
		photoCounter = photoCounter - 3;

		$('.onePhotoContainer').addClass('myItem');
		$('#onePhotoContainerId'+photoCounter).removeClass('myItem');
		$('#onePhotoContainerId'+(photoCounter+1)).removeClass('myItem');
		$('#onePhotoContainerId'+(photoCounter+2)).removeClass('myItem');
	}
}

function goToUploadPhoto(id){
	window.location.replace('/upload/'+id);
}

function goToEditAdvertisement(id){
	window.location.replace('/advertisement/'+id+'/edit');
}

function goToCreateTransaction(id){
		window.location.replace('/transaction/create/'+id);
}