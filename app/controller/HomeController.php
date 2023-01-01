<?php

class HomeController extends PageController
{
    function index()
    {
        $data['title'] = "Home";
        $this->view('home/home', $data);
    }
}