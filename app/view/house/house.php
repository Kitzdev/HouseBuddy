<?php
require_once __DIR__ . "/../../init.php";
require_once __DIR__ . "/../../controller/api/version_1/HouseAPIController.php";

$houseController = new HouseAPIController();
$houseData = $houseController->read();
?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Model</th>
        <th scope="col">Address</th>
        <th scope="col">Price / Month</th>
        <th scope="col">Detail</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($houseData as $index => $houseDatum): ?>
        <tr>
            <th scope="row"><?php echo ++$index; ?></th>
            <td><?php echo $houseDatum['model']; ?></td>
            <td><?php echo $houseDatum['address']; ?></td>
            <td>Rp. <?php echo number_format($houseDatum['price_per_month'], 2, ',', '.'); ?></td>
            <td><a href="/house/detail/<?php echo $houseDatum['id'];?>" class="btn btn-primary btn-lg">Detail Rumah</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
