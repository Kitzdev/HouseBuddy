<?php

class Home extends PageController
{
    function index()
    {
        $data['title'] = "Home";
        $this->view('home/home', $data);
    }
}