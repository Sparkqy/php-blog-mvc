<?php
/**
 * Created by PhpStorm.
 * User: sparky
 * Date: 31/08/18
 * Time: 11:57
 */

namespace MyProject\Models\Articles;


class Article
{
    private $id;
    private $name;
    private $text;
    public $authorId;
    private $createdAt;

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    public function underscoreToCamelCase(string $string): string
    {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }
}
