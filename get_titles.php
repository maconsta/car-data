<?php

require "database.php";

$model = $_GET['model'];

$query = "SELECT title FROM data WHERE model='$model'";
$result = mysqli_query($conn, $query);
$titles = array();

$i = 0;
while ($row = mysqli_fetch_array($result)) {
    $titles[$i]=$row[0];
    $i++;
}

echo json_encode($titles);