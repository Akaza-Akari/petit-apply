<?php
namespace petitApply;

class FrontendHelper {

	private function _stylesheets($href, $integrity) {
		$data = ['rel' => 'stylesheet', 'href' => $href];
		if($integrity) $data['integrity'] = $integrity;
		$data['crossorigin'] = 'anonymous';
		return $this->_HtmlElement('link', $data);
	}

	private function _scripts($href, $integrity) {
		$data = ['rel' => 'stylesheet', 'href' => $href];
		if($integrity) $data['integrity'] = $integrity;
		$data['crossorigin'] = 'anonymous';
		return $this->_HtmlElement('link', $data);
	}

	protected function htmlElement($type, $data, $value) {
		$data = implode(' ', $data);
		$closing = isset($value) ? `>$value</$type>` : ($type == 'script') ? '></script>' : '/>';
		return `<$type $data$closing`;
	}

}
