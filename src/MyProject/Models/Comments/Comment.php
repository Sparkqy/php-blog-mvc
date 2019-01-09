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
    protected $createdAt;

    public function getArticleId(): int
    {
        return (int)$this->articleId;
    }

    public function getText(): string
    {
        return (string)$this->text;
    }

    public function getUserId(): int
    {
        return (int)$this->userId;
    }

    public function getCreatedAt(): string 
    {
        return (string)$this->createdAt;
    }

    public function getCommentatorName(int $userId): ?string
    {
        $db = Db::getInstance();
        $commentatorName = $db->query(
            'SELECT `nickname` FROM `users` WHERE `id` = :userId;',
            [':userId' => $userId]);

        return $commentatorName ? (string)$commentatorName : null;
    }

    public static function getTableName(): string
    {
        return 'comments';
    }

    public function setText(string $text): void
    {
        $this->text = (string)$text;
    }

    public static function addCommentFromArray(array $fields): void
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Empty');
        }

        $comment = new Comment();

        $comment->articleId = $fields['article_id'];
        $comment->userId = $fields['user_id'];
        $comment->text = $this->setText($fields['text']);

        $comment->save();
    }
}