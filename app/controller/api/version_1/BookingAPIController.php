<?php

class BookingAPIController extends APIController
{
    private BookingModel $bookingModel;

    public function __construct()
    {
        require_once __DIR__ . "/../../../model/BookingModel.php";
        $this->bookingModel = new BookingModel();
    }

    function create()
    {
        require_once __DIR__ . "/../../../model/HouseModel.php";
        $houseModel = new HouseModel();

        if (!preg_match_all('/[1-9][0-9][0-7][0-9][0-6][0-9][0-3][0-9][0-1][0-2][0-9][0-9][0-9][0-9][0-9][0-9]/',
            $_POST['customer_id'])
        ) {
            http_response_code(422);
            return "Customer Id harus sesuai dengan format NIK KTP";
        }

        // Check if customer already booked a house.
        $bookingDataByCustomerId = $this->bookingModel->getBookingByCustomerId($_POST['customer_id']);

        if (!empty($bookingDataByCustomerId)) {
            http_response_code(422);
            return "Customer Id {$_POST['customer_id']} hanya dapat melakukan booking satu kali";
        }

        // Check if inserted address is available
        $houseData = $houseModel->getHouseByAddress($_POST['house_address']);

        if (empty($houseData)) {
            http_response_code(422);
            return "Data rumah dengan alamat yang dimasukkan tidak ditemukan";
        }

        // Check if house is already rented or not
        if ($houseData['rented_status']) {
            http_response_code(422);
            return "Rumah dengan alamat {$houseData['address']} sudah di-booking";
        }

        // Check if house is already rented or not
        if (empty($_POST['duration'])) {
            http_response_code(422);
            return "Durasi booking diperlukan";
        }

        $date = new DateTime();
        $endDate = $date->add(new DateInterval("P{$_POST['duration']}M"))
            ->format("Y-m-d H-i-s");

        $data = [
            'customer_id' => $_POST['customer_id'],
            'house_address' => $_POST['house_address'],
            'duration' => $_POST['duration'],
            'house_model' => $houseData['model'],
            'total_bill' => $_POST['duration'] * intval($houseData['price_per_month']),
            'end_date' => $endDate,
            'created_at' => date("Y-m-d H-i-s"),
        ];

        $bookingResult = $this->bookingModel->createBooking($data);

        if ($bookingResult !== 1) {
            return $bookingResult;
        }

        // Update house rented status
        $updateRentedStatusResult = $houseModel->updateHouseRentedStatusbyAddress($_POST['house_address'], true);

        if ($updateRentedStatusResult !== 1) {
            return "Gagal memperbarui status rumah";
        }

        return $bookingResult;
    }

    function read($mode = "")
    {
        if (empty($mode)) {
            return $this->bookingModel->getAllBooking();
        } else {
            return $this->bookingModel->getSpecificBooking($mode);
        }
    }

    function update()
    {
        // TODO: Implement update() method.
    }

    function delete()
    {
        // TODO: Implement delete() method.
    }
}