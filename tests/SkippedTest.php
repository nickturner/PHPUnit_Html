<?php
 
class SkippedTest extends PHPUnit_Framework_TestCase {
    protected function setUp() {
        $this->markTestSkipped('All tests are marked as skipped.');
    }

    public function testPassed() {
        $this->assertEquals(1, 1, 'This test should not fail!');
    }

    public function testFailed() {
        $this->assertEquals(1, 0, 'This test is meant to fail!');
    }
}

?>
