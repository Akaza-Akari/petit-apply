function regform_view() {
	$("#register_form").fadeIn("slow");
}

function noti_twitter() {
	$("#twitter_oauth").fadeIn("slow");
	$("#email_verify").css('display', 'none');
};
function noti_email() {
	$("#email_verify").fadeIn("slow");
	$("#twitter_oauth").css('display', 'none');
};

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function check() {
	if(!validateEmail(document.getElementById('emailvalue').value)) {
		alert("정상적인 이메일 주소가 아닙니다.");
		return false;
	}
	else {
		var returnValue = confirm('"'+document.getElementById('emailvalue').value+'"\n이 이메일 주소가 맞습니까?');
		if(returnValue) return true; else return false;
	}
}