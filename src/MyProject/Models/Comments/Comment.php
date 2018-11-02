<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/8/2018
 * Time: 2:47 PM
 */

namespace MyProject\Models\Comments;


use MyProject\Models\ActiveRecordEntity;

class Comment extends ActiveRecordEntity
{
    protected $articleId;
    protected $text;
    protected $userId;
    protected $userName;

    public function getArticleId(): int
    {
        return $this->articleId;
    }
    public function getText(): string
    {
        return $this->text;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getName(): string
    {
        return $this->userName;
    }

    public function setText(string $text): void
    {
        $this->text = (string) $text;
    }

    public static function getTableName(): string
    {
        return 'comments';
    }

    public static function addCommentFromArray(array $fields): Comment
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Пусто');
        }

        $comment = new Comment();

        $comment->userName = $fields['user_name'];
        $comment->articleId = $fields['article_id'];
        $comment->userId = $fields['user_id'];
        $comment->text = $fields['text'];

        $comment->save();

        return $comment;
    }
}