<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <title>Logging Out - திண்ணைப் பள்ளி</title>
  <style>
    /* ===== CSS VARIABLES & RESET ===== */
    :root {
      --primary: #4b2e1e;
      --secondary: #d4a762;
      --accent: #0066cc;
      --light: #f8f4ef;
      --dark: #2c1810;
      --success: #28a745;
      --danger: #dc3545;
      --card-bg: #ffffff;
      --shadow: rgba(75, 46, 30, 0.1);
      --shadow-lg: rgba(75, 46, 30, 0.15);
      --radius: 12px;
      --radius-sm: 8px;
      --radius-lg: 16px;
      --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
      min-height: 100vh;
      background: linear-gradient(135deg, #f6f1e7 0%, #f0e6d6 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      overflow-x: hidden;
      padding: 20px;
      color: #333;
      line-height: 1.5;
    }
    
    /* ===== ANIMATIONS ===== */
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
    
    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }
    
    @keyframes iconFloat {
      0%, 100% { 
        transform: translateY(0) rotate(0deg); 
      }
      50% { 
        transform: translateY(-15px) rotate(5deg); 
      }
    }
    
    @keyframes progressFill {
      0% { width: 0%; }
      100% { width: 100%; }
    }
    
    @keyframes pulse {
      0%, 100% { 
        opacity: 1; 
        transform: scale(1); 
      }
      50% { 
        opacity: 0.8; 
        transform: scale(1.05); 
      }
    }
    
    @keyframes shimmer {
      0% { background-position: -200px 0; }
      100% { background-position: 200px 0; }
    }
    
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    
    /* ===== BACKGROUND PATTERN ===== */
    .background-pattern {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: 
        radial-gradient(circle at 20% 80%, rgba(212, 167, 98, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(75, 46, 30, 0.05) 0%, transparent 50%);
      pointer-events: none;
      z-index: -1;
    }
    
    /* ===== MAIN CONTAINER ===== */
    .logout-wrapper {
      width: 100%;
      max-width: 520px;
      animation: fadeIn 0.6s ease-out;
    }
    
    /* ===== LOGOUT CARD ===== */
    .logout-card {
      background: var(--card-bg);
      border-radius: var(--radius-lg);
      padding: clamp(30px, 5vw, 50px);
      box-shadow: 0 25px 50px var(--shadow-lg);
      text-align: center;
      position: relative;
      overflow: hidden;
      animation: scaleIn 0.8s ease-out 0.2s both;
      border: 1px solid rgba(75, 46, 30, 0.05);
    }
    
    /* Top decorative border */
    .logout-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, 
        var(--danger) 0%, 
        var(--warning) 50%, 
        var(--secondary) 100%);
      background-size: 200% 100%;
      animation: shimmer 2s infinite linear;
    }
    
    /* Decorative background element */
    .logout-card::after {
      content: '🚪';
      position: absolute;
      bottom: 20px;
      right: 20px;
      font-size: clamp(40px, 6vw, 60px);
      opacity: 0.05;
      z-index: 0;
    }
    
    /* ===== ICON ===== */
    .logout-icon {
      width: clamp(80px, 15vw, 120px);
      height: clamp(80px, 15vw, 120px);
      background: linear-gradient(135deg, var(--danger) 0%, #c0392b 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto clamp(20px, 3vw, 30px);
      box-shadow: 0 15px 30px rgba(220, 53, 69, 0.2);
      animation: 
        scaleIn 0.6s ease-out 0.4s both,
        iconFloat 3s ease-in-out infinite 1s;
      position: relative;
      z-index: 1;
    }
    
    .logout-icon span {
      font-size: clamp(40px, 8vw, 60px);
      color: white;
    }
    
    /* ===== CONTENT ===== */
    .logout-content {
      position: relative;
      z-index: 1;
    }
    
    .logout-title {
      color: var(--primary);
      font-size: clamp(1.75rem, 5vw, 2.25rem);
      font-weight: 700;
      margin: 0 0 clamp(10px, 2vw, 15px) 0;
      line-height: 1.2;
      animation: fadeInUp 0.6s ease-out 0.6s both;
    }
    
    .logout-subtitle {
      color: var(--danger);
      font-size: clamp(1rem, 3vw, 1.125rem);
      font-weight: 600;
      margin: 0 0 clamp(5px, 1vw, 8px) 0;
      animation: fadeInUp 0.6s ease-out 0.7s both;
    }
    
    .logout-message {
      color: #666;
      font-size: clamp(0.875rem, 2.5vw, 1rem);
      line-height: 1.6;
      margin: 0 0 clamp(25px, 4vw, 35px) 0;
      opacity: 0.9;
      animation: fadeInUp 0.6s ease-out 0.8s both;
    }
    
    /* ===== PROGRESS SECTION ===== */
    .progress-section {
      margin: clamp(25px, 4vw, 35px) 0;
      animation: fadeInUp 0.6s ease-out 0.9s both;
    }
    
    .progress-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
    
    .progress-label {
      color: var(--dark);
      font-size: clamp(0.875rem, 2vw, 1rem);
      font-weight: 600;
    }
    
    .progress-percentage {
      color: var(--accent);
      font-size: clamp(0.875rem, 2vw, 1rem);
      font-weight: 700;
    }
    
    /* Progress Bar */
    .progress-bar {
      width: 100%;
      height: 8px;
      background: var(--light);
      border-radius: 4px;
      overflow: hidden;
      position: relative;
    }
    
    .progress-fill {
      height: 100%;
      background: linear-gradient(90deg, var(--danger), var(--warning));
      border-radius: 4px;
      width: 0%;
      transition: width 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    
    .progress-fill::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.3), 
        transparent);
      animation: shimmer 2s infinite linear;
    }
    
    /* ===== COUNTDOWN ===== */
    .countdown-container {
      margin: clamp(20px, 3vw, 25px) 0;
      animation: fadeInUp 0.6s ease-out 1s both;
    }
    
    .countdown-text {
      color: #666;
      font-size: clamp(0.875rem, 2vw, 1rem);
      margin-bottom: 5px;
    }
    
    .countdown-number {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, var(--primary), var(--dark));
      color: white;
      border-radius: 50%;
      font-weight: 700;
      font-size: 1.125rem;
      margin: 0 5px;
      animation: pulse 1s ease-in-out infinite;
    }
    
    /* ===== ACTION BUTTONS ===== */
    .action-buttons {
      display: flex;
      gap: 15px;
      margin: clamp(25px, 4vw, 35px) 0;
      animation: fadeInUp 0.6s ease-out 1.1s both;
    }
    
    .action-btn {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: clamp(14px, 3vw, 18px);
      border: none;
      border-radius: var(--radius);
      font-size: clamp(0.875rem, 2vw, 1rem);
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      text-decoration: none;
      position: relative;
      overflow: hidden;
    }
    
    .action-btn-primary {
      background: linear-gradient(135deg, var(--accent), #0056b3);
      color: white;
    }
    
    .action-btn-secondary {
      background: var(--light);
      color: var(--primary);
      border: 2px solid rgba(75, 46, 30, 0.1);
    }
    
    .action-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px var(--shadow);
    }
    
    .action-btn:active {
      transform: translateY(-1px);
    }
    
    .action-btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
    }
    
    /* ===== FOOTER ===== */
    .logout-footer {
      margin-top: clamp(25px, 4vw, 35px);
      padding-top: clamp(20px, 3vw, 25px);
      border-top: 1px solid rgba(75, 46, 30, 0.1);
      animation: fadeInUp 0.6s ease-out 1.2s both;
    }
    
    .footer-message {
      color: #888;
      font-size: clamp(0.75rem, 2vw, 0.875rem);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    
    /* ===== LOADING ANIMATION ===== */
    .loading-spinner {
      display: none;
      width: 20px;
      height: 20px;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-top-color: white;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }
    
    /* ===== RESPONSIVE DESIGN ===== */
    
    /* Tablets and small desktops */
    @media (max-width: 768px) {
      body {
        padding: 15px;
      }
      
      .logout-card {
        padding: 40px 30px;
      }
      
      .action-buttons {
        flex-direction: column;
      }
      
      .action-btn {
        width: 100%;
      }
    }
    
    /* Large smartphones */
    @media (max-width: 576px) {
      body {
        padding: 10px;
        align-items: flex-start;
        padding-top: 30px;
      }
      
      .logout-wrapper {
        max-width: 100%;
      }
      
      .logout-card {
        padding: 30px 20px;
        border-radius: 20px;
      }
      
      .logout-title {
        font-size: 1.5rem;
      }
      
      .logout-subtitle {
        font-size: 1rem;
      }
      
      .logout-message {
        font-size: 0.875rem;
      }
      
      .logout-icon {
        width: 80px;
        height: 80px;
      }
      
      .logout-icon span {
        font-size: 40px;
      }
    }
    
    /* Extra small devices */
    @media (max-width: 400px) {
      .logout-card {
        padding: 25px 16px;
      }
      
      .logout-title {
        font-size: 1.25rem;
      }
      
      .logout-icon {
        width: 70px;
        height: 70px;
      }
      
      .logout-icon span {
        font-size: 35px;
      }
      
      .countdown-number {
        width: 35px;
        height: 35px;
        font-size: 1rem;
      }
      
      .action-btn {
        padding: 14px;
      }
    }
    
    /* Landscape mode */
    @media (max-height: 600px) and (orientation: landscape) {
      body {
        align-items: flex-start;
        padding: 20px;
      }
      
      .logout-wrapper {
        max-width: 600px;
      }
      
      .logout-card {
        padding: 30px;
      }
      
      .logout-icon {
        width: 70px;
        height: 70px;
        margin-bottom: 20px;
      }
      
      .logout-icon span {
        font-size: 35px;
      }
      
      .logout-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
      }
      
      .logout-message {
        margin-bottom: 20px;
      }
    }
    
    /* High-resolution displays */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
      .logout-card::before {
        height: 3px;
      }
      
      .progress-bar {
        height: 6px;
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
      
      .logout-card::before,
      .progress-fill::after,
      .logout-icon,
      .countdown-number {
        animation: none !important;
      }
      
      .logout-icon {
        animation: fadeIn 0.3s ease-out !important;
      }
    }
    
    /* Print styles */
    @media print {
      .background-pattern,
      .logout-card::before,
      .logout-card::after,
      .progress-fill::after {
        display: none;
      }
      
      .logout-card {
        box-shadow: none;
        border: 1px solid #ddd;
      }
      
      .action-buttons {
        display: none;
      }
    }
  </style>
