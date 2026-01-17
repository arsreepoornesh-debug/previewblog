<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<style>
/* Enhanced Navbar Styles - Full width with vintage cream background */
.navbar {
  background: linear-gradient(
    135deg,
    rgba(245, 235, 220, 0.98) 0%,     /* Vintage Cream */
    rgba(240, 230, 210, 0.97) 50%,    /* Light Vintage Cream */
    rgba(245, 235, 220, 0.98) 100%    /* Vintage Cream */
  );
  backdrop-filter: blur(10px);
  border: 3px solid #C2A86D; /* Soft Gold */
  border-width: 3px 0;
  box-shadow: 
    0 4px 20px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(194, 168, 109, 0.2) inset,
    0 2px 15px rgba(194, 168, 109, 0.1);
  padding: 0 40px;
  height: 70px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 0;
  width: 100%;
  border-radius: 0;
  font-family: 'Georgia', 'serif', 'Latha', 'Tamil Sangam MN';
  position: relative;
  z-index: 100;
}

/* Floating Ornament Effect */
.navbar::before {
  content: '';
  position: absolute;
  top: -2px;
  left: 50%;
  transform: translateX(-50%);
  width: 90%;
  height: 4px;
  background: linear-gradient(
    90deg,
    transparent,
    #C2A86D, /* Soft Gold */
    #E6D6B8, /* Parchment */
    #C2A86D,
    transparent
  );
  border-radius: 2px;
  opacity: 0.7;
  animation: gentlePulse 4s ease-in-out infinite;
}

.navbar::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 50%;
  transform: translateX(-50%);
  width: 90%;
  height: 4px;
  background: linear-gradient(
    90deg,
    transparent,
    #C2A86D,
    #E6D6B8,
    #C2A86D,
    transparent
  );
  border-radius: 2px;
  opacity: 0.7;
  animation: gentlePulse 4s ease-in-out infinite reverse;
}

@keyframes gentlePulse {
  0%, 100% { opacity: 0.5; }
  50% { opacity: 0.8; }
}

.navbar ul {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  gap: 25px;
  align-items: center;
  height: 100%;
}

/* Left Navigation */
.nav-left {
  flex: 1;
  justify-content: flex-start;
}

.nav-left li {
  position: relative;
}

.nav-left a {
  color: #4A4A42; /* Dark Brown-Gray for better contrast on cream */
  text-decoration: none;
  font-size: 1.1rem;
  font-weight: 500;
  padding: 10px 18px;
  border-radius: 8px;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 8px;
  position: relative;
  overflow: hidden;
  z-index: 1;
  letter-spacing: 0.5px;
}

.nav-left a::before {
  content: '❖';
  font-size: 0.8rem;
  opacity: 0.7;
  transition: all 0.3s ease;
}

.nav-left a::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, #C2A86D, #E6D6B8, #C2A86D);
  transition: width 0.3s ease;
  border-radius: 1px;
}

.nav-left a:hover {
  color: #8B4513; /* Saddle Brown for better visibility on cream */
  background: rgba(139, 69, 19, 0.08);
  text-shadow: 0 0 10px rgba(139, 69, 19, 0.2);
}

.nav-left a:hover::before {
  transform: rotate(45deg);
  opacity: 1;
  color: #8B4513;
}

.nav-left a:hover::after {
  width: 70%;
}

.nav-left a.active {
  color: #8B4513; /* Saddle Brown */
  background: rgba(139, 69, 19, 0.1);
}

.nav-left a.active::before {
  content: '✦';
  transform: rotate(0);
  opacity: 1;
  color: #8B4513;
}

.nav-left a.active::after {
  width: 70%;
  background: #8B4513;
}

/* Right Navigation (Admin Section) */
.nav-right {
  justify-content: flex-end;
  min-width: 250px;
}

.nav-right li {
  position: relative;
}

.nav-right a {
  color: #4A4A42; /* Dark Brown-Gray for better contrast */
  text-decoration: none;
  font-size: 0.95rem;
  font-weight: 500;
  padding: 8px 18px;
  border-radius: 20px;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 8px;
  background: rgba(139, 69, 19, 0.15); /* Saddle Brown tint */
  border: 1px solid rgba(139, 69, 19, 0.3);
  position: relative;
  overflow: hidden;
  letter-spacing: 0.3px;
}

