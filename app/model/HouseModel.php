<?php

class HouseModel
{
    private $table = "houses";
    private $database;

    const COLUMN_TYPE = [
        "id" => PDO::PARAM_NULL,
        "model" => PDO::PARAM_STR,
        "address" => PDO::PARAM_STR,
        "price_per_month" => PDO::PARAM_STR,
        "rented_status" => PDO::PARAM_STR,
        "created_at" => PDO::PARAM_STR,
    ];

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getSpecificHouse($houseId)
    {
        $this->database->query("SELECT model, address, price_per_month FROM $this->table WHERE id =:id");
        $this->database->bind('id', $houseId, PDO::PARAM_STR);
        return $this->database->fetchSingle();
    }

    public function getAllHouse()
    {
        $this->database->query("SELECT * FROM $this->table");
        return $this->database->fetchAll();
    }

    public function getAllHouseAddress()
    {
        $this->database->query("SELECT address FROM $this->table WHERE rented_status=:rented_status");
        $this->database->bind('rented_status', 0, PDO::PARAM_INT);
        return $this->database->fetchAll();
    }

    /**
     * @param $data
     * {
     *  model,
     *  address,
     *  price_per_month,
     *  created_at
     * }
     * @return mixed
     */
    public function createHouse($data): mixed
    {
        $query = "INSERT INTO {$this->table} (model, address, price_per_month, created_at) VALUES(:model, :address, :price_per_month, :created_at)";
        $this->database->query($query);
        $this->database->bind('model', $data['model'], self::COLUMN_TYPE['model']);
        $this->database->bind('address', $data['address'], self::COLUMN_TYPE['address']);
        $this->database->bind('price_per_month', $data['price_per_month'], self::COLUMN_TYPE['price_per_month']);
        $this->database->bind('created_at', $data['created_at'], self::COLUMN_TYPE['created_at']);
        $this->database->execute();

        return $this->database->rowCount();
    }
}