입력하신 사용자 이름은 '<?php echo $GLOBALS['osu']['username']; ?>'입니다.
<?php echo $GLOBALS['osu']['mode']; ?> 모드를 선택하셨습니다.
<?php if($GLOBALS['osu']['nowValue'] != $GLOBALS['osu']['needValue']) {
	echo `현재 Occupation이 `.empty($GLOBALS['osu']['nowValue']) ? '설정되어 있지 않습니다.' : `'$GLOBALS[osu][nowValue]'으로 설정되어 있습니다.`;
} else {
?>
Occupation이 일치하는 것을 확인하였습니다.
대회 알림 수신을 위해 다음과 같은 방법을 사용 하실 수 있습니다. 원하시는 방식을 선택해주세요.
<div id="register_form">
	<div id="notitype">
		<label class="radio-inline" id="twitter"><input type="radio" name="noti">Twitter (DM)</input></label>
		<label class="radio-inline" id="discord"><input type="radio" name="noti">Discord</input></label>
		<label class="radio-inline" id="email"><input type="radio" name="noti">Email</input></label>
	</div>
	<div id="auth_form">
		<div id="twitter" style="display: none">트위터 DM을 통한 알림은 트위터 계정 인증이 필요합니다. 버튼을 눌러 인증 과정을 시작 해 주세요.
			<a href="<?php echo $this->apiRoot; ?>doTwitterLogin.php"><button class="btn btn-info">
			<i class="fa fa-twitter"></i>&nbsp;Start</button></a>
		</div>
		<div id="discord" style="display: none">준비중입니다.</div>
		<div id="email" style="display: none">
			알림을 수신 하실 때 사용하실 이메일 주소를 입력해주세요.
			<input type="email" id="email"><button class="btn btn-info" onclick="emailCheck();">
			<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;Next</button></a>
			<div id="emailVerifyConfirm" style="display: none">
				알림을 수신하시기 위해서는 해당 이메일 주소가 본인의 이메일 주소라는 것을 인증하여야 합니다.
				인증 코드를 발송하시기 원하신다면 버튼을 눌러주세요.
				<button class="btn btn-info" onclick="emailVerifyStart();"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;Send</button>
			</div>
			<div id="emailVerifyForm" style="display: none">
				수신하신 인증 코드를 입력하세요.
				<input type="text" id="emailcode"><button class="btn btn-info" onclick="emailVerifyEnd();"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Check</button>
			</div>
		</div>
	</div>
</div>
<?php
}