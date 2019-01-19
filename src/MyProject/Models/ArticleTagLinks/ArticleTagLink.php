<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/19/2018
 * Time: 6:36 PM
 */

namespace MyProject\Models\ArticleTagLinks;


use MyProject\Models\ActiveRecordEntity;
use MyProject\Services\Db;

class ArticleTagLink extends ActiveRecordEntity
{
    protected $tagId;
    protected $articleId;

    public static function getTableName(): string
    {
        return 'article_tag_links';
    }

    public function setTagId(array $tags): void
    {

        $this->tagId = (array)$tags;
    }

    public function setArticleId(int $articleId): void
    {
        $this->articleId = (int)$articleId;
    }
}