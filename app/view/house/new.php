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
        formData.append('model', document.querySelector("#model").value)
        formData.append('address', document.querySelector("#address").value)
        formData.append('price_per_month', document.querySelector("#price-per-month").value)

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
