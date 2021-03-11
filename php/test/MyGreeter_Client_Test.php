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

    private function mock_date($mock_datetime)
    {
        runkit_function_rename('date', 'date_real');
        runkit_function_add('date','$format="Y-m-d H:i:s", $timestamp=NULL', '$ts = $timestamp ? $timestamp : strtotime('.$mock_datetime.'); return date_real($format, $ts);');
    }
}
