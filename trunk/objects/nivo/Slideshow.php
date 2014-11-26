<?php
class PzkNivoSlideshow extends PzkObject {
	public $layout = 'nivo/slideshow';
	public static $inited = false;
	public $scriptable = true;
	public function init() {
		if(!PzkNivoSlideshow::$inited) {
			$head = pzk_element('head');
			$scripts = "<div layout='nivo/slideshow/scripts'></div>";
			$head->append(pzk_parse($scripts));
			PzkNivoSlideshow::$inited = true;
		}
	}
}