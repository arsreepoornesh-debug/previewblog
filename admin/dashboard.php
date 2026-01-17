<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="ta">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <title>Admin Dashboard - திண்ணைப் பள்ளி</title>
  <style>
    /* ===== GLOBAL STYLES & VARIABLES ===== */
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
      --shadow-lg: rgba(75, 46, 30, 0.15);
      --radius: 12px;
      --radius-sm: 8px;
      --radius-lg: 16px;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    html {
      font-size: 16px;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
      scroll-behavior: smooth;
    }
    
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      background: linear-gradient(135deg, #f6f1e7 0%, #f0e6d6 100%);
      min-height: 100vh;
      color: #333;
      line-height: 1.5;
      overflow-x: hidden;
      padding: 0;
      margin: 0;
    }
    
    /* ===== ANIMATIONS ===== */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    
    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(15px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.02); }
      100% { transform: scale(1); }
    }
    
    @keyframes ripple {
      to {
        transform: scale(4);
        opacity: 0;
      }
    }
    
    @keyframes shimmer {
      0% { background-position: -1000px 0; }
      100% { background-position: 1000px 0; }
    }
    
    /* ===== MAIN LAYOUT ===== */
    .dashboard-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 20px;
      animation: fadeIn 0.6s ease-out;
    }
    
    /* ===== HEADER STYLES ===== */
    .dashboard-header {
      background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
      color: white;
      padding: clamp(20px, 4vw, 30px);
      border-radius: var(--radius-lg);
      margin-bottom: 25px;
      box-shadow: 0 10px 30px var(--shadow);
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      gap: 20px;
      animation: slideDown 0.5s ease-out;
      position: relative;
      overflow: hidden;
    }
    
    .dashboard-header::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, var(--secondary), var(--accent), var(--secondary));
      animation: shimmer 3s infinite linear;
    }
    
    .header-content {
      flex: 1;
      min-width: 250px;
    }
    
    .dashboard-header h1 {
      color: white;
      margin: 0 0 8px 0;
      font-size: clamp(1.5rem, 4vw, 2rem);
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    
    .dashboard-header h1:before {
      content: "⚙️";
      font-size: clamp(1.5rem, 4vw, 2rem);
    }
    
    .header-subtitle {
      font-size: clamp(0.875rem, 2vw, 1rem);
      opacity: 0.9;
      font-weight: 300;
    }
    
    .admin-info {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      padding: clamp(10px, 2vw, 15px);
      border-radius: var(--radius);
      border: 1px solid rgba(255, 255, 255, 0.2);
      min-width: 200px;
    }
    
    .current-date {
      font-size: clamp(0.875rem, 2vw, 1rem);
      display: flex;
      align-items: center;
      gap: 8px;
      justify-content: center;
      text-align: center;
    }
    
    /* ===== STATS SECTION ===== */
    .stats-section {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 15px;
      margin-bottom: 30px;
      animation: fadeInUp 0.6s ease-out 0.2s both;
    }
    
    .stat-card {
      background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
      color: white;
      padding: clamp(15px, 3vw, 20px);
      border-radius: var(--radius);
      text-align: center;
      box-shadow: 0 6px 20px var(--shadow);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 25px var(--shadow-lg);
    }
    
    .stat-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      transition: left 0.6s ease;
    }
    
    .stat-card:hover::before {
      left: 100%;
    }
    
    .stat-icon {
      font-size: 2rem;
      margin-bottom: 10px;
      opacity: 0.9;
    }
    
    .stat-number {
      font-size: clamp(1.5rem, 4vw, 2.2rem);
      font-weight: 700;
      margin-bottom: 5px;
      line-height: 1;
    }
    
    .stat-label {
      font-size: clamp(0.75rem, 2vw, 0.875rem);
      opacity: 0.85;
      font-weight: 400;
    }
    
    /* ===== QUICK ACTIONS ===== */
    .quick-actions {
      background: var(--card-bg);
      padding: clamp(15px, 3vw, 25px);
      border-radius: var(--radius-lg);
      margin-bottom: 30px;
      box-shadow: 0 6px 20px var(--shadow);
      animation: slideUp 0.6s ease-out 0.3s both;
    }
    
    .quick-actions h3 {
      color: var(--primary);
      font-size: clamp(1.125rem, 3vw, 1.5rem);
      margin: 0 0 20px 0;
      padding-bottom: 12px;
      border-bottom: 2px solid var(--secondary);
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .quick-actions h3:before {
      content: "🚀";
    }
    
    .action-buttons {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 12px;
    }
    
    .action-button {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: clamp(12px, 2vw, 16px);
      background: var(--light);
      border: 2px solid transparent;
      border-radius: var(--radius-sm);
      text-decoration: none;
      color: var(--primary);
      font-weight: 600;
      font-size: clamp(0.875rem, 2vw, 1rem);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    
    .action-button:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px var(--shadow);
      border-color: var(--secondary);
      background: white;
    }
    
    .action-button:active {
      transform: translateY(-1px);
    }
    
    .action-icon {
      font-size: 1.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 40px;
    }
    
    .action-text {
      flex: 1;
    }
    
    /* ===== MANAGEMENT SECTION ===== */
    .management-section {
      background: var(--card-bg);
      padding: clamp(20px, 4vw, 30px);
      border-radius: var(--radius-lg);
      box-shadow: 0 8px 25px var(--shadow);
      animation: fadeInUp 0.6s ease-out 0.4s both;
    }
    
    .management-section h3 {
      color: var(--primary);
      font-size: clamp(1.125rem, 3vw, 1.5rem);
      margin: 0 0 25px 0;
      padding-bottom: 15px;
      border-bottom: 2px solid var(--secondary);
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .management-section h3:before {
      content: "📋";
    }
    
    .management-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 20px;
    }
    
    .management-card {
      background: var(--light);
      border-radius: var(--radius);
      padding: clamp(15px, 3vw, 22px);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      border-left: 4px solid var(--secondary);
      display: flex;
      flex-direction: column;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      position: relative;
      overflow: hidden;
    }
    
    .management-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 30px var(--shadow-lg);
      border-left-color: var(--accent);
    }
    
    .card-header {
      display: flex;
      align-items: flex-start;
      gap: 15px;
      margin-bottom: 15px;
    }
    
    .card-icon {
      font-size: 1.8rem;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      flex-shrink: 0;
    }
    
    .card-title {
      flex: 1;
    }
    
    .card-title h4 {
      margin: 0 0 5px 0;
      color: var(--primary);
      font-size: 1.125rem;
      font-weight: 600;
    }
    
    .card-description {
      color: #666;
      font-size: 0.875rem;
      line-height: 1.4;
      margin-bottom: 20px;
      flex: 1;
    }
    
    .card-actions {
      display: flex;
      gap: 10px;
      margin-top: auto;
    }
    
    .card-link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      padding: 8px 16px;
      background: var(--primary);
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: 600;
      font-size: 0.875rem;
      transition: all 0.3s ease;
      flex: 1;
      text-align: center;
      min-height: 40px;
    }
    
    .card-link:hover {
      background: var(--accent);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .card-link:active {
      transform: translateY(0);
    }
    
    .card-link.manage {
      background: var(--accent);
    }
    
    .card-link.manage:hover {
      background: #0056b3;
    }
    
    /* ===== TIPS CARD ===== */
    .tips-card {
      background: linear-gradient(135deg, #e8f4ff 0%, #f0f8ff 100%);
      border-left-color: var(--success);
      grid-column: 1 / -1;
    }
    
    .tips-card .card-header {
      align-items: center;
    }
    
    .tips-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .tips-list li {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      margin-bottom: 10px;
      font-size: 0.875rem;
      color: #555;
    }
    
    .tips-list li:before {
      content: "✓";
      color: var(--success);
      font-weight: bold;
      flex-shrink: 0;
    }
    
    /* ===== FOOTER ===== */
    .dashboard-footer {
      text-align: center;
      margin-top: 40px;
      padding-top: 20px;
      border-top: 1px solid rgba(75, 46, 30, 0.1);
      color: #666;
      font-size: 0.875rem;
      animation: fadeIn 0.8s ease-out 0.6s both;
    }
    
    .footer-links {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 10px;
    }
    
    .footer-links a {
      color: var(--primary);
      text-decoration: none;
      font-size: 0.75rem;
      transition: color 0.3s ease;
    }
    
    .footer-links a:hover {
      color: var(--accent);
      text-decoration: underline;
    }
    
    /* ===== RESPONSIVE DESIGN ===== */
    
    /* Large tablets and small desktops */
    @media (max-width: 1024px) {
      .management-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      }
      
      .action-buttons {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      }
    }
    
    /* Tablets */
    @media (max-width: 768px) {
      .dashboard-container {
        padding: 15px;
      }
      
      .dashboard-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
      }
      
      .header-content, .admin-info {
        width: 100%;
        text-align: center;
      }
      
      .management-grid {
        grid-template-columns: 1fr;
      }
      
      .action-buttons {
        grid-template-columns: 1fr;
      }
      
      .stats-section {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .card-actions {
        flex-direction: column;
      }
    }
    
    /* Large smartphones */
    @media (max-width: 576px) {
      .dashboard-container {
        padding: 10px;
      }
      
      .stats-section {
        grid-template-columns: 1fr;
        gap: 10px;
      }
      
      .management-section,
      .quick-actions {
        padding: 15px;
      }
      
      .dashboard-header {
        padding: 15px;
        border-radius: 12px;
      }
      
      .footer-links {
        flex-direction: column;
        gap: 10px;
      }
      
      .management-card {
        padding: 15px;
      }
      
      .card-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 10px;
      }
      
      .card-icon {
        width: 40px;
        height: 40px;
        font-size: 1.5rem;
      }
    }
    
    /* Extra small devices */
    @media (max-width: 400px) {
      .dashboard-container {
        padding: 8px;
      }
      
      .dashboard-header h1 {
        font-size: 1.25rem;
      }
      
      .stat-number {
        font-size: 1.5rem;
      }
      
      .management-card {
        padding: 12px;
      }
      
      .card-link {
        padding: 6px 12px;
        font-size: 0.8125rem;
      }
    }
    
    /* Landscape mode adjustments */
    @media (max-height: 600px) and (orientation: landscape) {
      .dashboard-header {
        padding: 15px;
      }
      
      .stats-section {
        margin-bottom: 15px;
      }
      
      .management-section {
        padding: 15px;
      }
    }
    
    /* High-resolution displays */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
      .management-card {
        border-left-width: 3px;
      }
    }
    
    /* Reduced motion preference */
    @media (prefers-reduced-motion: reduce) {
      *,
      *::before,
      *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
      
      .dashboard-header::before,
      .stat-card::before {
        animation: none !important;
      }
    }
    
    /* Print styles */
    @media print {
      .dashboard-header,
      .quick-actions,
      .tips-card {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
      }
      
      .action-button:hover,
      .card-link:hover,
      .management-card:hover,
      .stat-card:hover {
        transform: none !important;
        box-shadow: none !important;
      }
      
      body {
        background: white !important;
      }
    }
    
    /* ===== UTILITY CLASSES ===== */
    .sr-only {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      white-space: nowrap;
      border: 0;
    }
    
    .loading {
      opacity: 0.6;
      pointer-events: none;
      position: relative;
    }
    
    .loading::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 20px;
      height: 20px;
      border: 2px solid var(--primary);
      border-radius: 50%;
      border-top-color: transparent;
      animation: spin 1s linear infinite;
    }
  </style>
