<?php
// Start output buffering at the VERY beginning
ob_start();

// Include the database connection FIRST
include '../includes/db.php';

// NOW you can use $conn
$result = $conn->query("SELECT * FROM cinema_posts ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="ta">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <title>பழைய சினிமா - Old Tamil Cinema</title>
  <style>
  /* ===== CSS VARIABLES & THEME ===== */
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
    --tamil-red: #b33a3a;
    --shadow: rgba(0, 0, 0, 0.3);
    --shadow-light: rgba(194, 168, 109, 0.1);
    --shadow-lg: rgba(0, 0, 0, 0.4);
    --radius: 12px;
    --radius-sm: 8px;
    --radius-lg: 16px;
    --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }

  /* ===== ANIMATIONS ===== */
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

  @keyframes floatParticles {
    0% { transform: translateY(0) rotate(0deg); opacity: 0.7; }
    50% { transform: translateY(-20px) rotate(180deg); opacity: 0.9; }
    100% { transform: translateY(0) rotate(360deg); opacity: 0.7; }
  }

  @keyframes floatSlow {
    0% { transform: translate(0, 0) rotate(0deg) scale(1); }
    25% { transform: translate(20px, 30px) rotate(5deg) scale(1.1); }
    50% { transform: translate(0, 60px) rotate(0deg) scale(1); }
    75% { transform: translate(-20px, 30px) rotate(-5deg) scale(1.1); }
    100% { transform: translate(0, 0) rotate(0deg) scale(1); }
  }

  @keyframes floatSlowReverse {
    0% { transform: translate(0, 0) rotate(0deg) scale(1); }
    25% { transform: translate(-30px, 20px) rotate(-5deg) scale(1.1); }
    50% { transform: translate(0, 40px) rotate(0deg) scale(1); }
    75% { transform: translate(30px, 20px) rotate(5deg) scale(1.1); }
    100% { transform: translate(0, 0) rotate(0deg) scale(1); }
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(40px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  @keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
  }

  @keyframes twinkle {
    0%, 100% { opacity: 0.1; }
    50% { opacity: 0.4; }
  }

  @keyframes titleGlow {
    0% {
      text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.1),
                   0 0 20px rgba(110, 123, 91, 0.2);
    }
    100% {
      text-shadow: 2px 2px 8px rgba(110, 123, 91, 0.4),
                   0 0 30px rgba(194, 168, 109, 0.3);
    }
  }

  @keyframes cardHover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-15px); }
  }

  @keyframes ripple {
    to {
      transform: scale(4);
      opacity: 0;
    }
  }

  /* ===== BASE STYLES ===== */
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
    background: 
      linear-gradient(-45deg, var(--charcoal), var(--faded-black), var(--forest-green), var(--dusty-brown));
    background-size: 400% 400%;
    animation: gradientFlow 20s ease infinite;
    color: var(--off-white);
    font-family: 'Georgia', 'serif', 'Latha', 'Tamil Sangam MN', 'Noto Sans Tamil', serif;
    line-height: 1.6;
    overflow-x: hidden;
    position: relative;
    min-height: 100vh;
  }

  /* Animated Grain Overlay */
  body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%' height='100%' filter='url(%23noiseFilter)' opacity='0.1'/%3E%3C/svg%3E");
    opacity: 0.15;
    animation: grainEffect 8s steps(10) infinite;
    pointer-events: none;
    z-index: 1;
  }

  /* ===== DECORATIVE ELEMENTS ===== */
  .tamil-pattern {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cdefs%3E%3Cpattern id='tamilPattern' x='0' y='0' width='120' height='120' patternUnits='userSpaceOnUse'%3E%3Cg fill='none' stroke='%236E7B5B' stroke-width='0.5' opacity='0.15'%3E%3Cpath d='M60 20 L80 40 L70 60 L50 50 L40 70 L20 60 L30 40 Z'/%3E%3Cpath d='M30 90 L50 110 L40 130 L20 120 L10 140 L-10 130 L0 110 Z'/%3E%3Cpath d='M90 90 L110 110 L100 130 L80 120 L70 140 L50 130 L60 110 Z'/%3E%3C/g%3E%3C/pattern%3E%3C/defs%3E%3Crect width='100%25' height='100%25' fill='url(%23tamilPattern)'/%3E%3C/svg%3E");
    opacity: 0.3;
    pointer-events: none;
    z-index: 0;
    animation: grainEffect 60s infinite linear;
  }

  .vintage-border {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
  }

  .vintage-border::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 20px;
    background: linear-gradient(90deg, 
      transparent,
      var(--soft-gold),
      var(--olive-green),
      var(--soft-gold),
      transparent
    );
    opacity: 0.4;
    animation: shimmer 4s infinite;
  }

  .vintage-border::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 20px;
    background: linear-gradient(90deg, 
      transparent,
      var(--soft-gold),
      var(--olive-green),
      var(--soft-gold),
      transparent
    );
    opacity: 0.4;
    animation: shimmer 4s infinite reverse;
  }

  /* Floating Tamil decorative elements */
  .floating-element {
    position: fixed;
    opacity: 0.08;
    z-index: 0;
    font-size: clamp(4rem, 10vw, 8rem);
    color: var(--olive-green);
    font-family: 'Kavivanar', 'Noto Sans Tamil', serif;
    pointer-events: none;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    filter: drop-shadow(0 0 5px var(--soft-gold));
  }

  .floating-tamil-1 {
    top: 15%;
    left: 5%;
    animation: floatSlow 25s infinite linear;
  }

  .floating-tamil-2 {
    top: 60%;
    right: 8%;
    animation: floatSlowReverse 30s infinite linear;
  }

  .floating-tamil-3 {
    bottom: 20%;
    left: 10%;
    animation: floatSlow 35s infinite linear;
  }

  /* Floating Particles */
  .floating-particle {
    position: fixed;
    width: 4px;
    height: 4px;
    background-color: var(--soft-gold);
    border-radius: 50%;
    pointer-events: none;
    opacity: 0.7;
    animation: floatParticles 20s infinite linear;
    z-index: 0;
  }

  /* Corner decorations */
  .corner-decoration {
    position: absolute;
    width: clamp(50px, 10vw, 80px);
    height: clamp(50px, 10vw, 80px);
    z-index: 3;
    opacity: 0.8;
    border: 3px solid var(--soft-gold);
  }

  .corner-top-left {
    top: -5px;
    left: -5px;
    border-right: none;
    border-bottom: none;
    border-top-left-radius: 10px;
  }

  .corner-top-right {
    top: -5px;
    right: -5px;
    border-left: none;
    border-bottom: none;
    border-top-right-radius: 10px;
  }

  .corner-bottom-left {
    bottom: -5px;
    left: -5px;
    border-right: none;
    border-top: none;
    border-bottom-left-radius: 10px;
  }

  .corner-bottom-right {
    bottom: -5px;
    right: -5px;
    border-left: none;
    border-top: none;
    border-bottom-right-radius: 10px;
  }

  /* ===== MAIN CONTAINER ===== */
  .container {
    max-width: 1200px;
    margin: clamp(40px, 6vw, 60px) auto;
    background-color: var(--parchment);
    position: relative;
    box-shadow: 
      0 0 40px var(--shadow),
      0 0 100px var(--shadow-light) inset;
    border: 1px solid var(--dusty-brown);
    border-radius: var(--radius-lg);
    padding: clamp(30px, 4vw, 50px);
    animation: fadeInUp 1.2s ease-out;
    z-index: 2;
    position: relative;
    width: 90%;
  }

  /* Shimmer Effect on Container */
  .container::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
      90deg,
      transparent,
      rgba(255, 255, 255, 0.1),
      transparent
    );
    animation: shimmer 8s infinite;
    z-index: 1;
  }

  /* Pseudo-elements for enhanced vintage paper effect */
  .container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100%;
    background: 
      linear-gradient(90deg, transparent 0%, rgba(106, 90, 66, 0.08) 50%, transparent 100%),
      linear-gradient(rgba(106, 90, 66, 0.1) 1px, transparent 1px);
    background-size: 100% 100%, 100% 2em;
    pointer-events: none;
    z-index: -1;
  }

  .container > * {
    position: relative;
    z-index: 2;
  }

  /* ===== PAGE TITLE ===== */
  .container h1 {
    text-align: center;
    color: var(--forest-green);
    font-size: clamp(2rem, 5vw, 3.2rem);
    margin: clamp(20px, 3vw, 30px) 0 clamp(30px, 4vw, 40px);
    padding-bottom: clamp(12px, 2vw, 15px);
    border-bottom: 3px double var(--soft-gold);
    font-family: 'Kavivanar', 'Latha', 'Georgia', 'Noto Sans Tamil', serif;
    position: relative;
    text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.1);
    animation: titleGlow 3s ease-in-out infinite alternate;
    background: linear-gradient(90deg, var(--forest-green), var(--olive-green), var(--forest-green));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.3;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }

  .container h1::before,
  .container h1::after {
    content: '🎬';
    color: var(--soft-gold);
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: clamp(1.5rem, 3vw, 2rem);
    animation: twinkle 2s infinite;
  }

  .container h1::before {
    left: clamp(10px, 3vw, 20px);
    animation-delay: 0.5s;
  }

  .container h1::after {
    right: clamp(10px, 3vw, 20px);
    animation-delay: 1s;
  }

  /* ===== CARD GRID ===== */
  .cinema-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: clamp(25px, 3vw, 35px);
    margin-top: clamp(30px, 4vw, 40px);
  }

  /* ===== CARD STYLING ===== */
  .card {
    background-color: var(--light-cream);
    border: 2px solid var(--dusty-brown);
    border-radius: var(--radius-lg);
    padding: clamp(20px, 3vw, 30px);
    position: relative;
    overflow: hidden;
    transition: var(--transition);
    box-shadow: 0 10px 30px var(--shadow);
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
    display: flex;
    flex-direction: column;
    height: 100%;
    break-inside: avoid;
  }

  /* Staggered animation delays */
  .card:nth-child(1) { animation-delay: 0.2s; }
  .card:nth-child(2) { animation-delay: 0.4s; }
  .card:nth-child(3) { animation-delay: 0.6s; }
  .card:nth-child(4) { animation-delay: 0.8s; }
  .card:nth-child(5) { animation-delay: 1s; }
  .card:nth-child(6) { animation-delay: 1.2s; }

  .card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--moss-green), var(--soft-gold));
    border-radius: var(--radius-lg) var(--radius-lg) 0 0;
  }

  .card:hover {
    transform: translateY(-15px);
    border-color: var(--soft-gold);
    box-shadow: 0 20px 50px var(--shadow-lg);
    animation: cardHover 0.3s ease-out forwards;
  }

  /* Card Image */
  .card-image-container {
    width: 100%;
    height: clamp(250px, 35vw, 400px);
    overflow: hidden;
    border-radius: var(--radius);
    margin-bottom: clamp(15px, 2vw, 25px);
    position: relative;
    border: 2px solid var(--dusty-brown);
  }

  .card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
  }

  .card:hover img {
    transform: scale(1.05);
    border-color: var(--soft-gold);
  }

  /* Image overlay for hover effect */
  .card-image-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.1) 100%);
    opacity: 0;
    transition: var(--transition);
  }

  .card:hover .card-image-container::after {
    opacity: 1;
  }

  /* Card Content */
  .card-content {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  /* Card Title */
  .card h3 {
    color: var(--forest-green);
    font-size: clamp(1.5rem, 3vw, 2rem);
    margin: 0 0 clamp(10px, 1.5vw, 15px) 0;
    font-family: 'Kavivanar', 'Noto Sans Tamil', serif;
    font-weight: 700;
    line-height: 1.3;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    word-wrap: break-word;
  }

  /* Card Label */
  .card small {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, var(--moss-green), var(--olive-green));
    color: var(--off-white);
    padding: clamp(6px, 1vw, 8px) clamp(12px, 2vw, 18px);
    border-radius: 20px;
    font-size: clamp(0.8rem, 1.5vw, 0.9rem);
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: clamp(15px, 2vw, 20px);
    align-self: flex-start;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  /* Card Text Content */
  .card p {
    color: var(--faded-black);
    font-size: clamp(1rem, 1.8vw, 1.1rem);
    line-height: 1.8;
    margin: 0;
    position: relative;
    z-index: 2;
    padding: clamp(15px, 2vw, 20px);
    background: rgba(255, 255, 255, 0.3);
    border-radius: var(--radius-sm);
    border-left: 3px solid var(--soft-gold);
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  /* Card Date */
  .card-date {
    color: var(--dusty-brown);
    font-size: clamp(0.8rem, 1.5vw, 0.9rem);
    font-style: italic;
    margin-top: clamp(15px, 2vw, 20px);
    padding-top: clamp(10px, 1.5vw, 15px);
    border-top: 1px dashed var(--moss-green);
    opacity: 0.8;
  }

  /* No Content Message */
  .no-content {
    text-align: center;
    color: var(--forest-green);
    font-size: clamp(1.2rem, 2.5vw, 1.5rem);
    padding: clamp(40px, 6vw, 60px);
    background: rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    border: 2px dashed var(--moss-green);
    margin: clamp(30px, 4vw, 50px) 0;
    animation: fadeIn 1s ease-out;
  }

  .no-content::before {
    content: '🎞️';
    font-size: clamp(2rem, 4vw, 3rem);
    display: block;
    margin-bottom: 20px;
    opacity: 0.7;
  }

  /* ===== RESPONSIVE DESIGN ===== */

  /* Tablets and small desktops */
  @media (max-width: 1024px) {
    .cinema-grid {
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }
    
    .container {
      width: 95%;
    }
  }

  /* Tablets */
  @media (max-width: 768px) {
    .container {
      margin: 30px auto;
      padding: 25px;
      width: 92%;
    }
    
    .container h1::before,
    .container h1::after {
      display: none;
    }
    
    .cinema-grid {
      grid-template-columns: 1fr;
      gap: 25px;
    }
    
    .floating-element {
      font-size: clamp(3rem, 8vw, 5rem);
    }
    
    .corner-decoration {
      width: 40px;
      height: 40px;
    }
    
    .card {
      padding: 20px;
    }
    
    .card-image-container {
      height: clamp(200px, 40vw, 300px);
    }
  }

  /* Large smartphones */
  @media (max-width: 576px) {
    body {
      padding: 0;
    }
    
    .container {
      width: 95%;
      margin: 20px auto;
      padding: 20px;
      border-radius: 20px;
    }
    
    .container h1 {
      font-size: 1.75rem;
      margin: 15px 0 25px;
      padding-bottom: 12px;
      -webkit-text-fill-color: var(--forest-green);
      background: none;
    }
    
    .cinema-grid {
      gap: 20px;
      margin-top: 20px;
    }
    
    .card {
      padding: 18px;
    }
    
    .card-image-container {
      height: 200px;
    }
    
    .card h3 {
      font-size: 1.25rem;
    }
    
    .card small {
      font-size: 0.8rem;
      padding: 6px 12px;
    }
    
    .card p {
      font-size: 0.95rem;
      padding: 15px;
    }
    
    .card-date {
      font-size: 0.8rem;
    }
    
    .floating-element {
      font-size: 2.5rem;
      opacity: 0.05;
    }
    
    .floating-tamil-1 {
      left: 2%;
    }
    
    .floating-tamil-2 {
      right: 3%;
    }
    
    .floating-tamil-3 {
      left: 5%;
    }
    
    /* Simplify hover effects on touch devices */
    @media (hover: none) {
      .card:hover {
        transform: none;
        animation: none;
      }
      
      .card:hover img {
        transform: none;
      }
      
      .container:hover {
        box-shadow: 
          0 0 40px var(--shadow),
          0 0 100px var(--shadow-light) inset;
      }
    }
  }

  /* Extra small devices (phones in portrait) */
  @media (max-width: 400px) {
    .container {
      padding: 15px;
      width: 98%;
    }
    
    .container h1 {
      font-size: 1.5rem;
    }
    
    .cinema-grid {
      gap: 15px;
    }
    
    .card {
      padding: 15px;
    }
    
    .card-image-container {
      height: 180px;
    }
    
    .card h3 {
      font-size: 1.125rem;
    }
    
    .card p {
      font-size: 0.875rem;
      padding: 12px;
    }
    
    .floating-element {
      font-size: 2rem;
    }
  }

  /* Height-based adjustments for landscape mobile */
  @media (max-height: 600px) and (orientation: landscape) {
    .container {
      margin: 20px auto;
      padding: 20px;
    }
    
    .cinema-grid {
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
    }
    
    .card {
      padding: 15px;
    }
    
    .card-image-container {
      height: 150px;
    }
  }

  /* High-resolution displays */
  @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .card::before {
      height: 3px;
    }
    
    .card p {
      border-left-width: 2px;
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
    
    body::before,
    .vintage-border::before,
    .vintage-border::after,
    .tamil-pattern,
    .floating-element,
    .container::after,
    .floating-particle {
      animation: none !important;
    }
    
    .card {
      animation: fadeIn 0.3s ease-out !important;
    }
  }

  /* Print-friendly styles */
  @media print {
    .tamil-pattern,
    .vintage-border,
    .floating-element,
    .corner-decoration,
    .floating-particle {
      display: none;
    }
    
    body {
      background: white !important;
      animation: none !important;
      color: black !important;
    }
    
    body::before {
      display: none;
    }
    
    .container {
      box-shadow: none !important;
      border: 1px solid #ddd !important;
      animation: none !important;
      width: 100% !important;
      max-width: 100% !important;
      margin: 0 !important;
      padding: 20px !important;
    }
    
    .container::after {
      animation: none;
      display: none;
    }
    
    .container h1 {
      color: black !important;
      -webkit-text-fill-color: black !important;
      background: none !important;
      border-bottom: 2px solid #333;
    }
    
    .cinema-grid {
      display: block;
    }
    
    .card {
      box-shadow: none !important;
      border: 1px solid #ddd !important;
      break-inside: avoid;
      margin-bottom: 20px;
      transform: none !important;
    }
    
    .card:hover,
    .card:hover img {
      transform: none !important;
      box-shadow: none !important;
    }
    
    .card-image-container {
      border: 1px solid #ddd;
    }
    
    .card h3 {
      color: black;
    }
    
    .card p {
      color: black;
      background: none;
      border-left: 2px solid #ddd;
    }
    
    .no-content {
      border: 1px dashed #ddd;
      color: black;
    }
  }
  </style>
</head>
<body>

<!-- Background Elements -->
<div class="tamil-pattern"></div>
<div class="vintage-border"></div>

<!-- Floating Tamil decorative elements -->
<div class="floating-element floating-tamil-1">த</div>
<div class="floating-element floating-tamil-2">மி</div>
<div class="floating-element floating-tamil-3">ழ்</div>

<!-- Corner decorations -->
<div class="corner-decoration corner-top-left"></div>
<div class="corner-decoration corner-top-right"></div>
<div class="corner-decoration corner-bottom-left"></div>
<div class="corner-decoration corner-bottom-right"></div>

<?php 
// Include header and navbar
include '../includes/header.php'; 
include '../includes/navbar.php'; 
?>

<div class="container">
  <h1>பழைய சினிமா</h1>

  <?php if ($result && $result->num_rows > 0): ?>
    <div class="cinema-grid">
      <?php while ($row = $result->fetch_assoc()): ?>
        <article class="card" aria-label="<?php echo htmlspecialchars($row['title']); ?>">
          <?php if ($row['image_path']): ?>
            <div class="card-image-container">
              <img 
                src="../<?php echo htmlspecialchars($row['image_path']); ?>" 
                alt="<?php echo htmlspecialchars($row['title']); ?>"
                loading="lazy"
                decoding="async"
              >
            </div>
          <?php endif; ?>
          
          <div class="card-content">
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
            <small>
              <span>🏷️</span>
              <span><?php echo htmlspecialchars($row['label']); ?></span>
            </small>
            
            <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
            
            <?php if (!empty($row['created_at'])): ?>
              <div class="card-date">
                📅 <?php echo date('d M Y', strtotime($row['created_at'])); ?>
              </div>
            <?php endif; ?>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <div class="no-content" role="alert">
      <p><em>சினிமா உள்ளடக்கம் இல்லை. விரைவில் புதிய உள்ளடக்கம் சேர்க்கப்படும்.</em></p>
    </div>
  <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Console message
  console.log('%c🎬 பழைய சினிமா - Old Tamil Cinema', 'color: #4b2e1e; font-size: 14px; font-weight: bold;');
  console.log('%cExploring vintage Tamil cinema memories', 'color: #666;');
  
  // Add fade-in class to cards
  const cards = document.querySelectorAll('.card');
  cards.forEach(card => {
    card.classList.add('fade-in');
  });
  
  // Intersection Observer for scroll animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        // Add a slight delay between each card for better visual effect
        const delay = Array.from(cards).indexOf(entry.target) * 100;
        setTimeout(() => {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }, delay);
      }
    });
  }, observerOptions);
  
  cards.forEach(card => {
    observer.observe(card);
  });
  
  // Enhanced hover effect to container
  const container = document.querySelector('.container');
  if (window.matchMedia("(hover: hover)").matches) {
    container.addEventListener('mouseenter', function() {
      this.style.boxShadow = 
        '0 0 50px rgba(194, 168, 109, 0.3), ' +
        '0 0 100px rgba(110, 123, 91, 0.2) inset, ' +
        '0 0 30px rgba(122, 106, 85, 0.2)';
    });
    
    container.addEventListener('mouseleave', function() {
      this.style.boxShadow = 
        '0 0 40px rgba(0, 0, 0, 0.5), ' +
        '0 0 100px rgba(194, 168, 109, 0.1) inset';
    });
  }
  
  // Create floating particles - reduce number on mobile
  function createFloatingParticles() {
    const particleCount = window.innerWidth < 768 ? 15 : 25;
    const colors = ['#C2A86D', '#6E7B5B', '#8A946E', '#b33a3a'];
    
    for (let i = 0; i < particleCount; i++) {
      const particle = document.createElement('div');
      particle.className = 'floating-particle';
      particle.style.width = Math.random() * 4 + 2 + 'px';
      particle.style.height = particle.style.width;
      particle.style.left = Math.random() * 100 + 'vw';
      particle.style.top = Math.random() * 100 + 'vh';
      particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
      particle.style.opacity = Math.random() * 0.5 + 0.3;
      particle.style.animationDuration = Math.random() * 30 + 20 + 's';
      particle.style.animationDelay = Math.random() * 5 + 's';
      document.body.appendChild(particle);
    }
  }
  
  createFloatingParticles();
  
  // Add page load animation
  document.body.style.opacity = 0;
  window.requestAnimationFrame(() => {
    document.body.style.transition = 'opacity 1.5s ease';
    document.body.style.opacity = 1;
  });
  
  // Add subtle parallax effect to floating elements (only on non-mobile)
  if (window.innerWidth > 768) {
    window.addEventListener('scroll', function() {
      const scrolled = window.pageYOffset;
      const floatingElements = document.querySelectorAll('.floating-element');
      
      floatingElements.forEach((el, index) => {
        const speed = index === 0 ? 0.5 : index === 1 ? 0.3 : 0.7;
        el.style.transform = `translateY(${scrolled * speed * -0.5}px)`;
      });
    });
  }
  
  // Add ripple effect to cards
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
  
  // Apply ripple effect to all cards
  cards.forEach(addRippleEffect);
  
  // Add CSS for animations
  const style = document.createElement('style');
  style.textContent = `
    @keyframes ripple {
      to {
        transform: scale(4);
        opacity: 0;
      }
    }
    
    .fade-in {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.8s ease, transform 0.8s ease;
    }
    
    .fade-in.visible {
      opacity: 1;
      transform: translateY(0);
    }
  `;
  document.head.appendChild(style);
  
  // Handle window resize
  let resizeTimer;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      // Adjust container width on resize
      const container = document.querySelector('.container');
      if (window.innerWidth < 576) {
        container.style.width = '95%';
      } else if (window.innerWidth < 768) {
        container.style.width = '92%';
      } else {
        container.style.width = '90%';
      }
    }, 250);
  });
  
  // Initialize container width
  const initContainer = document.querySelector('.container');
  if (window.innerWidth < 576) {
    initContainer.style.width = '95%';
  } else if (window.innerWidth < 768) {
    initContainer.style.width = '92%';
  }
  
  // Performance optimization for images
  if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[loading="lazy"]');
    images.forEach(img => {
      if (img.dataset.src) {
        img.src = img.dataset.src;
      }
    });
  }
  
  // Add keyboard navigation for cards
  cards.forEach((card, index) => {
    card.setAttribute('tabindex', '0');
    card.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        this.click();
        
        // Add visual feedback
        this.style.transform = 'scale(0.98)';
        setTimeout(() => {
          this.style.transform = '';
        }, 200);
      }
    });
  });
  
  // Add touch feedback for mobile
  cards.forEach(card => {
    card.addEventListener('touchstart', function() {
      this.style.transform = 'scale(0.98)';
    }, { passive: true });
    
    card.addEventListener('touchend', function() {
      this.style.transform = '';
    }, { passive: true });
  });
});
</script>
</body>
</html>