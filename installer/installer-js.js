$("#installerForm").submit(function(){
	var password = $("#user_password").val();
	var password_confirm = $("#user_password_confirm").val();
	var retval = false;

	if(password != password_confirm) {
		alert('Passwords do not match');
		retval = false;
	} else {
		retval =  true;
	}
	return retval;
});