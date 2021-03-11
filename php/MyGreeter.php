<?php
namespace MyGreeter;

date_default_timezone_set('Etc/GMT-8');

class Client
{
    function getGreeting()
    {
         $h=date('H');
         if ($h>='00' and $h<'12')
         {
            return 'Good morning';
         }
         else if ($h>='12' and $h<'18')
         {
            return 'Good afternoon';
         }
         else
         {
            return 'Good evening';
         }
    }
}


//$greeter = new \MyGreeter\Client();
//echo $greeter->getGreeting();
