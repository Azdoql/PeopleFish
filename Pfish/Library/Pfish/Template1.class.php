<?php


class Templatel {

	public function __construct() {

	}

	static function fetch($_conter_dir) {

	}	

	/**
	 * 替换方法
	 * @param $search 	匹配的内容
	 * @param $replace   替换的内容
	 * @param $sunject	替换的内容
	 * @return $content 替换后的内容
	 */
	private function str_replace($search, $replace, $subject) {
		if (empty($search) || empty($replace) || empty($subject)) {
			return false;
		}

		return str_replace($search, $replace, $subject);
	}

	private function parse_foreach($content) {
		if (empty($content)) {
			return false;
		}
		
		$html = preg_replace($search, $replace, $content);

		return $html;

	}
}
?>