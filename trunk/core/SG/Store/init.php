<?php
function sg_session() {
	static $session;
	if($session) return $session;
	$session = new PzkSGStoreSession(new PzkSGStoreFormatXml(new PzkSGStoreDriverFile('cache/session')));	
	return $session;
}