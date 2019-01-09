<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/4/2018
 * Time: 5:44 AM
 */

namespace MyProject\Models\Tags;


use MyProject\Models\ActiveRecordEntity;

class Tag extends ActiveRecordEntity
{
    protected $name;
    protected $createdAt;


    public function getName(): string
    {
        return (string)$this->name;
    }

    public function getCreatedAt(): string 
    {
    	return (string)$this->createdAt;
    }

    public static function getTableName(): string
    {
        return 'tags';
    }
}