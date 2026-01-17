<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}

include '../../includes/db.php';

$msg = "";

// fetch existing content
$result = $conn->query("SELECT * FROM home_content WHERE id=1");
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $intro = $_POST['intro_text'];
  $weekly = $_POST['weekly_update'];

  $stmt = $conn->prepare(
    "UPDATE home_content SET intro_text=?, weekly_update=? WHERE id=1"
  );
  $stmt->bind_param("ss", $intro, $weekly);

  if ($stmt->execute()) {
    $msg = "Home content updated ✅";
  }
}
?>

<h2>Edit Home Page</h2>
<p style="color:green;"><?php echo $msg; ?></p>

<form method="post">

  <label>Intro Content</label><br>
  <textarea name="intro_text" rows="6" required><?php echo $data['intro_text']; ?></textarea>
  <br><br>

  <label>Weekly Update</label><br>
  <textarea name="weekly_update" rows="4" required><?php echo $data['weekly_update']; ?></textarea>
  <br><br>

  <button type="submit">Save</button>

</form>
