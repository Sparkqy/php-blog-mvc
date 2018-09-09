<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 06.09.2018
 * Time: 18:50
 */

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Services\Db;
use MyProject\View\View;
use MyProject\Models\Users\User;

class ArticlesController
{
    private $db;
    private $view;

    public function __construct()
    {
        $this->db = new Db();
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function view(int $articleId)
    {
        $result = $this->db->query(
            'SELECT * FROM `articles` WHERE `id` = :id;',
            [':id' => $articleId], Article::class);

        if ($result === [])
        {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $authorId = $result[0]->authorId;
        $authorById = $this->db->query('SELECT `nickname` FROM `users` WHERE `id` = :authorId;',
            [':authorId' => $authorId], User::class);

        $this->view->renderHtml('articles/view.php', ['article' => $result[0], 'author' => $authorById[0]]);
    }
}