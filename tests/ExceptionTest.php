<?php
 
class ExceptionTest extends PHPUnit_Framework_TestCase {
    public function testException() {
        throw new \Exception('This is an thrown exception. It was manually thrown by using the PHP \'throw\' keyword. The message is intentionally long so as to test the message wrapping in the message box display.');
    }

    public function testTrigger() {
        trigger_error('This is an triggered error. It was manually triggered by calling the PHP function \'trigger_error\'. The message is intentionally long so as to test the message wrapping in the message box display.');
    }
}

?>