</head>
<body>

<div class="dashboard-container">
  
  <!-- Header -->
  <header class="dashboard-header">
    <div class="header-content">
      <h1>Admin Dashboard</h1>
      <p class="header-subtitle">திண்ணைப் பள்ளி - Content Management System</p>
    </div>
    <div class="admin-info">
      <div class="current-date">
        <span>📅</span>
        <span><?php echo date("F j, Y"); ?></span>
      </div>
    </div>
  </header>
  
  <!-- Stats Section -->
  <section class="stats-section">
    <div class="stat-card" style="animation-delay: 0.1s">
      <div class="stat-icon">📊</div>
      <div class="stat-number">8</div>
      <div class="stat-label">Management Modules</div>
    </div>
    <div class="stat-card" style="animation-delay: 0.2s">
      <div class="stat-icon">📝</div>
      <div class="stat-number">4</div>
      <div class="stat-label">Content Types</div>
    </div>
    <div class="stat-card" style="animation-delay: 0.3s">
      <div class="stat-icon">⚡</div>
      <div class="stat-number">6</div>
      <div class="stat-label">Quick Actions</div>
    </div>
    <div class="stat-card" style="animation-delay: 0.4s">
      <div class="stat-icon">🔒</div>
      <div class="stat-number">24/7</div>
      <div class="stat-label">Secure Access</div>
    </div>
  </section>
  
  <!-- Quick Actions -->
  <section class="quick-actions">
    <h3>Quick Actions</h3>
    <div class="action-buttons">
      <a href="../index.php" target="_blank" class="action-button" aria-label="View home page">
        <span class="action-icon">🏠</span>
        <span class="action-text">View Home Page</span>
      </a>
      <a href="logout.php" class="action-button" aria-label="Logout from admin panel">
        <span class="action-icon">🚪</span>
        <span class="action-text">Logout</span>
      </a>
    </div>
  </section>
  
  <!-- Management Section -->
  <main class="management-section">
    <h3>Content Management</h3>
    
    <div class="management-grid">
      
      <!-- Cinema Management -->
      <article class="management-card">
        <div class="card-header">
          <div class="card-icon">🎬</div>
          <div class="card-title">
            <h4>Cinema Management</h4>
          </div>
        </div>
        <p class="card-description">Add and manage cinema content, showtimes, movie details, and reviews.</p>
        <div class="card-actions">
          <a href="cinema/add.php" class="card-link" aria-label="Add new cinema content">Add Content</a>
          <a href="cinema/manage.php" class="card-link manage" aria-label="Manage existing cinema content">Manage</a>
        </div>
      </article>
      
      <!-- Stories Management -->
      <article class="management-card">
        <div class="card-header">
          <div class="card-icon">📖</div>
          <div class="card-title">
            <h4>Story Management</h4>
          </div>
        </div>
        <p class="card-description">Create and manage Tamil stories, articles, and literary content.</p>
        <div class="card-actions">
          <a href="stories/add.php" class="card-link" aria-label="Add new story">Add Story</a>
          <a href="stories/manage.php" class="card-link manage" aria-label="Manage existing stories">Manage</a>
        </div>
      </article>
      
      <!-- Tamil Words Management -->
      <article class="management-card">
        <div class="card-header">
          <div class="card-icon">📘</div>
          <div class="card-title">
            <h4>Tamil Vocabulary</h4>
          </div>
        </div>
        <p class="card-description">Add new Tamil words, definitions, and manage vocabulary database.</p>
        <div class="card-actions">
          <a href="words/add.php" class="card-link" aria-label="Add new Tamil words">Add Words</a>
          <a href="words/manage.php" class="card-link manage" aria-label="Manage Tamil vocabulary">Manage</a>
        </div>
      </article>
      
      <!-- Home Page Management -->
      <article class="management-card">
        <div class="card-header">
          <div class="card-icon">🏠</div>
          <div class="card-title">
            <h4>Home Page</h4>
          </div>
        </div>
        <p class="card-description">Edit main page content, layout, banners, and featured sections.</p>
        <div class="card-actions">
          <a href="home/edit.php" class="card-link" aria-label="Edit home page content">Edit Home Page</a>
        </div>
      </article>
      
      <!-- Contact Management -->
      <article class="management-card">
        <div class="card-header">
          <div class="card-icon">📞</div>
          <div class="card-title">
            <h4>Contact Information</h4>
          </div>
        </div>
        <p class="card-description">Update contact details, social media links, and communication info.</p>
        <div class="card-actions">
          <a href="connect/edit.php" class="card-link" aria-label="Edit contact information">Edit Contact Info</a>
        </div>
      </article>
      
      <!-- Quick Tips -->
      <article class="management-card tips-card">
        <div class="card-header">
          <div class="card-icon">💡</div>
          <div class="card-title">
            <h4>Quick Tips</h4>
          </div>
        </div>
        <ul class="tips-list">
          <li>Click on any card to access management functions</li>
          <li>Use quick action buttons for frequently used pages</li>
          <li>All changes are saved automatically</li>
          <li>Use the logout button to securely exit</li>
          <li>View home page to see changes in real-time</li>
        </ul>
      </article>
      
    </div>
    
    <!-- Hidden original list for compatibility -->
    <ul style="display: none;">
      <li>🎬 <a href="cinema/add.php">Add Cinema</a></li>
      <li>🎬 <a href="cinema/manage.php">Manage Cinema</a></li>
      <li>📖 <a href="stories/add.php">Add Story</a></li>
      <li>📖 <a href="stories/manage.php">Manage Stories</a></li>
      <li>📘 <a href="words/add.php">Add Tamil Words</a></li>
      <li>📘 <a href="words/manage.php">Manage Tamil Words</a></li>
      <li>🏠 <a href="home/edit.php">Edit Home Page</a></li>
      <li>📞 <a href="connect/edit.php">Edit Contact Info</a></li>
    </ul>
  </main>
  
  <!-- Footer -->
  <footer class="dashboard-footer">
    <p>Admin Dashboard • திண்ணைப் பள்ளி CMS • Secure Access • <?php echo date("Y"); ?> ©</p>
    <div class="footer-links">
      <a href="#" onclick="window.print()">Print</a>
      <a href="#top">Back to Top</a>
      <span>Last login: Today, <?php echo date("g:i A"); ?></span>
    </div>
  </footer>
