<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 11.09.2018
 * Time: 15:51
 */

namespace MyProject\Models;

use MyProject\Exceptions\UserActivationException;
use MyProject\Services\Db;

/**
 * Class ActiveRecordEntity
 * @package MyProject\Models
 */
abstract class ActiveRecordEntity
{
    protected $id;

    /**
     * @method public getId returns an id from object
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    /**
     * @method public _set transforms an underscore value to CamelCase value
     * @param string $string
     * @return string
     */
    private function underscoreToCamelCase(string $string): string
    {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
    }

    /**
     * @method public static getAll returns an array of every entry from db
     * @return array
     */
    public static function getAll(): array
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }

    /**
     * @method public static getById returns an entity by id from db table
     * @param int $id
     * @return ActiveRecordEntity|null
     */
    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `id` = :id;',
            [':id' => $id],
            static::class);

        return $entities ? $entities[0] : null;
    }

    /**
     * @method public static getByCategoryId returns an array of entries by category id from db
     * @param int $categoryId
     * @return array|null
     */
    public static function getByCategoryId(int $categoryId): ?array
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `category_id` = :categoryId;',
            [':categoryId' => $categoryId],
            static::class);

        return $entities ? $entities : null;
    }

    /**
     * @method public static getTagsByArticleId returns an array of tags by article id from db
     * @param int $articleId
     * @return array|null
     */
    public static function getTagsByArticleId(int $articleId): ?array
    {
        $db = Db::getInstance();
        $entities = $db->query('SELECT * FROM `' . static::getTableName() . '` JOIN `article_tag_links` AS links ON
            (tags.id = links.tag_id) WHERE links.article_id = :articleId;',
            [':articleId' => $articleId,],
            static::class);

        return $entities ? $entities : null;
    }

    /**
     * @method public static getArticlesByTags returns an array of articles by tag id from db
     * @param int $tagId
     * @return array|null
     */
    public static function getArticlesByTags(int $tagId): ?array
    {
        $db = Db::getInstance();
        $entities = $db->query('SELECT * FROM `' . static::getTableName() . '` JOIN `article_tag_links` AS links ON
            (articles.id = links.article_id) WHERE links.tag_id = :tagId;',
            [':tagId' => $tagId,],
            static::class);

        return $entities ? $entities : null;
    }

    /**
     * @method public static getLastArticlesByCategoryId returns an array of int $limit articles by category id from db
     * @param int $categoryId
     * @param int $limit
     * @return array|null
     */
    public static function getLastArticlesByCategoryId(int $categoryId, int $limit): ?array
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() .
            '` WHERE `category_id` = :categoryId ORDER BY `created_at` DESC LIMIT ' . $limit . ';',
            [':categoryId' => $categoryId,],
            static::class);

        return $entities ? $entities : null;
    }

    /**
     * @method public static getLastArticles returns an array of last int $limit articles from db
     * @param int $limit
     * @return array|null
     */
    public static function getLastArticles(int $limit): ?array
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` ORDER BY `created_at` DESC LIMIT ' . $limit . ';',
            [],
            static::class);

        return $entities ? $entities : null;
    }

    /**
     * @method public static getPaginationLastArticles pagination for articles
     * @param int $page
     * @return array|null
     */
    public static function getPaginationLastArticles(int $page): ?array
    {
        $itemsPerPage = 6;
        $offset = ($page - 1) * $itemsPerPage;
        $db = Db::getInstance();
        $entities = $db->query(
            "SELECT * FROM `" . static::getTableName() .
            "` ORDER BY `created_at` DESC LIMIT " . $offset . "," . "$itemsPerPage;",
            [],
            static::class);

        return $entities ? $entities : null;
    }

    /**
     * @method public static getPaginationCategoryId pagination for categories
     * @param int $categoryId
     * @param int $page
     * @return array|null
     */
    public static function getPaginationCategoryId(int $categoryId, int $page): ?array
    {
        $itemsPerPage = 5;
        $offset = ($page - 1) * $itemsPerPage;
        $db = Db::getInstance();
        $entities = $db->query(
            "SELECT * FROM `" . static::getTableName() .
            "` WHERE `category_id` = :categoryId ORDER BY `id` LIMIT " . $offset . "," . "$itemsPerPage;",
            [':categoryId' => $categoryId],
            static::class);

        return $entities ? $entities : null;
    }

    public static function getPaginationTagId(int $tagId, int $page): ?array
    {
        $itemsPerPage = 5;
        $offset = ($page - 1) * $itemsPerPage;
        $db = Db::getInstance();
        $entities = $db->query('SELECT * FROM `' . static::getTableName() . '` JOIN `article_tag_links` AS links ON
            (articles.id = links.article_id) WHERE links.tag_id = :tagId;',
            [':tagId' => $tagId,],
            static::class);

        return $entities ? $entities : null;
    }

    /**
     * @method public static getTopCommentators returns an array of top commentators from db
     * @return array|null
     */
    public static function getTopCommentators(): ?array
    {
        $sql = 'SELECT `user_name` FROM `' . static::getTableName() .
            '` GROUP BY `user_id` ORDER BY COUNT(`user_id`) DESC LIMIT 5;';
        $db = Db::getInstance();
        $result = $db->query($sql, [], static::class);

        return $result ? $result : null;
    }

    /**
     * @method public static getByOneColumn returns an entity by column name and its value from db
     * @param string $columnName
     * @param $value
     * @return ActiveRecordEntity|null
     */
    public static function getByOneColumn(string $columnName, $value): ?self
    {
        $db = Db::getInstance();
        $result =
            $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;',
                [':value' => $value],
                static::class);

        if ($result === null) {
            return null;
        }

        return $result[0];
    }

    /**
     * @method public static getByOneColumnArray returns an array of entities by column name and its value from db
     * @param string $columnName
     * @param $value
     * @return array|null
     */
    public static function getByOneColumnArray(string $columnName, $value): ?array
    {
        $db = Db::getInstance();
        $result = $db->query('SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value;',
            [':value' => $value],
            static::class);

        return !empty($result) ? $result : null;
    }

    /**
     * @method public static getPopularArticles returns an array of most popular 6 articles from db
     * @return array|null
     */
    public static function getPopularArticles(): ?array
    {
        $db = Db::getInstance();
        $sql =
            'SELECT articles.id, articles.category_id, articles.author_id, articles.name, articles.text, articles.image, articles.created_at
            FROM `articles`
            JOIN `article_views_info`
            ON articles.id = article_views_info.article_id 
            ORDER BY `views` DESC LIMIT 6;';
        $result = $db->query($sql, [], static::class);

        return !empty($result) ? $result : null;
    }

    /**
     * @method public static getLastComments returns an array of last 10 comments from db
     * @return array|null
     */
    public static function getLastComments(): ?array
    {
        $db = Db::getInstance();
        $result = $db->query('SELECT * FROM `' . static::getTableName() . '` ORDER BY `id` DESC LIMIT 10;',
            [],
            static::class);

        return !empty($result) ? $result : null;
    }

    /**
     * @method public save updates or inserts data to db
     */
    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }

    /**
     * @method private camelCaseToUnderscore transforms CamelCase string to underscore
     * @param string $source
     * @return string
     */
    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    /**
     * @method private mapPropertiesToDbFormat transforms object's data to db format
     * @return array
     */
    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }

        return $mappedProperties;
    }

    /**
     * @method private update updates data to db
     * @param array $mappedProperties
     */
    private function update(array $mappedProperties): void
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;

        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index; // :param1
            $columns2params[] = $column . ' = ' . $param; // column1 = :param1
            $params2values[':param' . $index] = $value; // [:param1 => value1]
            $index++;
        }

        $sql = 'UPDATE `' . static::getTableName() . '` SET ' . implode(', ', $columns2params) .
            ' WHERE id = ' . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    /**
     * @method private insert inserts data to db
     * @param array $mappedProperties
     */
    private function insert(array $mappedProperties): void
    {
        $filteredProperties = array_filter($mappedProperties);
        $columns = [];
        $paramsNames = [];
        $params2values = [];

        foreach ($filteredProperties as $columnName => $value) {
            $columns[] = '`' . $columnName . '`';
            $paramsNames[] = ':' . $columnName;
            $params2values[':' . $columnName] = $value;
        }

        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);

        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' .
            $paramsNamesViaSemicolon . ');';
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
        $this->id = $db->getLastInsertId();
        $this->refresh();
    }

    /**
     * @method private refresh refreshes data in db
     */
    private function refresh(): void
    {
        $objectFromDb = static::getById($this->id);
        $reflector = new \ReflectionObject($objectFromDb);
        $properties = $reflector->getProperties();

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $this->$propertyName = $property->getValue($objectFromDb);
        }

    }

    /**
     * @method public delete deletes entry in db
     */
    public function delete(): void
    {
        $db = Db::getInstance();
        $sql = 'DELETE FROM `' . static::getTableName() . '` WHERE `id` = :id;';
        $params = [':id' => $this->id];

        $db->query($sql, $params);
        $this->id = null;
    }

    /**
     * @method public static validate returns string value if validation OK
     * @param string $value
     * @return string
     */
    public static function validate($value = ''): string
    {
        $value = trim(stripcslashes(strip_tags(htmlspecialchars($value))));

        return $value;
    }

    /**
     * @return string
     */
    abstract protected static function getTableName(): string;
}