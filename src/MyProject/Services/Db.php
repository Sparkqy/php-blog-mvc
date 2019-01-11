<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 06.09.2018
 * Time: 13:41
 */

namespace MyProject\Services;

use MyProject\Exceptions\DbException;
use PDO;

class Db
{
    private $pdo;
    private static $instance;

    private function __construct()
    {

        try
        {
            $dbOptions = (require __DIR__ . '/../../settings.php')['db'];
            $this->pdo = new PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['db_name'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->exec('SET NAMES UTF8');


        } catch (\PDOException $e)
        {
            throw new DbException('Database connecting error: ' . $e->getMessage());
        }
    }

    public function getLastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }
    
    public static function getInstance(): self
    {
        if (self::$instance === null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function query(string $sql, $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result)
        {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }
}