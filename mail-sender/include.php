<?php
namespace osu_petit;
require __DIR__.'/../vendor/autoload.php';
$config = require_once __DIR__.'/../config.php';

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