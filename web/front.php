<?php

// framework.dev/web/front.php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\DependencyInjection\Reference;

function render_template(Request $request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    if(isset($_GET['name']))
        $name = $_GET['name'];

    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);

    return new Response(ob_get_clean());
}

$sc = include __DIR__.'/../src/container.php';

$sc->setParameter('debug', true);

$sc->setParameter('charset', 'UTF-8');
$sc->setParameter('routes', include __DIR__.'/../src/app.php');

$sc->register('listener.string_response', 'Simplex\StringResponseListener');
$sc->getDefinition('dispatcher')
    ->addMethodCall('addSubscriber', array(new Reference('listener.string_response')));

$request = Request::createFromGlobals();
$response = $sc->get('framework')->handle($request);


$response->send();