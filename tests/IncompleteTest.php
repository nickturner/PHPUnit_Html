<?php
 
class IncompleteTest extends PHPUnit_Framework_TestCase {
    public function testIncomplete() {
        $this->assertTrue(TRUE);
        $this->markTestIncomplete('This test is marked as incomplete.');
    }

    public function testAssertFailAssertPass() {
        print_r('This test has a bad assertion followed by a good assertion');
        $this->assertEquals(1, 0);
        $this->assertEquals(1, 1);
    }

    public function testNoAssertions() {
        print_r('This test does nothing');
    }
}

?>
