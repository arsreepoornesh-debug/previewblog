<?php
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/db.php';

$result = $conn->query("SELECT title, slug, summary FROM tamil_word_pages ORDER BY created_at DESC");
?>

<style>
/* Enhanced Tamil Words Page Styles with Your Color Palette */
:root {
  --parchment: #E6D6B8;
  --muted-beige: #D8C8A6;
  --light-cream: #EFE6CF;
  --olive-green: #6E7B5B;
  --forest-green: #3F4A3C;
  --moss-green: #8A946E;
  --charcoal: #2F2F2A;
  --faded-black: #1E1E1C;
  --dusty-brown: #7A6A55;
  --off-white: #F5F5F0;
  --soft-gold: #C2A86D;
  --muted-white: #ECECEC;
  --black: #000000;
}

/* Background Animations */
@keyframes gradientFlow {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes grainEffect {
  0%, 100% { transform: translate(0, 0); }
  10% { transform: translate(-1%, -1%); }
  20% { transform: translate(2%, 0%); }
  30% { transform: translate(-1%, 2%); }
  40% { transform: translate(1%, -1%); }
  50% { transform: translate(-2%, 1%); }
  60% { transform: translate(1%, 2%); }
  70% { transform: translate(2%, -1%); }
  80% { transform: translate(-1%, 1%); }
  90% { transform: translate(1%, -2%); }
}

@keyframes floatSubtle {
  0% { transform: translateY(0) rotate(0deg); opacity: 0.7; }
  50% { transform: translateY(-10px) rotate(5deg); opacity: 0.9; }
  100% { transform: translateY(0) rotate(0deg); opacity: 0.7; }
}

@keyframes shimmer {
  0% { background-position: -1000px 0; }
  100% { background-position: 1000px 0; }
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

@keyframes pulseGreen {
  0%, 100% { 
    box-shadow: 0 0 0 0 rgba(110, 123, 91, 0.4),
                0 0 0 0 rgba(138, 148, 110, 0.3); 
  }
  70% { 
    box-shadow: 0 0 0 10px rgba(110, 123, 91, 0),
                0 0 0 20px rgba(138, 148, 110, 0); 
  }
  100% { 
    box-shadow: 0 0 0 0 rgba(110, 123, 91, 0),
                0 0 0 0 rgba(138, 148, 110, 0); 
  }
}

@keyframes floatingLeaves {
  0% { transform: translateY(0px) rotate(0deg); }
  25% { transform: translateY(-20px) rotate(5deg); }
  50% { transform: translateY(-40px) rotate(0deg); }
  75% { transform: translateY(-20px) rotate(-5deg); }
  100% { transform: translateY(0px) rotate(0deg); }
}

@keyframes backgroundPulse {
  0%, 100% { background-position: 0% 0%; }
  50% { background-position: 100% 100%; }
}

@keyframes ripple {
  0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
  100% { transform: translate(-50%, -50%) scale(10); opacity: 0; }
}

/* Body with multiple animated backgrounds */
body {
  background: 
    linear-gradient(-45deg, var(--charcoal), var(--faded-black), var(--forest-green), var(--dusty-brown)),
    url("data:image/svg+xml,%3Csvg width='200' height='200' viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%236E7B5B' fill-opacity='0.05'%3E%3Ccircle cx='100' cy='100' r='50'/%3E%3Cpath d='M100 50 Q150 100 100 150 Q50 100 100 50'/%3E%3Cpath d='M50 100 Q100 50 150 100 Q100 150 50 100'/%3E%3C/g%3E%3C/svg%3E"),
    url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%238A946E' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
  background-size: 400% 400%, 300px 300px, 200px 200px;
  background-blend-mode: overlay, normal, normal;
  animation: 
    gradientFlow 25s ease infinite,
    backgroundPulse 30s ease infinite;
  color: var(--off-white);
  font-family: 'Georgia', 'serif', 'Latha', 'Tamil Sangam MN';
  line-height: 1.6;
  position: relative;
  min-height: 100vh;
  overflow-x: hidden;
}

/* Animated Grain Overlay */
body::before {
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%' height='100%' filter='url(%23noiseFilter)' opacity='0.08'/%3E%3C/svg%3E");
  opacity: 0.15;
  animation: grainEffect 8s steps(10) infinite;
  pointer-events: none;
  z-index: 0;
}

/* Floating Leaves/Green Elements Animation */
.floating-leaf {
  position: fixed;
  width: 40px;
  height: 40px;
  background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%236E7B5B' d='M12 2C8.1 2 5 5.1 5 9c0 5.2 7 13 7 13s7-7.8 7-13c0-3.9-3.1-7-7-7z'/%3E%3C/svg%3E");
  opacity: 0.1;
  pointer-events: none;
  z-index: 1;
  animation: floatingLeaves 20s infinite linear;
}

.leaf-1 { top: 10%; left: 5%; animation-delay: 0s; animation-duration: 25s; }
.leaf-2 { top: 20%; right: 10%; animation-delay: 5s; animation-duration: 30s; }
.leaf-3 { bottom: 30%; left: 15%; animation-delay: 10s; animation-duration: 35s; }
.leaf-4 { bottom: 40%; right: 20%; animation-delay: 15s; animation-duration: 28s; }
.leaf-5 { top: 60%; left: 25%; animation-delay: 7s; animation-duration: 32s; }

/* Container Styling */
.container {
  max-width: 1200px;
  margin: 40px auto;
  padding: 30px;
  position: relative;
  z-index: 2;
  animation: fadeInUp 1s ease-out;
  background: rgba(230, 214, 184, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 15px;
  box-shadow: 
    0 20px 40px rgba(0, 0, 0, 0.3),
    0 0 100px rgba(110, 123, 91, 0.2) inset;
}

/* Page Title Styling */
.page-title {
  color: var(--forest-green);
  text-align: center;
  font-size: 3rem;
  margin-bottom: 40px;
  font-family: 'Kavivanar', 'Latha', 'Georgia', serif;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
  position: relative;
  padding-bottom: 20px;
  animation: pulseGreen 3s infinite;
}

.page-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 200px;
  height: 4px;
  background: linear-gradient(90deg, transparent, var(--olive-green), transparent);
  border-radius: 2px;
}

/* Story List Container */
.story-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 25px;
  margin-top: 30px;
}

/* Story Item - Enhanced as Content Box/Label */
.story-item {
  background: linear-gradient(145deg, var(--parchment), var(--light-cream));
  border: 2px solid transparent;
  border-radius: 15px;
  padding: 25px;
  position: relative;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  box-shadow: 
    0 8px 25px rgba(0, 0, 0, 0.15),
    0 2px 10px rgba(0, 0, 0, 0.1);
  animation: fadeInUp 0.6s ease-out forwards;
  opacity: 0;
  z-index: 1;
}

.story-item:nth-child(1) { animation-delay: 0.1s; }
.story-item:nth-child(2) { animation-delay: 0.2s; }
.story-item:nth-child(3) { animation-delay: 0.3s; }
.story-item:nth-child(4) { animation-delay: 0.4s; }
.story-item:nth-child(5) { animation-delay: 0.5s; }
.story-item:nth-child(6) { animation-delay: 0.6s; }
.story-item:nth-child(7) { animation-delay: 0.7s; }
.story-item:nth-child(8) { animation-delay: 0.8s; }
.story-item:nth-child(9) { animation-delay: 0.9s; }
.story-item:nth-child(10) { animation-delay: 1s; }

.story-item::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, transparent 0%, rgba(110, 123, 91, 0.1) 100%);
  pointer-events: none;
  z-index: 1;
}

