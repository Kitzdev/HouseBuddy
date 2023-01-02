<?php
/**
 * @var $data ['house_id']
 */

require_once __DIR__ . "/../../init.php";
require_once __DIR__ . "/../../controller/api/version_1/HouseAPIController.php";

$houseController = new HouseAPIController();
$houseData = $houseController->read($data['house_id']);

?>
<p class="text-center" style="margin: 25px 0;">Detail Rumah</p>

<div class="container bg-light">
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">ID</span>
        </div>
        <input type="text" class="form-control" aria-label="Id" readonly
               placeholder="<?php echo $houseData['id']; ?>"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Model</span>
        </div>
        <input type="text" class="form-control" aria-label="Model" readonly
               placeholder="<?php echo $houseData['model']; ?>"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Address</span>
        </div>
        <input type="text" class="form-control" aria-label="Address" readonly
               placeholder="<?php echo $houseData['address']; ?>"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Price / Month</span>
        </div>
        <input type="text" class="form-control" aria-label="Price / Month" readonly
               placeholder="Rp. <?php echo number_format($houseData['price_per_month'], 2, ',', '.'); ?>"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Rented Status</span>
        </div>
        <input type="text" class="form-control" aria-label="Sizing example input" readonly
               placeholder="<?php echo $houseData['rented_status'] ? "Tersewa" : "Tersedia"; ?>"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Created At</span>
        </div>
        <input type="text" class="form-control" aria-label="Sizing example input" readonly
               placeholder="<?php echo $houseData['created_at']; ?>"
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