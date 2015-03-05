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
}