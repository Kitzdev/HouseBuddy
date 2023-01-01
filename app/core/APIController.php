<?php

abstract class APIController extends Controller
{
    abstract function create();
    abstract function read($mode);
    abstract function update();
    abstract function delete();
}