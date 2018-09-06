<?php
/**
 * Created by PhpStorm.
 * User: sparky
 * Date: 01.09.18
 * Time: 10:15
 */

namespace MyProject\Controllers;

use MyProject\View\View;
use MyProject\Services\Db;

class MainController
{
    private $view;
    private $db;

    public function __construct()
    {
        $this->db = new Db();
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function main()
    {
        $title = null;
        $articles = $this->db->query('SELECT * FROM `articles`;');
        var_dump($articles);
//        $this->view->renderHtml('main/main.php', ['articles' => $articles, 'title' => $title]);
    }

    public function sayHello(string $name)
    {
        $title = "Страница приветствия";
        $this->view->renderHtml('main/hello.php', ['name' => $name, 'title' => $title]);
    }
}