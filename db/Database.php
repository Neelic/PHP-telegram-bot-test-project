<?php

namespace db;

use Exception;
use PDO;
use PDOStatement;

class Database
{
    private static ?Database $instance = null;
    private ?PDO $connection;

    protected function __construct()
    {
        $conf = include_once './db_config.php';
        $this->connection = new PDO (
            "{$conf['db']}:host={$conf['db_host']};port={$conf['db_port']};
                dbname={$conf['db_name']};", $conf['db_username'], $conf['db_password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function __wakeup()
    {
        throw new Exception('method not available');
    }

    public static function getInstance(): Database
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function connection(): PDO
    {
        return static::getInstance()->connection;
    }

    public static function prepare($statement): false|PDOStatement
    {
        return static::connection()->prepare($statement);
    }

    public static function lastInseredID(): int
    {
        return intval(static::connection()->lastInsertId());
    }
}