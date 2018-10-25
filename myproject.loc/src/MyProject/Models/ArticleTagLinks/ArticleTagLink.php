<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/19/2018
 * Time: 6:36 PM
 */

namespace MyProject\Models\ArticleTagLinks;


use MyProject\Models\ActiveRecordEntity;

class ArticleTagLink extends ActiveRecordEntity
{
    protected $tagId;
    protected $articleId;

    public static function getTableName(): string
    {
        return 'article_tag_links';
    }
}