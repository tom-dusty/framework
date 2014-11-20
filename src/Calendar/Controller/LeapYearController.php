<?php

// framework.dev/Calendar/Controller/LeapYearController.php

namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Request;
use Calendar\Model\LeapYear;

class LeapYearController
{
    public function indexAction(Request $request, $year)
    {
        $leapyear = new LeapYear();
        if ($leapyear->isLeapYear($year)){
            $response = 'Yep, this is a leap year!';
        }
        else{
            $response ='Nope, this is not a leap year';
        }


        return $response;
    }
}