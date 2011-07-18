<?php

class SubTest extends PHPUnit_Framework_TestCase {    
    public function testDeprecatedAndError() {
        $this->assertType('int', 3);
        sample_function();
    }

function test2() {
    $fred = array(2, 4, 6);
    echo '$fred=';
    print_r($fred);
    $this->assertEquals($fred, array(2, 4, 6));
}
    
}

if (!function_exists('sample_function')) {

function sample_function() { sample_function1(); }
function sample_function1() { sample_function2(); }
function sample_function2() { sample_function3(); }
function sample_function3() { sample_function_containing_error(); }
function sample_function_containing_error() { echo $some_undefined_variable; }

}

?>
