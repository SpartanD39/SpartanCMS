$(".confirmpostdelete").click(function(){
	return confirm('Are you sure you want to delete this post?');
});

$(".confirmcategorydelete").click(function(){
	return confirm('Are you sure you want to delete this category?');
});

$(".confirmcommentdelete").click(function(){
	return confirm('Are you sure you want to delete this comment?');
});

$(".confirmstatus").click(function(){
	return confirm('Are you sure you want to change this comments status?');
});

$('#userProfileForm').submit(function() {

	var pass = $('#user_password').val();
	var pass_confirm = $('#user_password_confirm').val();
	var allowsubmit = false;

	if(pass !== undefined  && pass_confirm !== undefined) {
		if(pass == pass_confirm) {
			allowsubmit = true;
		} else {
			allowsubmit = false;
		}
		return allowsubmit;
	} else {
		return true;
	}





});
