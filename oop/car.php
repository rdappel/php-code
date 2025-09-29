<?php

namespace oop;

class Car
{
    public $make;
    public $model;
    public $year;
    public $color;
    public $status;

    function __construct()
    {
        $this->stop()
    }

    function display() { echo "The $this->model is $this->status."; }
    function forward() { $this->status = "moving forward"; }
    function reverse() { $this->status = "moving in reverse"; }
    function stop() { $this->status = "stopped"; }
}

$ryansCar = new Car();

$ryansCar->reverse();
$ryansCar->display();