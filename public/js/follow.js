$(".follow-btn").click(function(event) {
	updateFollow($(this), event);
});

// for dynamically generated elements, such as in community.blade.php
$("#members").on("click", ".follow-btn", function(event) {
	updateFollow($(this), event);
});



function updateFollow(btn, event) {

	event.preventDefault();

	$.ajax({
		type: "POST",
		url: "/update-follow",
		data: {
			id: btn.val(),
			_token: $('meta[name="_token"]').attr('content')
		},
		success: function(response) {
			console.log(response);
			if(response['isFollowing']){
				btn.removeClass("btn-outline-primary not-following");
				btn.addClass("btn-primary following");
			}else{
				btn.removeClass("btn-primary following");
				btn.addClass("btn-outline-primary not-following");
			}
		},
		error: function(response) {
			console.log(response);
		}
	});
}