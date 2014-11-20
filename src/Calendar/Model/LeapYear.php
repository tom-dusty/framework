<?php

//framework.dev/src/Calendar/Model/LeapYear.php

namespace Calendar\Model;

class LeapYear
{
    public function isLeapYear($year = 0)
    {
        if(isset($_REQUEST['year']))
            $year = (int)$_REQUEST['year'];
        if($year == 0)
        {
            $year = date('Y');
        }

        return 0 == $year % 400 || (0 == $year %4 && 0 != $year % 100);
    }
}