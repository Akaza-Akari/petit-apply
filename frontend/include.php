<?php
namespace petitApply;

require './templetehelper.php';

class Frontend {

	public function __construct($config) {
		$this->config = $config;
	}

	private $_stylesheets = [
		['https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', 'sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u'],
		['https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', 'sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN']
	];

	private $_scripts = [
		['https://code.jquery.com/jquery-3.2.1.min.js', 'sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4='],
		['https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', 'sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa']
	];

	public function renderPage($name, $data, $pageData) {

	}

	private function _buildHead($config) {
		$return = [];
		array_push($return, FrontendHelper::htmlElement('meta', [
			'charset="UTF-8"'
		]));
		array_push($return, FrontendHelper::htmlElement('meta', [
			'http-equiv="X-UA-Compatible"',
			'content="IE=edge,chrome=1"'
		]));
		array_push($return, FrontendHelper::htmlElement('meta', [
			'name="viewport"',
			'content="width=device-width,initial-scale=1"'
		]));
		array_push($return, FrontendHelper::htmlElement('meta', [
			'itemprop="name"',
			`content="$config[title]"`
		]));
		array_push($return, FrontendHelper::htmlElement('meta', [
			'itemprop="description"',
			`content="$config[description]"`
		]));
		array_push($return, FrontendHelper::htmlElement('meta', [
			'itemprop="image"',
			'content="osu!petit Apply"'
		]));
	}

	private function _buildOg($config) {
		$return = [];
		foreach(array_keys($config) as $key) {
			array_push($return, FrontendHelper::htmlElement('meta', [
				`property="og:$key"`,
				`content="$config[$key]"`
			]));
		}
		return implode($return);
	}

	private function _buildTwiiter($config) {
		$return = [];
		foreach(array_keys($config) as $key) {
			array_push($return, FrontendHelper::htmlElement('meta', [
				`name="twitter:$key"`,
				`content="$config[$key]"`
			]));
		}
		return implode($return);
	}

}
