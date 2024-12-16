<?php 

$host = "localhost";
$user = "root";
$password = "";
$dbname = "ic_fut_team";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("error" . mysqli_connect_error());
}


?>