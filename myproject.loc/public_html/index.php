<?php
/**
 * Created by PhpStorm.
 * User: sparky
 * Date: 31/08/18
 * Time: 14:01
 * @param string $className
 */


use MyProject\View\View;

try
{
    require __DIR__ . '/../vendor/autoload.php';
    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/../src/routes.php';
    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction)
    {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }
    if (!$isRouteFound)
    {
        throw new \MyProject\Exceptions\NotFoundException();
    }
    unset($matches[0]);
    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];
    if (method_exists($controllerName, $actionName))
    {
        $controller = new $controllerName();
        $controller->$actionName(...$matches);
    } else
    {
        throw new \MyProject\Exceptions\NotFoundException();
    }
} catch (\MyProject\Exceptions\DbException $e)
{
    $view = new View(__DIR__ . '/../templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (\MyProject\Exceptions\NotFoundException $e)
{
    $view = new View(__DIR__ . '/../templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
} catch (\MyProject\Exceptions\UnauthorizedException $e)
{
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
} catch (\MyProject\Exceptions\Forbidden $e)
{
    $view = new \MyProject\View\View(__DIR__ . '/../templates/errors');
    $view->renderHtml('403.php', ['error' => $e->getMessage()], 403);
}


