function userIsAuthorizedToPublish() {
	var nativeLang = document.forms["publishSentenceForm"]["nativeLang"].value;
	alert(nativeLang);
	if (nativeLang == "") {
		return false;
	}else {
		return true;
	}
}

$(document).on('click', '#publishSentenceBtn', function(e){
	if(userIsAuthorizedToPublish()){
		alert("Indeed you can publish");
		$("#publishSentenceForm").submit();
	}else{
		alert("Cannot");
		e.preventDefault();
		$('#profileSetupModal').modal('show');
	}
});

$(document).on('input', '#new-sentence', function(e){
	var length = $(this).val().length;
	var max = $("#char-max").text();
	$("#char-count").text(length);
	if(length>max)
		$("#char-count-div").addClass("text-danger");
	else
		$("#char-count-div").removeClass("text-danger");

	if(length > 200)
		fontSize = '20px';
	else if(length > 100)
		fontSize = '25px';
	else if(length > 40)
		fontSize = '30px';
	else
		fontSize = '50px';

	$(this).css('font-size', fontSize);

});