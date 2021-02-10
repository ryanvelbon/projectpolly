$(".follow-btn").click(function(event) {

	event.preventDefault();

	var btn = this;

	$.ajax({
		type: "POST",
		url: "/update-follow",
		data: {
			id: $(this).val(),
			_token: $('meta[name="_token"]').attr('content')
		},
		success: function(response) {
			console.log(response);
			if(response['isFollowing']){
				$(btn).removeClass("btn-outline-primary not-following");
				$(btn).addClass("btn-primary following");
			}else{
				$(btn).removeClass("btn-primary following");
				$(btn).addClass("btn-outline-primary not-following");
			}
		},
		error: function(response) {
			console.log(response);
		}
	});
});