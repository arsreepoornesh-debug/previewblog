<?php
session_start();
include '../includes/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username=?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();

    if (password_verify($password, $admin['password'])) {
      $_SESSION['admin'] = $admin['username'];
      
      // Update last login timestamp
      $updateStmt = $conn->prepare("UPDATE admin_users SET last_login = NOW() WHERE username = ?");
      $updateStmt->bind_param("s", $username);
      $updateStmt->execute();
      
      // 🔥 LOGIN SUCCESS → REDIRECT TO ADMIN DASHBOARD
      header("Location: index.php");
      exit;
    } else {
      $error = "Invalid password. Please try again.";
    }
  } else {
    $error = "Username not found.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <title>Admin Login - திண்ணைப் பள்ளி</title>
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
      --warning: #ffc107;
      --card-bg: #ffffff;
      --shadow: rgba(75, 46, 30, 0.1);
      --shadow-lg: rgba(75, 46, 30, 0.15);
      --input-border: #ddd;
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
      background: linear-gradient(135deg, #f6f1e7 0%, #f0e6d6 100%);
      min-height: 100vh;
      color: #333;
      line-height: 1.5;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      position: relative;
      overflow-x: hidden;
    }
    
    /* ===== BACKGROUND PATTERN ===== */
    .pattern-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: 
        radial-gradient(circle at 25% 25%, rgba(212, 167, 98, 0.05) 2px, transparent 2px),
        radial-gradient(circle at 75% 75%, rgba(75, 46, 30, 0.05) 2px, transparent 2px);
      background-size: 100px 100px;
      pointer-events: none;
      z-index: -1;
    }
    
    /* ===== ANIMATIONS ===== */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    
    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(-30px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }
    
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
      20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    
    @keyframes ripple {
      to {
        transform: scale(4);
        opacity: 0;
      }
    }
    
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
    
    /* ===== MAIN CONTAINER ===== */
    .login-wrapper {
      width: 100%;
      max-width: 480px;
      animation: fadeIn 0.6s ease-out;
    }
    
    /* ===== LOGIN CARD ===== */
    .login-card {
      background: var(--card-bg);
      border-radius: var(--radius-lg);
      padding: clamp(30px, 5vw, 50px);
      box-shadow: 0 25px 50px var(--shadow-lg);
      position: relative;
      overflow: hidden;
      animation: slideUp 0.8s ease-out 0.2s both;
      border: 1px solid rgba(75, 46, 30, 0.05);
    }
    
    /* Decorative top border */
    .login-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, 
        var(--primary) 0%, 
        var(--secondary) 50%, 
        var(--accent) 100%);
      animation: shimmer 3s infinite linear;
    }
    
    @keyframes shimmer {
      0% { background-position: -1000px 0; }
      100% { background-position: 1000px 0; }
    }
    
    /* Decorative corner accents */
    .login-card::after {
      content: '🔐';
      position: absolute;
      bottom: 20px;
      right: 20px;
      font-size: clamp(24px, 4vw, 32px);
      opacity: 0.05;
      animation: float 3s ease-in-out infinite;
    }
    
    /* ===== HEADER ===== */
    .login-header {
      text-align: center;
      margin-bottom: clamp(30px, 4vw, 40px);
      animation: slideIn 0.6s ease-out 0.4s both;
    }
    
    .login-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      box-shadow: 0 8px 20px rgba(75, 46, 30, 0.2);
      animation: pulse 2s ease-in-out infinite;
    }
    
    .login-icon span {
      font-size: 32px;
      color: white;
    }
    
    .login-header h1 {
      color: var(--primary);
      font-size: clamp(1.75rem, 4vw, 2.25rem);
      font-weight: 700;
      margin: 0 0 10px 0;
      line-height: 1.2;
    }
    
    .login-header p {
      color: #666;
      font-size: clamp(0.875rem, 2vw, 1rem);
      margin: 0;
      opacity: 0.8;
    }
    
    /* ===== ERROR MESSAGE ===== */
    .error-message {
      background: linear-gradient(135deg, 
        rgba(220, 53, 69, 0.1) 0%, 
        rgba(220, 53, 69, 0.05) 100%);
      border-left: 4px solid var(--danger);
      color: var(--danger);
      padding: clamp(15px, 3vw, 20px);
      border-radius: var(--radius-sm);
      margin: 0 0 25px 0;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 12px;
      animation: shake 0.5s ease-in-out, fadeIn 0.3s ease-out;
    }
    
    .error-icon {
      font-size: 20px;
      flex-shrink: 0;
    }
    
    .error-text {
      flex: 1;
      font-size: clamp(0.875rem, 2vw, 1rem);
    }
    
    /* ===== FORM STYLES ===== */
    .login-form {
      animation: fadeIn 0.8s ease-out 0.6s both;
    }
    
    /* Input Groups */
    .input-group {
      margin-bottom: clamp(20px, 3vw, 25px);
      position: relative;
    }
    
    .input-label {
      display: block;
      margin-bottom: 8px;
      color: var(--dark);
      font-weight: 600;
      font-size: clamp(0.875rem, 2vw, 1rem);
      padding-left: 5px;
    }
    
    .input-wrapper {
      position: relative;
    }
    
    .input-icon {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      font-size: 20px;
      transition: var(--transition);
      pointer-events: none;
      z-index: 1;
    }
    
    /* Input Fields */
    .form-input {
      width: 100%;
      padding: clamp(14px, 3vw, 18px) 16px clamp(14px, 3vw, 18px) 52px;
      border: 2px solid var(--input-border);
      border-radius: var(--radius);
      font-size: clamp(15px, 2vw, 16px);
      transition: var(--transition);
      background: var(--light);
      color: var(--dark);
      outline: none;
      appearance: none;
      -webkit-appearance: none;
    }
    
    .form-input:focus {
      border-color: var(--secondary);
      box-shadow: 0 0 0 4px rgba(212, 167, 98, 0.15);
      background: white;
      transform: translateY(-2px);
    }
    
    .form-input:focus + .input-icon {
      color: var(--secondary);
      transform: translateY(-50%) scale(1.1);
    }
    
    .form-input::placeholder {
      color: #999;
      opacity: 0.7;
    }
    
    /* Password Toggle */
    .password-toggle {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #999;
      cursor: pointer;
      font-size: 20px;
      transition: var(--transition);
      padding: 5px;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
    }
    
    .password-toggle:hover {
      color: var(--secondary);
      background: rgba(212, 167, 98, 0.1);
    }
    
    .password-toggle:active {
      transform: translateY(-50%) scale(0.95);
    }
    
    /* Submit Button */
    .submit-group {
      margin-top: 30px;
    }
    
    .submit-btn {
      width: 100%;
      padding: clamp(16px, 3vw, 20px);
      background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
      color: white;
      border: none;
      border-radius: var(--radius);
      font-size: clamp(16px, 2vw, 18px);
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
    }
    
    .submit-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 25px var(--shadow-lg);
    }
    
    .submit-btn:active {
      transform: translateY(-1px);
    }
    
    .submit-btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
      transform: none;
      box-shadow: none;
    }
    
    /* Loading Animation */
    .loading-spinner {
      display: none;
      width: 20px;
      height: 20px;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-top-color: white;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }
    
    /* ===== FOOTER LINKS ===== */
    .login-footer {
      margin-top: clamp(30px, 4vw, 40px);
      padding-top: clamp(20px, 3vw, 25px);
      border-top: 1px solid rgba(75, 46, 30, 0.1);
      text-align: center;
      animation: fadeIn 0.8s ease-out 0.8s both;
    }
    
    .home-link {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--accent);
      text-decoration: none;
      font-weight: 600;
      padding: 12px 24px;
      border-radius: var(--radius-sm);
      transition: var(--transition);
      background: rgba(0, 102, 204, 0.05);
      font-size: clamp(0.875rem, 2vw, 1rem);
    }
    
    .home-link:hover {
      background: rgba(0, 102, 204, 0.1);
      transform: translateX(-5px);
      box-shadow: 0 4px 12px rgba(0, 102, 204, 0.1);
    }
    
    .footer-text {
      margin-top: 20px;
      color: #888;
      font-size: clamp(0.75rem, 2vw, 0.875rem);
      opacity: 0.8;
    }
    
    /* ===== RESPONSIVE DESIGN ===== */
    
    /* Tablets and small desktops */
    @media (max-width: 768px) {
      body {
        padding: 15px;
      }
      
      .login-card {
        padding: 30px;
      }
      
      .login-icon {
        width: 70px;
        height: 70px;
      }
      
      .login-icon span {
        font-size: 28px;
      }
    }
    
    /* Large smartphones */
    @media (max-width: 576px) {
      body {
        padding: 10px;
        align-items: flex-start;
        padding-top: 30px;
      }
      
      .login-wrapper {
        max-width: 100%;
      }
      
      .login-card {
        padding: 25px 20px;
        border-radius: 20px;
      }
      
      .login-header h1 {
        font-size: 1.5rem;
      }
      
      .form-input {
        padding: 14px 14px 14px 48px;
      }
      
      .input-icon {
        left: 14px;
        font-size: 18px;
      }
      
      .password-toggle {
        right: 14px;
        width: 36px;
        height: 36px;
      }
      
      .submit-btn {
        padding: 16px;
      }
    }
    
    /* Extra small devices */
    @media (max-width: 400px) {
      .login-card {
        padding: 20px 16px;
      }
      
      .login-header {
        margin-bottom: 25px;
      }
      
      .login-icon {
        width: 60px;
        height: 60px;
        margin-bottom: 15px;
      }
      
      .login-icon span {
        font-size: 24px;
      }
      
      .input-group {
        margin-bottom: 18px;
      }
      
      .home-link {
        padding: 10px 20px;
        width: 100%;
        justify-content: center;
      }
    }
    
    /* Landscape mode */
    @media (max-height: 600px) and (orientation: landscape) {
      body {
        align-items: flex-start;
        padding: 20px;
      }
      
      .login-wrapper {
        max-width: 500px;
      }
      
      .login-card {
        padding: 25px;
      }
      
      .login-header {
        margin-bottom: 20px;
      }
      
      .login-icon {
        width: 60px;
        height: 60px;
        margin-bottom: 15px;
      }
      
      .input-group {
        margin-bottom: 15px;
      }
    }
    
    /* High-resolution displays */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
      .form-input {
        border-width: 1.5px;
      }
      
      .login-card::before {
        height: 3px;
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
      
      .login-card::before,
      .login-icon,
      .login-card::after {
        animation: none !important;
      }
    }
    
    /* Print styles */
    @media print {
      .pattern-overlay,
      .login-card::before,
      .login-card::after {
        display: none;
      }
      
      .login-card {
        box-shadow: none;
        border: 1px solid #ddd;
      }
      
      .submit-btn,
      .password-toggle {
        display: none;
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
  </style>
</head>
<body>
  
  <!-- Background Pattern -->
  <div class="pattern-overlay"></div>
  
  <div class="login-wrapper">
    <div class="login-card">
      
      <!-- Login Header -->
      <header class="login-header">
        <div class="login-icon">
          <span>🔐</span>
        </div>
        <h1>Admin Login</h1>
        <p>திண்ணைப் பள்ளி - Content Management System</p>
      </header>
      
      <!-- Error Message -->
      <?php if ($error): ?>
      <div class="error-message" role="alert">
        <span class="error-icon">⚠️</span>
        <span class="error-text"><?php echo htmlspecialchars($error); ?></span>
      </div>
      <?php endif; ?>
      
      <!-- Login Form -->
      <form method="post" class="login-form" id="loginForm">
        
        <!-- Username Field -->
        <div class="input-group">
          <label for="username" class="input-label">Username</label>
          <div class="input-wrapper">
            <span class="input-icon">👤</span>
            <input 
              type="text" 
              id="username" 
              name="username" 
              class="form-input" 
              placeholder="Enter your username" 
              required
              autocomplete="username"
              autocapitalize="none"
              spellcheck="false"
              <?php if (isset($_POST['username'])) echo 'value="' . htmlspecialchars($_POST['username']) . '"'; ?>
            >
          </div>
        </div>
        
        <!-- Password Field -->
        <div class="input-group">
          <label for="password" class="input-label">Password</label>
          <div class="input-wrapper">
            <span class="input-icon">🔒</span>
            <input 
              type="password" 
              id="password" 
              name="password" 
              class="form-input" 
              placeholder="Enter your password" 
              required
              autocomplete="current-password"
              minlength="6"
            >
            <button 
              type="button" 
              class="password-toggle" 
              id="togglePassword"
              aria-label="Show password"
              title="Toggle password visibility"
            >
              👁️
            </button>
          </div>
        </div>
        
        <!-- Submit Button -->
        <div class="submit-group">
          <button type="submit" class="submit-btn" id="submitBtn">
            <span>Sign In</span>
            <div class="loading-spinner" id="loadingSpinner"></div>
          </button>
        </div>
        
      </form>
      
      <!-- Footer Links -->
      <footer class="login-footer">
        <a href="../index.php" class="home-link">
          <span>←</span>
          <span>Back to Home Page</span>
        </a>
        <p class="footer-text">
          Secure Admin Access • Authorized Personnel Only • © <?php echo date('Y'); ?>
        </p>
      </footer>
      
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize console message
      console.log('%c🔐 திண்ணைப் பள்ளி Admin Login', 'color: #4b2e1e; font-size: 14px; font-weight: bold;');
      console.log('%cSecure authentication required. Please enter valid credentials.', 'color: #666;');
      
      // DOM Elements
      const loginForm = document.getElementById('loginForm');
      const submitBtn = document.getElementById('submitBtn');
      const loadingSpinner = document.getElementById('loadingSpinner');
      const togglePasswordBtn = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('password');
      const usernameInput = document.getElementById('username');
      
      // Toggle password visibility
      togglePasswordBtn.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type');
        const isPassword = type === 'password';
        
        passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
        this.innerHTML = isPassword ? '🙈' : '👁️';
        this.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
        this.setAttribute('title', isPassword ? 'Hide password' : 'Show password');
        
        // Animate toggle
        this.style.transform = 'translateY(-50%) scale(1.2)';
        setTimeout(() => {
          this.style.transform = 'translateY(-50%) scale(1)';
        }, 200);
        
        // Focus back to password field
        passwordInput.focus();
      });
      
      // Form validation
      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate inputs
        let isValid = true;
        const inputs = this.querySelectorAll('input[required]');
        
        inputs.forEach(input => {
          if (!input.value.trim()) {
            isValid = false;
            showInputError(input, 'This field is required');
          } else {
            clearInputError(input);
          }
        });
        
        if (!isValid) return;
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.querySelector('span').style.opacity = '0.5';
        loadingSpinner.style.display = 'block';
        submitBtn.style.cursor = 'wait';
        
        // Simulate network delay for UX
        setTimeout(() => {
          // Submit form if validation passes
          this.submit();
        }, 800);
      });
      
      // Input validation functions
      function showInputError(input, message) {
        const wrapper = input.closest('.input-wrapper') || input;
        wrapper.style.borderColor = 'var(--danger)';
        wrapper.style.boxShadow = '0 0 0 3px rgba(220, 53, 69, 0.1)';
        
        // Create error message if it doesn't exist
        let errorElement = wrapper.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains('input-error')) {
          errorElement = document.createElement('div');
          errorElement.className = 'input-error';
          errorElement.style.cssText = `
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 5px;
            padding-left: 5px;
          `;
          wrapper.parentNode.appendChild(errorElement);
        }
        errorElement.textContent = message;
        
        // Add shake animation
        wrapper.style.animation = 'shake 0.5s ease-in-out';
        setTimeout(() => {
          wrapper.style.animation = '';
        }, 500);
      }
      
      function clearInputError(input) {
        const wrapper = input.closest('.input-wrapper') || input;
        wrapper.style.borderColor = '';
        wrapper.style.boxShadow = '';
        
        const errorElement = wrapper.nextElementSibling;
        if (errorElement && errorElement.classList.contains('input-error')) {
          errorElement.remove();
        }
      }
      
      // Real-time validation
      usernameInput.addEventListener('input', function() {
        if (this.value.length < 3 && this.value.length > 0) {
          showInputError(this, 'Username must be at least 3 characters');
        } else {
          clearInputError(this);
        }
      });
      
      passwordInput.addEventListener('input', function() {
        if (this.value.length < 6 && this.value.length > 0) {
          showInputError(this, 'Password must be at least 6 characters');
        } else {
          clearInputError(this);
        }
      });
      
      // Add focus effects
      const formInputs = document.querySelectorAll('.form-input');
      formInputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
          this.parentElement.style.transform = '';
        });
      });
      
      // Ripple effect for submit button
      submitBtn.addEventListener('click', function(e) {
        if (this.disabled) return;
        
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
        `;
        
        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
      });
      
      // Keyboard shortcuts
      document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + Enter to submit
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
          if (document.activeElement === usernameInput || 
              document.activeElement === passwordInput) {
            submitBtn.click();
          }
        }
        
        // Escape to clear form
        if (e.key === 'Escape') {
          loginForm.reset();
          formInputs.forEach(clearInputError);
        }
      });
      
      // Auto-focus username on page load
      if (usernameInput && !usernameInput.value) {
        usernameInput.focus();
      }
      
      // Prevent form resubmission on page refresh
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }
      
      // Performance optimization: Remove animations for users who prefer reduced motion
      if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('*').forEach(el => {
          el.style.animation = 'none';
          el.style.transition = 'none';
        });
      }
    });
  </script>
</body>
</html>