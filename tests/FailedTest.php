<?php

class FailedTest extends PHPUnit_Framework_TestCase {    
    public function testFailed() {
        print_r('some random debug message');
        $this->assertEquals(1, 2, 'This is doomed to failure!');
    }

    public function testWithError() {
        somestr;
        $this->assertEquals(1, 2);
    }

    public function testWithDeepError() {
	sample_function();
        $this->assertEquals(1, 2);
    }
}

function sample_function() { sample_function1(); }
function sample_function1() { sample_function2(); }
function sample_function2() { sample_function3(); }
function sample_function3() { sample_function_containing_error(); }
function sample_function_containing_error() { echo $some_undefined_variable; }


?>
