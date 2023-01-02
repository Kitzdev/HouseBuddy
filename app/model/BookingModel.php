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
    public function createBooking($data): mixed
    {
        $query = "INSERT INTO {$this->table} (customer_id, house_address, house_model, duration, total_bill, end_date, created_at) 
                    VALUES(:customer_id, :house_address, :house_model, :duration, :total_bill, :end_date, :created_at)";
        $this->database->query($query)
            ->bind('customer_id', $data['customer_id'], self::COLUMN_TYPE['customer_id'])
            ->bind('house_address', $data['house_address'], self::COLUMN_TYPE['house_address'])
            ->bind('house_model', $data['house_model'], self::COLUMN_TYPE['house_model'])
            ->bind('duration', $data['duration'], self::COLUMN_TYPE['duration'])
            ->bind('total_bill', $data['total_bill'], self::COLUMN_TYPE['total_bill'])
            ->bind('end_date', $data['end_date'], self::COLUMN_TYPE['end_date'])
            ->bind('created_at', $data['created_at'], self::COLUMN_TYPE['created_at'])
            ->execute();

        if ($this->database->isError()) {
            http_response_code(422);
            return $this->createBookingErrorMessage();
        }

        return $this->database->rowCount();
    }

    public function createBookingErrorMessage(): string
    {
        $errorCode = $this->database->getErrorCode();

        $message = "";
        if (!empty($errorCode)) {
            switch ($errorCode) {
                case "P0001":
                    $message = "Customer ID harus berjumlah 16 digit";
                    break;
                default:
                    $message = "Terjadi kesalahan saat memasukkan data";
            }
        }

        return $message;
    }

    public function getBookingByCustomerId($customerId)
    {
        $this->database->query("SELECT * FROM $this->table WHERE customer_id = :customer_id")
            ->bind('customer_id', $customerId, PDO::PARAM_STR);
        return $this->database->fetchSingle();
    }

    public function getAllBooking()
    {
        $this->database->query("SELECT customer_id, house_model, house_address, end_date FROM $this->table");
        return $this->database->fetchAll();
    }

    public function getSpecificBooking($bookingId)
    {
        $this->database->query("SELECT * FROM $this->table WHERE booking_id =:booking_id");
        $this->database->bind('booking_id', $bookingId, PDO::PARAM_STR);
        return $this->database->fetchSingle();
    }
}