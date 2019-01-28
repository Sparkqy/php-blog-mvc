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

    /**
     * @param array $fields
     * @param User $author
     * @return Article
     * @throws FileUploadException
     * @throws InvalidArgumentException
     */
    public static function createFromArray(array $fields, User $author): Article
    {
        // validation
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
        if (empty($_FILES['aImages']['name'][0])) {
            throw new InvalidArgumentException('Empty image field.');
        }

        $article = new Article();
        $articleTagLink = new ArticleTagLink();

        // article data save to object
        $article->setAuthor($author);
        $article->setCatId($fields['aCatId']);
        $article->setName($fields['aName']);
        $article->setText($fields['aText']);
        $article->setShortDescription($fields['aShortDesc']);
        $article->setImages($_FILES['aImages']['name']);

        // uploading image to server folder
        ImageUploader::uploadImage($_FILES['aImages']);

        $article->save();

        // article_tag_links data to object
        $articleTagLink->setArticleId($article->getId());
        $articleTagLink->setTagId($fields['aTagId']);

        $articleTagLink->saveArray();

        return $article;
    }

    /**
     * @param array $fields
     * @return Article
     * @throws InvalidArgumentException
     */
    public function updateFromArray(array $fields)
    {
        if (empty($fields['eName'])) {
            throw new InvalidArgumentException('Empty article name field.');
        }
        if (empty($fields['eText'])) {
            throw new InvalidArgumentException('Empty article text field.');
        }
        if (empty($fields['eShortDesc'])) {
            throw new InvalidArgumentException('Empty article description field.');
        }
        if (empty($fields['eCatId'])) {
            throw new InvalidArgumentException('Empty article category field.');
        }
        if (empty($fields['eTagId'])) {
            throw new InvalidArgumentException('Empty article tags field.');
        }
       if (empty($_FILES['eImages']['name'][0])) {
           throw new InvalidArgumentException('Empty image field.');
       }


        // article data update to object
        $this->setName($fields['eName']);
        $this->setCatId($fields['eCatId']);
        $this->setText($fields['eText']);
        $this->setShortDescription($fields['eShortDesc']);
        $this->setImages($_FILES['eImages']['name']);

        // uploading image to server folder
        ImageUploader::uploadImage($_FILES['eImages']);

        $this->save();

        // articleTagLinks data update to object
        $articleTagLink = ArticleTagLink::getByOneColumn('article_id', $this->getId());
        // deleting article_tag_links old data from db
        $articleTagLink->deleteByOneColumn('article_id', $this->getId());
        // article_tag_links data to object
        $articleTagLink->setTagId($fields['eTagId']);

        $articleTagLink->saveArray();

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
