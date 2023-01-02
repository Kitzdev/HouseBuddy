<?php

class HouseModel
{
    private string $table = "houses";
    private Database $database;

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
        $this->database->query("SELECT * FROM $this->table WHERE id =:id");
        $this->database->bind('id', $houseId, PDO::PARAM_STR);
        return $this->database->fetchSingle();
    }

    public function getAllHouse()
    {
        $this->database->query("SELECT id, model, address, price_per_month FROM $this->table");
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
        $query = "INSERT INTO {$this->table} (model, address, price_per_month, created_at) 
                    VALUES(:model, :address, :price_per_month, :created_at)";
        $this->database->query($query)
            ->bind('model', $data['model'], self::COLUMN_TYPE['model'])
            ->bind('address', $data['address'], self::COLUMN_TYPE['address'])
            ->bind('price_per_month', $data['price_per_month'], self::COLUMN_TYPE['price_per_month'])
            ->bind('created_at', $data['created_at'], self::COLUMN_TYPE['created_at'])
            ->execute();

        if ($this->database->isError()) {
            http_response_code(422);
            return $this->createHouseErrorMessage();
        }

        return $this->database->rowCount();
    }

    public function createHouseErrorMessage(): string
    {
        $errorCode = $this->database->getErrorCode();

        $message = "";
        if (!empty($errorCode)) {
            switch ($errorCode) {
                case 23505:
                    $message = "Rumah dengan alamat yang dimasukkan sudah tersedia";
                    break;
                default:
                    $message = "Terjadi kesalahan saat memasukkan data";
            }
        }

        return $message;
    }

    public function getHouseByAddress($address): string|array
    {
        $this->database->query("SELECT * FROM $this->table WHERE address = :address")
            ->bind('address', $address, PDO::PARAM_STR);
        $data = $this->database->fetchSingle();

        if (empty($data)) {
            http_response_code(422);
            return "Rumah dengan alamat yang dimasukkan tidak tersedia";
        }

        return $data;
    }

    public function updateHouseRentedStatusbyAddress($houseAddress, bool $rentedStatus)
    {
        $this->database->query("UPDATE $this->table SET rented_status = :rented_status WHERE address = :address")
            ->bind('rented_status',  intval($rentedStatus), PDO::PARAM_INT)
            ->bind('address', $houseAddress, PDO::PARAM_STR)
            ->execute();

        if ($this->database->isError()) {
            return "Gagal memperbarui status rumah";
        }

        return $this->database->rowCount();
    }
}