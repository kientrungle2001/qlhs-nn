<?php
function copyGlob($pattern) {
	$files = glob($pattern);
	foreach($files as $file) {
		$parts = explode('/', $file);
		array_shift($parts);
		foreach($parts as $index => $part) {
			$parts[$index] = str_ucfirst($parts[$index]);
		}
		$fileTarget = 'compile/objects/Pzk' . implode('', $parts);
		copy($file, $fileTarget);
		//require_once $fileTarget;
	}
}
function compileObjects() {
	$files = glob('compile/objects/*.php');
	foreach($files as $file) {
		unlink($file);
	}
	copyGlob('objects/*.php');
	copyGlob('objects/*/*.php');
	copyGlob('objects/*/*/*.php');
	copyGlob('objects/*/*/*/*.php');
	copyGlob('objects/*/*/*/*/*.php');
	copyGlob('objects/*/*/*/*/*/*.php');
	copyGlob('objects/*/*/*/*/*/*/*.php');
	copyGlob('objects/*/*/*/*/*/*/*/*.php');
}
function compileGlob($pattern) {
	$files = glob($pattern);
	foreach($files as $file) {
		compileXmlFile($file);
	}
}
function readNode($node, &$index = 0) {
	$content = '';
	$name = $node->nodeName;

	// xet xem co phai html tag binh thuong khong
	if (PzkParser::isHtmlTag($name)) {
		$name = 'HtmlTag';
	}
	$names = explode('.', $name);
	$fullNames = array_merge(array(), $names);

	$name = array_pop($names);
	$package = implode('/', $names);

	$className = PzkParser::getClass($fullNames);
	$content .= "require_once 'compile/objects/$className.php';\r\n";
	// lay cac thuoc tinh
	$attrs = array();
	foreach ($node->attributes as $attr) {
		$attrs[$attr->nodeName] = $attr->nodeValue;
	}
	$attrs['tagName'] = $node->nodeName;
	$attrs['package'] = $package;
	$attrs['className'] = $className;
	$attrs['fullNames'] = $fullNames;
	$attrs = var_export($attrs, true);
	$content .= '$obj'.$index.' = new ' . $className . '('. $attrs . ');' ."\r\n";
	$content .= 'pzk_element($obj'.$index.'->id, $obj'.$index.');'. "\r\n";
	$oldIndex = $index;
	$index++;
	$content .= '$obj'.$oldIndex.'->init();' ."\r\n";
	foreach($node->childNodes as $childNode) {
		if ($childNode->nodeType == XML_ELEMENT_NODE) {
			$childIndex = $index;
			$content .= readNode($childNode, $index);
			$content .= '$obj'.$oldIndex.'->append($obj'.$childIndex.');' ."\r\n";
		} else if ($childNode->nodeType == XML_TEXT_NODE || $childNode->nodeType == XML_CDATA_SECTION_NODE) {
			if (trim($childNode->nodeValue)) {
				$attrs = array();
				$attrs['tagName'] = 'textLabel';
				$attrs['package'] = '';
				$attrs['className'] = 'PzkTextLabel';
				$attrs['fullNames'] = array('TextLabel');
				$attrs['value'] = trim($childNode->nodeValue);
				$attrs = var_export($attrs, true);
				$content .= '$obj'.$index.' = new PzkTextLabel('. $attrs . ');' ."\r\n";
				$content .= '$obj'.$index.'->init();' ."\r\n";
				$content .= '$obj'.$index.'->finish();' ."\r\n";
				$content .= '$obj'.$oldIndex.'->append($obj'.$index.');' ."\r\n";
				$index++;
			}
			// neu la mot cdata node
		}
	}
	$content .= '$obj'.$oldIndex.'->finish();' ."\r\n";
	return $content;
}
function compileXmlFile($file, $regenerate = true) {
	// echo $file . '<br />';
	$fileName = 'compile/pages/' . str_replace('/', '_', $file);
	if($regenerate) {
		try {
			$content = '';
			ob_start();
			require $file;
			$content = ob_get_contents();
			ob_end_clean();
			$content = str_replace('&', '&amp;', $content);
			
			$pageDom = new DOMDocument('1.0', 'utf-8');
			$pageDom->preserveWhiteSpace = false;
			$pageDom->formatOutput = true;
			$pageDom->loadXML($content);
			$fileContent = readNode($pageDom->documentElement);
			file_put_contents($fileName, '<'.'?php '. $fileContent);	
		} catch(Exception $ex) {
			echo 'Error at: ' . $file . '<br />' . $ex->getMessage() .'<br />';
		}
		
	}
	//require_once $fileName;
}
function compileXmls() {
	compileGlob('system/*.php');
	compileGlob('app/ptnn/application.php');
	compileGlob('app/ptnn/offapplication.php');
	compileGlob('app/ptnn/pages/*.php');
	compileGlob('app/ptnn/pages/*/*.php');
	compileGlob('app/ptnn/pages/*/*/*.php');
	compileGlob('app/ptnn/pages/*/*/*/*.php');
}
@mkdir(BASE_DIR . '/compile');
@mkdir(BASE_DIR . '/compile/objects');
@mkdir(BASE_DIR . '/compile/pages');