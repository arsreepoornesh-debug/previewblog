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

/* Fetch existing data */
$stmt = $conn->prepare(
  "SELECT title, content, label, image_path 
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

/* Update data */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $title   = trim($_POST['title']);
  $content = trim($_POST['content']);
  $label   = $_POST['label'];
  $imagePath = $row['image_path']; // keep old image by default

  if (!empty($_FILES['image']['name'])) {
    $imagePath = uploadImage($_FILES['image'], 'cinema');
  }

  $update = $conn->prepare(
    "UPDATE cinema_posts 
     SET title = ?, content = ?, label = ?, image_path = ?
     WHERE id = ?"
  );

  $update->bind_param(
    "ssssi",
    $title,
    $content,
    $label,
    $imagePath,
    $id
  );

  if ($update->execute()) {
    $msg = "Cinema content updated successfully ✅";
  } else {
    $msg = "Update failed ❌";
  }
}
?>

<h2>Edit Cinema Content</h2>

<?php if ($msg): ?>
  <p style="color:green;"><?php echo $msg; ?></p>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">

  <input type="text"
         name="title"
         value="<?php echo htmlspecialchars($row['title']); ?>"
         required
         style="width:100%;"><br><br>

  <select name="label" required style="width:100%;">
    <option value="">Select Label</option>
    <option value="actor" <?php if ($row['label']=='actor') echo 'selected'; ?>>Actor</option>
    <option value="movie" <?php if ($row['label']=='movie') echo 'selected'; ?>>Movie</option>
    <option value="song" <?php if ($row['label']=='song') echo 'selected'; ?>>Song</option>
    <option value="memory" <?php if ($row['label']=='memory') echo 'selected'; ?>>Memory</option>
  </select><br><br>

  <textarea name="content"
            rows="8"
            required
            style="width:100%;"><?php echo htmlspecialchars($row['content']); ?></textarea><br><br>

  <p>Current Image:</p>
  <img src="/<?php echo $row['image_path']; ?>" width="150"><br><br>

  <input type="file" name="image"><br><br>

  <button type="submit">Update Cinema</button>
  <a href="manage.php" style="margin-left:15px;">Cancel</a>

</form>
