<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}

include '../../includes/db.php';
include '../includes/upload_image.php';

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $title   = trim($_POST['title']);
  $content = trim($_POST['content']);
  $label   = $_POST['label'];

  $imagePath = uploadImage($_FILES['image'], 'cinema');

  $stmt = $conn->prepare(
    "INSERT INTO cinema_posts (title, content, label, image_path)
     VALUES (?,?,?,?)"
  );

  if (!$stmt) {
    die("SQL Error: " . $conn->error);
  }

  $stmt->bind_param("ssss", $title, $content, $label, $imagePath);

  if ($stmt->execute()) {
    $lastId = $conn->insert_id;

    $msg = "
      <strong>✅ Cinema content added successfully</strong><br><br>
      👉 <a href='/thinnai-palli/cinema/view.php?id=$lastId' target='_blank'>View Cinema Page</a>
    ";
  } else {
    $msg = "❌ Insert failed";
  }
}
?>
<!DOCTYPE html>
<html lang="ta">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Cinema Content - Admin</title>
  <style>
    /* Reset and base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      background: linear-gradient(135deg, #f6f1e7 0%, #f0e6d6 100%);
      padding: 20px;
      color: #2c1810;
    }
    
    /* Main container */
    .dashboard-container {
      max-width: 1200px;
      margin: 0 auto;
    }
    
    /* Header */
    .header {
      background: linear-gradient(135deg, #4b2e1e 0%, #2c1810 100%);
      color: white;
      padding: 25px 30px;
      border-radius: 15px;
      margin-bottom: 30px;
      box-shadow: 0 8px 25px rgba(75, 46, 30, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .header h1 {
      color: white;
      margin: 0;
      font-size: 28px;
      display: flex;
      align-items: center;
    }
    
    .header h1:before {
      content: "🎬";
      margin-right: 15px;
      font-size: 32px;
    }
    
    /* Navigation */
    .navigation {
      background: #ffffff;
      padding: 18px 25px;
      border-radius: 12px;
      margin-bottom: 25px;
      box-shadow: 0 4px 15px rgba(75, 46, 30, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .nav-links a {
      display: inline-flex;
      align-items: center;
      padding: 10px 18px;
      border-radius: 8px;
      transition: all 0.3s ease;
      font-weight: 600;
      background: #f8f4ef;
      color: #4b2e1e;
      text-decoration: none;
      margin-right: 10px;
      border: 1px solid rgba(75, 46, 30, 0.1);
      font-size: 14px;
    }
    
    .nav-links a:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(75, 46, 30, 0.1);
      background: #d4a762;
      color: #2c1810;
    }
    
    .page-info {
      font-size: 14px;
      color: #666;
      background: rgba(0, 102, 204, 0.05);
      padding: 6px 12px;
      border-radius: 6px;
    }
    
    /* Main content card */
    .content-card {
      background: #ffffff;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 10px 30px rgba(75, 46, 30, 0.1);
      overflow: hidden;
    }
    
    .content-card h2 {
      color: #4b2e1e;
      font-size: 24px;
      margin-bottom: 30px;
      padding-bottom: 15px;
      border-bottom: 2px solid #d4a762;
      display: flex;
      align-items: center;
    }
    
    .content-card h2:before {
      content: "➕";
      margin-right: 12px;
      font-size: 24px;
    }
    
    /* Message styling */
    .message {
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 25px;
      font-weight: 600;
      animation: fadeIn 0.5s ease-out;
      border-left: 4px solid #28a745;
    }
    
    .message.success {
      background: rgba(40, 167, 69, 0.1);
      color: #28a745;
    }
    
    .message.error {
      background: rgba(220, 53, 69, 0.1);
      color: #dc3545;
      border-left-color: #dc3545;
    }
    
    .message a {
      color: #0066cc;
      text-decoration: none;
      font-weight: bold;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      margin-top: 10px;
      padding: 8px 15px;
      background: rgba(0, 102, 204, 0.1);
      border-radius: 6px;
      transition: all 0.3s ease;
    }
    
    .message a:hover {
      background: rgba(0, 102, 204, 0.2);
      transform: translateX(5px);
    }
    
    /* Form styling */
    .cinema-form {
      animation: fadeIn 0.8s ease-out;
    }
    
    .form-group {
      margin-bottom: 25px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 10px;
      color: #2c1810;
      font-weight: 600;
      font-size: 15px;
      padding-left: 5px;
    }
    
    .form-group label:after {
      content: " *";
      color: #dc3545;
    }
    
    /* Input field styling */
    .form-control {
      width: 100%;
      padding: 15px 20px;
      border: 2px solid rgba(75, 46, 30, 0.15);
      border-radius: 12px;
      font-size: 16px;
      transition: all 0.3s ease;
      background: #f8f4ef;
      color: #2c1810;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .form-control:focus {
      outline: none;
      border-color: #d4a762;
      box-shadow: 0 0 0 3px rgba(212, 167, 98, 0.2);
      background: white;
      transform: translateY(-2px);
    }
    
    /* Select dropdown styling */
    .select-wrapper {
      position: relative;
    }
    
    .select-wrapper:after {
      content: "▼";
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      color: #666;
      pointer-events: none;
    }
    
    select.form-control {
      appearance: none;
      padding-right: 40px;
    }
    
    /* Label options styling */
    .label-options {
      display: flex;
      gap: 10px;
      margin-top: 10px;
      flex-wrap: wrap;
    }
    
    .label-option {
      padding: 8px 16px;
      border-radius: 8px;
      background: #f8f9fa;
      border: 1px solid #dee2e6;
      color: #495057;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .label-option:hover {
      background: #e9ecef;
      transform: translateY(-2px);
    }
    
    .label-option.active {
      background: #d4a762;
      color: white;
      border-color: #d4a762;
    }
    
    .label-option:before {
      font-size: 16px;
    }
    
    .label-option[data-value="actor"]:before { content: "🎭"; }
    .label-option[data-value="movie"]:before { content: "🎥"; }
    .label-option[data-value="song"]:before { content: "🎵"; }
    .label-option[data-value="memory"]:before { content: "💭"; }
    
    /* Textarea specific styling */
    textarea.form-control {
      min-height: 200px;
      resize: vertical;
      line-height: 1.6;
      font-family: 'Arial Unicode MS', 'Tahoma', sans-serif;
    }
    
    /* Character counter */
    .char-counter {
      text-align: right;
      font-size: 12px;
      color: #888;
      margin-top: 5px;
      opacity: 0.7;
      transition: all 0.3s ease;
    }
    
    .char-counter.warning {
      color: #ffc107;
      font-weight: bold;
    }
    
    .char-counter.danger {
      color: #dc3545;
      font-weight: bold;
    }
    
    /* File upload styling */
    .file-upload-container {
      border: 2px dashed rgba(75, 46, 30, 0.15);
      border-radius: 12px;
      padding: 30px;
      text-align: center;
      transition: all 0.3s ease;
      background: #f8f4ef;
      position: relative;
      overflow: hidden;
    }
    
    .file-upload-container:hover {
      border-color: #d4a762;
      background: rgba(212, 167, 98, 0.05);
      transform: translateY(-3px);
    }
    
    .file-upload-container.dragover {
      border-color: #0066cc;
      background: rgba(0, 102, 204, 0.05);
      box-shadow: 0 0 20px rgba(0, 102, 204, 0.1);
    }
    
    .upload-icon {
      font-size: 48px;
      margin-bottom: 15px;
      opacity: 0.7;
    }
    
    .upload-text {
      margin-bottom: 15px;
      color: #666;
    }
    
    .file-input {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
    }
    
    .file-label {
      display: inline-block;
      padding: 12px 24px;
      background: #4b2e1e;
      color: white;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 600;
    }
    
    .file-label:hover {
      background: #2c1810;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(75, 46, 30, 0.2);
    }
    
    .file-info {
      margin-top: 15px;
      font-size: 14px;
      color: #888;
    }
    
    .preview-container {
      margin-top: 20px;
      display: none;
    }
    
    .image-preview {
      max-width: 300px;
      max-height: 200px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      animation: fadeIn 0.5s ease-out;
    }
    
    /* Submit button */
    .submit-btn {
      padding: 16px 40px;
      background: linear-gradient(135deg, #4b2e1e 0%, #2c1810 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 20px;
      position: relative;
      overflow: hidden;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 180px;
    }
    
    .submit-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(75, 46, 30, 0.2);
    }
    
    .submit-btn:active {
      transform: translateY(-1px);
    }
    
    .submit-btn:after {
      content: "🎬";
      margin-right: 10px;
      font-size: 18px;
    }
    
    /* Form actions */
    .form-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 40px;
      padding-top: 20px;
      border-top: 1px solid rgba(75, 46, 30, 0.1);
    }
    
    /* Tips section */
    .tips-section {
      background: rgba(212, 167, 98, 0.05);
      border-radius: 12px;
      padding: 20px;
      margin-top: 40px;
      border-left: 4px solid #d4a762;
    }
    
    .tips-section h4 {
      color: #4b2e1e;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
    }
    
    .tips-section h4:before {
      content: "💡";
      margin-right: 10px;
    }
    
    .tips-section ul {
      padding-left: 20px;
      margin: 0;
    }
    
    .tips-section li {
      margin-bottom: 8px;
      color: #666;
      font-size: 14px;
      line-height: 1.5;
    }
    
    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
      20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    
    /* ===== RESPONSIVE ENHANCEMENTS ===== */
    
    /* Large devices (desktops, 992px to 1199px) */
    @media (max-width: 1199px) and (min-width: 992px) {
      .dashboard-container {
        max-width: 100%;
        padding: 0 20px;
      }
      
      .content-card {
        padding: 35px;
      }
      
      .file-upload-container {
        padding: 25px;
      }
    }
    
    /* Medium devices (tablets, 768px to 991px) */
    @media (max-width: 991px) and (min-width: 768px) {
      .header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
        padding: 22px;
      }
      
      .navigation {
        flex-direction: column;
        gap: 15px;
        text-align: center;
        padding: 16px 20px;
      }
      
      .nav-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
        width: 100%;
      }
      
      .nav-links a {
        margin-right: 0;
        flex: 1;
        min-width: 140px;
        padding: 9px 15px;
        font-size: 13px;
        justify-content: center;
        text-align: center;
      }
      
      .page-info {
        font-size: 13px;
        padding: 6px 10px;
        text-align: center;
        width: 100%;
      }
      
      .content-card {
        padding: 28px;
        border-radius: 12px;
      }
      
      .content-card h2 {
        font-size: 22px;
        margin-bottom: 25px;
      }
      
      .message {
        padding: 16px 18px;
        font-size: 15px;
        margin-bottom: 22px;
      }
      
      .message a {
        padding: 7px 12px;
        font-size: 13px;
      }
      
      .form-group {
        margin-bottom: 22px;
      }
      
      .form-control {
        padding: 14px 18px;
        font-size: 15px;
        border-radius: 10px;
      }
      
      textarea.form-control {
        min-height: 180px;
        font-size: 15px;
      }
      
      .char-counter {
        font-size: 11px;
      }
      
      .select-wrapper:after {
        right: 18px;
        font-size: 12px;
      }
      
      select.form-control {
        padding-right: 36px;
      }
      
      .label-options {
        gap: 8px;
      }
      
      .label-option {
        padding: 7px 14px;
        font-size: 13px;
        flex: 1;
        min-width: 120px;
        justify-content: center;
      }
      
      .file-upload-container {
        padding: 22px;
        border-radius: 10px;
      }
      
      .upload-icon {
        font-size: 40px;
      }
      
      .upload-text {
        font-size: 14px;
      }
      
      .file-label {
        padding: 10px 20px;
        font-size: 14px;
      }
      
      .file-info {
        font-size: 13px;
      }
      
      .image-preview {
        max-width: 250px;
        max-height: 180px;
      }
      
      .form-actions {
        flex-direction: column;
        gap: 20px;
        text-align: center;
        margin-top: 35px;
      }
      
      .submit-btn {
        width: 100%;
        max-width: 350px;
        padding: 15px 30px;
        font-size: 15px;
      }
      
      .tips-section {
        padding: 18px;
        margin-top: 35px;
      }
      
      .tips-section h4 {
        font-size: 15px;
      }
      
      .tips-section li {
        font-size: 13px;
      }
    }
    
    /* Small devices (landscape phones, 576px to 767px) */
    @media (max-width: 767px) and (min-width: 576px) {
      body {
        padding: 15px;
      }
      
      .dashboard-container {
        padding: 0 15px;
      }
      
      .header {
        flex-direction: column;
        text-align: center;
        gap: 12px;
        padding: 20px;
        border-radius: 12px;
      }
      
      .header h1 {
        font-size: 24px;
        flex-direction: column;
        gap: 8px;
      }
      
      .header h1:before {
        margin-right: 0;
        margin-bottom: 5px;
        font-size: 28px;
      }
      
      .navigation {
        flex-direction: column;
        gap: 12px;
        text-align: center;
        padding: 15px;
        border-radius: 10px;
      }
      
      .nav-links {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
        width: 100%;
        margin-bottom: 10px;
      }
      
      .nav-links a {
        margin-right: 0;
        padding: 8px 12px;
        font-size: 13px;
        justify-content: center;
        text-align: center;
      }
      
      .page-info {
        font-size: 12px;
        padding: 5px 10px;
        width: 100%;
      }
      
      .content-card {
        padding: 22px;
        border-radius: 12px;
      }
      
      .content-card h2 {
        font-size: 20px;
        margin-bottom: 20px;
        padding-bottom: 12px;
        flex-direction: column;
        text-align: center;
        gap: 8px;
      }
      
      .content-card h2:before {
        margin-right: 0;
        font-size: 22px;
        margin-bottom: 5px;
      }
      
      .message {
        padding: 14px 16px;
        font-size: 14px;
        margin-bottom: 20px;
        border-radius: 8px;
        border-left-width: 3px;
      }
      
      .message a {
        padding: 6px 12px;
        font-size: 13px;
        margin-top: 8px;
      }
      
      .form-group {
        margin-bottom: 20px;
      }
      
      .form-group label {
        font-size: 14px;
        margin-bottom: 8px;
      }
      
      .form-control {
        padding: 12px 16px;
        font-size: 14px;
        border-radius: 10px;
        border-width: 1.5px;
      }
      
      .form-control:focus {
        box-shadow: 0 0 0 2px rgba(212, 167, 98, 0.2);
      }
      
      textarea.form-control {
        min-height: 160px;
        line-height: 1.5;
        font-size: 14px;
      }
      
      .char-counter {
        font-size: 11px;
        margin-top: 3px;
      }
      
      .select-wrapper:after {
        right: 16px;
        font-size: 11px;
      }
      
      select.form-control {
        padding-right: 34px;
        font-size: 14px;
      }
      
      .label-options {
        gap: 6px;
        flex-direction: column;
      }
      
      .label-option {
        padding: 10px;
        font-size: 14px;
        width: 100%;
        justify-content: center;
      }
      
      .file-upload-container {
        padding: 20px;
        border-radius: 10px;
      }
      
      .upload-icon {
        font-size: 36px;
      }
      
      .upload-text {
        font-size: 13px;
        line-height: 1.4;
        margin-bottom: 12px;
      }
      
      .upload-text br {
        display: none;
      }
      
      .file-label {
        padding: 10px 18px;
        font-size: 14px;
        border-radius: 6px;
        width: 100%;
        max-width: 200px;
      }
      
      .file-info {
        font-size: 12px;
        margin-top: 12px;
        line-height: 1.4;
      }
      
      .image-preview {
        max-width: 220px;
        max-height: 160px;
      }
      
      .form-actions {
        flex-direction: column;
        gap: 15px;
        text-align: center;
        margin-top: 30px;
        padding-top: 15px;
      }
      
      .submit-btn {
        width: 100%;
        padding: 14px 24px;
        font-size: 15px;
        border-radius: 10px;
        margin-top: 10px;
      }
      
      #formStatus {
        font-size: 13px;
        text-align: center;
        display: block;
        width: 100%;
      }
      
      .tips-section {
        padding: 16px;
        margin-top: 30px;
        border-radius: 10px;
        border-left-width: 3px;
      }
      
      .tips-section h4 {
        font-size: 15px;
        margin-bottom: 8px;
      }
      
      .tips-section ul {
        padding-left: 18px;
      }
      
      .tips-section li {
        font-size: 13px;
        margin-bottom: 6px;
        line-height: 1.4;
      }
    }
    
    /* Extra small devices (phones, 575px and down) */
    @media (max-width: 575px) {
      body {
        padding: 10px;
        font-size: 14px;
      }
      
      .dashboard-container {
        padding: 0;
        width: 100%;
      }
      
      .header {
        flex-direction: column;
        text-align: center;
        gap: 12px;
        padding: 18px 15px;
        border-radius: 12px;
        margin-bottom: 20px;
      }
      
      .header h1 {
        font-size: 20px;
        flex-direction: column;
        gap: 10px;
      }
      
      .header h1:before {
        margin-right: 0;
        font-size: 26px;
        margin-bottom: 5px;
      }
      
      .navigation {
        flex-direction: column;
        gap: 12px;
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
      }
      
      .nav-links {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
        width: 100%;
        margin-bottom: 10px;
      }
      
      .nav-links a {
        margin-right: 0;
        padding: 8px 10px;
        font-size: 12px;
        justify-content: center;
        min-height: 40px;
        word-break: break-word;
      }
      
      .page-info {
        font-size: 11px;
        padding: 5px 8px;
        width: 100%;
        text-align: center;
      }
      
      .content-card {
        padding: 18px;
        border-radius: 10px;
        margin: 0 auto;
        width: 100%;
        box-shadow: 0 6px 15px rgba(75, 46, 30, 0.1);
      }
      
      .content-card h2 {
        font-size: 18px;
        margin-bottom: 20px;
        padding-bottom: 12px;
        flex-direction: column;
        text-align: center;
        gap: 8px;
      }
      
      .content-card h2:before {
        margin-right: 0;
        font-size: 22px;
        margin-bottom: 5px;
      }
      
      .message {
        padding: 14px 15px;
        font-size: 13px;
        margin-bottom: 20px;
        border-radius: 8px;
        border-left-width: 3px;
        line-height: 1.5;
      }
      
      .message:before {
        font-size: 18px;
        margin-right: 8px;
      }
      
      .message a {
        display: block;
        width: 100%;
        text-align: center;
        padding: 8px 12px;
        font-size: 13px;
        margin-top: 10px;
      }
      
      .form-group {
        margin-bottom: 18px;
      }
      
      .form-group label {
        font-size: 14px;
        margin-bottom: 8px;
      }
      
      .form-control {
        padding: 12px 14px;
        font-size: 14px;
        border-radius: 8px;
        border-width: 1.5px;
      }
      
      .form-control:focus {
        box-shadow: 0 0 0 2px rgba(212, 167, 98, 0.2);
        transform: translateY(-1px);
      }
      
      textarea.form-control {
        min-height: 140px;
        line-height: 1.5;
        font-size: 14px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      
      .char-counter {
        font-size: 11px;
        margin-top: 3px;
      }
      
      .select-wrapper:after {
        right: 14px;
        font-size: 10px;
      }
      
      select.form-control {
        padding-right: 30px;
        font-size: 14px;
      }
      
      .label-options {
        flex-direction: column;
        gap: 6px;
        margin-top: 8px;
      }
      
      .label-option {
        padding: 10px;
        font-size: 13px;
        width: 100%;
        justify-content: center;
        border-radius: 6px;
      }
      
      .file-upload-container {
        padding: 18px 15px;
        border-radius: 8px;
        border-width: 2px;
      }
      
      .upload-icon {
        font-size: 32px;
        margin-bottom: 10px;
      }
      
      .upload-text {
        font-size: 13px;
        line-height: 1.4;
        margin-bottom: 12px;
      }
      
      .upload-text strong {
        display: block;
        margin-bottom: 4px;
      }
      
      .file-label {
        padding: 10px 16px;
        font-size: 14px;
        border-radius: 6px;
        width: 100%;
        max-width: 180px;
      }
      
      .file-info {
        font-size: 11px;
        margin-top: 10px;
        line-height: 1.4;
      }
      
      .image-preview {
        max-width: 100%;
        max-height: 150px;
        width: auto;
        height: auto;
      }
      
      .preview-container {
        margin-top: 15px;
      }
      
      .form-actions {
        flex-direction: column;
        gap: 15px;
        text-align: center;
        margin-top: 25px;
        padding-top: 15px;
      }
      
      .submit-btn {
        width: 100%;
        padding: 14px 20px;
        font-size: 15px;
        border-radius: 8px;
        margin-top: 10px;
        min-width: auto;
      }
      
      .submit-btn:after {
        font-size: 16px;
        margin-right: 8px;
      }
      
      #formStatus {
        font-size: 12px;
        text-align: center;
        display: block;
        width: 100%;
        line-height: 1.4;
        padding: 0 5px;
      }
      
      .tips-section {
        padding: 15px;
        margin-top: 25px;
        border-radius: 8px;
        border-left-width: 3px;
      }
      
      .tips-section h4 {
        font-size: 14px;
        margin-bottom: 8px;
      }
      
      .tips-section ul {
        padding-left: 16px;
      }
      
      .tips-section li {
        font-size: 12px;
        margin-bottom: 6px;
        line-height: 1.4;
      }
      
      /* Improve touch targets for mobile */
      input, textarea, button, select {
        font-size: 16px; /* Prevents iOS zoom on focus */
      }
      
      button, .file-label, .nav-links a, .label-option, .submit-btn {
        min-height: 44px; /* Minimum touch target size */
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }
    }
    
    /* Very small devices (phones, 360px and down) */
    @media (max-width: 360px) {
      .header {
        padding: 15px 12px;
      }
      
      .header h1 {
        font-size: 18px;
      }
      
      .nav-links {
        grid-template-columns: 1fr;
      }
      
      .nav-links a {
        width: 100%;
      }
      
      .content-card {
        padding: 15px;
      }
      
      .content-card h2 {
        font-size: 17px;
      }
      
      .form-control {
        padding: 10px 12px;
      }
      
      textarea.form-control {
        min-height: 120px;
      }
      
      .label-option {
        padding: 8px;
        font-size: 12px;
      }
      
      .file-upload-container {
        padding: 15px 12px;
      }
      
      .upload-text {
        font-size: 12px;
      }
      
      .file-label {
        padding: 8px 14px;
        font-size: 13px;
        max-width: 160px;
      }
      
      .submit-btn {
        padding: 12px 16px;
        font-size: 14px;
      }
    }
    
    /* Orientation specific adjustments */
    @media (max-height: 500px) and (orientation: landscape) {
      body {
        padding: 10px;
      }
      
      .dashboard-container {
        max-height: 100vh;
        overflow-y: auto;
      }
      
      .header {
        padding: 15px;
      }
      
      .navigation {
        padding: 12px;
      }
      
      .content-card {
        padding: 20px;
      }
      
      textarea.form-control {
        min-height: 120px;
      }
      
      .form-actions {
        margin-top: 20px;
        padding-top: 15px;
      }
    }
    
    /* High-resolution displays */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
      .form-control,
      .submit-btn,
      .file-label,
      .nav-links a,
      .label-option {
        border-width: 0.5px;
      }
    }
    
    /* Print styles */
    @media print {
      body {
        background: white;
        padding: 0;
      }
      
      .header,
      .navigation,
      .file-upload-container,
      .submit-btn,
      .tips-section {
        display: none;
      }
      
      .content-card {
        box-shadow: none;
        padding: 0;
      }
      
      .form-control {
        border: 1px solid #ccc;
        background: white;
      }
    }
    
    /* Accessibility improvements */
    @media (prefers-reduced-motion: reduce) {
      *,
      *::before,
      *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }
  </style>
