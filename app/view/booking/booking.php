<?php
require_once __DIR__ . "/../../init.php";
require_once __DIR__ . "/../../controller/api/version_1/BookingAPIController.php";

$bookingController = new BookingAPIController();
$bookingData = $bookingController->read();
?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Customer ID</th>
        <th scope="col">House Model</th>
        <th scope="col">House Address</th>
        <th scope="col">End Date</th>
        <th scope="col">Detail Booking</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($bookingData as $index => $bookingDatum): ?>
        <tr>
            <th scope="row"><?php echo $bookingDatum['customer_id']; ?></th>
            <td><?php echo $bookingDatum['house_model']; ?></td>
            <td><?php echo $bookingDatum['house_address']; ?></td>
            <td><?php echo $bookingDatum['end_date']; ?></td>
            <td><a href="/booking/detail/<?php echo $bookingDatum['booking_id'];?>" class="btn btn-primary btn-lg">Detail Booking</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
