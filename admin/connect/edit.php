<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}

include '../../includes/db.php';

$msg = "";

// fetch existing contact info
$result = $conn->query("SELECT * FROM contact_info WHERE id=1");
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $instagram = $_POST['instagram'];
  $youtube = $_POST['youtube'];
  $website = $_POST['website'];

  $stmt = $conn->prepare(
    "UPDATE contact_info 
     SET email=?, phone=?, instagram=?, youtube=?, website=? 
     WHERE id=1"
  );
  $stmt->bind_param("sssss", $email, $phone, $instagram, $youtube, $website);

  if ($stmt->execute()) {
    $msg = "Contact info updated ✅";
  }
}
?>

<h2>Edit Contact Info</h2>
<p style="color:green;"><?php echo $msg; ?></p>

<form method="post">

  <label>Email</label><br>
  <input type="email" name="email" value="<?php echo $data['email']; ?>"><br><br>

  <label>Phone</label><br>
  <input type="text" name="phone" value="<?php echo $data['phone']; ?>"><br><br>

  <label>Instagram Link</label><br>
  <input type="text" name="instagram" value="<?php echo $data['instagram']; ?>"><br><br>

  <label>YouTube Link</label><br>
  <input type="text" name="youtube" value="<?php echo $data['youtube']; ?>"><br><br>

  <label>Website</label><br>
  <input type="text" name="website" value="<?php echo $data['website']; ?>"><br><br>

  <button type="submit">Save</button>

</form>