.story-item::after {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(138, 148, 110, 0.2),
    transparent
  );
  transition: left 0.7s ease;
  z-index: 1;
}

.story-item:hover::after {
  left: 100%;
}

.story-item:hover {
  transform: translateY(-10px) scale(1.02);
  border: 2px solid var(--olive-green);
  box-shadow: 
    0 15px 35px rgba(0, 0, 0, 0.25),
    0 10px 25px rgba(110, 123, 91, 0.2),
    inset 0 0 50px rgba(138, 148, 110, 0.1);
  animation: pulseGreen 2s infinite;
}

/* Title/Link Styling - BLACK COLOR with Green Effects */
.story-item h2 {
  margin: 0 0 15px 0;
  font-size: 1.5rem;
  line-height: 1.4;
}

.story-item h2 a {
  color: var(--black) !important; /* Black color */
  text-decoration: none;
  display: block;
  transition: all 0.3s ease;
  position: relative;
  padding-left: 35px;
  font-family: 'Kavivanar', 'Georgia', serif;
  font-weight: bold;
  background: linear-gradient(90deg, var(--olive-green), var(--moss-green));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.story-item h2 a::before {
  content: '🌿';
  position: absolute;
  left: 0;
  top: 0;
  font-size: 1.4rem;
  animation: floatSubtle 3s infinite ease-in-out;
}

.story-item h2 a:hover {
  background: linear-gradient(90deg, var(--forest-green), var(--olive-green));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  text-shadow: 0 2px 10px rgba(110, 123, 91, 0.3);
  transform: translateX(5px);
}

.story-item h2 a::after {
  content: '→';
  position: absolute;
  right: 0;
  top: 0;
  opacity: 0;
  transform: translateX(-10px);
  transition: all 0.3s ease;
  color: var(--olive-green);
  font-weight: bold;
  font-size: 1.2rem;
}

.story-item h2 a:hover::after {
  opacity: 1;
  transform: translateX(5px);
  color: var(--forest-green);
}

/* Green underline effect for links */
.story-item h2 a {
  position: relative;
  display: inline-block;
}

.story-item h2 a::before {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 35px;
  width: 0;
  height: 2px;
  background: linear-gradient(90deg, var(--moss-green), var(--olive-green));
  transition: width 0.3s ease;
}

.story-item h2 a:hover::before {
  width: calc(100% - 35px);
}

/* Summary Text Styling */
.story-item p {
  color: var(--faded-black);
  font-size: 1rem;
  line-height: 1.7;
  margin: 0;
  position: relative;
  z-index: 2;
  padding-left: 35px;
  border-left: 3px solid var(--moss-green);
  background: linear-gradient(90deg, transparent, rgba(138, 148, 110, 0.05));
  padding: 15px;
  border-radius: 0 8px 8px 0;
}

/* Decorative Corner Elements */
.story-item::before {
  content: '';
  position: absolute;
  top: 10px;
  left: 10px;
  right: 10px;
  bottom: 10px;
  border: 1px solid rgba(110, 123, 91, 0.2);
  border-radius: 8px;
  pointer-events: none;
}

/* Label Badge Effect */
.story-item::after {
  content: 'தமிழ் சொல்';
  position: absolute;
  top: -12px;
  right: 20px;
  background: linear-gradient(135deg, var(--olive-green), var(--forest-green));
  color: var(--off-white);
  padding: 6px 15px;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: bold;
  letter-spacing: 1px;
  box-shadow: 0 4px 10px rgba(110, 123, 91, 0.3);
  z-index: 3;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
  animation: pulseGreen 4s infinite;
}

/* Green Pattern Background for Items */
.story-item {
  background-image: 
    radial-gradient(circle at 10% 20%, rgba(110, 123, 91, 0.08) 0%, transparent 50%),
    radial-gradient(circle at 90% 80%, rgba(138, 148, 110, 0.08) 0%, transparent 50%),
    url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236E7B5B' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

/* Floating Tamil Letters Decoration */
.tamil-decoration {
  position: fixed;
  font-size: 8rem;
  color: rgba(110, 123, 91, 0.05);
  font-family: 'Kavivanar', serif;
  pointer-events: none;
  z-index: 1;
  animation: floatSubtle 25s infinite ease-in-out;
}

.decoration-1 { top: 10%; left: 5%; }
.decoration-2 { top: 60%; right: 5%; animation-delay: 2s; }
.decoration-3 { bottom: 20%; left: 10%; animation-delay: 4s; }

/* Green accent glow */
.green-glow {
  position: absolute;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at center, transparent 0%, rgba(110, 123, 91, 0.1) 100%);
  top: 0;
  left: 0;
  opacity: 0;
  transition: opacity 0.3s ease;
  pointer-events: none;
  z-index: 0;
}

.story-item:hover .green-glow {
  opacity: 1;
}

/* Ensure black color with green gradient for all links */
a {
  color: var(--black) !important;
}

.story-item h2 a,
.story-item h2 a:link,
.story-item h2 a:visited,
.story-item h2 a:active {
  color: var(--black) !important;
}

.story-item h2 a:hover {
  color: var(--black) !important;
}

/* Animated Green Particles */
.green-particle {
  position: fixed;
  width: 6px;
  height: 6px;
  background: var(--olive-green);
  border-radius: 50%;
  pointer-events: none;
  opacity: 0.3;
  animation: floatingLeaves 15s infinite linear;
  z-index: 0;
}

/* No Results Message */
.story-list:empty::before {
  content: 'தமிழ் சொற்கள் எதுவும் கிடைக்கவில்லை.';
  display: block;
  text-align: center;
  padding: 40px;
  color: var(--olive-green);
  font-size: 1.3rem;
  background: rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  border: 2px dashed var(--moss-green);
  animation: pulseGreen 3s infinite;
}

/* Print Styles */
@media print {
  body {
    background: white !important;
    animation: none !important;
  }
  
  body::before {
    display: none;
  }
  
  .story-item {
    break-inside: avoid;
    box-shadow: none !important;
    border: 1px solid #ddd !important;
    transform: none !important;
  }
  
  .story-item::after {
    display: none;
  }
  
  .story-item h2 a {
    color: #000000 !important;
    background: none !important;
    -webkit-text-fill-color: #000000 !important;
  }
  
  .floating-leaf,
  .tamil-decoration,
  .green-particle {
    display: none;
  }
}

/* ===== RESPONSIVE ENHANCEMENTS ===== */

/* Large devices (desktops, 1200px and up) */
@media (min-width: 1200px) {
  .container {
    max-width: 1400px;
    padding: 40px;
  }
  
  .story-list {
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 30px;
  }
  
  .tamil-decoration {
    font-size: 10rem;
  }
}

/* Medium devices (tablets, 768px to 1199px) */
@media (max-width: 1199px) and (min-width: 768px) {
  body {
    padding: 15px;
  }
  
  .container {
    margin: 20px auto;
    padding: 25px;
    max-width: 95%;
  }
  
  .page-title {
    font-size: 2.5rem;
    margin-bottom: 35px;
  }
  
  .page-title::after {
    width: 180px;
  }
  
  .story-list {
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
  }
  
  .story-item {
    padding: 20px;
  }
  
  .story-item h2 {
    font-size: 1.4rem;
  }
  
  .story-item h2 a {
    padding-left: 30px;
    font-size: 1.3rem;
  }
  
  .story-item h2 a::before {
    font-size: 1.2rem;
  }
  
  .story-item p {
    padding-left: 30px;
    font-size: 0.95rem;
  }
  
  /* Adjust floating elements for tablets */
  .floating-leaf {
    width: 30px;
    height: 30px;
  }
  
  .tamil-decoration {
    font-size: 6rem;
  }
  
  .decoration-1 { left: 2%; top: 5%; }
  .decoration-2 { right: 2%; top: 55%; }
  .decoration-3 { left: 5%; bottom: 15%; }
  
  /* Reduce particle density on tablets */
  .green-particle {
    width: 4px;
    height: 4px;
  }
}

/* Small devices (landscape phones, 576px to 767px) */
@media (max-width: 767px) and (min-width: 576px) {
  body {
    padding: 10px;
    animation: gradientFlow 30s ease infinite;
  }
  
  .container {
    margin: 15px auto;
    padding: 20px;
    width: 100%;
    max-width: 100%;
    border-radius: 12px;
  }
  
  .page-title {
    font-size: 2rem;
    margin-bottom: 30px;
    padding-bottom: 15px;
  }
  
  .page-title::after {
    width: 150px;
    height: 3px;
  }
  
  .story-list {
    grid-template-columns: 1fr;
    gap: 20px;
    margin-top: 25px;
  }
  
  .story-item {
    padding: 18px;
    border-radius: 12px;
  }
  
  .story-item h2 {
    font-size: 1.3rem;
    margin-bottom: 12px;
  }
  
  .story-item h2 a {
    padding-left: 28px;
    font-size: 1.2rem;
  }
  
  .story-item h2 a::before {
    font-size: 1.1rem;
  }
  
  .story-item h2 a::after {
    font-size: 1.1rem;
  }
  
  .story-item p {
    padding-left: 28px;
    padding: 12px;
    font-size: 0.9rem;
    line-height: 1.6;
  }
  
  /* Adjust decorative elements for mobile */
  .story-item::after {
    content: 'தமிழ்';
    padding: 5px 12px;
    font-size: 0.7rem;
    top: -10px;
    right: 15px;
  }
  
  /* Hide most floating elements on mobile for performance */
  .floating-leaf {
    width: 20px;
    height: 20px;
    opacity: 0.05;
  }
  
  .leaf-2, .leaf-4, .leaf-5 {
    display: none;
  }
  
  .tamil-decoration {
    font-size: 4rem;
    opacity: 0.03;
  }
  
  .decoration-2, .decoration-3 {
    display: none;
  }
  
  .green-particle {
    display: none; /* Hide particles on mobile for better performance */
  }
  
  /* Reduce animations for mobile performance */
  @media (prefers-reduced-motion: reduce) {
    body,
    .floating-leaf,
    .tamil-decoration,
    .story-item,
    .page-title {
      animation: none !important;
    }
  }
}

/* Extra small devices (phones, 575px and down) */
@media (max-width: 575px) {
  body {
    padding: 8px;
    background-size: 600% 600%, 200px 200px, 150px 150px;
    animation: gradientFlow 40s ease infinite;
  }
  
  body::before {
    animation: grainEffect 12s steps(10) infinite;
  }
  
  .container {
    margin: 10px auto;
    padding: 15px;
    border-radius: 10px;
    backdrop-filter: blur(5px);
  }
  
  .page-title {
    font-size: 1.8rem;
    margin-bottom: 25px;
    padding-bottom: 12px;
    animation: pulseGreen 4s infinite;
  }
  
  .page-title::after {
    width: 120px;
    height: 2px;
  }
  
  .story-list {
    gap: 15px;
    margin-top: 20px;
  }
  
  .story-item {
    padding: 15px;
    border-radius: 10px;
    animation: fadeInUp 0.8s ease-out forwards;
  }
  
  .story-item:nth-child(n) {
    animation-delay: 0s; /* Remove staggered animations on mobile */
  }
  
  .story-item h2 {
    font-size: 1.2rem;
    margin-bottom: 10px;
  }
  
  .story-item h2 a {
    padding-left: 25px;
    font-size: 1.1rem;
  }
  
  .story-item h2 a::before {
    font-size: 1rem;
  }
  
  .story-item h2 a::after {
    display: none; /* Hide arrow on mobile */
  }
  
  .story-item p {
    padding-left: 25px;
    padding: 10px;
    font-size: 0.85rem;
    line-height: 1.5;
    border-left-width: 2px;
  }
  
  /* Adjust hover effects for touch devices */
  .story-item:hover {
    transform: translateY(-5px) scale(1.01);
  }
  
  .story-item:active {
    transform: translateY(-2px) scale(1.005);
  }
  
  /* Simplify decorative elements */
  .story-item::after {
    content: 'த';
    padding: 4px 10px;
    font-size: 0.6rem;
    top: -8px;
    right: 10px;
    border-radius: 15px;
  }
  
  .story-item::before {
    top: 5px;
    left: 5px;
    right: 5px;
    bottom: 5px;
    border-width: 1px;
  }
  
  /* Hide most animations on very small screens */
  .floating-leaf {
    display: none;
  }
  
  .tamil-decoration {
    display: none;
  }
  
  .green-particle {
    display: none;
  }
  
  /* Adjust link underline for mobile */
  .story-item h2 a::before {
    bottom: -1px;
    height: 1px;
  }
  
  /* Improve touch targets */
  .story-item h2 a {
    min-height: 44px; /* Minimum touch target size */
    display: flex;
    align-items: center;
  }
  
  /* Reduce shadow effects on mobile */
  .story-item {
    box-shadow: 
      0 4px 15px rgba(0, 0, 0, 0.1),
      0 1px 5px rgba(0, 0, 0, 0.08);
  }
  
  .story-item:hover {
    box-shadow: 
      0 8px 20px rgba(0, 0, 0, 0.15),
      0 5px 15px rgba(110, 123, 91, 0.15);
  }
  
  /* No results message */
  .story-list:empty::before {
    padding: 30px 20px;
    font-size: 1.1rem;
    margin: 20px 0;
  }
}

/* Very small devices (phones, 360px and down) */
@media (max-width: 360px) {
  .container {
    padding: 12px;
    margin: 8px;
  }
  
  .page-title {
    font-size: 1.6rem;
    margin-bottom: 20px;
  }
  
  .story-item {
    padding: 12px;
  }
  
  .story-item h2 {
    font-size: 1.1rem;
  }
  
  .story-item h2 a {
    padding-left: 22px;
    font-size: 1rem;
  }
  
  .story-item p {
    padding-left: 22px;
    padding: 8px;
    font-size: 0.8rem;
  }
  
  .story-list:empty::before {
    padding: 25px 15px;
    font-size: 1rem;
  }
}

/* Orientation specific adjustments */
@media (max-height: 500px) and (orientation: landscape) {
  .container {
    margin: 15px auto;
    padding: 20px;
  }
  
  .page-title {
    font-size: 2rem;
    margin-bottom: 25px;
  }
  
  .story-list {
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 15px;
  }
  
  .story-item {
    padding: 15px;
    min-height: 120px;
    display: flex;
    flex-direction: column;
  }
  
  .story-item h2 {
    font-size: 1.2rem;
    margin-bottom: 8px;
  }
  
  .story-item p {
    flex: 1;
    overflow: hidden;
    font-size: 0.85rem;
    line-height: 1.4;
  }
  
  /* Hide decorative elements in landscape */
  .tamil-decoration,
  .floating-leaf {
    display: none;
  }
}

/* High-resolution displays */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  body::before {
    opacity: 0.1;
  }
  
  .story-item {
    border-width: 1.5px;
  }
}

