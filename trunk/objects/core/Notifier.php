<?php
class PzkCoreNotifier extends PzkObjectLightWeight {
	// active, success, info, warning, danger
	public function addMessage($message, $type = 'success') {
		$messages = $this->getMessages();
		$messages[] = array('message' => $message, 'type' => $type);
		$this->setMessages($messages);
	}
	public function getMessages() {
		$messages = pzk_session('messages');
		if(!$messages) {
			$messages = array();
		}
		return $messages;
	}
	public function setMessages($messages) {
		pzk_session('messages', $messages);
	}
	public function clearMessages() {
		pzk_session('messages', array());
	}
}
function pzk_notifier_messages() {
	$notifier = pzk_element('notifier');
	$messages = $notifier->getMessages();
	$notifier->clearMessages();
	return $messages;
}
function pzk_notifier() {
	return pzk_element('notifier');
}