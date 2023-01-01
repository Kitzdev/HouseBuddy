<?php

namespace model;
class House
{
    private $table = "houses";
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getSpecificHouse($houseId)
    {

    }

    public function getAllHouse()
    {

    }

    public function getAllHouseAddress()
    {

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
        $query = "INSERT INTO {$this->table} VALUES('', :model, :address, :price_per_month, :created_at)";
        $this->database->query($query);
        $this->database->bind('model', $data['model']);
        $this->database->bind('address', $data['address']);
        $this->database->bind('price_per_month', $data['price_per_month']);
        $this->database->bind('created_at', $data['created_at']);
        $this->database->execute();

        return $this->database->rowCount();
    }
}