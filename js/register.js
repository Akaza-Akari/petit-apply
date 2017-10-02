$('#register_form').fadeIn('slow');

$('#notitype > label').click(function() {
	var types = [ 'twitter', 'discord', 'email' ];
	if(!types.includes(this.id)) return;
	$('#auth_form > div:visible').hide();
	$('#auth_form > #' + this.id).fadeIn('slow');
});

function reCheck() {
	return confirm('"'+document.getElementById('emailvalue').value+'"\n이 이메일 주소가 맞습니까?');
}

function check() {
	const isValidateEmail = validator.isEmail(document.getElementById('emailvalue').value)

	return (isValidateEmail)
		? reCheck()
		: alert('정상적인 이메일 주소가 아닙니다.');
}