</div>

<!-- JavaScript -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize
    console.log('%c🔐 Admin Dashboard Loaded Successfully', 'color: #4b2e1e; font-size: 14px; font-weight: bold;');
    
    // Add ripple effect to all buttons
    function addRippleEffect(element) {
      element.addEventListener('click', function(e) {
        if(this.getAttribute('href') === '#' || this.hasAttribute('onclick')) {
          return;
        }
        
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size/2;
        const y = e.clientY - rect.top - size/2;
        
        const ripple = document.createElement('span');
        ripple.style.cssText = `
          position: absolute;
          border-radius: 50%;
          background: rgba(255, 255, 255, 0.7);
          transform: scale(0);
          animation: ripple 0.6s linear;
          width: ${size}px;
          height: ${size}px;
          top: ${y}px;
          left: ${x}px;
          pointer-events: none;
          z-index: 1;
        `;
        
        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
      });
    }
    
    // Apply ripple effect to all interactive elements
    document.querySelectorAll('.action-button, .card-link').forEach(addRippleEffect);
    
    // Add click animation to management cards
    const cards = document.querySelectorAll('.management-card:not(.tips-card)');
    cards.forEach(card => {
      card.addEventListener('click', function(e) {
        if(!e.target.closest('.card-link')) {
          const firstLink = this.querySelector('.card-link');
          if(firstLink) {
            firstLink.click();
          }
        }
      });
      
      // Touch feedback for mobile
      card.addEventListener('touchstart', function() {
        this.style.transform = 'translateY(-4px) scale(0.99)';
      }, { passive: true });
      
      card.addEventListener('touchend', function() {
        this.style.transform = '';
      }, { passive: true });
    });
    
    // Update time every minute
    function updateTime() {
      const timeElements = document.querySelectorAll('.footer-links span');
      if(timeElements.length > 0) {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', { 
          hour: 'numeric', 
          minute: '2-digit',
          hour12: true 
        });
        timeElements[0].textContent = `Last login: Today, ${timeString}`;
      }
    }
    
    setInterval(updateTime, 60000);
    
    // Handle window resize
    let resizeTimeout;
    window.addEventListener('resize', function() {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(() => {
        // Adjust layout if needed
        const container = document.querySelector('.dashboard-container');
        const isMobile = window.innerWidth <= 768;
        
        if(isMobile) {
          container.style.padding = '12px';
        } else {
          container.style.padding = '20px';
        }
      }, 250);
    });
    
    // Add keyboard navigation support
    document.addEventListener('keydown', function(e) {
      // Focus trap for modal (if any)
      if(e.key === 'Escape') {
        console.log('Escape pressed');
      }
      
      // Quick shortcuts (Ctrl + Key)
      if(e.ctrlKey) {
        switch(e.key) {
          case 'h':
            e.preventDefault();
            window.location.href = '../index.php';
            break;
          case 'l':
            e.preventDefault();
            window.location.href = 'logout.php';
            break;
          case '1':
            e.preventDefault();
            window.location.href = 'cinema/add.php';
            break;
          case '2':
            e.preventDefault();
            window.location.href = 'stories/add.php';
            break;
        }
      }
    });
    
    // Add loading state to links that might take time
    document.querySelectorAll('a[href*="manage.php"]').forEach(link => {
      link.addEventListener('click', function(e) {
        if(this.getAttribute('href').includes('manage.php')) {
          this.classList.add('loading');
          setTimeout(() => {
            this.classList.remove('loading');
          }, 1000);
        }
      });
    });
    
    // Performance optimization: Lazy load images (if any)
    if('loading' in HTMLImageElement.prototype) {
      const images = document.querySelectorAll('img[loading="lazy"]');
      images.forEach(img => {
        img.src = img.dataset.src;
      });
    }
  });
</script>

</body>
</html>