.nav-right a::before {
  position: absolute;
  content: '';
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(139, 69, 19, 0.2),
    transparent
  );
  transition: left 0.6s ease;
}

.nav-right a:hover {
  color: #8B4513; /* Saddle Brown */
  background: rgba(139, 69, 19, 0.25);
  border-color: #8B4513;
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(139, 69, 19, 0.2);
}

.nav-right a:hover::before {
  left: 100%;
}

/* Admin/Dashboard specific styling */
.nav-right a[href*="dashboard"] {
  background: linear-gradient(
    135deg,
    rgba(138, 148, 110, 0.25), /* Moss Green */
    rgba(110, 123, 91, 0.35)   /* Olive Green */
  );
  border: 1px solid rgba(138, 148, 110, 0.4);
  padding-right: 25px;
}

.nav-right a[href*="dashboard"]::after {
  content: '⚙️';
  font-size: 0.8rem;
  margin-left: 5px;
  position: absolute;
  right: 8px;
}

.nav-right a[href*="logout"] {
  background: linear-gradient(
    135deg,
    rgba(179, 58, 58, 0.25), /* Tamil Red */
    rgba(110, 123, 91, 0.35) /* Olive Green */
  );
  border: 1px solid rgba(179, 58, 58, 0.3);
  padding-right: 25px;
}

.nav-right a[href*="logout"]::after {
  content: '🚪';
  font-size: 0.8rem;
  margin-left: 5px;
  position: absolute;
  right: 8px;
}

.nav-right a[href*="login"] {
  background: linear-gradient(
    135deg,
    rgba(230, 214, 184, 0.25), /* Parchment */
    rgba(110, 123, 91, 0.35)   /* Olive Green */
  );
  border: 1px solid rgba(230, 214, 184, 0.3);
  padding-right: 25px;
}

.nav-right a[href*="login"]::after {
  content: '🔑';
  font-size: 0.8rem;
  margin-left: 5px;
  position: absolute;
  right: 8px;
}

/* Mobile Responsive */
@media (max-width: 1200px) {
  .navbar {
    padding: 0 30px;
  }
}

@media (max-width: 1024px) {
  .navbar {
    padding: 0 25px;
    height: 65px;
  }
  
  .navbar ul {
    gap: 20px;
  }
  
  .nav-left a {
    font-size: 1rem;
    padding: 8px 15px;
  }
  
  .nav-right a {
    font-size: 0.9rem;
    padding: 7px 16px;
  }
}

@media (max-width: 768px) {
  .navbar {
    flex-direction: column;
    height: auto;
    padding: 20px;
    gap: 15px;
    border-radius: 0;
  }
  
  .navbar::before,
  .navbar::after {
    width: 95%;
  }
  
  .nav-left, .nav-right {
    width: 100%;
    justify-content: center;
    flex-wrap: wrap;
  }
  
  .nav-left {
    gap: 15px;
  }
  
  .nav-right {
    gap: 15px;
    min-width: auto;
  }
  
  .nav-left a::before {
    display: none; /* Hide ornament on mobile for space */
  }
}

@media (max-width: 480px) {
  .navbar {
    padding: 15px;
  }
  
  .nav-left, .nav-right {
    flex-direction: column;
    gap: 12px;
  }
  
  .nav-left a,
  .nav-right a {
    width: 100%;
    justify-content: center;
    text-align: center;
  }
  
  .nav-right a {
    padding: 10px 20px;
  }
}

/* Corner Decorative Elements */
.navbar-corner {
  position: absolute;
  width: 15px;
  height: 15px;
  border-color: #C2A86D;
  border-style: solid;
  opacity: 0.6;
}

.navbar-corner.tl {
  top: 8px;
  left: 8px;
  border-width: 2px 0 0 2px;
}

.navbar-corner.tr {
  top: 8px;
  right: 8px;
  border-width: 2px 2px 0 0;
}

