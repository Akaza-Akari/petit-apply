<?php
namespace osu_petit;

class Frontend {

	public function __construct($apiRoot) {
		$this->apiRoot = $apiRoot;
	}

	private $_stylesheets = [
		['https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', 'sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u'],
		['https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 'sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN']
	];

	private $_scripts = [
		['https://code.jquery.com/jquery-3.2.1.min.js', 'sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4='],
		['https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', 'sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa']
	];

	protected function includeTop() {
		echo('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		</script>
		<script type="text/javascript" src="./js/lib/validator.min.js" crossorigin="anonymous"></script>
		');
	}

	protected function includeBottom() {
		echo('<script type="text/javascript" src="./js/register.js" crossorigin="anonymous"></script>');
	}

	public function check($array) {
		if(is_null($array['username']) || is_null($array['rank']) || is_null($array['need_set'])) die('needed values are null');
		$this->includeTop(); ?>
		입력하신 사용자 이름은 "<?php echo $array['username']; ?>"입니다.<br>
		사용자 정보<br>
		<?php echo $array['username'] . ' (#' .  $array['rank'] . ') (' . $array['mode'] . ')<br>'; ?>
		이 모드를 플레이 한 횟수 : <?php echo $array['pc']; ?><br>
		퍼포맨스 포인트 : <?php echo $array['pp']; ?><br> <?php
		if($array['now_set'] === $array['need_set']) { ?>
			Occupation이 일치하는 것을 확인하였습니다.<br> <?php
			$this->_formRegister();
		} else if(empty($array['now_set'])) { ?>
			현재 프로필에 'Occupation'이 설정되지 않았습니다.<br>
			사용자 본인임을 인증하기 위해서, 프로필의 'Occupation'을 <?php echo $array['need_set']; ?>으로 바꿔주세요. <?php
		} else { ?>
			현재 설정 된 프로필의 'Occupation' : <?php echo $array['now_set']; ?><br>
			사용자 본인임을 인증하기 위해서, 프로필의 'Occupation'을 <?php echo $array['need_set']; ?>으로 바꿔주세요. <?php
		}
		$this->includeBottom(); ?>
		<br>
	<?php
	}

	private function _formRegister() {
	?>
		<div id="register_form" style="display: none">
			<div id="notitype">
				<label class="radio-inline" id="twitter"><input type="radio" name="noti">Twitter</input></label>
				<label class="radio-inline" id="discord"><input type="radio" name="noti">Discord</input></label>
				<label class="radio-inline" id="email"><input type="radio" name="noti">Email</input></label>
			</div>
			<div id="auth_form">
				<div id="twitter" style="display: none">트위터 DM을 통한 알림은 트위터 계정 인증이 필요합니다. 버튼을 눌러 인증 과정을 시작 해 주세요.
					<a href="<?php echo $this->apiRoot; ?>doTwitterLogin.php"><button class="btn btn-info">
					<i class="fa fa-twitter"></i>&nbsp;Start</button></a>
				</div>
				<div id="discord" style="display: none">준비중입니다. 대신 트위터 알림 기능을 사용해주시면 감사하겠습니다.</div>
				<div id="email" style="display: none">
					osu!petit 대회 관련 알림을 받으실 이메일 주소를 입력해주세요.
					<input type="email" name="emailvalue" id="emailvalue"><button class="btn btn-info" onclick="check();">
					<i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;Next</button></a>
				</div>
			</div>
		</div>
	<?php
	}

}
