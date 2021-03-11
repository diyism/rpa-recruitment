<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/../lib/MyGreeter.php";

class MyGreeter_Client_Test extends PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        $this->greeter = new MyGreeter\Client();
    }

    public function test_Instance()
    {
        $this->assertEquals(
            get_class($this->greeter),
            'MyGreeter\Client'
        );
    }

    public function test_getGreeting()
    {
        $this->assertTrue(
            strlen($this->greeter->getGreeting()) > 0
        );
    }
}
