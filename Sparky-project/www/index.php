<?php
/**
 * Created by PhpStorm.
 * User: sparky
 * Date: 31/08/18
 * Time: 14:01
 */

function myAutoLoader(string $className)
{
    require_once __DIR__ . '/../src/' . str_replace('\\', '/', $className ) . '.php';
}

spl_autoload_register('myAutoLoader');

$controller = new MyProject\Controllers\MainController();

if (!empty($_GET['name']))
{
    $controller->sayHello($_GET['name']);
} else
{
    $controller->main();
}

var_dump($_GET['route']);

//$re = '/\/(?P<controller>[a-z]+)\/(?<id>[0-9]+)/m';
//$str = '/post/892';
//
//preg_match($re, $str, $matches);
//
//$controller = $matches['controller'];
//$id = $matches['id'];

