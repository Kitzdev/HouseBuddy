<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $databaseName = DB_NAME;

    private $databaseHelper;
    private $statement;
    private $exception;

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
        return $this;
    }

    public function bind($parameter, $value, $type = null)
    {
        $this->statement->bindValue($parameter, $value, $type);
        return $this;
    }

    public function execute()
    {
        try {
            $this->statement->execute();
        } catch (PDOException $exception) {
            var_dump($exception->getMessage());
            $this->exception = $exception->getCode();
        }

        return $this;
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

    public function isError(): bool
    {
        return !empty($this->exception);
    }

    public function getErrorCode()
    {
        return $this->exception;
    }
}