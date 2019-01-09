<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/2/2018
 * Time: 6:00 PM
 */

namespace MyProject\Models\Categories;

use MyProject\Services\Db;
use MyProject\Models\ActiveRecordEntity;

class Category extends ActiveRecordEntity
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

    protected static function getTableName(): string
    {
        return 'categories';
    }
}