<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/19/2018
 * Time: 5:56 PM
 */

namespace MyProject\Controllers;


use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Pagination\Pagination;
use MyProject\Models\Tags\Tag;

class TagsController extends AbstractController
{
    public function view(int $tagId): void
    {
        $tag = Tag::getById($tagId);
        $this->view->setExtraVars('tag', $tag);

        if ($tag === null)
        {
            throw new NotFoundException();
        }

        $articles = Article::getArticlesByTags($tagId);

        if ($articles === null)
        {
            $this->view->renderHtml(
                'tags/articlesByTag.php', [
                    'error' => 'По данному тегу еще нет статей.',
                    'articles' => null]
            );
            return;
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $articlesCount = count($articles);
        if ($articlesCount > 0)
        {
            $pagination = new Pagination($articlesCount, $page);
            $articles = Article::getPaginationTagId($tagId, $page);
        }

        $this->view->renderHtml('tags/articlesByTag.php', [
                'articles' => $articles,
                'pagination' => $pagination]
        );
    }
}