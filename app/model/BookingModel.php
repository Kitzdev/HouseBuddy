<?php

class BookingModel
{
    private $table = "booking";
    private $database;

    const COLUMN_TYPE = [
        "booking_id" => PDO::PARAM_NULL,
        "customer_id" => PDO::PARAM_STR,
        "house_address" => PDO::PARAM_STR,
        "house_model" => PDO::PARAM_STR,
        "duration" => PDO::PARAM_INT,
        "total_bill" => PDO::PARAM_STR,
        "end_date" => PDO::PARAM_STR,
        "created_at" => PDO::PARAM_STR,
    ];

    public function __construct()
    {
        $this->database = new Database();
    }

    /**
     * @param $data
     * {
     *  customer_id,
     *  house_address,
     *  duration,
     *  total_bill,
     *  end_date,
     *  created_at,
     * }
     * @return mixed
     */
    public function createHouse($data): mixed
    {
        $query = "INSERT INTO {$this->table} (customer_id, house_address, duration, total_bill, end_date, created_at) 
                    VALUES(:customer_id, :house_address, :duration, :total_bill, :end_date, :created_at)";
        $this->database->query($query);
        $this->database->bind('customer_id', $data['customer_id'], self::COLUMN_TYPE['customer_id']);
        $this->database->bind('house_address', $data['house_address'], self::COLUMN_TYPE['house_address']);
        $this->database->bind('duration', $data['duration'], self::COLUMN_TYPE['duration']);
        $this->database->bind('total_bill', $data['total_bill'], self::COLUMN_TYPE['total_bill']);
        $this->database->bind('end_date', $data['end_date'], self::COLUMN_TYPE['end_date']);
        $this->database->bind('created_at', $data['created_at'], self::COLUMN_TYPE['created_at']);
        $this->database->execute();

        return $this->database->rowCount();
    }
}