<?php 

$host = "localhost";
$user = "root";
$password = "";
$dbname = "test_playears";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("error" . mysqli_connect_error());
}


?>