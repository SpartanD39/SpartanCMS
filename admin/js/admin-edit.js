tinymce.init({
    selector: '#post_content',
	plugins: [
		'autosave spellchecker table'
		],
	menubar: 'edit view format',
	contextmenu: "link image imagetools table spellchecker"
  });
  
 
setInterval(function(){
 
    	var $form = $("#postEditForm"),
    	postData = $form.serialize(),
    	url = $form.attr("action");
    	
    	console.log(postData);

}, 60000);
