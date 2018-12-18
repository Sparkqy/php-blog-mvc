<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 06.09.2018
 * Time: 18:50
 */

namespace MyProject\Controllers;

use http\Exception\UnexpectedValueException;
use MyProject\Exceptions\Forbidden;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Models\Articles\Article;
use MyProject\Models\ArticlesViewsInfo\ArticleViewInfo;
use MyProject\Models\Categories\Category;
use MyProject\Models\Comments\Comment;
use MyProject\Models\Tags\Tag;
use MyProject\View\View;
use MyProject\Models\Users\User;
use MyProject\Services\UsersAuthService;


class ArticlesController extends AbstractController
{
    public function view(int $articleId): void
    {
        $article = Article::getById($articleId);
        if ($article === null) {
            throw new NotFoundException();
        }

        $title = $article->getName();
        $nextArticle = Article::nextArticle($articleId);
        $prevArticle = Article::prevArticle($articleId);
        $comments = Comment::getByOneColumnArray('article_id', $articleId);
        $tags = Tag::getTagsByArticleId($articleId);
        ArticleViewInfo::incViews($articleId);
        $views = ArticleViewInfo::getByOneColumn('article_id', $articleId);

        $this->view->renderHtml('articles/view.php', [
            'title' => $title,
            'article' => $article,
            'nextArticle' => $nextArticle,
            'prevArticle' => $prevArticle,
            'tags' => $tags,
            'comments' => $comments,
            'views' => $views,
        ]);
    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);
        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if ($this->user->getRole() !== 'admin') {
            throw new Forbidden('Only admin can edit articles.');
        }
        $categoryList = Category::getAll();
        $title = $article->getName() . ' - edit';
        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php', [
            'article' => $article,
            'categoryList' => $categoryList,
            'title' => $title,
        ]);
    }

    public function add(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if ($this->user->getRole() !== 'admin') {
            throw new Forbidden('Only admin can edit articles.');
        }

        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php');
    }

    public function delete(int $articleId): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if ($this->user->getRole() !== 'admin') {
            throw new Forbidden('Удалять статьи может только администратор');
        }
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        $article->delete();

        $this->view->renderHtml('admin/admin.php');
    }

    public function comment(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $comment = Comment::addCommentFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/view.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }
    }
}