<?php
$conn = mysqli_connect("localhost", "root", "", "car_data");

if (!$conn) {
    die('Database connection failed!');
}
