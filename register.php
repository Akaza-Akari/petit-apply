<?php

	$config = parse_ini_file('config.ini', true);

	ini_set('session.cookie_domain', '.'.$config['root']['domain']);
	session_start();

	require 'osu-framework/include.php';
	$osu = new OsuTournament\Check();

	require 'frontend/include.php';
	$html = new osu_petit\Frontend($config['root']['api']);

	function getData($username, $mode, $mode_full_name) {
		$osu = $GLOBALS['osu'];
		$osu->CheckUser($username, $mode);
		isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $cf = $_SERVER['HTTP_CF_CONNECTING_IP'] : $cf = false;
		return(array(
			'pc' => $osu->Playcount,
			'pp' => $osu->Performance,
			'rank' => $osu->Rank,
			'need_set' => $osu->Occupation_Set,
			'now_set' => $osu->Occupation,
			'username' => $osu->RealID,
			'id' => $osu->OsuID,
			'mode' => $mode_full_name,
			'mode_code' => $mode,
			'ip' => $_SERVER['REMOTE_ADDR'],
			'cf' => isset($cf) ? $cf : '',
			)
		);
	}

	if(!$_POST['username'] or !$_POST['mode']) {
		echo('no post data');
	} else {
		switch($_POST['mode']) {
			case('osu'):
				$_SESSION['osudata'] = getData($_POST['username'], 0, 'osu!');
				$html->check(getData($_POST['username'], 0, 'osu!'));
				break;
			case('taiko'):
				$html->check(getData($_POST['username'], 1, 'Taiko'));
				$_SESSION['osudata'] = getData($_POST['username'], 1, 'Taiko');
				break;
			case('ctb'):
				$html->check(getData($_POST['username'], 2, 'CatchTheBeat'));
				$_SESSION['osudata'] = getData($_POST['username'], 2, 'CatchTheBeat');
				break;
			case('mania'):
				$html->check(getData($_POST['username'], 3, 'osu!mania'));
				$_SESSION['osudata'] = getData($_POST['username'], 3, 'osu!mania');
				break;
			default:
				echo 'undefined mode';
				break;
		}
	}
?>