.navbar-corner.bl {
  bottom: 8px;
  left: 8px;
  border-width: 0 0 2px 2px;
}

.navbar-corner.br {
  bottom: 8px;
  right: 8px;
  border-width: 0 2px 2px 0;
}
</style>

<nav class="navbar">
  <!-- Decorative corners -->
  <div class="navbar-corner tl"></div>
  <div class="navbar-corner tr"></div>
  <div class="navbar-corner bl"></div>
  <div class="navbar-corner br"></div>

  <ul class="nav-left">
    <li><a href="/thinnai-palli/index.php">முகப்பு</a></li>
    <li><a href="/thinnai-palli/pages/stories.php">கதைகள்</a></li>
    <li><a href="/thinnai-palli/pages/old-cinema.php">பழைய சினிமா</a></li>
    <li><a href="/thinnai-palli/pages/tamil-words.php">தமிழ் சொற்கள்</a></li>
    <li><a href="/thinnai-palli/pages/connect.php">தொடர்பு</a></li>
  </ul>

  <ul class="nav-right">
    <?php if (isset($_SESSION['admin'])): ?>
      <li><a href="/thinnai-palli/admin/dashboard.php">Dashboard</a></li>
      <li><a href="/thinnai-palli/admin/logout.php">Logout</a></li>
    <?php else: ?>
      <li><a href="/thinnai-palli/admin/login.php">Admin</a></li>
    <?php endif; ?>
  </ul>
</nav>

<script>
// Add active class based on current page
document.addEventListener('DOMContentLoaded', function() {
  const currentPath = window.location.pathname;
  const navLinks = document.querySelectorAll('.nav-left a');
  
  navLinks.forEach(link => {
    const linkPath = new URL(link.href).pathname;
    
    // Check if current path matches link path
    if (currentPath === linkPath) {
      link.classList.add('active');
    }
    
    // Special handling for index.php
    if (currentPath === '/' && linkPath.includes('index.php')) {
      link.classList.add('active');
    }
  });
  
  // Add hover effect to navbar
  const navbar = document.querySelector('.navbar');
  
  navbar.addEventListener('mouseenter', function() {
    this.style.boxShadow = 
      '0 6px 30px rgba(0, 0, 0, 0.15), ' +
      '0 0 0 1px rgba(194, 168, 109, 0.3) inset, ' +
      '0 3px 20px rgba(194, 168, 109, 0.1)';
    this.style.transform = 'translateY(-2px)';
  });
  
  navbar.addEventListener('mouseleave', function() {
    this.style.boxShadow = 
      '0 4px 20px rgba(0, 0, 0, 0.15), ' +
      '0 0 0 1px rgba(194, 168, 109, 0.2) inset, ' +
      '0 2px 15px rgba(194, 168, 109, 0.1)';
    this.style.transform = 'translateY(0)';
  });
  
  // Add ripple effect to nav items
  const navItems = document.querySelectorAll('.navbar a');
  navItems.forEach(item => {
    item.addEventListener('click', function(e) {
      // Create ripple element
      const ripple = document.createElement('span');
      const rect = this.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height);
      const x = e.clientX - rect.left - size / 2;
      const y = e.clientY - rect.top - size / 2;
      
      ripple.style.cssText = `
        position: absolute;
        background: rgba(139, 69, 19, 0.2); /* Saddle Brown ripple */
        border-radius: 50%;
        transform: scale(0);
        animation: ripple 0.6s linear;
        width: ${size}px;
        height: ${size}px;
        top: ${y}px;
        left: ${x}px;
        pointer-events: none;
        z-index: 0;
      `;
      
      this.style.position = 'relative';
      this.style.overflow = 'hidden';
      this.appendChild(ripple);
      
      setTimeout(() => {
        if (ripple.parentNode === this) {
          this.removeChild(ripple);
        }
      }, 600);
    });
  });
  
  // Add ripple animation style if not already present
  if (!document.querySelector('#ripple-style')) {
    const rippleStyle = document.createElement('style');
    rippleStyle.id = 'ripple-style';
    rippleStyle.textContent = `
      @keyframes ripple {
        to {
          transform: scale(4);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(rippleStyle);
  }
});
</script>