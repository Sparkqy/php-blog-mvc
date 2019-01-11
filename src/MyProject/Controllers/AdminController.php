<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/6/2018
 * Time: 3:37 PM
 */

namespace MyProject\Controllers;

use MyProject\Models\Pagination\Pagination;
use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comment;

class AdminController extends AbstractController
{
    public function view()
    {
        if ($this->user === null || $this->user->getRole() !== 'admin') {
            throw new NotFoundException();
        }

        $this->view->renderHtml('admin/admin.php', []);
    }

    public function lastArticles()
    {
        if ($this->user === null || $this->user->getRole() !== 'admin') {
            throw new NotFoundException();
        }

        $recentArticles = Article::getLastArticles(15);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $articlesCount = count($recentArticles);
        $pagination = new Pagination($articlesCount, $page);
        $articles = Article::getPaginationLastArticles($page);

        $this->view->renderHtml('admin/adminLastArticles.php', [
            'articles' => $articles,
            'pagination' => $pagination,
        ]);
    }
}