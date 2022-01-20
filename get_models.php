<?php

require "database.php";

$make = $_GET['make'];

$query = "SELECT DISTINCT model FROM data WHERE make='$make'";
$result = mysqli_query($conn, $query);
$models = array();

$i = 0;
while ($row = mysqli_fetch_array($result)) {
    $models[$i]=$row[0];
    $i++;
}

echo json_encode($models);
