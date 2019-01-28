<?php

require __DIR__ . '/../../vendor/autoload.php';

use MyProject\Exceptions\DbException;
use MyProject\Exceptions\Forbidden;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\View\View;
use MyProject\Exceptions\NotFoundException;

try {
    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/../../src/routes_api.php';
    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }
    if (!$isRouteFound) {
        throw new NotFoundException('Route not found.');
    }
    unset($matches[0]);
    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];
    if (method_exists($controllerName, $actionName)) {
        $controller = new $controllerName();
        $controller->$actionName(...$matches);
    } else {
        throw new NotFoundException();
    }
} catch (DbException $e) {
    $view = new View(__DIR__ . '/../templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (NotFoundException $e) {
    $view = new View(__DIR__ . '/../templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
} catch (UnauthorizedException $e) {
    $view = new View(__DIR__ . '/../templates/errors');
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
} catch (Forbidden $e) {
    $view = new View(__DIR__ . '/../templates/errors');
    $view->renderHtml('403.php', ['error' => $e->getMessage()], 403);
}


