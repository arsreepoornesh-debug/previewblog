<?php
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/db.php';

if (!isset($_GET['slug'])) {
  echo "<h2>Page not found</h2>";
  exit;
}

$slug = $_GET['slug'];

$stmt = $conn->prepare("SELECT title, content FROM tamil_word_pages WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  echo "<h2>Page not found</h2>";
  exit;
}

$page = $result->fetch_assoc();
?>

<div class="container">
  <h1 class="page-title"><?php echo htmlspecialchars($page['title']); ?></h1>

  <div class="story-content">
    <?php echo nl2br($page['content']); ?>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
