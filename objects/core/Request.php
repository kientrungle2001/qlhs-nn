<?php
class PzkCoreRequest extends PzkObjectLightWeight {
	public $url;
	public $method;
	public $protocol;
	public $host;
	public $port;
	public $uri;
	public $query;
	public $options;
	
	public function init() {
		$this->parse_full_path();
	}
	
	public function parse_full_path()
	{
		$s = &$_SERVER;
		$ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
		$sp = strtolower($s['SERVER_PROTOCOL']);
		
		$protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
		$this->protocol = $protocol;
		
		$port = $s['SERVER_PORT'];
		$this->port = $port;
		$port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
		$this->resovledPort = $port;
		$host = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
		$this->host = $host;
		$host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
		$uri = $protocol . '://' . $host . $s['REQUEST_URI'];
		$this->uri = $uri;
		$segments = explode('?', $uri, 2);
		$url = $segments[0];
		$this->url = $url;
		$route_uri = $s['REQUEST_URI'];
		$segments2 = explode('?', $route_uri, 2);
		$full_route = $segments2[0];
		$this->full_route = $full_route;
		$segments3 = explode('index.php', $full_route, 2);
		$this->route = @$segments3[1]?@$segments3[1]: @$segments3[0];
		$this->query = $_REQUEST;
		$this->method = $_SERVER['REQUEST_METHOD'];
		return $url;
	}
	
	/**
	$method = get|post|put|delete|head|options|ajax|ssl|flash|mobile
	*/
	public function is($method) {
		return ($this->method == $method);
	}
	
	public function build($route, $query = false, $options = false) {
		return BASE_REQUEST . '/' . $route . ($query ? '?' . http_build_query($query) : '') . ($options ? '#' . http_build_query($options) : '');
	}
	
	public function buildCurrent($query = false, $options = false) {
		$route = preg_replace('/^\//', '', $this->route);
		return $this->build($route, $query, $options);
	}
	
	public function buildAction($action = false, $query = false, $options = false) {
		$route = $this->get('controller') . '/' . $action;
		return $this->build($route, $query, $options);
	}
	
	public function set($key, $value) {
		$this->query[$key] = $value;
	}
	
	public function un_set($key) {
		unset($this->query[$key]);
	}
	
	public function get($key, $default = NULL) {
		if(isset($this->query[$key])) return $this->query[$key];
		else return $default;
	}
	
	public function getSegment($index) {
		$parts = explode('/', $this->route);
		return @$parts[$index];
	}
	
	public function redirect($url) {
		header('Location: ' . $url);
	}
}
function pzk_request($var = NULL, $value = NULL) {
	$request = pzk_element('request');
	if($var == NULL) return $request;
	if($value == NULL) return $request->get($var);
	return $request->set($var, $value);
}