<?php
/**
 * Created by PhpStorm.
 * User: sparky
 * Date: 31/08/18
 * Time: 14:01
 * @param string $className
 */

use MyProject\View\View;

spl_autoload_register(function (string $className)
{
   require_once __DIR__ . '/../src/' . $className . '.php';
});

$route = $_GET['route'] ?? '';
$routes = require __DIR__ . '/../src/routes.php';

$isRouteFound = false;
foreach ($routes as $pattern => $controllerAndAction)
{
    preg_match($pattern, $route, $matches);
    if (!empty($matches))
    {
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound)
{
    $view = new View(__DIR__ . '/../templates');
    $view->renderHtml('errors/404.php', [], 404);
    return;
}

unset($matches[0]);
$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];

$controller = new $controllerName();
$controller->$actionName(...$matches);


