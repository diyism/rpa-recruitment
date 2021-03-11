<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/../lib/MyGreeter.php";
runkit_function_rename('date', 'date_real');

class MyGreeter_Client_Test extends PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        $this->mock_date(date_real('Y-m-d H:i:s'));
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

    public function test_getGreeting_morning()
    {
        $this->mock_date('2021-03-11 01:00:00');
        $this->assertTrue(
            $this->greeter->getGreeting()==='Good morning'
        );
    }

    public function test_getGreeting_afternoon()
    {
        $this->mock_date('2021-03-11 13:00:00');
        $this->assertTrue(
            $this->greeter->getGreeting()==='Good afternoon'
        );
    }


    public function test_getGreeting_evening()
    {
        $this->mock_date('2021-03-11 23:00:00');
        $this->assertTrue(
            $this->greeter->getGreeting()==='Good evening'
        );
    }

    private function mock_date($mock_datetime)
    {
        @runkit_function_remove('date');
        runkit_function_add('date','$format="Y-m-d H:i:s", $timestamp=NULL', '$ts = $timestamp ? $timestamp : strtotime("'.$mock_datetime.'"); return date_real($format, $ts);');
    }
}
