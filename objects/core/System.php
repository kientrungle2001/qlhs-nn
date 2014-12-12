<?php
class PzkCoreSystem extends PzkObjectLightWeight {
	public $boundable = false;
	public $libs = array(); 
	public $bootstrap = 'application';
	public $app = false;
	
	/**
	 * 
	 * @return PzkCoreApplication
	 */
	public function getApp() {
		if($this->app) return $this->app;
		$request = pzk_element('request');
		$application = $request->query['app'];
		$app = PzkParser::parse('app/'. $application . '/' . $this->bootstrap);
		$this->app = $app;
		return $app;
	}
	
	public static function appPath($path) {
		return 'app/' . $this->getApp()->name . '/' . $path;
	}
	
	public function path($path) {
		return BASE_DIR . '/' . $path;
	}
	
}
/**
 * 
 * @return PzkCoreSystem
 */
function pzk_system() {
	return pzk_store_element('system');
}
?>