<?php

class HouseController extends PageController
{
    public function index()
    {
        $data['title'] = "House";
        $this->view('house/house', $data);
    }

    public function detail($houseId)
    {
        $data['title'] = "Detail Rumah";
        $data['house_id'] = "$houseId";
        $this->view('house/detail', $data);
    }

    public function new()
    {
        $data['title'] = "Input New House";
        $this->view('house/new', $data);
    }
}