<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "thinnai_palli";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Database connection failed");
}
?>
