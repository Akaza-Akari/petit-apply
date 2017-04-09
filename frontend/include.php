<?php
namespace osu_petit;
class Frontend {

function defaultIncludes() {
echo('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	crossorigin="anonymous">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
	integrity=sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN
	crossorigin="anonymous">
<script
	src="https://code.jquery.com/jquery-3.2.1.min.js"
	integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	crossorigin="anonymous">
</script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
	integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
	crossorigin="anonymous">
</script>
<script
	src="./js/register.js"
	crossorigin="anonymous">
</script>
'); }

if(is_null($array['username']) || is_null($array['rank']) || is_null($array['need_set'])) {
	die('needed values are null');
}

function check($array) {
$this->defaultIncludes(); ?>
입력하신 사용자 이름은 "<?php echo $array['username']; ?>"입니다.<br>
사용자 정보<br>
<?php echo $array['username'] . ' (#' .  $array['rank'] . ') (' . $array['mode'] . ')<br>'; ?>
이 모드를 플레이 한 횟수 : <?php echo $array['pc']; ?><br>
퍼포맨스 포인트 : <?php echo $array['pp']; ?><br>
<?php if($array['now_set'] === $array['need_set']) { ?>
Occupation이 일치하는 것을 확인하였습니다.<br>
<?php $this->register(); } else if(empty($array['now_set'])) { ?>
현재 프로필에 'Occupation'이 설정되지 않았습니다.<br>
사용자 본인임을 인증하기 위해서, 프로필의 'Occupation'을 <?php echo $array['need_set']; ?>으로 바꿔주세요.
<?php } else { ?>
현재 설정 된 프로필의 'Occupation' : <?php echo $array['now_set']; ?><br>
사용자 본인임을 인증하기 위해서, 프로필의 'Occupation'을 <?php echo $array['need_set']; ?>으로 바꿔주세요.
<?php } ?>
<br>

<?php }

function register() {
global $twitter;?>

<div id="register_form" style="display: none">
	<div id="notitype">
		<label class="radio-inline" onclick="noti_twitter();"><input type="radio" name="noti">트위터 (인증 필요)</div></label>
		<label class="radio-inline" onclick="noti_discord();"><input type="radio" name="noti">Discord (인증 필요)</div></label>
	</div>
	<div id="twitter_oauth" style="display: none">트위터 DM을 통한 알림은 트위터 계정 인증이 필요합니다. 버튼을 눌러 인증 과정을 시작 해 주세요.
		<a href="https://api.osu.life/doTwitterLogin.php"><button class="btn btn-info">
		<i class="fa fa-twitter"></i>&nbsp;시작</button></a>
	</div>
	<div id="discord_oauth" style="display: none">준비중입니다. 대신 트위터 알림 기능을 사용해주시면 감사하겠습니다.</div>
</div>
<script>regform_view();</script>

<?php }
}