/* Reduced motion preferences */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
  
  body {
    animation: none !important;
  }
  
  .story-item {
    animation: fadeInUp 0.3s ease-out forwards !important;
  }
  
  .floating-leaf,
  .tamil-decoration,
  .green-particle {
    display: none;
  }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
  .story-item {
    background: linear-gradient(145deg, #1a1a1a, #2a2a2a);
  }
  
  .story-item p {
    color: #cccccc;
  }
  
  .story-item h2 a {
    background: linear-gradient(90deg, var(--moss-green), var(--olive-green));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
}

/* Performance optimizations for low-end devices */
@media (max-width: 768px) {
  /* Simplify background for mobile */
  body {
    background: 
      linear-gradient(-45deg, var(--charcoal), var(--faded-black), var(--forest-green)),
      url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%238A946E' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
    background-size: 300% 300%, 150px 150px;
  }
  
  body::before {
    opacity: 0.08;
  }
}
</style>

<!-- Animated Background Elements -->
<div class="floating-leaf leaf-1"></div>
<div class="floating-leaf leaf-2"></div>
<div class="floating-leaf leaf-3"></div>
<div class="floating-leaf leaf-4"></div>
<div class="floating-leaf leaf-5"></div>

<!-- Floating Tamil Decorative Elements -->
<div class="tamil-decoration decoration-1">த</div>
<div class="tamil-decoration decoration-2">மி</div>
<div class="tamil-decoration decoration-3">ழ்</div>

<!-- Create Green Particles -->
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Only create particles on desktop for performance
  if (window.innerWidth > 767) {
    for(let i = 0; i < 12; i++) {
      const particle = document.createElement('div');
      particle.className = 'green-particle';
      particle.style.left = Math.random() * 100 + 'vw';
      particle.style.top = Math.random() * 100 + 'vh';
      particle.style.animationDelay = Math.random() * 20 + 's';
      particle.style.animationDuration = (Math.random() * 20 + 15) + 's';
      particle.style.opacity = Math.random() * 0.2 + 0.1;
      particle.style.width = particle.style.height = (Math.random() * 6 + 2) + 'px';
      document.body.appendChild(particle);
    }
  }
});
</script>

