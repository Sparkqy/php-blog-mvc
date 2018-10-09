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

    public function getName(): string
    {
        return $this->name;
    }

    protected static function getTableName(): string
    {
        return 'categories';
    }
}