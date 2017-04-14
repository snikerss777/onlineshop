

function acceptTransaction (id) {
	$.get('/acceptTransaction/'+id)
		.done(function(data){
			console.log(data);
		});
}