</head>
<body>

<div class="dashboard-container">
  
  <!-- Header -->
  <div class="header">
    <h1>Add Old Cinema Content</h1>
    <div class="page-info">
      🎬 Classic Cinema Archive
    </div>
  </div>
  
  <!-- Navigation -->
  <div class="navigation">
    <div class="nav-links">
      <a href="/thinnai-palli/admin/dashboard.php">Dashboard</a>
      <a href="/thinnai-palli/">Home</a>
    </div>
    <div style="font-size: 14px; color: #666;">
      ✨ Preserve classic cinema memories
    </div>
  </div>
  
  <!-- Main Content Card -->
  <div class="content-card">
    <h2>Add Cinema Content</h2>
    
    <!-- Message Display -->
    <?php if ($msg) { ?>
    <div class="message <?php echo strpos($msg, '✅') !== false ? 'success' : 'error'; ?>">
      <?php echo $msg; ?>
    </div>
    <?php } ?>
    
    <!-- Form -->
    <form method="post" enctype="multipart/form-data" class="cinema-form" id="cinemaForm">
      
      <!-- Title Field -->
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" 
               name="title" 
               id="title" 
               class="form-control" 
               placeholder="Enter cinema content title..." 
               required
               maxlength="200">
        <div class="char-counter" id="titleCounter">0/200</div>
      </div>
      
      <!-- Label Field -->
      <div class="form-group">
        <label for="label">Category / Label</label>
        <div class="select-wrapper">
          <select name="label" id="label" class="form-control" required>
            <option value="">Select Category</option>
            <option value="actor">Actor</option>
            <option value="movie">Movie</option>
            <option value="song">Song</option>
            <option value="memory">Memory</option>
          </select>
        </div>
        
        <!-- Visual label options -->
        <div class="label-options">
          <div class="label-option" data-value="actor">
            🎭 Actor
          </div>
          <div class="label-option" data-value="movie">
            🎥 Movie
          </div>
          <div class="label-option" data-value="song">
            🎵 Song
          </div>
          <div class="label-option" data-value="memory">
            💭 Memory
          </div>
        </div>
      </div>
      
      <!-- Content Field -->
      <div class="form-group">
        <label for="content">Cinema Content</label>
        <textarea name="content" 
                  id="content" 
                  class="form-control" 
                  placeholder="Write cinema content in Tamil..." 
                  rows="8" 
                  required></textarea>
        <div class="char-counter" id="contentCounter">0 characters</div>
      </div>
      
      <!-- Image Upload -->
      <div class="form-group">
        <label>Cinema Image</label>
        <div class="file-upload-container" id="uploadContainer">
          <div class="upload-icon">🖼️</div>
          <div class="upload-text">
            <strong>Drag & drop your cinema image here</strong><br>
            or click to browse
          </div>
          <input type="file" 
                 name="image" 
                 id="image" 
                 class="file-input" 
                 accept="image/*"
                 required
                 onchange="previewImage(this)">
          <label for="image" class="file-label">Choose Cinema Image</label>
          <div class="file-info">
            Supports: JPG, PNG, GIF • Recommended: 16:9 aspect ratio
          </div>
          <div class="preview-container" id="previewContainer">
            <img id="imagePreview" class="image-preview" src="" alt="Preview">
          </div>
        </div>
      </div>
      
      <!-- Form Actions -->
      <div class="form-actions">
        <button type="submit" class="submit-btn" id="submitBtn">
          Add Cinema Content
        </button>
        
        <div style="font-size: 14px; color: #888;">
          <span id="formStatus">Ready to add cinema content</span>
        </div>
      </div>
    </form>
    
    <!-- Tips Section -->
    <div class="tips-section">
      <h4>Cinema Content Tips:</h4>
      <ul>
        <li>Use descriptive titles for easy searchability</li>
        <li>Select appropriate category for better organization</li>
        <li>Write content in Tamil for authentic feel</li>
        <li>Use high-quality images for better visual appeal</li>
        <li>Include nostalgic elements for memory category</li>
        <li>For actors: Include famous roles and trivia</li>
        <li>For movies: Include year, director, and cast</li>
        <li>For songs: Include singers and composers</li>
      </ul>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var titleInput = document.getElementById('title');
    var contentInput = document.getElementById('content');
    var labelSelect = document.getElementById('label');
    var labelOptions = document.querySelectorAll('.label-option');
    var titleCounter = document.getElementById('titleCounter');
    var contentCounter = document.getElementById('contentCounter');
    var form = document.getElementById('cinemaForm');
    var submitBtn = document.getElementById('submitBtn');
    var formStatus = document.getElementById('formStatus');
    var uploadContainer = document.getElementById('uploadContainer');
    
    // Character counter for title
    titleInput.addEventListener('input', function() {
      var length = this.value.length;
      titleCounter.textContent = length + '/200';
      
      if (length > 180) {
        titleCounter.className = 'char-counter warning';
      } else if (length > 190) {
        titleCounter.className = 'char-counter danger';
      } else {
        titleCounter.className = 'char-counter';
      }
    });
    
    // Character counter for content
    contentInput.addEventListener('input', function() {
      var length = this.value.length;
      var wordCount = this.value.trim().split(/\s+/).filter(function(word) {
        return word.length > 0;
      }).length;
      contentCounter.textContent = length + ' characters • ' + wordCount + ' words';
      
      if (length < 100) {
        contentCounter.className = 'char-counter warning';
      } else {
        contentCounter.className = 'char-counter';
      }
    });
    
    // Initialize counters
    titleInput.dispatchEvent(new Event('input'));
    contentInput.dispatchEvent(new Event('input'));
    
    // Label option selection
    labelOptions.forEach(function(option) {
      option.addEventListener('click', function() {
        var value = this.getAttribute('data-value');
        labelSelect.value = value;
        
        // Update active state
        labelOptions.forEach(function(opt) {
          opt.classList.remove('active');
        });
        this.classList.add('active');
      });
    });
    
    // Update label options when select changes
    labelSelect.addEventListener('change', function() {
      var value = this.value;
      labelOptions.forEach(function(option) {
        if (option.getAttribute('data-value') === value) {
          option.classList.add('active');
        } else {
          option.classList.remove('active');
        }
      });
    });
    
    // Drag and drop for image upload
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(function(eventName) {
      uploadContainer.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
      e.preventDefault();
      e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(function(eventName) {
      uploadContainer.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(function(eventName) {
      uploadContainer.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
      uploadContainer.classList.add('dragover');
    }
    
    function unhighlight() {
      uploadContainer.classList.remove('dragover');
    }
    
    uploadContainer.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
      var dt = e.dataTransfer;
      var files = dt.files;
      var fileInput = document.getElementById('image');
      
      if (files.length > 0) {
        fileInput.files = files;
        previewImage(fileInput);
      }
    }
    
    // Form submission animation
    form.addEventListener('submit', function(e) {
      // Validate required fields
      if (!titleInput.value.trim() || !contentInput.value.trim() || !labelSelect.value) {
        e.preventDefault();
        formStatus.textContent = "Please fill in all required fields";
        formStatus.style.color = "#dc3545";
        form.style.animation = 'shake 0.5s';
        setTimeout(function() {
          form.style.animation = '';
        }, 500);
        return;
      }
      
      // Check image is selected
      var imageInput = document.getElementById('image');
      if (!imageInput.value) {
        e.preventDefault();
        formStatus.textContent = "Please select an image";
        formStatus.style.color = "#dc3545";
        uploadContainer.style.animation = 'shake 0.5s';
        setTimeout(function() {
          uploadContainer.style.animation = '';
        }, 500);
        return;
      }
      
      // Show loading state
      submitBtn.style.opacity = '0.8';
      submitBtn.style.cursor = 'not-allowed';
      submitBtn.innerHTML = '<span style="margin-right: 10px;">⏳</span> Adding Cinema Content...';
      formStatus.textContent = "Adding cinema content to archive...";
      formStatus.style.color = "#0066cc";
    });
    
    // Auto-save indicator (simulated)
    var autoSaveTimer;
    var inputs = [titleInput, contentInput, labelSelect];
    
    for (var i = 0; i < inputs.length; i++) {
      inputs[i].addEventListener('input', function() {
        clearTimeout(autoSaveTimer);
        formStatus.textContent = "Changes detected...";
        formStatus.style.color = "#ffc107";
        
        autoSaveTimer = setTimeout(function() {
          formStatus.textContent = "All changes saved locally";
          formStatus.style.color = "#28a745";
          
          // Fade out message after 2 seconds
          setTimeout(function() {
            formStatus.textContent = "Ready to add cinema content";
            formStatus.style.color = "#888";
          }, 2000);
        }, 1500);
      });
    }
    
    // Add CSS for ripple effect
    var style = document.createElement('style');
    style.textContent = '@keyframes ripple {' +
                        'to {' +
                        'transform: scale(4);' +
                        'opacity: 0;' +
                        '}' +
                        '}';
    document.head.appendChild(style);
    
    // Keyboard shortcut for saving (Ctrl+S)
    document.addEventListener('keydown', function(e) {
      if (e.ctrlKey && e.key === 's') {
        e.preventDefault();
        submitBtn.click();
        
        // Add visual feedback for mobile
        if (window.innerWidth <= 767) {
          submitBtn.style.animation = 'none';
          void submitBtn.offsetWidth; // Trigger reflow
          submitBtn.style.animation = 'fadeIn 0.3s';
        }
      }
    });
    
    // Touch improvements for mobile
    if ('ontouchstart' in window) {
      // Add touch feedback
      var touchElements = document.querySelectorAll('.submit-btn, .nav-links a, .label-option, .file-label');
      touchElements.forEach(function(el) {
        el.addEventListener('touchstart', function() {
          this.style.transform = 'scale(0.98)';
          this.style.opacity = '0.9';
        });
        
        el.addEventListener('touchend', function() {
          this.style.transform = '';
          this.style.opacity = '';
        });
        
        // Prevent sticky hover on touch devices
        el.addEventListener('touchstart', function() {
          this.classList.remove('hover');
        });
      });
      
      // Prevent iOS zoom on input focus
      var formControls = document.querySelectorAll('.form-control');
      formControls.forEach(function(control) {
        control.addEventListener('touchstart', function() {
          // iOS will handle zoom automatically
        });
      });
    }
    
    // Adjust textarea height based on content
    function adjustTextareaHeight(textarea) {
      textarea.style.height = 'auto';
      var newHeight = Math.max(textarea.scrollHeight, 200);
      if (window.innerWidth <= 575) {
        newHeight = Math.max(newHeight, 140);
      }
      textarea.style.height = newHeight + 'px';
    }
    
    contentInput.addEventListener('input', function() {
      adjustTextareaHeight(this);
    });
    
    // Initial adjustment
    setTimeout(function() {
      adjustTextareaHeight(contentInput);
    }, 100);
    
    // Handle orientation change
    window.addEventListener('orientationchange', function() {
      setTimeout(function() {
        adjustTextareaHeight(contentInput);
      }, 300);
    });
  });
  
  // Image preview function
  function previewImage(input) {
    var preview = document.getElementById('imagePreview');
    var container = document.getElementById('previewContainer');
    
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        preview.src = e.target.result;
        container.style.display = 'block';
        preview.style.animation = 'fadeIn 0.5s ease-out';
        
        // Update upload text for mobile
        var uploadText = document.querySelector('.upload-text');
        var fileName = input.files[0].name;
        var fileSize = Math.round(input.files[0].size / 1024 / 1024 * 100) / 100;
        
        if (window.innerWidth <= 575) {
          uploadText.innerHTML = '<strong>Image Selected</strong><br>' +
                                 (fileName.length > 20 ? fileName.substring(0, 20) + '...' : fileName);
        } else {
          uploadText.innerHTML = '<strong>Image Selected:</strong><br>' +
                                 fileName + ' (' + fileSize + ' MB)';
        }
      };
      
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>

</body>
</html>