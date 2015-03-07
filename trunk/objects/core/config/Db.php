<?php
class PzkCoreConfigDb extends PzkObjectLightWeight {
	public function set($key, $value) {
		$item = _db()->selectAll()->fromConfig()->whereConfigKey($key)->result_one();
		if($item) {
			$row = array('configKey' => $key, 'configValue' => json_encode($value));
			_db()->updateConfig()->set($row)->whereId($item['id'])->result();
		} else {
			$row = array('configKey' => $key, 'configValue' => json_encode($value));
			_db()->insertConfig()->fields(implode(',', array_keys($row)))->values(array($row))->result();
		}
		return $this;
	}
	
	public function get($key, $default = null) {
		$item = _db()->selectAll()->fromConfig()->whereConfigKey($key)->result_one();
		if($item) {
			return json_decode($item['configValue'], true);
		} else {
			return $default;
		}
	}
}