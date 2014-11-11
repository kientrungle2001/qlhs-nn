<?php
class PzkCoreLanguage extends PzkObject {
	public $data = array();
	public function translateText($module, $text) {
		$language = pzk_session('language') ? pzk_session('language') : 'en';
		$data = $this->load($module . '/' . $language);
		$global = $this->load('global/' . $language);
		if(isset($data[$text])) {
			return $data[$text];
		} else {
			if(isset($global[$text])) {
				return $global[$text];
			} else {
				return $text;
			}
		}
	}
	
	public function load($module) {
		if(isset($this->data[$module])) {
			return $this->data[$module];
		} else {
			$this->data[$module] = $this->loadLanguageData($module);
			return $this->data[$module];
		}
	}
	public function loadLanguageData($module) {
		if(!file_exists('language/' . $module . '.php'))
			return array();
		return require 'language/' . $module . '.php';
	}
}

function pzk_language() {
	return pzk_element('language');
}