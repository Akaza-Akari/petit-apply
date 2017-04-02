<?php
namespace osu_petit;
require '../vendor/autoload.php';
$config = require_once '../config.php';

$db_host = $config['db_host'];
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_name = $config['db_name'];
$db_table = $config['db_table'];

use Mailgun\Mailgun;
$configurator = new HttpClientConfigurator();
$configurator->setEndpoint('http://bin.mailgun.net/2d700f3d');
$configurator->setDebug(true);
$mg = Mailgun::configure($configurator);
//$mg = Mailgun::create($config['mailgun_key']);
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