<?php
namespace case\connector;

use PDO;

// реалізований патерн одинак (singletone)
// дозволяє не створювати для одного користувача купц різних
// запитів а обійтися тільки 1. Це не тільки спростить роботу з бд
// а і дозволить використовувати деякі контстанти, як наприклад LAST_INSERT_ID()

class Connector
{ 
    protected $pdo;
    static protected $connector;

    public function __construct()
    {
        $dsn = 'mysql:host=mysql;dbname=case';
        $this->pdo = new PDO($dsn, 'admin', 'admin');
    }

    public function get()
    {
        return $this->pdo;
    }

    public function getQuery(string $sql, array $params = null)
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        return $query;
    }

    static public function getInstance()
    {
        if(!isset(self::$connector))
        {
            self::$connector = new static();
        }
        return self::$connector;
    }
}