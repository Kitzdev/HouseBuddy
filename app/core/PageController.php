<?php

abstract class PageController
{
    abstract function index();

    // $data used for view parameter.
    public function view($view, $data = [])
    {
        require_once __DIR__ . "/../view/template/header.php";
        require_once __DIR__ . "/../view/" . $view . '.php';
        require_once __DIR__ . "/../view/template/footer.php";
    }
}