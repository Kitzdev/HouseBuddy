<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $databaseName = DB_NAME;

    private $databaseHelper;
    private $statement;

    public function __construct()
    {
        $dataSourceName = "pgsql:host={$this->host};port=5432;dbname={$this->databaseName};";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        try {
            $this->databaseHelper = new PDO($dataSourceName, $this->user, $this->password, $options);
        } catch (PDOException $PDOException) {
            die($PDOException->getMessage());
        }
    }

    public function query($query)
    {
        $this->statement = $this->databaseHelper->prepare($query);
    }

    public function bind($parameter, $value, $type = null)
    {
        $this->statement->bindValue($parameter, $value, $type);
    }

    public function execute()
    {
        $this->statement->execute();
    }

    public function fetchAll()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchSingle()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount() {
        return $this->statement->rowCount();
    }
}