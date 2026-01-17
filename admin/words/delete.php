<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}

include '../../includes/db.php';

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

$id = intval($_GET['id']);

// prepare & delete safely
$stmt = $conn->prepare("DELETE FROM tamil_word_pages WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
  header("Location: index.php?deleted=1");
  exit;
} else {
  echo "Delete failed ❌";
}
