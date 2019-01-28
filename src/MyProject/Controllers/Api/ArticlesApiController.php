<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 28.01.2019
 * Time: 18:30
 */

namespace MyProject\Controllers\Api;


use MyProject\Controllers\AbstractController;
use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Articles\Article;

class ArticlesApiController extends AbstractController
{
    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $this->view->displayJson([
            'articles' => [$article]
        ]);
    }
}