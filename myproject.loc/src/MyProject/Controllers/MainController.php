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
use MyProject\Services\UsersAuthService;
use MyProject\View\View;

class MainController extends AbstractController
{
    public function main()
    {
        $categories = Category::getAll();
        $sliderArticles = Article::getLastArticles(3);
        $topCommentators = Comment::getTopCommentators();

        foreach ($categories as $category)
        {
            $articles[$category->getId()] = Article::getLastArticlesByCategoryId($category->getId(), 5);
        }
        $articles = array_diff($articles, array(NULL));

        $this->view->renderHtml('main/main.php', [
            'categories' => $categories,
            'articles' => $articles,
            'sliderArticles' => $sliderArticles,
            'topCommentators' => $topCommentators,
            ]);
    }
}