<?php


class BookingController extends APIController
{
    function create()
    {
        echo "Create a booking";
    }

    function read($mode = "")
    {
        if (empty($mode)) {
            echo "Get all booking";
        } else {
            echo "Get specific booking";
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