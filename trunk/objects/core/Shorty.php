<?php
class PzkCoreShorty extends PzkObjectLightWeight {
	public function init() {
		pzk_global()->set('shorty_' . $this->name, $this->value);
	}
}