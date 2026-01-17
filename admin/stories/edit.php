<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}

include '../../includes/db.php';
include '../includes/upload_image.php';

if (!isset($_GET['id'])) {
  die("Invalid request");
}

$id = (int) $_GET['id'];
$msg = "";

/* Fetch existing story */
$stmt = $conn->prepare(
  "SELECT title, content, slug, image_path 
   FROM stories 
   WHERE id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  die("Story not found");
}

$row = $result->fetch_assoc();

/* Update story */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $title   = trim($_POST['title']);
  $content = trim($_POST['content']);
  $imagePath = $row['image_path']; // keep old image

  // upload new image if selected
  if (!empty($_FILES['image']['name'])) {
    $imagePath = uploadImage($_FILES['image'], 'stories');
  }

  $update = $conn->prepare(
    "UPDATE stories 
     SET title = ?, content = ?, image_path = ?
     WHERE id = ?"
  );

  $update->bind_param(
    "sssi",
    $title,
    $content,
    $imagePath,
    $id
  );

  if ($update->execute()) {
    $msg = "Story updated successfully ✅";
  } else {
    $msg = "Update failed ❌";
  }
}
?>

<h2>Edit Story</h2>

<?php if ($msg): ?>
  <p style="color:green;"><?php echo $msg; ?></p>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">

  <label>Title</label><br>
  <input type="text"
         name="title"
         value="<?php echo htmlspecialchars($row['title']); ?>"
         required
         style="width:100%;"><br><br>

  <label>Slug (read-only)</label><br>
  <input type="text"
         value="<?php echo htmlspecialchars($row['slug']); ?>"
         readonly
         style="width:100%; background:#eee;"><br><br>

  <label>Content</label><br>
  <textarea name="content"
            rows="10"
            required
            style="width:100%;"><?php echo htmlspecialchars($row['content']); ?></textarea><br><br>

  <label>Current Image</label><br>
  <?php if ($row['image_path']): ?>
    <img src="/<?php echo $row['image_path']; ?>" width="180"><br><br>
  <?php else: ?>
    <p>No image uploaded</p>
  <?php endif; ?>

  <label>Change Image (optional)</label><br>
  <input type="file" name="image"><br><br>

  <button type="submit">Update Story</button>
  <a href="manage.php" style="margin-left:15px;">Cancel</a>

</form>
