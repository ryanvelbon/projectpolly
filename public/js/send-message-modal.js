function alreadyContacted() {
	// pending ...
	return false;
}

$(document).on('click', '#sendMsgBtn1', function(e){
	alert("gay");
	if(alreadyContacted()){
		// redirect to message thread
	}else{
		e.preventDefault();
		$('#sendMsgModal').modal('show');
	}
});