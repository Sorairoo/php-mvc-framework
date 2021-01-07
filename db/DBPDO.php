<?php

namespace App\DB;

class DbPdo
{
    private $conn;
    protected static $instance;

    public static function getInstance(array $options): DbPdo
    {
        if (!static::$instance) {
            static::$instance = new static($options);
        }
        return static::$instance;

    }

    private function __construct(array $options)
    {

        $this->conn = new \PDO($options['dsn'], $options['user'], $options['password']);
        if (array_key_exists('options', $options)) {
            foreach ($options['options'] as $opt) {
                $this->conn->setAttribute(key($opt), current($opt));
            }
        }

    }

    public function getConn()
    {
        return $this->conn;
    }
}