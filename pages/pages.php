<?php
include '../includes/db.php';

if (!isset($_GET['slug'])) {
  die("Page not found");
}

$slug = $_GET['slug'];

$stmt = $conn->prepare(
  "SELECT title, content FROM pages WHERE slug=?"
);
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  die("Page not found");
}

$page = $result->fetch_assoc();

include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container">
  <h1 class="page-title"><?php echo htmlspecialchars($page['title']); ?></h1>

  <div class="story-content">
    <?php echo nl2br($page['content']); ?>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
