






$(".like-btn, .dislike-btn").click(function(event) {

	// $(this).css("color", "yellow");

	event.preventDefault();

	id = $(this).data("sentence-id");

	$.ajax({
		type: "POST",
		url: "/update-like-sentence-status",
		data: {
			sentenceId: id,
			isLike: $(event.target).attr('class').includes('thumbs-up'),
			_token: $("#_token").val()
		},
		success: function(response) {

			// deactivate both icons
			$('#like-btn-'+id).css("color", "var(--text3)");
			$('#dislike-btn-'+id).css("color", "var(--text3)");

			switch(response['reaction']) {
				case 'neither':
					// do nothing
					break;
				case 'like':
					$('#like-btn-'+id).css("color", "var(--like)");
					break;
				case 'dislike':
					$('#dislike-btn-'+id).css("color", "var(--dislike)");
					break;
					
			}
		},
		error: function(response) {
			// console.log(response);
			alert("error");
		}
	});
});