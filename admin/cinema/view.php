<?php
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/db.php';

if (!isset($_GET['id'])) {
  die("Invalid request");
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare(
  "SELECT title, content, image_path, label 
   FROM cinema_posts 
   WHERE id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  die("Content not found");
}

$row = $result->fetch_assoc();
?>

<div class="container">

  <h1 class="page-title">
    <?php echo htmlspecialchars($row['title']); ?>
  </h1>

  <img src="/uploads/<?php echo $row['image_path']; ?>" 
       style="width:100%; max-height:400px; object-fit:cover; margin-bottom:20px;">

  <div class="story-content">
    <?php echo nl2br(htmlspecialchars($row['content'])); ?>
  </div>

  <p style="margin-top:20px;">
    <strong>வகை:</strong> <?php echo ucfirst($row['label']); ?>
  </p>

</div>

<?php include '../includes/footer.php'; ?>
