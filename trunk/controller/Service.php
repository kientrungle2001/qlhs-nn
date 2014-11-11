<?php
class PzkServiceController extends PzkController {
	public function runAction() {
		$request = pzk_request();
		$model = $request->getSegment(3);
		$action = $request->getSegment(4);
		$modelObject = pzk_loader()->getModel($model);
		echo json_encode($modelObject->run($action, $request->query));
	}
}