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

        if ($article === null)
        {
            throw new NotFoundException();
        }

        $comments = Comment::getByOneColumnArray('article_id', $articleId);
        $tags = Tag::getTagsByArticleId($articleId);
        $author = $article->getAuthor()->getNickname();
        $title = $article->getName();

        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
            'author' => $author,
            'title' => $title,
            'tags' => $tags,
            'comments' => $comments,
        ]);
    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article === null)
        {
            throw new NotFoundException();
        }

        if ($this->user === null)
        {
            throw new UnauthorizedException();
        }

        if ($this->user->getRole() !== 'admin')
        {
            throw new Forbidden('Редактировать статьи может только администратор');
        }

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

        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }

    public function add(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if ($this->user->getRole() !== 'admin')
        {
            throw new Forbidden('Добавлять статьи может только администратор');
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

        if ($this->user->getRole() !== 'admin')
        {
            throw new Forbidden('Удалять статьи может только администратор');
        }
        $article = Article::getById($articleId);

        if ($article === null)
        {
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

        if (!empty($_POST))
        {
            try
            {
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