<?php
namespace MyGreeter;

class Client
{
    private String $timezone;
    private PersonalTime $personal_time;

    function __construct()
    {
        $this->timezone='Etc/GMT-9';                                                    //set default japanese user timezone
        $now=new \DateTime('now');
        $this->personal_time=new PersonalTime($now->getTimestamp(), $this->timezone);   //set default personal_time
    }

    function setTimezone($tz)
    {
        $this->timezone=$tz;
        $tmp=new PersonalTime($this->personal_time->getTimeInTimezone($tz), $tz);
        $this->personal_time=$tmp;                                                      //update personal_time according new timezone
    }

    function setPersonalTime($dt)
    {
        $tmp=new PersonalTime($dt->getTimeInTimezone($this->timezone), $this->timezone);
        $this->personal_time=$tmp;
    }

    function getGreeting()
    {
        $h=$this->personal_time->getHour();

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

class PersonalTime
{
    private String $time;
    private String $timezone;

    function __construct($time, $timezone)
    {
        $this->time=$time;
        $this->timezone=$timezone;
    }

    function getTimeInTimezone($timezone)
    {
        $tmp=new \DateTime($this->time, new \DateTimeZone($this->timezone));
        $tmp->setTimezone(new \DateTimeZone($timezone));
        return $tmp->format('Y-m-d H:i:s');
    }

    function getHour()
    {
        $dt=new \DateTime($this->time, new \DateTimeZone($this->timezone));
        return $dt->format('H');
    }
}

function test_getGreeting()
{
    $greeter=new \MyGreeter\Client();
    $greeter->setTimezone('Etc/GMT-9');                                        //the japanese user's timezone

    $personal_time=new PersonalTime('2021-03-12 23:00:00', 'Etc/GMT-8');    //test with his chinese friend's time
    $greeter->setPersonalTime($personal_time);

    echo $greeter->getGreeting();
}

test_getGreeting();