<?php
include '../includes/db.php';
include '../includes/header.php';
include '../includes/navbar.php';

if (!isset($_GET['slug'])) {
  echo "Story not found";
  exit;
}

$slug = $_GET['slug'];

$stmt = $conn->prepare("SELECT title, content FROM stories WHERE slug=?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  echo "Story not found";
  exit;
}

$story = $result->fetch_assoc();
?>

<div class="container">
  <h1><?php echo htmlspecialchars($story['title']); ?></h1>

  <div class="story-content">
    <?php echo nl2br($story['content']); ?>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
