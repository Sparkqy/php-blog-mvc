<?php
/**
 * Created by PhpStorm.
 * User: sparky
 * Date: 31/08/18
 * Time: 11:57
 */

namespace MyProject\Models\Articles;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\FileUploadException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\ArticleTagLinks\ArticleTagLink;
use MyProject\Models\Categories\Category;
use MyProject\Models\Users\User;
use MyProject\Services\Db;
use MyProject\Services\ImageUploader;

class Article extends ActiveRecordEntity
{
    protected $authorId;
    protected $categoryId;
    protected $name;
    protected $shortDescription;
    protected $text;
    protected $images;
    protected $createdAt;

    protected static function getTableName(): string
    {
        return 'articles';
    }

    public function getImages(): array
    {
        return unserialize($this->images);
    }

    public function getAdditionalImages(): ?array
    {
        $array = $this->getImages();
        unset($array[0]);

        return $array;
    }

    public function getMainImage(): string
    {
        return $this->getImages()[0];
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    /**
     * @return Category
     */
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

    public function setImages(array $images): void
    {
        $imagePath = 'images/articles/';
        foreach ($images as &$image) {
            $image = $imagePath . $image;
        }

        $imagesToDb = serialize($images);
        $this->images = $imagesToDb;
    }

    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = static::validate((string)$shortDescription);
    }

    public function setAuthor(User $author): void
    {
        $this->authorId = static::validate((int)$author->getId());
    }

    public function setName(string $name): void
    {
        $this->name = static::validate((string)$name);
    }

    public function setText(string $text): void
    {
        $this->text = static::validate((string)$text);
    }

    public function setCatId(int $catId): void
    {
        $this->categoryId = (int)$catId;
    }

    public static function createFromArray(array $fields, User $author): Article
    {
        if (empty($fields['aName'])) {
            throw new InvalidArgumentException('Empty article name field.');
        }

        if (empty($fields['aShortDesc'])) {
            throw new InvalidArgumentException('Empty article description field.');
        }

        if (empty($fields['aText'])) {
            throw new InvalidArgumentException('Empty article text field.');
        }

        if (empty($fields['aTagId'])) {
            throw new InvalidArgumentException('Empty article tags ID field.');
        }

        if (empty($fields['aCatId'])) {
            throw new InvalidArgumentException('Empty article category ID field.');
        }


        $article = new Article();
        $articleTagLink = new ArticleTagLink();

        // article data to db
        $article->setAuthor($author);
        $article->setCatId($fields['aCatId']);
        $article->setName($fields['aName']);
        $article->setText($fields['aText']);
        $article->setShortDescription($fields['aShortDesc']);
        $article->setImages($_FILES['aImages']['name']);

        // uploading image to server folder
        ImageUploader::uploadImage($_FILES['aImages']);

        $article->save();

        // article_tag_links to db
        $articleTagLink->setArticleId($article->getId());
        $articleTagLink->setTagId($fields['aTagId']);

        $articleTagLink->saveArray();

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
