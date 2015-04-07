<?php
/**
 * Created by PhpStorm.
 * User: nickp666
 * Date: 07/04/15
 * Time: 22:45
 */

namespace vendor;


class DBConnector {

    public $connection;

    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    protected function __construct()
    {
        try {
            $this->connection = new \PDO(sprintf('mysql:host=%s;dbname=%s', DBMS_HOST, DBMS_DB) , DBMS_USER, DBMS_PASS);
        } catch (\PDOException $e) {
            die('DBMS connection issue: ' . $e);
        }

    }

    public function setFetchMode($fetch_mode, $query)
    {
        $query->setFetchMode($fetch_mode);
    }

    public function query($query, $fetchmode = false)
    {
        return $this->connection->query($query);
    }

    // Dont clone my shit kthx.
    private function __clone()
    {}

    private function __wakeup()
    {}
}