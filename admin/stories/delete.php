<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}

include '../../includes/db.php';

$id = $_GET['id'];

$result = $conn->query("SELECT image_path FROM stories WHERE id=$id");
$row = $result->fetch_assoc();

if ($row && file_exists("../../".$row['image_path'])) {
  unlink("../../".$row['image_path']);
}

$conn->query("DELETE FROM stories WHERE id=$id");

header("Location: manage.php");
exit;
