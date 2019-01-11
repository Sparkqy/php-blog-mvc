<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/3/2018
 * Time: 4:29 PM
 */

namespace MyProject\Controllers;


use MyProject\Models\Articles\Article;
use MyProject\Models\Categories\Category;
use MyProject\Models\Tags\Tag;
use MyProject\Services\UsersAuthService;
use MyProject\View\View;

class AbstractController
{
    protected $view;
    protected $user;
    protected $recentArticles;
    protected $tagsAll;
    protected $categories;

    public function __construct()
    {
        // View
        $this->view = new View(__DIR__ . '/../../../templates');

        // User
        $this->user = UsersAuthService::getUserByToken();

        // Header & footer data
        $this->categories = Category::getAll();
        $this->tagsAll = Tag::getAll();
        $this->recentArticles = Article::getLastArticles(2);

        $this->view->setExtraVars('categories', $this->categories);
        $this->view->setExtraVars('user', $this->user);
        $this->view->setExtraVars('recentArticles', $this->recentArticles);
        $this->view->setExtraVars('tagsAll', $this->tagsAll);
    }
}