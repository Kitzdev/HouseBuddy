<?php

class BookingController extends PageController
{
    function index()
    {
        $data['title'] = "Booking";
        $this->view('booking/booking', $data);
    }

    public function detail($bookingId)
    {
        $data['title'] = "Detail Rumah";
        $data['booking_id'] = "$bookingId";
        $this->view('booking/detail', $data);
    }

    public function new()
    {
        $data['title'] = "Input New House";
        $this->view('booking/new', $data);
    }
}