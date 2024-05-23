<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "cricket_club";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM Players WHERE id = $id";

    if ($connection->query($sql) === TRUE) {
        header("Location: /dbms/message.php?status=success&message=Player+was+deleted+successfully");
    } else {
        header("Location: /dbms/message.php?status=error&message=Error+deleting+record+with+ID+$id");
    }
    exit;
}
?>
