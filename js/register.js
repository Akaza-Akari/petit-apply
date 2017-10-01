(function() {
	$('#register_form').fadeIn('slow');
})();

function noti_twitter() {
	$('#twitter_oauth').fadeIn('slow');
	$('#discord_oauth').css('display', 'none');
}

function noti_email() {
	$('#discord_oauth').fadeIn('slow');
	$('#twitter_oauth').css('display', 'none');
}

function notiShow(name) {
	var types = [ 'twitter', 'discord', 'email' ];
	if(!types.includes(name)) return;

}

function check() {
	if(!validator.isEmail(document.getElementById('emailvalue').value)) {
		alert('정상적인 이메일 주소가 아닙니다.');
		return false;
	} else {
		var returnValue = confirm('"'+document.getElementById('emailvalue').value+'"\n이 이메일 주소가 맞습니까?');
		if(returnValue) return true; else return false;
	}
}