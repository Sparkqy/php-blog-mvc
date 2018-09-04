<?php
/**
 * Created by PhpStorm.
 * User: sparky
 * Date: 01.09.18
 * Time: 10:15
 */

namespace MyProject\Controllers;

class MainController
{
    public function main()
    {
        echo "Main page!";
    }

    public function sayHello(string $name)
    {
        echo "Hello, $name";
    }

    public function sayBye(string $name)
    {
        echo "Bye, $name";
    }
}