<div class="container">
  <h1 class="page-title">📘 தமிழ் சொற்கள்</h1>

  <div class="story-list">
    <?php 
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) { 
    ?>
      <div class="story-item">
        <div class="green-glow"></div>
        <h2>
          <a href="word.php?slug=<?php echo htmlspecialchars($row['slug']); ?>">
            <?php echo htmlspecialchars($row['title']); ?>
          </a>
        </h2>
        <p><?php echo nl2br(htmlspecialchars($row['summary'])); ?></p>
      </div>
    <?php 
      }
    } else {
      // No items message will be shown via CSS
    }
    ?>
  </div>
</div>

<script>
// Add interactive animations with performance considerations
document.addEventListener('DOMContentLoaded', function() {
  // Add hover sound effect simulation
  const storyItems = document.querySelectorAll('.story-item');
  
  storyItems.forEach(item => {
    item.addEventListener('mouseenter', function() {
      this.style.zIndex = '10';
    });
    
    item.addEventListener('mouseleave', function() {
      this.style.zIndex = '1';
    });
  });
  
  // Page load animation - only on desktop
  if (window.innerWidth > 767) {
    const container = document.querySelector('.container');
    container.style.opacity = '0';
    container.style.transform = 'translateY(30px) scale(0.95)';
    
    setTimeout(() => {
      container.style.transition = 'opacity 1s ease, transform 1s ease';
      container.style.opacity = '1';
      container.style.transform = 'translateY(0) scale(1)';
    }, 100);
  }
  
  // Add parallax effect to decorations - only on desktop
  if (window.innerWidth > 767) {
    window.addEventListener('scroll', function() {
      const scrolled = window.pageYOffset;
      const decorations = document.querySelectorAll('.tamil-decoration, .floating-leaf');
      
      decorations.forEach((dec, index) => {
        const speed = 0.2 + (index * 0.05);
        dec.style.transform = `translateY(${scrolled * speed}px) rotate(${dec.style.rotate || '0deg'})`;
      });
    });
  }
  
  // Lazy load animation for items
  const observerOptions = {
    threshold: 0.05,
    rootMargin: '0px 0px -50px 0px'
  };
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.animation = 'fadeInUp 0.8s ease-out forwards';
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);
  
  storyItems.forEach(item => {
    observer.observe(item);
  });
  
  // Animate green particles - only on desktop
  if (window.innerWidth > 767) {
    const particles = document.querySelectorAll('.green-particle');
    particles.forEach(particle => {
      particle.addEventListener('animationiteration', function() {
        this.style.left = Math.random() * 100 + 'vw';
        this.style.top = Math.random() * 100 + 'vh';
      });
    });
  }
  
  // Add ripple effect on click - optimized for mobile
  storyItems.forEach(item => {
    item.addEventListener('click', function(e) {
      if (e.target.tagName === 'A') return;
      
      // Only create ripple on desktop or if performance allows
      if (window.innerWidth > 767 || 'ontouchstart' in window === false) {
        const ripple = document.createElement('div');
        ripple.style.position = 'absolute';
        ripple.style.width = '10px';
        ripple.style.height = '10px';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(110, 123, 91, 0.3)';
        ripple.style.left = e.offsetX + 'px';
        ripple.style.top = e.offsetY + 'px';
        ripple.style.transform = 'translate(-50%, -50%)';
        ripple.style.animation = 'ripple 0.6s ease-out forwards';
        
        this.appendChild(ripple);
        setTimeout(() => ripple.remove(), 600);
      }
    });
  });
  
  // Handle orientation changes
  window.addEventListener('orientationchange', function() {
    setTimeout(() => {
      // Recalculate animations after orientation change
      const storyItems = document.querySelectorAll('.story-item');
      storyItems.forEach(item => {
        item.style.animation = 'none';
        setTimeout(() => {
          item.style.animation = '';
        }, 10);
      });
    }, 300);
  });
  
  // Performance optimization: Reduce animations when battery is low
  if ('getBattery' in navigator) {
    navigator.getBattery().then(battery => {
      if (battery.level < 0.3) {
        document.body.style.animationDuration = '0s';
        document.querySelectorAll('.floating-leaf, .tamil-decoration').forEach(el => {
          el.style.animation = 'none';
        });
      }
    });
  }
  
  // Add CSS for ripple animation if not already present
  if (!document.querySelector('style[data-ripple="true"]')) {
    const style = document.createElement('style');
    style.setAttribute('data-ripple', 'true');
    style.textContent = `
      @keyframes ripple {
        0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
        100% { transform: translate(-50%, -50%) scale(10); opacity: 0; }
      }
    `;
    document.head.appendChild(style);
  }
  
  // Touch device optimizations
  if ('ontouchstart' in window) {
    // Increase touch targets
    storyItems.forEach(item => {
      const link = item.querySelector('h2 a');
      if (link) {
        link.style.minHeight = '44px';
        link.style.display = 'flex';
        link.style.alignItems = 'center';
      }
    });
    
    // Disable hover effects on touch devices
    document.body.classList.add('touch-device');
  }
  
  // Handle window resize with debouncing
  let resizeTimeout;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      // Re-initialize animations on resize
      const container = document.querySelector('.container');
      if (container) {
        container.style.transition = 'none';
        setTimeout(() => {
          container.style.transition = '';
        }, 10);
      }
    }, 250);
  });
});
</script>

<?php include '../includes/footer.php'; ?>