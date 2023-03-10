<?php
require_once __DIR__ . "/../../init.php";
require_once __DIR__ . "/../../controller/api/version_1/HouseAPIController.php";

$houseController = new HouseAPIController();
$addressData = $houseController->read("address");
?>
<p class="text-center" style="margin: 25px 0;">Rent a House</p>

<div class="container bg-light">
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Customer ID</span>
        </div>
        <input type="text" class="form-control" aria-label="Id" id="customer-id"
               pattern="[0-9]{16}"
               title="Format customer ID harus sesuai dengan NIK KTP"
               placeholder="Customer ID"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Address</span>
        </div>
        <select class="form-select" id="address" aria-label="Address">
            <?php foreach ($addressData as $addressDatum): ?>
                <option value="<?php echo $addressDatum['address']; ?>"><?php echo $addressDatum['address']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Duration (Month)</span>
        </div>
        <input type="text" class="form-control" aria-label="Address" id="duration"
               placeholder="Duration"
               aria-describedby="inputGroup-sizing-default">
    </div>

    <a id="save-button" class="btn btn-primary btn-lg">Save</a>
</div>

<script>
    let saveButton = document.querySelector("#save-button");

    saveButton.addEventListener('click', function () {
        const formData = new FormData()

        const customerId = document.querySelector("#customer-id").value
        const houseAddress = document.querySelector("#address").value
        const duration = document.querySelector("#duration").value

        formData.append('customer_id', customerId)
        formData.append('house_address', houseAddress)
        formData.append('duration', duration)

        fetch('/api/v1/booking/', {
            method: "POST",
            body: formData
        })
            .then((response) => response.json())
            .then((response) => {
                    if (response === 1) {
                        alert('Data berhasil dimasukkan')
                    } else {
                        alert(response)
                    }
                }
            )
    })
</script>
