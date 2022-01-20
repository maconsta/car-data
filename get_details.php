<?php

session_start();
require "database.php";

$model_one = $_POST["model_one"];
$title_one = $_POST["title_one"];
$model_two = $_POST["model_two"];
$title_two = $_POST["title_two"];

$query = "SELECT * FROM data WHERE model='$model_one' and title='$title_one'";
$result = mysqli_query($conn, $query);
$arr = mysqli_fetch_all($result);

$details_one = array();
$details_two = array();

for ($i = 0; $i < count($arr[0]); $i++) {
    $details_one[$i] = $arr[0][$i];
}

$hide_the_cards = false;

if ($model_two != "") {
    $query = "SELECT * FROM data WHERE model='$model_two' and title='$title_two'";
    $result = mysqli_query($conn, $query);
    $arr = mysqli_fetch_all($result);
    // $_SESSION["hide_the_cards"] = false;

    for ($i = 0; $i < count($arr[0]); $i++) {
        $details_two[$i] = $arr[0][$i];
    }
}else{
    $hide_the_cards = true;
}

$_SESSION["details_one"] = $details_one;
$_SESSION["details_two"] = $details_two;
$_SESSION["redirected"] = true;

echo json_encode($hide_the_cards);