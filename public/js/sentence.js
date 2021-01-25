// do we need script tag?








$(".like-btn, .dislike-btn").click(function(event) {

	$(this).css("color", "yellow");

	event.preventDefault();

	$.ajax({
		type: "POST",
		url: "/update-like-sentence-status",
		data: {
			sentenceId: $(this).data("sentence-id"),
			isLike: $(event.target).attr('class').includes('thumbs-up'),
			_token: $("#_token").val()
		},
		success: function(response) {
			// console.log(response);
			alert("success");
		},
		error: function(response) {
			// console.log(response);
			alert("error");
		}
	});
});