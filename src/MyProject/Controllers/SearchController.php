<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 11/15/2018
 * Time: 1:19 PM
 */

namespace MyProject\Controllers;


use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Articles\Article;


class SearchController extends AbstractController
{
    public function search()
    {
        if (!empty($_GET['s'])) {
            $query = (string)$_GET['s'];
            $articles = Article::search($query);

            if ($articles === null) {
                $this->view->renderHtml('search/search.php', [
                    'articles' => null,
                    'query' => $query,
                ]);
                return;
            }

            $this->view->renderHtml('search/search.php', [
                'articles' => $articles,
                'query' => $query,
            ]);
            return;
        }

        $this->view->renderHtml('search/search.php', []);
    }
}
