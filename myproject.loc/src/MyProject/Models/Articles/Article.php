<?php
/**
 * Created by PhpStorm.
 * User: sparky
 * Date: 31/08/18
 * Time: 11:57
 */

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Categories\Category;
use MyProject\Models\Users\User;

class Article extends ActiveRecordEntity
{
    protected $categoryId;
    protected $name;
    protected $text;
    protected $authorId;
    protected $image;
    protected $createdAt;

    protected static function getTableName(): string
    {
        return 'articles';
    }

    public function getImgPath(): string
    {
        return $this->image;
    }
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }
    public function getCategory(): Category
    {
        return Category::getById($this->categoryId);
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getText(): string
    {
        return $this->text;
    }
    public function getCatId(): int
    {
        return (int) $this->categoryId;
    }
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    public function getTagId(): string
    {
        return $this->tagId;
    }

    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }
    public function setName(string $newName): void
    {
        $this->name = $newName;
    }
    public function setText(string $newText): void
    {
        $this->text = $newText;
    }
    public function setImage(string $imagePath): void
    {
        $this->image = $imagePath;
    }
    public function setAuthorId(string $newAuthorId): void
    {
        $this->authorId = $newAuthorId;
    }
    public function setTags(string $tags): void
    {
        $this->tagId = $tags;
    }
    public function setCatId(string $catId): void
    {
        $this->categoryId = $catId;
    }

    public static function createFromArray(array $fields, User $author): Article
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['image'])) {
            throw new InvalidArgumentException('Не передана картинка статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        if (empty($fields['tags'])) {
            throw new InvalidArgumentException('Не переданы ID теги статьи');
        }

        if (empty($fields['catId'])) {
            throw new InvalidArgumentException('Не передан ID категории статьи');
        }

        $article = new Article();

        $article->setAuthor($author);
        $article->setName($fields['name']);
        $article->setImage($fields['image']);
        $article->setCatId($fields['catId']);
        $article->setText($fields['text']);
        $article->setTags($fields['tags']);

        $article->save();

        return $article;
    }

    public function updateFromArray(array $fields): Article
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        if (empty($fields['tags'])) {
            throw new InvalidArgumentException('Не переданы ID теги статьи');
        }

        if (empty($fields['catId'])) {
            throw new InvalidArgumentException('Не передан ID категории статьи');
        }

        $this->setName($fields['name']);
        $this->setCatId($fields['catId']);
        $this->setText($fields['text']);
        $this->setTags($fields['tags']);

        $this->save();

        return $this;
    }
}
