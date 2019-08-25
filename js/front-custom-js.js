$("#addcomment").submit(function(event){
	
	event.preventDefault();
	var $form = $(this);
	postData = $form.serialize();
	url = $form.attr("action");
	
	var posting = $.post(url, {postData});
	posting.done(function(data) {
		var content = $(data);
		$("#submitstatus").html(content);
	});

});