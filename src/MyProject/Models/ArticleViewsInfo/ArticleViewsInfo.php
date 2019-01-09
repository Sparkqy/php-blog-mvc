<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/31/2018
 * Time: 1:58 PM
 */

namespace MyProject\Models\ArticlesViewsInfo;


use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Articles\Article;
use MyProject\Services\Db;

class ArticleViewsInfo extends ActiveRecordEntity
{
    protected $articleId;
    protected $views;

    public function getViews(): int
    {
        return (int)$this->views;
    }

    public function getArticleId(): int
    {
        return (int)$this->articleId;
    }

    protected static function getTableName(): string
    {
        return 'article_views_info';
    }

    public function incViews(int $articleId): void
    {
        $db = Db::getInstance();
        $idExists = $db->query('SELECT `id` FROM `' . static::getTableName() . '` WHERE `article_id` = :articleId;',
            [':articleId' => $articleId]);

        if (!empty($idExists)) {
            $db->query('UPDATE `' . static::getTableName() .
                '` SET `views` = `views` + 1 WHERE `article_id` = :articleId;',
                ['articleId' => $articleId]);
        }

        if (empty($idExists)) {
            $db->query('INSERT INTO `' . static::getTableName() . '` (`article_id`, `views`) VALUES (:articleId, 0);',
                [':articleId' => $articleId]);
        }
    }
}