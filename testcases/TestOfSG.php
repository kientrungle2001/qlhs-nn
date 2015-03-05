<?php
class TestOfSG extends UnitTestCase {
    function testSG() {
        $sg = new PzkSGStoreDriverFile('cache');
		$sg->setTestingVariable('testing');
		$this->assertEqual($sg->getTestingVariable(), 'testing');
		$this->assertTrue($sg->hasTestingVariable());
		$sg->delTestingVariable();
		$this->assertFalse($sg->hasTestingVariable());
    }
	
	function testRegister() {
		$c = _db()->useCB()->select('count(*) as c')->fromUser()->result_one();
		$this->assertEqual($c['c'], 4);
	}
}