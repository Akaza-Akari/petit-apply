<?php
function giveHost($host_with_subdomain) {
	$array = explode(".", $host_with_subdomain);
	return (array_key_exists(count($array) - 2, $array) ? $array[count($array) - 2] : "").".".$array[count($array) - 1];
}
ini_set('session.cookie_domain', '.'.giveHost($_SERVER['SERVER_NAME']));
session_start();

// TO MAKE DB : CREATE TABLE `db_name`.`db_table` ( `number` INT NOT NULL AUTO_INCREMENT COMMENT '입력 된 순서' , `date` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '입력 된 시간' , `noti_type` TEXT NOT NULL COMMENT '알림 방식' , `osu_id` INT NOT NULL COMMENT 'osu! 사용자 ID (숫자)' , `osu_mode` INT NOT NULL COMMENT 'osu! 플레이 모드 (숫자)' , `twitter_id` INT NULL DEFAULT NULL COMMENT '트위터 사용자 ID (숫자)' , `twitter_access_token` TEXT NULL DEFAULT NULL COMMENT '트위터 엑세스 토큰' , `twitter_access_secret` TEXT NULL DEFAULT NULL COMMENT '트위터 엑세스 시크릿' , `twitter_email` TEXT NULL DEFAULT NULL COMMENT '트위터 계정에 연결 된 이메일' , `email_address` TEXT NULL DEFAULT NULL COMMENT '이메일 주소' , `email_verifying_key` TEXT NULL DEFAULT NULL COMMENT '이메일 인증 키' , `email_verified` BOOLEAN NULL DEFAULT NULL COMMENT '이메일 인증 여부' , `web_ip` TEXT NOT NULL COMMENT '웹 REMOTE ADDRESS' , `cf_ip` TEXT NULL DEFAULT NULL COMMENT 'CloudFlare REMOTE IP' , `passed` BOOLEAN NULL DEFAULT NULL COMMENT '통과 여부' , PRIMARY KEY (`number`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;

$config = require_once 'config.php';
$db_host = $config['db_host'];
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_name = $config['db_name'];
$db_table = $config['db_table'];

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
	die('Connection failed: ' . $conn->connect_error);
}

$twitter_access_token = $conn->real_escape_string($_SESSION['twitteraccess']);
$twitter_secret_token = $conn->real_escape_string($_SESSION['twittersecret']);
$twitter_id = $conn->real_escape_string($_SESSION['twitterdata']['id']);
$twitter_email = $conn->real_escape_string($_SESSION['twitterdata']['email']); 

$osu_id = $_SESSION['osudata']['id'];
$osu_mode = $_SESSION['osudata']['mode_code'];

$noti_type = $_SESSION['noti_type'];
$web_ip = $_SESSION['osudata']['ip'];
$cf_ip = $_SESSION['osudata']['cf'];

$timenow = date("Y-m-d\_H:i:s",time());
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
$sql_osu_columes =	'osu_id, osu_mode';
$sql_osu_insert =	$osu_id.', '.$osu_mode;
$sql_twitter_columes =	'twitter_id, twitter_access_token, twitter_access_secret, twitter_email';
$sql_twitter_insert =	$twitter_id.', '.$twitter_access_token.', '.$twitter_secret_token.', '.$twitter_email;
$sql = 'INSERT INTO `'.$db_name.'` (number, date, noti_type, '.$sql_osu_columes.', '.$sql_twitter_columes.', web_ip, cf_ip, passed)
		VALUES (NULL, NULL, '.$noti_type.', '.$sql_osu_insert.', '.$sql_twitter_insert.', '.$web_ip.', '.$cf_ip.', NULL);';
if ($conn->query($sql) === TRUE) {
	echo 'registered';
} else {
	echo 'register error: ' . $conn->error;
}