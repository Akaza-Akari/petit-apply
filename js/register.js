function regform_view() {
	$("#register_form").fadeIn("slow");
}

function noti_twitter() {
	$("#twitter_oauth").fadeIn();
	$("#email_verify").css('display', 'none');
};
function noti_email() {
	$("#email_verify").fadeIn();
	$("#twitter_oauth").css('display', 'none');
};