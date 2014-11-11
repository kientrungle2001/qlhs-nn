<?php
class PzkNewsletterController extends PzkController {
	public $masterStructure = 'master';
	public $masterPosition = 'content';
	public function subscribeAction() {
		$this->viewStructure('newsletter/subscribe');
	}
	public function subscribePostAction() {
		$request = pzk_element('request');
		$fullName = trim($request->get('fullName'));
		$email = trim($request->get('email'));
		$newsletterEntity = _db()->getEntity('newsletter.subscriber');
		$newsletterEntity->setData(array(
			'fullName' => $fullName,
			'email' => $email,
			'status' => 1
		));
		$newsletterEntity->save();
		if($newsletterEntity->get('id')) {
			$this->viewStructure('newsletter/subscribe/success');
		} else {
			$this->viewStructure('newsletter/subscribe');
		}
	}
}