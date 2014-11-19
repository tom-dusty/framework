<?php

// framework/app.php

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$routes = new Routing\RouteCollection();
$routes -> add("hello", new Routing\Route('/hello/{name}', array(
    'name' => 'World',
    '_controller' => 'render_template',
)));

$routes -> add("bye", new Routing\Route('/bye', array(
    '_controller' => 'render_template',
)));

$routes -> add("leap_year", new Routing\Route('/is_leap_year/{year}', array(
    'year' => null,
    '_controller' => 'Calendar\\Controller\\LeapYearController::indexAction',
)));

return $routes;

class LeapYearController
{
    public function indexAction(Request $request)
    {
        if (isset($_REQUEST['year']) && is_leap_year((int)$_REQUEST['year'])) {
            return new Response('Yep, this is a leap year!');
        }

        return new Response('Nope, this is not a leap year');
    }
}

function is_leap_year($year = null) {
    if(null === $year | $year == 0) {
        $year = date('Y');
    }

    return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
}