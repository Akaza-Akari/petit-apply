<?php
$config = parse_ini_file('config.ini', true);
$dbConfig = $config['db'];
$twitterData = [];

ini_set('session.cookie_domain', '.'.$config['root']['domain']);
session_start();

$conn = new mysqli($dbConfig['host'], $dbConfig['user'], $dbConfig['pass'], $dbConfig['name']);
if($conn->connect_error) die('Connection failed: '.$conn->connect_error);

$twitter['access'] = (String) $conn->real_escape_string($_SESSION['twitteraccess']);
$twitter['secret'] = (String) $conn->real_escape_string($_SESSION['twittersecret']);
$twitter['id'] = (Int) $conn->real_escape_string($_SESSION['twitterdata']['id']);
$twitter['email'] = (String) $conn->real_escape_string($_SESSION['twitterdata']['email']);

$osu_id = (Int) $conn->real_escape_string($_SESSION['osudata']['id']);
$osu_mode = (Int) $conn->real_escape_string($_SESSION['osudata']['mode_code']);

$noti_type = (String) $conn->real_escape_string($_SESSION['noti_type']);
$web_ip = (String) $conn->real_escape_string($_SESSION['osudata']['ip']);
$cf_ip = (String) $conn->real_escape_string($_SESSION['osudata']['cf']);

$timenow = date("Y-m-d\_H:i:s", time());
$sql = 'SELECT * FROM `'.$db_table.'` WHERE `osu_id` LIKE '.$osu_id.';';
$result = $conn->query($sql);
$sqlarray = $result->fetch_array(MYSQLI_ASSOC);
if(!is_null($sqlarray)) {
	$pattern = '/(....)-(..)-(..)_(..):(..):(..)/';
	$replacement = '${1}년 ${2}월 ${3}일 ${4}시 ${5}분 ${6}초';
	$regexed_date = preg_replace($pattern, $replacement, $sqlarray['date']);
	echo 'already registered, ' . $regexed_date;
	exit;
}

$sql_osu_columes = 'osu_id, osu_mode';
$sql_osu_insert = $osu_id.'`, `'.$osu_mode;
$sql_twitter_columes = 'twitter_id, twitter_access_token, twitter_access_secret, twitter_email';
$sql_twitter_insert = $twitter['id'].'`, `'.$twitter['access'].'`, `'.$twitter['secret'].'`, `'.$twitter['email'];
$sql = 'INSERT INTO `'.$dbConfig['table'].'` (number, date, noti_type, '.$sql_osu_columes.', '.$sql_twitter_columes.', web_ip, cf_ip, passed)
		VALUES (NULL, NULL, `'.$noti_type.'`, `'.$sql_osu_insert.'`, `'.$sql_twitter_insert.'`, `'.$web_ip.'`, `'.$cf_ip.'`, NULL);';
if ($conn->query($sql) == true) {
	echo 'registered';
} else {
	echo 'register error: ' . $conn->error;
}
