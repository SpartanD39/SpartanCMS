$(".confirmpostdelete").click(function(){
	return confirm('Are you sure you want to delete this post?');
});

$(".confirmcategorydelete").click(function(){
	return confirm('Are you sure you want to delete this category?');
});

$(".confirmProfileDelete").click(function(){
	return confirm('Are you sure you want to delete this user?');
});

$(".confirmcommentdelete").click(function(){
	return confirm('Are you sure you want to delete this comment?');
});

$(".confirmstatus").click(function(){
	return confirm('Are you sure you want to change this comments status?');
});

function passwords_match() {
	var password = $("#user_password").val();
	var password_confirm = $("#user_password_confirm").val();
	var retval = false;
	console.log(password);
	console.log(password_confirm);

	if(password != password_confirm) {
		alert('Passwords do not match');
		retval = false;
	} else {
		retval =  true;
	}
	return retval;
}
