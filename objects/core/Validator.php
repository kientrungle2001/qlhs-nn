<?php
class PzkCoreValidator extends PzkObjectLightWeight {
	public function required($str) {
		return trim($str);
	}
	public function email($str) {
		if (filter_var($str, FILTER_VALIDATE_EMAIL)) { 
			return true; 
		} else {
			return false;
		}
	}
	public function url($str) {
		if (filter_var($str, FILTER_VALIDATE_URL)) { 
			return true; 
		} else {
			return false;
		}
	}
	public function dateNormal($str) {
		return (strlen($str) == 10) && (strtotime($str) != NULL);
	}
	public function dateISO($str) {
	}
	public function number($str) {
		if (filter_var($str, FILTER_VALIDATE_FLOAT)) { 
			return true; 
		} else {
			return false;
		}
	}
	public function digits($str) {
		if (filter_var($str, FILTER_VALIDATE_INT)) { 
			return true; 
		} else {
			return false;
		}
	}
	public function creditcard($str) {
	}
	public function maxlength($str, $len) {
		return strlen($str) <= $len;
	}
	public function minlength($str, $len) {
		return strlen($str) >= $len;
	}
	public function rangeLength($str, $min, $max) {
		return (strlen($str) >= $min) && (strlen($str) <= $max);
	}
	public function max($str, $max) {
		return $str <= $max;
	}
	public function min($str, $min) {
		return $str >= $min;
	}
	public function range($str, $min, $max) {
		return $str >= $min && $str <= $max;
	}
	public function equalTo($str, $value) {
		return $str == $value;
	}
	public function validate($data, $options) {
		$result = array();
		foreach($options['rules'] as $field => $validators) {
			foreach($validators as $validator => $validatorParams) {
				if(!$this->isValid(@$data[$field], $validator, $validatorParams)) {
					$result[$field][$validator] = $options['messages'][$field][$validator];
				}
			}
		}
		if(count($result)) return $result;
		return true;
	}
	public function isValid($value, $validator, $params = NULL) {
		if(is_array($params)) {
			return $this->$validator($value, @$params[0], @$params[1], @$params[2]);
		} else {
			return $this->$validator($value, @$params);
		}
	}
	public function setEditingData($data) {
		pzk_session('editingData', $data);
	}
	public function getEditingData() {
		$data = pzk_session('editingData');
		pzk_session('editingData', false);
		return $data;
	}
}
function pzk_validator() {
	return pzk_element('validator');
}
function pzk_validate($data, $options) {
	return pzk_validator()->validate($data, $options);
}