<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "apa";

// $dbHost = "localhost";
// $dbUser = "airships_user1";
// $dbPass = "nmesoma5050";
// $dbName = "meshipst_online_banking";


$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
     die("Database not connected");
}
