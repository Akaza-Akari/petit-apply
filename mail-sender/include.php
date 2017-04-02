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
	function sendMail($to, $text) {
		$mg->message()->send($config['mailgun_domain'], [
			'from'	 => $config['mail_from'], 
			'to'	 => $to, 
			'subject'=> $config['mail_subject'], 
			'text'	 => $text
		]);
	}
}