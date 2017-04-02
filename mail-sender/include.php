<?php
namespace osu_petit;
require __DIR__.'/../vendor/autoload.php';
$config = require_once __DIR__.'/../config.php';

$db_host = $config['db_host'];
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_name = $config['db_name'];
$db_table = $config['db_table'];

use Mailgun\Mailgun;
$mg = new Mailgun($config['mailgun_key']);
class Mailer {
	function sendMail($domain, $from, $to, $subject, $text) {
		$mg->message()->send($domain, [
			'from'	 => $from, 
			'to'	 => $to, 
			'subject'=> $subject, 
			'text'	 => $text
		]);
	}
}