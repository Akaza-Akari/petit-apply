<?php
namespace osu_petit;
require __DIR__.'/../vendor/autoload.php';
$config = require_once __DIR__.'/../config.php';

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