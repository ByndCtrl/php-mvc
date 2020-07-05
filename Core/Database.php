<?php

declare(strict_types=1);

namespace Core;

use PDO;
use PDOStatement;
use BadMethodCallException;
use App\Credentials;

/**
 * Class Database
 * @package Core
 */
class Database
{
    protected static ?Database $instance = null;
    protected ?PDO $pdo = null;

    final function __construct()
    {
        if (self::$instance === null)
        {
            $dsn = 'mysql:host=' . Credentials::DB_HOST . ';dbname=' . Credentials::DB_NAME;

            $opt = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => FALSE,
                PDO::ATTR_PERSISTENT => TRUE
            );

            $this->pdo = new PDO($dsn, Credentials::DB_USER, Credentials::DB_PASSWORD, $opt);
        }
    }

    final function __clone()
    {
    }

    /**
     * @return Database
     */
    public static function instance(): Database
    {
        if (self::$instance === null)
        {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @param string $method
     * @param array $args
     *
     * @return PDOStatement
     */
    public function __call(string $method = '', array $args = []): PDOStatement
    {
        if (is_callable(array($this->pdo, $method)))
        {
            return call_user_func_array(array($this->pdo, $method), $args);
        }
        else
        {
            throw new BadMethodCallException('Undefined method Database::' . $method);
        }
    }

    /**
     * @param string $sql
     * @param array $args
     *
     * @return PDOStatement
     */
    public function run(string $sql = '', array $args = []): PDOStatement
    {
        if (!$args)
        {
            return $this->query($sql);
        }

        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
