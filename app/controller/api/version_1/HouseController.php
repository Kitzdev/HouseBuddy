<?php

class HouseController extends APIController
{
    private HouseModel $model;
    public function __construct()
    {
        require_once __DIR__."/../../../model/HouseModel.php";
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

        return $this->model->createHouse($data);
    }

    function read($mode = "")
    {
        if ($mode == "address") {
            return $this->model->getAllHouseAddress();
        } else if (!empty($mode)) {
            return $this->model->getSpecificHouse($mode);
        } else {
            return $this->model->getAllHouse();
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