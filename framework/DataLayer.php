<?php

namespace framework;

class DataLayer
{
    private $dbHost = DB_HOST;
    private $dbPort = DB_PORT;
    private $dbName = DB_DATABASENAME;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASSWORD;

    /**
     * @var \PDO
     */
    private $dbh;
    /**
     * @var \PDOStatement
     */
    private $stmt;
    private $error;

    public function __construct()
    {
        try {
            $dsn = "pgsql:host=$this->dbHost;port=$this->dbPort;dbname=$this->dbName;";

            $options = [
                \PDO::ATTR_PERSISTENT => true,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ];

            $this->dbh = new \PDO($dsn, $this->dbUser, $this->dbPass, $options);
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
        return $this;
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = \PDO::PARAM_INT;
                    break;
                case is_null($value):
                    $type = \PDO::PARAM_NULL;
                    break;
                case is_bool($value):
                    $type = \PDO::PARAM_BOOL;
                    break;
                default:
                    $type = \PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
        return $this;
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function findAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function findOne()
    {
        $this->execute();
        return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}