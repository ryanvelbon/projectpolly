
$(".like-btn, .dislike-btn").click(function(event) {

	event.preventDefault();

	id = $(this).data("sentence-id");

	$.ajax({
		type: "POST",
		url: "/update-like",
		data: {
			sentenceId: id,
			isLike: $(event.target).attr('class').includes('thumbs-up'),
			_token: $("#_token").val()
		},
		success: function(response) {
			// deactivate both icons
			$('#like-btn-'+id).removeClass("active");
			$('#dislike-btn-'+id).removeClass("active");

			switch(response['reaction']) {
				case 'neither':
					// do nothing
					break;
				case 'like':
					$(event.target).addClass("active");
					break;
				case 'dislike':
					$(event.target).addClass("active");
					break;
			}
		},
		error: function(response) {
			alert("error");
		}
	});
});

$(".fa-bookmark").click(function(event) {
	id =$(this).data("sentence-id");

	$.ajax({
		type: "POST",
		url: "/update-bookmark",
		data: {
			sentenceId: id,
			_token: $("#_token").val()
		},
		success: function(response) {
			if(response['isBookmarked']) {
				$(event.target).addClass("active");
			}else {
				$(event.target).removeClass("active");
			}
			console.log(response);
		},
		error: function(response) {
			console.log(response);
		}
	});
});