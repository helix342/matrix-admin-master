<?php
$db_server_name = "localhost";
$username = "root";
$db_password = "";
$db_name = "dbnew";

$conn = new mysqli($db_server_name, $username, $db_password, $db_name);

if ($conn->connect_error) {
    die("$conn->connect_error". $conn->connect_error);
}
?>

