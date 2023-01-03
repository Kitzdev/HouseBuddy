<?php
?>
<p class="text-center" style="margin: 25px 0;">Input New House</p>

<div class="container bg-light">
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Model</span>
        </div>
        <input type="text" class="form-control" aria-label="Id" id="model"
               placeholder="Model"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Address</span>
        </div>
        <input type="text" class="form-control" aria-label="Model" id="address"
               placeholder="Address"
               aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend col-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Price / Month</span>
        </div>
        <input type="text" class="form-control" aria-label="Address" id="price-per-month"
               placeholder="Price / Month"
               aria-describedby="inputGroup-sizing-default">
    </div>

    <a id="save-button" class="btn btn-primary btn-lg">Save</a>
</div>

<script>
    let saveButton = document.querySelector("#save-button");

    saveButton.addEventListener('click', function () {
        const formData = new FormData()

        const modelValue = document.querySelector("#model").value;
        const addressValue = document.querySelector("#address").value
        const pricePerMonthValue = document.querySelector("#price-per-month").value

        if (modelValue.length === 0) {
            alert('Silakan masukkan model terlebih dahulu')
            return;
        }

        if (addressValue.length === 0) {
            alert('Silakan masukkan alamat / address terlebih dahulu')
            return;
        }

        if (pricePerMonthValue.length === 0) {
            alert('Silakan masukkan price / month terlebih dahulu')
            return;
        }

        formData.append('model', modelValue)
        formData.append('address', addressValue)
        formData.append('price_per_month', pricePerMonthValue)

        fetch('/api/v1/house', {
            method: "POST",
            body: formData
        })
            .then((response) => response.json())
            .then((response) => {
                if (response) {
                    alert('Data berhasil dimasukkan')
                } else {
                    alert(response)
                }
            }
        )
    })
</script>
