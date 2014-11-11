<?php
class PzkCoreRewriteRequest extends PzkObjectLightweight{
	public $matcher = 'route'; // 
	public $pattern = '';
	public $route = false; // target
	public $matchMethod = 'preg_match'; // equal, strpos
	public $replaceMethod = 'preg_replace';
	public $replaceFullTarget = false;
	public $queryParams = false;
	public $defaultQueryParams = false;
	public $optionsParams = false;
	public $defaultOptionsParams = false;
	public $elementParams = false;
	public $defaultElementParams = false;
	public function init() {
		$request = pzk_element('request');
		$matcher = $this->matcher; $matchSource = $request->$matcher;
		if($this->matchMethod == 'equal') {
			if ($matchSource == $this->pattern) {
				if($this->defaultQueryParams) {
					$params = json_decode($this->defaultQueryParams, true);
					$request->query = array_merge($request->query, $params);
				}
				if($this->defaultElementParams) {
					$params = json_decode($this->defaultElementParams, true);
					foreach($params as $param => $value) {
						$parts = explode('.', $param);
						$element = $parts[0];
						$attr = $parts[1];
						if($e = pzk_element($element)) {
							$e->$attr = $value;
						}
					}
				}
				if($this->route) {
					$request->route = $this->route;
				}
			}
		} else if ($this->matchMethod == 'preg_match') {
			$this->pattern = preg_replace('/\[\*([\w][\w\d]*)\*\]/', '?P<$1>', $this->pattern);
			$this->pattern = str_replace('&lt;', '<', str_replace('&gt;', '>', $this->pattern));
			if(preg_match('/'.$this->pattern.'/is', $matchSource, $matches)) {
				if($this->defaultQueryParams) {
					$params = json_decode($this->defaultQueryParams, true);
					$request->query = array_merge($request->query, $params);
				}
				if($this->queryParams) {
					$keys = explode(',', $this->queryParams);
					foreach($keys as $key) {
						$key = trim($key);
						if(@$matches[$key])
							$request->query[$key] = @$matches[$key];
					}
				}
				
				if($this->defaultElementParams) {
					$params = json_decode($this->defaultElementParams, true);
					var_dump($params);
					foreach($params as $param => $value) {
						$parts = explode('.', $param);
						$element = $parts[0];
						$attr = $parts[1];
						if($e = pzk_element($element)) {
							$e->$attr = $value;
						}
					}
				}
				if($this->elementParams) {
					$keys = explode(',', $this->elementParams);
					foreach($keys as $key) {
						$key = trim($key);
						$parts = explode('.', $key);
						$element = $parts[0];
						$attr = $parts[1];
						if($value = @$matches[str_replace('.', '_', $key)]) {
							if($e = pzk_element($element)) {
								$e->$attr = $value;
							}
						}
					}
				}
				
				if($this->route) {
					$route = $this->route;
					foreach($matches as $index => $value) {
						$route = str_replace('$' . $index, $value, $route);
					}
					$request->route = $route;
				}
			}
		}
	}
	public function build($queryParams) {
	}
}