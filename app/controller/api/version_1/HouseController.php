<?php
namespace controller;

use APIController;
use model\House as HouseModel;

class House extends APIController
{
    private HouseModel $model;
    public function __construct()
    {
        $this->model = new HouseModel();
    }

    function create()
    {
        $data = [
            'model' => $_POST['model'],
            'address' => $_POST['address'],
            'price_per_month' => $_POST['price_per_month'],
            'created_at' => date("Y-m-d H-i-s"),
        ];

        $this->model->createHouse($data);
    }

    function read($mode = "")
    {
        var_dump($mode);
        if ($mode == "address") {
            echo "read address";
        } else if (!empty($mode)) {
            echo "read specific";
        } else {
            echo "read house";
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