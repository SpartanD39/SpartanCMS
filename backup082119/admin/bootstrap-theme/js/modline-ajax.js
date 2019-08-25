$("#genModLine").submit(function( event ){
	event.preventDefault();
	var $form = $(this),
	modPack = $form.find("input[name='modPackSelect']:checked").val(),
	url = $form.attr("action");

	if (jQuery.type(modPack) === "undefined") {
		var content = "Please select a modpack";
		$("#modLineContainer").html(content);
		return false;		
	}
		
	var posting = $.post(url, { modPackSelect: modPack});
	posting.done(function(data) {
		var content = $(data);
		$("#modLineContainer").html(content);
	});
});