</head>
<body>
  
  <!-- Background Pattern -->
  <div class="background-pattern"></div>
  
  <div class="logout-wrapper">
    <div class="logout-card">
      
      <!-- Animated Icon -->
      <div class="logout-icon">
        <span>🚪</span>
      </div>
      
      <!-- Content -->
      <div class="logout-content">
        <h1 class="logout-title">Logging Out</h1>
        <h2 class="logout-subtitle">Secure Session Termination</h2>
        <p class="logout-message">
          You are being securely logged out of the admin panel.<br>
          Your session has been terminated and all credentials cleared.
        </p>
        
        <!-- Progress Section -->
        <div class="progress-section">
          <div class="progress-header">
            <span class="progress-label">Logout Progress</span>
            <span class="progress-percentage" id="progressPercentage">0%</span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" id="progressFill"></div>
          </div>
        </div>
        
        <!-- Countdown -->
        <div class="countdown-container">
          <div class="countdown-text">
            Redirecting to home page in
          </div>
          <div>
            <span class="countdown-number" id="countdownNumber">3</span> seconds
          </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="action-buttons">
          <a href="../index.php" class="action-btn action-btn-primary" id="homeBtn">
            <span>🏠</span>
            <span>Go Home Now</span>
          </a>
          <button class="action-btn action-btn-secondary" id="cancelBtn">
            <span>❌</span>
            <span>Cancel Redirect</span>
          </button>
        </div>
        
        <!-- Footer -->
        <div class="logout-footer">
          <div class="footer-message">
            <span>🔒</span>
            <span>Session Cleared • Secure Logout • திண்ணைப் பள்ளி</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // PHP Session Destruction
    <?php
    // Clear all session variables
    $_SESSION = array();
    
    // Destroy the session
    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
      );
    }
    
    session_destroy();
    ?>
    
    document.addEventListener('DOMContentLoaded', function() {
      // Console message
      console.log('%c🔐 Admin Logout Complete', 'color: #4b2e1e; font-size: 14px; font-weight: bold;');
      console.log('%cSession terminated. User logged out securely.', 'color: #666;');
      
      // DOM Elements
      const progressFill = document.getElementById('progressFill');
      const progressPercentage = document.getElementById('progressPercentage');
      const countdownNumber = document.getElementById('countdownNumber');
      const homeBtn = document.getElementById('homeBtn');
      const cancelBtn = document.getElementById('cancelBtn');
      
      // Variables
      let countdown = 3;
      let progress = 0;
      let redirectTimeout;
      let progressInterval;
      let countdownInterval;
      let isCancelled = false;
      
      // Initialize animations
      function startLogoutSequence() {
        // Start progress animation
        progressInterval = setInterval(() => {
          if (progress < 100) {
            progress += 1;
            progressFill.style.width = `${progress}%`;
            progressPercentage.textContent = `${progress}%`;
            
            // Change gradient as progress increases
            if (progress < 50) {
              progressFill.style.background = 'linear-gradient(90deg, var(--danger), var(--warning))';
            } else {
              progressFill.style.background = 'linear-gradient(90deg, var(--warning), var(--secondary))';
            }
          } else {
            clearInterval(progressInterval);
          }
        }, 20); // Complete in 2 seconds
      
        // Start countdown
        countdownInterval = setInterval(() => {
          if (countdown > 0) {
            countdown -= 1;
            countdownNumber.textContent = countdown;
            
            // Add animation to countdown number
            countdownNumber.style.animation = 'none';
            setTimeout(() => {
              countdownNumber.style.animation = 'pulse 0.5s ease-in-out';
            }, 10);
          } else {
            clearInterval(countdownInterval);
            if (!isCancelled) {
              redirectToHome();
            }
          }
        }, 1000);
      
        // Set redirect timeout
        redirectTimeout = setTimeout(() => {
          if (!isCancelled) {
            redirectToHome();
          }
        }, 3000);
      }
      
      // Redirect function
      function redirectToHome() {
        // Add transition effect
        document.body.style.opacity = '0.7';
        document.body.style.transition = 'opacity 0.3s ease';
        
        // Redirect after brief delay
        setTimeout(() => {
          window.location.href = "../index.php";
        }, 300);
      }
      
      // Home button click handler
      homeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        clearAllIntervals();
        isCancelled = true;
        redirectToHome();
      });
      
      // Cancel button click handler
      cancelBtn.addEventListener('click', function() {
        if (!isCancelled) {
          clearAllIntervals();
          isCancelled = true;
          
          // Update UI to show cancelled state
          this.innerHTML = '<span>✓</span><span>Cancelled</span>';
          this.style.background = 'linear-gradient(135deg, var(--success), #1e7e34)';
          this.style.color = 'white';
          this.disabled = true;
          
          // Update progress bar to cancelled state
          progressFill.style.background = 'linear-gradient(90deg, #6c757d, #adb5bd)';
          progressFill.style.animation = 'none';
          
          // Update messages
          document.querySelector('.logout-subtitle').textContent = 'Logout Cancelled';
          document.querySelector('.logout-message').textContent = 
            'Redirect has been cancelled. You can manually navigate using the buttons below.';
          document.querySelector('.countdown-text').textContent = 'Redirect cancelled';
          document.querySelector('.footer-message').innerHTML = 
            '<span>⏸️</span><span>Redirect Cancelled • Manual Navigation Required</span>';
          
          console.log('%c⚠️ Redirect cancelled by user', 'color: #ffc107;');
        }
      });
      
      // Clear all intervals and timeouts
      function clearAllIntervals() {
        clearInterval(progressInterval);
        clearInterval(countdownInterval);
        clearTimeout(redirectTimeout);
      }
      
      // Add ripple effect to buttons
      function addRippleEffect(element) {
        element.addEventListener('click', function(e) {
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
      
      // Add ripple to action buttons
      addRippleEffect(homeBtn);
      addRippleEffect(cancelBtn);
      
      // Keyboard shortcuts
      document.addEventListener('keydown', function(e) {
        // Escape to cancel redirect
        if (e.key === 'Escape' && !isCancelled) {
          cancelBtn.click();
        }
        
        // Enter or Space to go home immediately
        if ((e.key === 'Enter' || e.key === ' ') && e.target === document.body) {
          e.preventDefault();
          homeBtn.click();
        }
      });
      
      // Start the logout sequence
      startLogoutSequence();
      
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
      
      // Prevent form resubmission
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }
      
      // Performance optimization
      if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('*').forEach(el => {
          el.style.animation = 'none';
          el.style.transition = 'none';
        });
      }
      
      // Page visibility handling
      document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
          // Page is hidden, pause animations
          clearAllIntervals();
        } else if (!isCancelled) {
          // Page is visible again, restart if not cancelled
          startLogoutSequence();
        }
      });
    });
  </script>
</body>
</html>