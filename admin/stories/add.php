<?php
session_start();
include '../../includes/db.php';
include '../includes/upload_image.php';

if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $title   = trim($_POST['title']);
  $summary = trim($_POST['summary']);
  $content = trim($_POST['content']);

  // create slug automatically
  $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));

  // upload image
  $imagePath = null;
  if (!empty($_FILES['image']['name'])) {
    $imagePath = uploadImage($_FILES['image'], 'stories');
  }

  $stmt = $conn->prepare(
    "INSERT INTO stories (title, slug, summary, content, image_path)
     VALUES (?,?,?,?,?)"
  );

  $stmt->bind_param(
    "sssss",
    $title,
    $slug,
    $summary,
    $content,
    $imagePath
  );

  $stmt->execute();

  header("Location: ../dashboard.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Story - Admin</title>
  <style>
    /* Modern color palette */
    :root {
      --primary: #4b2e1e;
      --secondary: #d4a762;
      --accent: #0066cc;
      --light: #f8f4ef;
      --dark: #2c1810;
      --success: #28a745;
      --warning: #ffc107;
      --danger: #dc3545;
      --card-bg: #ffffff;
      --shadow: rgba(75, 46, 30, 0.1);
      --input-border: #ddd;
    }
    
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
      color: var(--dark);
      animation: fadeIn 0.8s ease-out;
    }
    
    /* Main container */
    .dashboard-container {
      max-width: 1200px;
      margin: 0 auto;
      animation: fadeIn 0.8s ease-out;
    }
    
    /* Header enhancements */
    .header {
      background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
      color: white;
      padding: 25px 30px;
      border-radius: 15px;
      margin-bottom: 30px;
      box-shadow: 0 8px 25px var(--shadow);
      display: flex;
      justify-content: space-between;
      align-items: center;
      animation: slideDown 0.6s ease-out;
    }
    
    .header h1 {
      color: white;
      margin: 0;
      font-size: 28px;
      display: flex;
      align-items: center;
    }
    
    .header h1:before {
      content: "📖";
      margin-right: 15px;
      font-size: 32px;
    }
    
    /* Breadcrumb navigation */
    .breadcrumb {
      background: var(--card-bg);
      padding: 15px 25px;
      border-radius: 12px;
      margin-bottom: 25px;
      box-shadow: 0 4px 15px var(--shadow);
      display: flex;
      justify-content: space-between;
      align-items: center;
      animation: slideUp 0.7s ease-out 0.2s both;
    }
    
    .breadcrumb-links a {
      display: inline-flex;
      align-items: center;
      padding: 8px 16px;
      border-radius: 8px;
      transition: all 0.3s ease;
      font-weight: 600;
      background: var(--light);
      color: var(--primary);
      text-decoration: none;
      margin-right: 10px;
      border: 1px solid rgba(75, 46, 30, 0.1);
      font-size: 14px;
    }
    
    .breadcrumb-links a:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px var(--shadow);
      background: var(--secondary);
      color: var(--dark);
    }
    
    .breadcrumb-links a:before {
      margin-right: 8px;
      font-size: 16px;
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
      background: var(--card-bg);
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 10px 30px var(--shadow);
      animation: fadeInUp 0.8s ease-out 0.3s both;
    }
    
    .content-card h2 {
      color: var(--primary);
      font-size: 24px;
      margin-bottom: 30px;
      padding-bottom: 15px;
      border-bottom: 2px solid var(--secondary);
      display: flex;
      align-items: center;
    }
    
    .content-card h2:before {
      content: "✏️";
      margin-right: 12px;
      font-size: 24px;
    }
    
    /* Form enhancements */
    .story-form {
      animation: fadeIn 0.8s ease-out 0.5s both;
    }
    
    /* Input group styling */
    .form-group {
      margin-bottom: 25px;
      position: relative;
      animation: fadeInUp 0.6s ease-out;
    }
    
    .form-group:nth-child(1) { animation-delay: 0.6s; }
    .form-group:nth-child(2) { animation-delay: 0.7s; }
    .form-group:nth-child(3) { animation-delay: 0.8s; }
    .form-group:nth-child(4) { animation-delay: 0.9s; }
    .form-group:nth-child(5) { animation-delay: 1.0s; }
    
    .form-group label {
      display: block;
      margin-bottom: 10px;
      color: var(--dark);
      font-weight: 600;
      font-size: 15px;
      padding-left: 5px;
    }
    
    .form-group label:after {
      content: " *";
      color: var(--danger);
    }
    
    /* Input field styling */
    .form-control {
      width: 100%;
      padding: 15px 20px;
      border: 2px solid var(--input-border);
      border-radius: 12px;
      font-size: 16px;
      transition: all 0.3s ease;
      background: var(--light);
      color: var(--dark);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .form-control:focus {
      outline: none;
      border-color: var(--secondary);
      box-shadow: 0 0 0 3px rgba(212, 167, 98, 0.2);
      background: white;
      transform: translateY(-2px);
    }
    
    /* Textarea specific styling */
    textarea.form-control {
      min-height: 120px;
      resize: vertical;
      line-height: 1.6;
    }
    
    textarea#content {
      min-height: 250px;
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
      color: var(--warning);
      font-weight: bold;
    }
    
    .char-counter.danger {
      color: var(--danger);
      font-weight: bold;
      animation: pulse 1s infinite;
    }
    
    /* File upload styling */
    .file-upload-container {
      border: 2px dashed var(--input-border);
      border-radius: 12px;
      padding: 30px;
      text-align: center;
      transition: all 0.3s ease;
      background: var(--light);
      position: relative;
      overflow: hidden;
    }
    
    .file-upload-container:hover {
      border-color: var(--secondary);
      background: rgba(212, 167, 98, 0.05);
      transform: translateY(-3px);
    }
    
    .file-upload-container.dragover {
      border-color: var(--accent);
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
      background: var(--primary);
      color: white;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 600;
    }
    
    .file-label:hover {
      background: var(--dark);
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
      background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
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
    
    .submit-btn:before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }
    
    .submit-btn:hover:before {
      left: 100%;
    }
    
    .submit-btn:after {
      content: "💾";
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
      border-left: 4px solid var(--secondary);
    }
    
    .tips-section h4 {
      color: var(--primary);
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
    
    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.6; }
    }
    
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
      20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    
    /* ===== RESPONSIVE ENHANCEMENTS ===== */
    
    /* Extra large devices (large desktops, 1200px and up) */
    @media (min-width: 1200px) {
      .dashboard-container {
        max-width: 1400px;
        padding: 0 30px;
      }
    }
    
    /* Large devices (desktops, 992px to 1199px) */
    @media (max-width: 1199px) and (min-width: 992px) {
      .dashboard-container {
        max-width: 100%;
        padding: 0 25px;
      }
      
      .content-card {
        padding: 35px;
      }
    }
    
    /* Medium devices (tablets, 768px to 991px) */
    @media (max-width: 991px) and (min-width: 768px) {
      .dashboard-container {
        padding: 0 20px;
      }
      
      .header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
        padding: 25px;
      }
      
      .breadcrumb {
        flex-direction: column;
        gap: 15px;
        text-align: center;
        padding: 20px;
      }
      
      .breadcrumb-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
      }
      
      .breadcrumb-links a {
        margin-right: 0;
      }
      
      .content-card {
        padding: 30px;
      }
      
      .form-actions {
        flex-direction: column;
        gap: 20px;
        text-align: center;
      }
      
      .submit-btn {
        width: 100%;
        max-width: 400px;
      }
      
      .image-preview {
        max-width: 250px;
        max-height: 180px;
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
        gap: 15px;
        padding: 22px;
        border-radius: 12px;
      }
      
      .header h1 {
        font-size: 24px;
      }
      
      .header h1:before {
        font-size: 28px;
        margin-right: 12px;
      }
      
      .breadcrumb {
        flex-direction: column;
        gap: 15px;
        text-align: center;
        padding: 18px;
        border-radius: 10px;
      }
      
      .breadcrumb-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
        margin-bottom: 10px;
      }
      
      .breadcrumb-links a {
        margin-right: 0;
        padding: 7px 14px;
        font-size: 13px;
      }
      
      .page-info {
        font-size: 13px;
        padding: 5px 10px;
      }
      
      .content-card {
        padding: 25px;
        border-radius: 12px;
      }
      
      .content-card h2 {
        font-size: 22px;
        margin-bottom: 25px;
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
        min-height: 110px;
      }
      
      textarea#content {
        min-height: 220px;
      }
      
      .file-upload-container {
        padding: 25px;
        border-radius: 10px;
      }
      
      .upload-icon {
        font-size: 40px;
      }
      
      .upload-text {
        font-size: 15px;
      }
      
      .file-label {
        padding: 11px 22px;
        font-size: 15px;
      }
      
      .image-preview {
        max-width: 220px;
        max-height: 160px;
      }
      
      .form-actions {
        flex-direction: column;
        gap: 18px;
        text-align: center;
        margin-top: 35px;
      }
      
      .submit-btn {
        width: 100%;
        padding: 15px 30px;
        font-size: 15px;
        border-radius: 10px;
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
        padding: 20px 15px;
        border-radius: 12px;
        margin-bottom: 20px;
      }
      
      .header h1 {
        font-size: 20px;
        flex-direction: column;
        gap: 10px;
      }
      
      .header h1:before {
        font-size: 26px;
        margin-right: 0;
        margin-bottom: 5px;
      }
      
      .breadcrumb {
        flex-direction: column;
        gap: 12px;
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
      }
      
      .breadcrumb-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 6px;
        margin-bottom: 8px;
      }
      
      .breadcrumb-links a {
        margin-right: 0;
        padding: 6px 12px;
        font-size: 12px;
        min-width: auto;
        flex: 1;
        justify-content: center;
        text-align: center;
      }
      
      .page-info {
        font-size: 12px;
        padding: 5px 10px;
        width: 100%;
      }
      
      .content-card {
        padding: 20px 15px;
        border-radius: 10px;
        margin: 0 auto;
        width: 100%;
        box-shadow: 0 6px 15px var(--shadow);
      }
      
      .content-card h2 {
        font-size: 18px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        flex-direction: column;
        text-align: center;
        gap: 8px;
      }
      
      .content-card h2:before {
        margin-right: 0;
        font-size: 22px;
      }
      
      .form-group {
        margin-bottom: 18px;
      }
      
      .form-group label {
        font-size: 14px;
        margin-bottom: 8px;
      }
      
      .form-control {
        padding: 12px 15px;
        font-size: 14px;
        border-radius: 8px;
        border-width: 1.5px;
      }
      
      .form-control:focus {
        box-shadow: 0 0 0 2px rgba(212, 167, 98, 0.2);
      }
      
      textarea.form-control {
        min-height: 100px;
        line-height: 1.5;
      }
      
      textarea#content {
        min-height: 180px;
      }
      
      .char-counter {
        font-size: 11px;
      }
      
      .file-upload-container {
        padding: 20px 15px;
        border-radius: 8px;
        border-width: 2px;
      }
      
      .upload-icon {
        font-size: 36px;
        margin-bottom: 10px;
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
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 6px;
        width: 100%;
        max-width: 200px;
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
        margin-top: 30px;
        padding-top: 15px;
      }
      
      .submit-btn {
        width: 100%;
        padding: 14px 20px;
        font-size: 15px;
        border-radius: 8px;
        min-width: auto;
        margin-top: 10px;
      }
      
      #formStatus {
        font-size: 13px;
        line-height: 1.4;
        padding: 0 10px;
      }
      
      .tips-section {
        padding: 15px;
        margin-top: 30px;
        border-radius: 8px;
        border-left-width: 3px;
      }
      
      .tips-section h4 {
        font-size: 14px;
        margin-bottom: 8px;
      }
      
      .tips-section ul {
        padding-left: 18px;
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
      
      button, .file-label, .breadcrumb-links a {
        min-height: 44px; /* Minimum touch target size */
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }
    }
    
    /* Very small devices (phones, 360px and down) */
    @media (max-width: 360px) {
      .header {
        padding: 18px 12px;
      }
      
      .header h1 {
        font-size: 18px;
      }
      
      .breadcrumb-links a {
        padding: 5px 8px;
        font-size: 11px;
        flex-basis: calc(50% - 6px);
      }
      
      .content-card {
        padding: 15px 12px;
      }
      
      .content-card h2 {
        font-size: 16px;
      }
      
      .form-control {
        padding: 10px 12px;
      }
      
      .file-upload-container {
        padding: 15px 12px;
      }
      
      .upload-text {
        font-size: 12px;
      }
      
      .file-label {
        padding: 8px 16px;
        font-size: 13px;
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
      
      .content-card {
        padding: 20px;
      }
      
      textarea#content {
        min-height: 150px;
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
      .breadcrumb-links a {
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
      .breadcrumb,
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
    
    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
      :root {
        --light: #2c1810;
        --dark: #f8f4ef;
        --card-bg: #1a1a1a;
        --input-border: #444;
      }
      
      body {
        background: linear-gradient(135deg, #1a1a1a 0%, #2c1810 100%);
        color: var(--dark);
      }
    }
  </style>
</head>
<body>

<div class="dashboard-container">
  
  <!-- Header -->
  <div class="header">
    <h1>Add New Story</h1>
    <div style="background: rgba(255,255,255,0.2); padding: 8px 15px; border-radius: 20px; font-size: 14px;">
      📖 Story Management
    </div>
  </div>
  
  <!-- Breadcrumb Navigation -->
  <div class="breadcrumb">
    <div class="breadcrumb-links">
      <a href="/thinnai-palli/admin/dashboard.php">Dashboard</a>
      <a href="/thinnai-palli/">Home</a>
      <a href="/thinnai-palli/admin/dashboard.php/stories/manage.php">Manage Stories</a>
    </div>
    <div class="page-info">
      ✨ Create a new story
    </div>
  </div>
  
  <!-- Main Content Card -->
  <div class="content-card">
    <h2>Add Story</h2>
    
    <!-- Form -->
    <form method="post" enctype="multipart/form-data" class="story-form" id="storyForm">
      
      <!-- Title Field -->
      <div class="form-group">
        <label for="title">Story Title</label>
        <input type="text" 
               name="title" 
               id="title" 
               class="form-control" 
               placeholder="Enter the story title..." 
               required
               maxlength="200">
        <div class="char-counter" id="titleCounter">0/200</div>
      </div>
      
      <!-- Summary Field -->
      <div class="form-group">
        <label for="summary">Short Summary</label>
        <textarea name="summary" 
                  id="summary" 
                  class="form-control" 
                  placeholder="Write a brief summary (1-2 lines)..." 
                  required
                  maxlength="300"></textarea>
        <div class="char-counter" id="summaryCounter">0/300</div>
      </div>
      
      <!-- Content Field -->
      <div class="form-group">
        <label for="content">Full Story Content</label>
        <textarea name="content" 
                  id="content" 
                  class="form-control" 
                  placeholder="Write your full story here..." 
                  rows="10" 
                  required></textarea>
        <div class="char-counter" id="contentCounter">0 characters</div>
      </div>
      
      <!-- Image Upload -->
      <div class="form-group">
        <label>Story Image</label>
        <div class="file-upload-container" id="uploadContainer">
          <div class="upload-icon">🖼️</div>
          <div class="upload-text">
            <strong>Drag & drop your image here</strong><br>
            or click to browse
          </div>
          <input type="file" 
                 name="image" 
                 id="image" 
                 class="file-input" 
                 accept="image/*"
                 onchange="previewImage(this)">
          <label for="image" class="file-label">Choose Image</label>
          <div class="file-info">
            Supports: JPG, PNG, GIF • Max: 5MB
          </div>
          <div class="preview-container" id="previewContainer">
            <img id="imagePreview" class="image-preview" src="" alt="Preview">
          </div>
        </div>
      </div>
      
      <!-- Form Actions -->
      <div class="form-actions">
        <button type="submit" class="submit-btn" id="submitBtn">
          Save Story
        </button>
        
        <div style="font-size: 14px; color: #888;">
          <span id="formStatus">Ready to save</span>
        </div>
      </div>
    </form>
    
    <!-- Tips Section -->
    <div class="tips-section">
      <h4>Tips for Great Stories:</h4>
      <ul>
        <li>Use a catchy title that grabs attention</li>
        <li>Keep summary short and engaging (1-2 lines)</li>
        <li>Add relevant images to enhance the story</li>
        <li>Use paragraphs for better readability</li>
        <li>Proofread before publishing</li>
      </ul>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const summaryInput = document.getElementById('summary');
    const contentInput = document.getElementById('content');
    const titleCounter = document.getElementById('titleCounter');
    const summaryCounter = document.getElementById('summaryCounter');
    const contentCounter = document.getElementById('contentCounter');
    const uploadContainer = document.getElementById('uploadContainer');
    const previewContainer = document.getElementById('previewContainer');
    const imagePreview = document.getElementById('imagePreview');
    const form = document.getElementById('storyForm');
    const submitBtn = document.getElementById('submitBtn');
    const formStatus = document.getElementById('formStatus');
    
    // Update console
    console.log('%c📖 Add Story Editor', 'color: #4b2e1e; font-size: 16px; font-weight: bold;');
    console.log('%cCreate engaging stories for your audience', 'color: #666;');
    
    // Character counter for title
    titleInput.addEventListener('input', function() {
      const length = this.value.length;
      titleCounter.textContent = `${length}/200`;
      
      if (length > 180) {
        titleCounter.classList.add('warning');
        titleCounter.classList.remove('danger');
      } else if (length > 190) {
        titleCounter.classList.remove('warning');
        titleCounter.classList.add('danger');
      } else {
        titleCounter.classList.remove('warning', 'danger');
      }
    });
    
    // Character counter for summary
    summaryInput.addEventListener('input', function() {
      const length = this.value.length;
      summaryCounter.textContent = `${length}/300`;
      
      if (length > 250) {
        summaryCounter.classList.add('warning');
        summaryCounter.classList.remove('danger');
      } else if (length > 280) {
        summaryCounter.classList.remove('warning');
        summaryCounter.classList.add('danger');
      } else {
        summaryCounter.classList.remove('warning', 'danger');
      }
    });
    
    // Character counter for content
    contentInput.addEventListener('input', function() {
      const length = this.value.length;
      const wordCount = this.value.trim().split(/\s+/).filter(word => word.length > 0).length;
      contentCounter.textContent = `${length} characters • ${wordCount} words`;
      
      if (length < 100) {
        contentCounter.classList.add('warning');
        contentCounter.classList.remove('danger');
      } else {
        contentCounter.classList.remove('warning', 'danger');
      }
    });
    
    // Initialize counters
    titleInput.dispatchEvent(new Event('input'));
    summaryInput.dispatchEvent(new Event('input'));
    contentInput.dispatchEvent(new Event('input'));
    
    // Drag and drop for image upload
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      uploadContainer.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
      e.preventDefault();
      e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
      uploadContainer.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
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
      const dt = e.dataTransfer;
      const files = dt.files;
      const fileInput = document.getElementById('image');
      
      if (files.length > 0) {
        fileInput.files = files;
        previewImage(fileInput);
      }
    }
    
    // Form submission animation
    form.addEventListener('submit', function(e) {
      // Validate required fields
      if (!titleInput.value.trim() || !summaryInput.value.trim() || !contentInput.value.trim()) {
        e.preventDefault();
        formStatus.textContent = "Please fill in all required fields";
        formStatus.style.color = "var(--danger)";
        form.style.animation = 'shake 0.5s';
        setTimeout(() => {
          form.style.animation = '';
        }, 500);
        return;
      }
      
      // Show loading state
      submitBtn.style.opacity = '0.8';
      submitBtn.style.cursor = 'not-allowed';
      submitBtn.innerHTML = '<span style="margin-right: 10px;">⏳</span> Saving Story...';
      formStatus.textContent = "Saving your story...";
      formStatus.style.color = "var(--accent)";
      
      // Add ripple effect
      const ripple = document.createElement('span');
      const rect = submitBtn.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height);
      const x = rect.width / 2;
      const y = rect.height / 2;
      
      ripple.style.cssText = `
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.7);
        transform: scale(0);
        animation: ripple 1s linear;
        width: ${size}px;
        height: ${size}px;
        top: ${0}px;
        left: ${0}px;
        pointer-events: none;
      `;
      
      submitBtn.style.position = 'relative';
      submitBtn.style.overflow = 'hidden';
      submitBtn.appendChild(ripple);
      
      setTimeout(() => {
        ripple.remove();
      }, 1000);
    });
    
    // Auto-save indicator (simulated)
    let autoSaveTimer;
    [titleInput, summaryInput, contentInput].forEach(input => {
      input.addEventListener('input', function() {
        clearTimeout(autoSaveTimer);
        formStatus.textContent = "Changes detected...";
        formStatus.style.color = "var(--warning)";
        
        autoSaveTimer = setTimeout(() => {
          formStatus.textContent = "All changes saved locally";
          formStatus.style.color = "var(--success)";
          
          // Fade out message after 2 seconds
          setTimeout(() => {
            formStatus.textContent = "Ready to save";
            formStatus.style.color = "#888";
          }, 2000);
        }, 1500);
      });
    });
    
    // Add CSS for ripple effect
    const style = document.createElement('style');
    style.textContent = `
      @keyframes ripple {
        to {
          transform: scale(4);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(style);
    
    // Keyboard shortcut for saving (Ctrl+S)
    document.addEventListener('keydown', function(e) {
      if (e.ctrlKey && e.key === 's') {
        e.preventDefault();
        submitBtn.click();
        
        // Add visual feedback
        submitBtn.style.animation = 'pulse 0.5s';
        setTimeout(() => {
          submitBtn.style.animation = '';
        }, 500);
      }
    });
    
    // Mobile-specific improvements
    if ('ontouchstart' in window) {
      // Add touch feedback for mobile
      const touchElements = document.querySelectorAll('.file-label, .breadcrumb-links a, .submit-btn');
      touchElements.forEach(el => {
        el.addEventListener('touchstart', function() {
          this.style.transform = 'scale(0.98)';
        });
        
        el.addEventListener('touchend', function() {
          this.style.transform = '';
        });
      });
      
      // Improve file input for mobile
      const fileInput = document.getElementById('image');
      fileInput.addEventListener('touchstart', function(e) {
        e.stopPropagation();
      });
    }
  });
  
  // Image preview function
  function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const container = document.getElementById('previewContainer');
    
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      
      reader.onload = function(e) {
        preview.src = e.target.result;
        container.style.display = 'block';
        preview.style.animation = 'fadeIn 0.5s ease-out';
        
        // Update upload text
        const uploadText = document.querySelector('.upload-text');
        const fileName = input.files[0].name;
        const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
        
        // Adjust text for mobile
        if (window.innerWidth <= 575) {
          uploadText.innerHTML = `
            <strong>Image Selected</strong><br>
            ${fileName.length > 20 ? fileName.substring(0, 20) + '...' : fileName}
          `;
        } else {
          uploadText.innerHTML = `
            <strong>Image Selected:</strong><br>
            ${fileName} (${fileSize} MB)
          `;
        }
      };
      
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>

</body>
</html>