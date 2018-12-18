<?php
/**
 * Created by PhpStorm.
 * User: sparky
 * Date: 31/08/18
 * Time: 11:57
 */

namespace MyProject\Models\Articles;

use http\Exception\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Categories\Category;
use MyProject\Models\Users\User;
use MyProject\Services\Db;

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
        return (int)$this->categoryId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
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
        if (empty($fields['aName'])) {
            throw new InvalidArgumentException('Empty article\'s name field.');
        }

        if (empty($fields['aImage'])) {
            throw new InvalidArgumentException('Empty article\'s image field.');
        }

        if (empty($fields['aText'])) {
            throw new InvalidArgumentException('Empty article\'s text field.');
        }

        if (empty($fields['aTags'])) {
            throw new InvalidArgumentException('Empty article\'s tags ID field.');
        }

        if (empty($fields['aCatId'])) {
            throw new InvalidArgumentException('Empty article\'s category ID field.');
        }

        $article = new Article();

        $article->setAuthor($author);
        $article->setName($fields['aName']);
        $article->setImage($fields['aImage']);
        $article->setCatId($fields['aCatId']);
        $article->setText($fields['aText']);

        $article->save();

        return $article;
    }

    public function updateFromArray(array $fields): Article
    {
        if (empty($fields['eName'])) {
            throw new InvalidArgumentException('Empty article\'s name field.');
        }

        if (empty($fields['eText'])) {
            throw new InvalidArgumentException('Empty article\' text field.');
        }

        if (empty($fields['eCatId'])) {
            throw new InvalidArgumentException('Empty article\'s category ID field.');
        }

        $this->setName($fields['eName']);
        $this->setCatId($fields['eCatId']);
        $this->setText($fields['eText']);

        $this->save();

        return $this;
    }

    public static function search(string $query): ?array
    {
        $query = Article::validate($query);

        $db = Db::getInstance();
        $result =
            $db->query("SELECT * FROM `" . static::getTableName() . "` WHERE `name` LIKE CONCAT('%', :query, '%')",
                [':query' => $query], static::class);

        return !empty($result) ? $result : null;
    }

    public static function nextArticle(int $articleId): ?self
    {
        $db = Db::getInstance();
        $nextId = $articleId + 1;
        $result = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE `id` = :nextId;',
            [':nextId' => $nextId], static::class);

        return $result[0] ? $result[0] : null;
    }

    public static function prevArticle(int $articleId): ?self
    {
        $db = Db::getInstance();
        $prevId = $articleId - 1;
        $result = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE `id` = :nextId;',
            [':nextId' => $prevId], static::class);

        return $result[0] ? $result[0] : null;
    }
}
