// Do not use click() on dynamically generated elements.
// a non-dynamic parent selector has to be used. For more info read: https://stackoverflow.com/questions/6658752/click-event-doesnt-work-on-dynamically-generated-elements
$("#sentences").on("click", ".like-btn, .dislike-btn", function(event) {
	
	event.preventDefault();

	id = $(this).data("sentence-id");

	$.ajax({
		type: "POST",
		url: "/update-like",
		data: {
			sentenceId: id,
			isLike: $(event.target).attr('class').includes('thumbs-up'),
			_token: $('meta[name=_token]').attr('content')
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

$("#sentences").on("click", ".fa-bookmark", function(event) {

	event.preventDefault();

	id =$(this).data("sentence-id");

	$.ajax({
		type: "POST",
		url: "/update-bookmark",
		data: {
			sentenceId: id,
			_token: $('meta[name=_token]').attr('content')
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