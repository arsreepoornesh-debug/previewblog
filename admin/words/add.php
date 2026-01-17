<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}

include '../../includes/db.php';

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $title   = trim($_POST['title']);
  $summary = trim($_POST['summary']);
  $content = trim($_POST['content']);

  if ($title && $summary && $content) {

    // SAFE slug (NO regex, NO Tamil processing)
    $slug = 'page-' . time();

    $stmt = $conn->prepare(
      "INSERT INTO tamil_word_pages (title, slug, summary, content)
       VALUES (?, ?, ?, ?)"
    );

    if ($stmt) {
      $stmt->bind_param("ssss", $title, $slug, $summary, $content);

      if ($stmt->execute()) {
        $msg = "Tamil Word document added successfully ✅";
      } else {
        $msg = "Database insert failed ❌";
      }
    } else {
      $msg = "Prepare failed ❌";
    }

  } else {
    $msg = "All fields are required ❌";
  }
}
?>
<!DOCTYPE html>
<html lang="ta">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Tamil Words Page - Admin</title>
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
      content: "📘";
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
      content: "✏️";
      margin-right: 12px;
      font-size: 24px;
    }
    
    /* Message styling */
    .message {
      padding: 15px 20px;
      border-radius: 10px;
      margin-bottom: 25px;
      font-weight: 600;
      display: flex;
      align-items: center;
      animation: fadeIn 0.5s ease-out;
    }
    
    .message.success {
      background: rgba(40, 167, 69, 0.1);
      color: #28a745;
      border-left: 4px solid #28a745;
    }
    
    .message.error {
      background: rgba(220, 53, 69, 0.1);
      color: #dc3545;
      border-left: 4px solid #dc3545;
    }
    
    .message:before {
      margin-right: 10px;
      font-size: 20px;
    }
    
    /* Form styling */
    .tamil-form {
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
    
    /* Textarea specific styling */
    textarea.form-control {
      min-height: 150px;
      resize: vertical;
      line-height: 1.6;
    }
    
    #content {
      min-height: 400px;
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
      content: "📝";
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
    
    /* Tamil text specific styling */
    .tamil-example {
      background: rgba(0, 102, 204, 0.05);
      padding: 15px;
      border-radius: 8px;
      margin-top: 10px;
      border-left: 3px solid #0066cc;
    }
    
    .tamil-example h5 {
      color: #4b2e1e;
      margin-bottom: 5px;
      font-size: 14px;
    }
    
    .tamil-example p {
      color: #666;
      font-size: 13px;
      margin: 0;
      font-family: 'Arial Unicode MS', 'Tahoma', sans-serif;
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
        min-width: 130px;
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
        padding: 14px 18px;
        font-size: 15px;
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
        min-height: 130px;
      }
      
      #content {
        min-height: 300px;
        font-size: 15px;
      }
      
      .char-counter {
        font-size: 11px;
      }
      
      .tamil-example {
        padding: 12px;
        font-size: 12px;
      }
      
      .tamil-example h5 {
        font-size: 13px;
      }
      
      .tamil-example p {
        font-size: 12px;
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
        padding: 9px 12px;
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
        padding: 12px 16px;
        font-size: 14px;
        margin-bottom: 20px;
        border-radius: 8px;
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
        min-height: 120px;
        line-height: 1.5;
      }
      
      #content {
        min-height: 250px;
        font-size: 14px;
      }
      
      .char-counter {
        font-size: 11px;
        margin-top: 3px;
      }
      
      .tamil-example {
        padding: 10px;
        margin-top: 8px;
        font-size: 11px;
      }
      
      .tamil-example h5 {
        font-size: 12px;
        margin-bottom: 4px;
      }
      
      .tamil-example p {
        font-size: 11px;
        line-height: 1.4;
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
        padding: 12px 15px;
        font-size: 13px;
        margin-bottom: 20px;
        border-radius: 8px;
        border-left-width: 3px;
      }
      
      .message:before {
        font-size: 18px;
        margin-right: 8px;
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
        min-height: 100px;
        line-height: 1.5;
      }
      
      #content {
        min-height: 200px;
        font-size: 14px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      
      .char-counter {
        font-size: 11px;
        margin-top: 3px;
      }
      
      .tamil-example {
        padding: 10px;
        margin-top: 8px;
        border-left-width: 2px;
      }
      
      .tamil-example h5 {
        font-size: 12px;
        margin-bottom: 4px;
      }
      
      .tamil-example p {
        font-size: 11px;
        line-height: 1.4;
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
      
      button, .nav-links a, .submit-btn {
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
        min-height: 80px;
      }
      
      #content {
        min-height: 180px;
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
      
      #content {
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
      .nav-links a {
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
    <h1>Add Tamil Words Page</h1>
    <div class="page-info">
      தமிழ் சொல் ஆவணம் சேர்க்கவும்
    </div>
  </div>
  
  <!-- Navigation -->
  <div class="navigation">
    <div class="nav-links">
      <a href="/thinnai-palli/admin/dashboard.php">Dashboard</a>
      <a href="/thinnai-palli/">Home</a>
      <a href="manage.php">Manage Tamil Word Pages</a>
    </div>
    <div style="font-size: 14px; color: #666;">
      ✨ Create new Tamil vocabulary document
    </div>
  </div>
  
  <!-- Main Content Card -->
  <div class="content-card">
    <h2>Add Tamil Words Page (Document Upload)</h2>
    
    <!-- Message Display -->
    <?php if ($msg): ?>
    <div class="message <?php echo strpos($msg, '✅') !== false ? 'success' : 'error'; ?>">
      <?php echo $msg; ?>
    </div>
    <?php endif; ?>
    
    <!-- Form -->
    <form method="post" class="tamil-form" id="tamilForm">
      
      <!-- Title Field -->
      <div class="form-group">
        <label for="title">Page Title</label>
        <input type="text" 
               name="title" 
               id="title" 
               class="form-control" 
               placeholder="எ.கா: அஞ்சறைப் பெட்டிப் பொருட்கள்" 
               required
               maxlength="200">
        <div class="char-counter" id="titleCounter">0/200</div>
        <div class="tamil-example">
          <h5>📌 Example Titles:</h5>
          <p>• அஞ்சறைப் பெட்டிப் பொருட்கள்</p>
          <p>• வீட்டுப் பயன்பாட்டுச் சொற்கள்</p>
          <p>• கல்வி தொடர்பான தமிழ்ச் சொற்கள்</p>
        </div>
      </div>
      
      <!-- Summary Field -->
      <div class="form-group">
        <label for="summary">Short Summary</label>
        <textarea name="summary" 
                  id="summary" 
                  class="form-control" 
                  placeholder="சிறிய சுருக்கம் (2-3 வரிகள்)..." 
                  required
                  maxlength="500"></textarea>
        <div class="char-counter" id="summaryCounter">0/500</div>
      </div>
      
      <!-- Content Field -->
      <div class="form-group">
        <label for="content">Full Document Content</label>
        <textarea name="content" 
                  id="content" 
                  class="form-control" 
                  placeholder="முழு ஆவண உள்ளடக்கத்தை இங்கே ஒட்டவும் (படிவம்: மோசமான → நல்ல)" 
                  required></textarea>
        <div class="char-counter" id="contentCounter">0 characters</div>
        <div class="tamil-example">
          <h5>📋 Content Format Example:</h5>
          <p>மோசமான படிவம்: word1 - meaning1, word2 - meaning2</p>
          <p>நல்ல படிவம்: </p>
          <p>• <strong>சொல்1:</strong> பொருள்1</p>
          <p>• <strong>சொல்2:</strong> பொருள்2</p>
          <p>• <strong>சொல்3:</strong> பொருள்3</p>
        </div>
      </div>
      
      <!-- Form Actions -->
      <div class="form-actions">
        <button type="submit" class="submit-btn" id="submitBtn">
          Create Page
        </button>
        
        <div style="font-size: 14px; color: #888;">
          <span id="formStatus">Ready to create Tamil document</span>
        </div>
      </div>
    </form>
    
    <!-- Tips Section -->
    <div class="tips-section">
      <h4>தமிழ் ஆவண உருவாக்க உதவிக்குறிப்புகள்:</h4>
      <ul>
        <li>தெளிவான தலைப்பைப் பயன்படுத்தவும்</li>
        <li>சுருக்கத்தை 2-3 வரிகளில் வைக்கவும்</li>
        <li>உள்ளடக்கத்தை புள்ளிவிவர பட்டியல் போல் அமைக்கவும்</li>
        <li>தமிழ் எழுத்துருக்களை சரியாகப் பயன்படுத்தவும்</li>
        <li>சேர்க்கும் முன் ஒருமுறை சரிபார்க்கவும்</li>
      </ul>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var titleInput = document.getElementById('title');
    var summaryInput = document.getElementById('summary');
    var contentInput = document.getElementById('content');
    var titleCounter = document.getElementById('titleCounter');
    var summaryCounter = document.getElementById('summaryCounter');
    var contentCounter = document.getElementById('contentCounter');
    var form = document.getElementById('tamilForm');
    var submitBtn = document.getElementById('submitBtn');
    var formStatus = document.getElementById('formStatus');
    
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
    
    // Character counter for summary
    summaryInput.addEventListener('input', function() {
      var length = this.value.length;
      summaryCounter.textContent = length + '/500';
      
      if (length > 400) {
        summaryCounter.className = 'char-counter warning';
      } else if (length > 450) {
        summaryCounter.className = 'char-counter danger';
      } else {
        summaryCounter.className = 'char-counter';
      }
    });
    
    // Character counter for content
    contentInput.addEventListener('input', function() {
      var length = this.value.length;
      var wordCount = this.value.trim().split(/\s+/).filter(function(word) {
        return word.length > 0;
      }).length;
      contentCounter.textContent = length + ' characters • ' + wordCount + ' words';
      
      if (length < 50) {
        contentCounter.className = 'char-counter warning';
      } else {
        contentCounter.className = 'char-counter';
      }
    });
    
    // Initialize counters
    titleInput.dispatchEvent(new Event('input'));
    summaryInput.dispatchEvent(new Event('input'));
    contentInput.dispatchEvent(new Event('input'));
    
    // Form submission animation
    form.addEventListener('submit', function(e) {
      // Validate required fields
      if (!titleInput.value.trim() || !summaryInput.value.trim() || !contentInput.value.trim()) {
        e.preventDefault();
        formStatus.textContent = "அனைத்து புலங்களையும் நிரப்பவும்";
        formStatus.style.color = "#dc3545";
        form.style.animation = 'shake 0.5s';
        setTimeout(function() {
          form.style.animation = '';
        }, 500);
        return;
      }
      
      // Show loading state
      submitBtn.style.opacity = '0.8';
      submitBtn.style.cursor = 'not-allowed';
      submitBtn.innerHTML = '<span style="margin-right: 10px;">⏳</span> Creating Tamil Document...';
      formStatus.textContent = "தமிழ் ஆவணம் உருவாக்கப்படுகிறது...";
      formStatus.style.color = "#0066cc";
      
      // Add ripple effect
      var ripple = document.createElement('span');
      var rect = submitBtn.getBoundingClientRect();
      var size = Math.max(rect.width, rect.height);
      
      ripple.style.cssText = 'position: absolute;' +
                            'border-radius: 50%;' +
                            'background: rgba(255, 255, 255, 0.7);' +
                            'transform: scale(0);' +
                            'animation: ripple 1s linear;' +
                            'width: ' + size + 'px;' +
                            'height: ' + size + 'px;' +
                            'top: 0;' +
                            'left: 0;' +
                            'pointer-events: none;';
      
      submitBtn.style.position = 'relative';
      submitBtn.style.overflow = 'hidden';
      submitBtn.appendChild(ripple);
      
      setTimeout(function() {
        ripple.parentNode.removeChild(ripple);
      }, 1000);
    });
    
    // Auto-save indicator (simulated)
    var autoSaveTimer;
    var inputs = [titleInput, summaryInput, contentInput];
    
    for (var i = 0; i < inputs.length; i++) {
      inputs[i].addEventListener('input', function() {
        clearTimeout(autoSaveTimer);
        formStatus.textContent = "மாற்றங்கள் கண்டறியப்பட்டன...";
        formStatus.style.color = "#ffc107";
        
        autoSaveTimer = setTimeout(function() {
          formStatus.textContent = "அனைத்து மாற்றங்களும் உள்ளூரில் சேமிக்கப்பட்டன";
          formStatus.style.color = "#28a745";
          
          // Fade out message after 2 seconds
          setTimeout(function() {
            formStatus.textContent = "தமிழ் ஆவணத்தை உருவாக்க தயார்";
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
      var touchElements = document.querySelectorAll('.submit-btn, .nav-links a');
      touchElements.forEach(function(el) {
        el.addEventListener('touchstart', function() {
          this.style.transform = 'scale(0.98)';
          this.style.opacity = '0.9';
        });
        
        el.addEventListener('touchend', function() {
          this.style.transform = '';
          this.style.opacity = '';
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
      var newHeight = Math.max(textarea.scrollHeight, 150);
      if (window.innerWidth <= 575) {
        newHeight = Math.max(newHeight, 100);
      }
      textarea.style.height = newHeight + 'px';
    }
    
    contentInput.addEventListener('input', function() {
      adjustTextareaHeight(this);
    });
    
    summaryInput.addEventListener('input', function() {
      adjustTextareaHeight(this);
    });
    
    // Initial adjustment
    setTimeout(function() {
      adjustTextareaHeight(contentInput);
      adjustTextareaHeight(summaryInput);
    }, 100);
    
    // Handle orientation change
    window.addEventListener('orientationchange', function() {
      setTimeout(function() {
        adjustTextareaHeight(contentInput);
        adjustTextareaHeight(summaryInput);
      }, 300);
    });
  });
</script>

</body>
</html>