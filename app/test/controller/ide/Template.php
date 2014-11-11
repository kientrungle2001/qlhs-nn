<?php
class PzkIdeTemplateController extends PzkController {
	public function regionlistjsonAction() {
		$request = pzk_element('request');
		$template = _db()->select('*')->from('resource')->where('id='. $request->get('templateId'))->result_one();
		if(isset($template['layouts'])) {
			echo json_encode($template['layouts']);
			return ;
		}
		echo 'null';
	}
}