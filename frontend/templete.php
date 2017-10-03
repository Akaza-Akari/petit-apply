<?php
namespace osu_petit;

class Templete {

	private function _stylesheets($href, $integrity) {
		$data = ['rel' => 'stylesheet', 'href' => $href];
		if($integrity) $data['integrity'] = $integrity;
		$data['crossorigin'] = 'anonymous';
		return $this->_HtmlElement('link', $data);
	}

	private function _htmlElement($type, $data, $value) {
		$data = implode(' ', $data);
		$closing = isset($value) ? `>$value</$type>` : ($type == 'script') ? '></script>' : '/>';
		return `<$type $data$closing`;
	}

}
