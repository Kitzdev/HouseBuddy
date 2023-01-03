<?php
/**
 * @var $data ['house_id']
 */

require_once __DIR__ . "/../../init.php";
require_once __DIR__ . "/../../controller/api/version_1/BookingAPIController.php";

$bookingController = new BookingAPIController();
$bookingData = $bookingController->read($data['booking_id']);
?>
<p class="text-center" style="margin: 25px 0;">Detail Booking</p>

<div class="container bg-light">
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Booking ID</span>
        </div>
        <input type="text" class="form-control" aria-label="Id" readonly
               placeholder="<?php echo $bookingData['booking_id']; ?>"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Customer ID</span>
        </div>
        <input type="text" class="form-control" aria-label="Model" readonly
               placeholder="<?php echo $bookingData['customer_id']; ?>"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">House Address</span>
        </div>
        <input type="text" class="form-control" aria-label="Address" readonly
               placeholder="<?php echo $bookingData['house_address']; ?>"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">House Model</span>
        </div>
        <input type="text" class="form-control" aria-label="Price / Month" readonly
               placeholder="<?php echo $bookingData['house_model']; ?>"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Duration</span>
        </div>
        <input type="text" class="form-control" aria-label="Sizing example input" readonly
               placeholder="<?php echo $bookingData['duration'] . " Bulan"; ?>"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">End Date</span>
        </div>
        <input type="text" class="form-control" aria-label="Sizing example input" readonly
               placeholder="<?php echo $bookingData['end_date']; ?>"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Created At</span>
        </div>
        <input type="text" class="form-control" aria-label="Sizing example input" readonly
               placeholder="<?php echo $bookingData['created_at']; ?>"
               aria-describedby="inputGroup-sizing-default">
    </div>

    <a id="back-button" class="btn btn-primary btn-lg">Back</a>
</div>

<script>
    let backButton = document.querySelector("#back-button");

    backButton.addEventListener('click', function () {
        window.history.back()
    })
</script>