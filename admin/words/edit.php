<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}

include '../../includes/db.php';

if (!isset($_GET['id'])) {
  die("Page ID missing");
}

$id = (int) $_GET['id'];

/* Fetch existing data */
$stmt = $conn->prepare(
  "SELECT title, slug, summary, content 
   FROM tamil_word_pages 
   WHERE id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  die("Page not found");
}

$page = $result->fetch_assoc();

/* Update logic */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $title   = $_POST['title'];
  $slug    = $_POST['slug'];
  $summary = $_POST['summary'];
  $content = $_POST['content'];

  $update = $conn->prepare(
    "UPDATE tamil_word_pages 
     SET title=?, slug=?, summary=?, content=? 
     WHERE id=?"
  );

  $update->bind_param(
    "ssssi",
    $title,
    $slug,
    $summary,
    $content,
    $id
  );

  if ($update->execute()) {
    header("Location: manage.php?updated=1");
    exit;
  } else {
    echo "Update failed";
  }
}
?>

<h2>Edit Tamil Word Page</h2>

<form method="post">

  <label>Title</label><br>
  <input type="text" name="title"
         value="<?php echo htmlspecialchars($page['title']); ?>"
         required style="width:100%;"><br><br>

  <label>Slug</label><br>
  <input type="text" name="slug"
         value="<?php echo htmlspecialchars($page['slug']); ?>"
         required style="width:100%;"><br><br>

  <label>Summary</label><br>
  <textarea name="summary" rows="4"
            style="width:100%;"><?php
    echo htmlspecialchars($page['summary']);
  ?></textarea><br><br>

  <label>Content</label><br>
  <textarea name="content" rows="15"
            style="width:100%;"><?php
    echo htmlspecialchars($page['content']);
  ?></textarea><br><br>

  <button type="submit">Update Page</button>
  <a href="manage.php">Cancel</a>

</form>
