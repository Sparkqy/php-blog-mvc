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
    protected $authorId;
    protected $categoryId;
    protected $name;
    protected $shortDescription;
    protected $text;
    protected $image1;
    protected $image2;
    protected $createdAt;

    protected static function getTableName(): string
    {
        return 'articles';
    }

    public function getImg1(): string
    {
        return (string)$this->image1;
    }

    public function getImg2(): string
    {
        return (string)$this->image2;
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
        return (string)$this->name;
    }

    public function getText(): string
    {
        return (string)$this->text;
    }

    public function getCatId(): int
    {
        return (int)$this->categoryId;
    }

    public function getCreatedAt(): string
    {
        return (string)$this->createdAt;
    }

    public function getShortDescription(): string
    {
        return (string)$this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = (string)$shortDescription;
    }

    public function setAuthor(User $author): void
    {
        $this->authorId = (int)$author->getId();
    }

    public function setName(string $name): void
    {
        $this->name = (string)$name;
    }

    public function setText(string $text): void
    {
        $this->text = (string)$text;
    }

    public function setImage1(string $image1): void
    {
        $this->image1 = (string)$image1;
    }

    public function setImage2(string $image2): void
    {
        $this->image2 = (string)$image2;
    }

    public function setAuthorId(string $authorId): void
    {
        $this->authorId = (string)$authorId;
    }

    public function setCatId(string $catId): void
    {
        $this->categoryId = (string)$catId;
    }

    public static function createFromArray(array $fields, User $author): Article
    {
        if (empty($fields['aName'])) {
            throw new InvalidArgumentException('Empty article\'s name field.');
        }

        if (empty($fields['aImage1'])) {
            throw new InvalidArgumentException('Empty article\'s first image field.');
        }

        if (empty($fields['aDesc'])) {
            throw new InvalidArgumentException('Empty article\'s description field.');
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

        $article
            ->setAuthor($author)
            ->setCatId($fields['aCatId'])
            ->setName($fields['aName'])
            ->setImage1($fields['aImage1'])
            ->setImage2($fields['aImage2'])
            ->setText($fields['aText'])

            ->save();

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
