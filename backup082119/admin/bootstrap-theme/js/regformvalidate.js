$(document).ready(function() {	

	$('#userRegForm').submit(function(e) {
	var userName = $('#username').val();
	var userEmail = $('#useremail').val();
	var userPass = $('#userpass').val();
	var userPassConf = $('#userpassConf').val();
	$(".error").remove();

	if(userName.length < 1) {
		    $('#username').after("<span class='error'> Please provide a username.</span>");
	    }
	
	if(userEmail.length < 1) { 
                $('#useremail').after("<span class='error'> Please provide an email address.</span>");
       	}

	if(userPass.length < 1) {
                $('#userpass').after("<span class='error'> Please select a password.</span>");
        }

	 if(userPass != userPassConf) {
                $('#userpassConf').after("<span class='error'> Please confirm your password.</span>");
       	}
    return true;
	});

});
