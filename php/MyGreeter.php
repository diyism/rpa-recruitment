<?php
namespace MyGreeter;

class Client
{
    function getGreeting()
    {
         echo 'greet';
    }
}


$greeter = new \MyGreeter\Client();
$greeter->getGreeting();