<?php

class DeprecatedTest extends PHPUnit_Framework_TestCase {    
    public function testDeprecated() {
        $this->assertType('int', 3);
    }
}

?>
