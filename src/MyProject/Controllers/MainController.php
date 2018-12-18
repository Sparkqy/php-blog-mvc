<?php
/**
 * Created by PhpStorm.
 * User: sparky
 * Date: 01.09.18
 * Time: 10:15
 */

namespace MyProject\Controllers;

use MyProject\Models\Comments\Comment;
use MyProject\Models\Articles\Article;
use MyProject\Models\Categories\Category;
use MyProject\Models\Pagination\Pagination;
use MyProject\Models\Tags\Tag;
use MyProject\Services\UsersAuthService;
use MyProject\View\View;

class MainController extends AbstractController
{
    public function main()
    {
        $title = 'Sparky-blog';
        $articlesAll = Article::getAll();
        $featuredArticles = Article::getLastArticles(3);
        $featuredArticleBig = array_shift($featuredArticles);

        $topCommentators = Comment::getTopCommentators();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $articlesCount = count($articlesAll);
        if ($articlesCount > 6) {
            $pagination = new Pagination($articlesCount, $page);
            $articles = Article::getPaginationLastArticles($page);
        }

        $this->view->renderHtml('main/main.php', [
            'title' => $title,
            'articles' => $articles,
            'pagination' => $pagination,
            'featuredArticles' => $featuredArticles,
            'featuredArticleBig' => $featuredArticleBig,
            'topCommentators' => $topCommentators,
        ]);
    }
}