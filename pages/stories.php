<?php
// Start output buffering at the VERY beginning
ob_start();

// Include database connection FIRST
include '../includes/db.php';

// Get stories from database
$result = $conn->query(
  "SELECT title, slug, summary FROM stories ORDER BY created_at DESC"
);
?>
<!DOCTYPE html>
<html lang="ta">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <title>கதைகள் - Tamil Stories Collection</title>
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
  @keyframes floatTamilWords {
    0% {
      transform: translateY(100vh) translateX(var(--start-x)) rotate(0deg);
      opacity: 0;
    }
    10% {
      opacity: var(--opacity);
    }
    90% {
      opacity: var(--opacity);
    }
    100% {
      transform: translateY(-100px) translateX(var(--end-x)) rotate(var(--rotation));
      opacity: 0;
    }
  }

  @keyframes floatingLeaves {
    0% {
      transform: translateY(100vh) translateX(var(--leaf-x)) rotate(0deg) scale(var(--leaf-scale));
      opacity: 0;
      filter: blur(0px);
    }
    15% {
      opacity: var(--leaf-opacity);
      filter: blur(1px);
    }
    85% {
      opacity: var(--leaf-opacity);
      filter: blur(1px);
    }
    100% {
      transform: translateY(-150px) translateX(calc(var(--leaf-x) + 80px)) rotate(960deg) scale(calc(var(--leaf-scale) * 0.8));
      opacity: 0;
      filter: blur(2px);
    }
  }

  @keyframes glowingOrbs {
    0%, 100% { 
      transform: translate(-50%, -50%) scale(1);
      opacity: 0.03;
      box-shadow: 0 0 80px rgba(110, 123, 91, 0.3);
    }
    50% { 
      transform: translate(-50%, -50%) scale(1.3);
      opacity: 0.08;
      box-shadow: 0 0 120px rgba(194, 168, 109, 0.4);
    }
  }

  @keyframes gentlePulse {
    0%, 100% { opacity: 0.1; transform: scale(1); }
    50% { opacity: 0.15; transform: scale(1.05); }
  }

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

  @keyframes subtleFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
  }

  @keyframes ripple {
    to {
      transform: scale(4);
      opacity: 0;
    }
  }

  @keyframes bookFlip {
    0%, 100% { transform: rotateY(0deg); }
    50% { transform: rotateY(20deg); }
  }

  @keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
  }

  @keyframes twinkle {
    0%, 100% { opacity: 0.1; }
    50% { opacity: 0.4; }
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
      linear-gradient(-45deg, 
        #3F4A3C 0%,     /* Forest Green */
        #6E7B5B 25%,    /* Olive Green */
        #8A946E 50%,    /* Moss Green */
        #6E7B5B 75%,    /* Olive Green */
        #3F4A3C 100%    /* Forest Green */
      ),
      radial-gradient(
        circle at 20% 80%,
        rgba(194, 168, 109, 0.15) 0%,
        transparent 50%
      ),
      radial-gradient(
        circle at 80% 20%,
        rgba(110, 123, 91, 0.1) 0%,
        transparent 50%
      );
    background-size: 400% 400%, 200% 200%, 200% 200%;
    animation: gradientFlow 25s ease infinite, subtleFloat 20s ease-in-out infinite;
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
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%' height='100%' filter='url(%23noiseFilter)' opacity='0.08'/%3E%3C/svg%3E");
    opacity: 0.12;
    animation: grainEffect 8s steps(10) infinite;
    pointer-events: none;
    z-index: 1;
  }

  /* ===== BACKGROUND ELEMENTS ===== */
  .glow-orbs {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
  }

  .glow-orb {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(
      circle,
      var(--soft-gold) 0%,
      transparent 70%
    );
    animation: glowingOrbs 8s ease-in-out infinite;
  }

  .glow-orb:nth-child(1) {
    width: clamp(150px, 20vw, 300px);
    height: clamp(150px, 20vw, 300px);
    top: 20%;
    left: 10%;
    animation-delay: 0s;
    background: radial-gradient(
      circle,
      rgba(194, 168, 109, 0.2) 0%,
      transparent 70%
    );
  }

  .glow-orb:nth-child(2) {
    width: clamp(100px, 15vw, 200px);
    height: clamp(100px, 15vw, 200px);
    top: 60%;
    left: 80%;
    animation-delay: 2s;
    background: radial-gradient(
      circle,
      rgba(110, 123, 91, 0.15) 0%,
      transparent 70%
    );
  }

  .glow-orb:nth-child(3) {
    width: clamp(80px, 10vw, 150px);
    height: clamp(80px, 10vw, 150px);
    top: 80%;
    left: 20%;
    animation-delay: 4s;
    background: radial-gradient(
      circle,
      rgba(138, 148, 110, 0.1) 0%,
      transparent 70%
    );
  }

  /* Floating Leaves Background */
  .floating-leaves {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
  }

  .leaf {
    position: absolute;
    font-size: var(--leaf-size);
    color: var(--leaf-color);
    opacity: 0;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    animation: floatingLeaves var(--leaf-duration) linear infinite;
    animation-delay: var(--leaf-delay);
  }

  /* Tamil Words Background Container */
  .tamil-words-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
  }

  /* Tamil Words Styling */
  .tamil-word {
    position: absolute;
    color: rgba(194, 168, 109, 0.15);
    font-size: var(--size);
    font-family: 'Arial Unicode MS', 'Noto Sans Tamil', 'Tahoma', sans-serif;
    font-weight: bold;
    opacity: 0;
    text-shadow: 
      0 0 10px rgba(110, 123, 91, 0.3),
      0 0 20px rgba(110, 123, 91, 0.2);
    animation: floatTamilWords var(--duration) linear infinite;
    animation-delay: var(--delay);
    z-index: 0;
  }

  /* Vintage border with Olive Green theme */
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
    height: clamp(10px, 2vw, 15px);
    background: linear-gradient(90deg, 
      transparent,
      rgba(110, 123, 91, 0.6),
      rgba(138, 148, 110, 0.8),
      rgba(194, 168, 109, 0.6),
      rgba(110, 123, 91, 0.6),
      transparent
    );
    opacity: 0.5;
    animation: gentlePulse 8s ease-in-out infinite;
  }

  .vintage-border::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: clamp(10px, 2vw, 15px);
    background: linear-gradient(90deg, 
      transparent,
      rgba(110, 123, 91, 0.6),
      rgba(138, 148, 110, 0.8),
      rgba(194, 168, 109, 0.6),
      rgba(110, 123, 91, 0.6),
      transparent
    );
    opacity: 0.5;
    animation: gentlePulse 8s ease-in-out infinite reverse;
  }

  /* ===== MAIN CONTAINER ===== */
  .container {
    max-width: 1200px;
    margin: clamp(40px, 6vw, 60px) auto;
    padding: clamp(30px, 4vw, 50px);
    position: relative;
    z-index: 2;
    animation: fadeInUp 1.2s ease-out;
    background-color: rgba(239, 230, 207, 0.92);
    border: 2px solid var(--olive-green);
    border-radius: var(--radius-lg);
    box-shadow: 
      0 0 40px rgba(110, 123, 91, 0.4),
      0 0 100px rgba(194, 168, 109, 0.1) inset,
      0 20px 50px rgba(0, 0, 0, 0.3),
      0 0 0 1px rgba(230, 214, 184, 0.3) inset;
    backdrop-filter: blur(8px);
    transition: var(--transition);
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

  /* Pseudo-element for enhanced vintage paper effect */
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

  /* ===== PAGE HEADER ===== */
  .container h1 {
    text-align: center;
    color: var(--forest-green);
    font-size: clamp(2rem, 5vw, 3.2rem);
    margin: clamp(20px, 3vw, 30px) 0 clamp(30px, 4vw, 40px);
    padding-bottom: clamp(12px, 2vw, 15px);
    border-bottom: 3px double var(--olive-green);
    font-family: 'Kavivanar', 'Latha', 'Georgia', 'Noto Sans Tamil', serif;
    position: relative;
    text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.1);
    animation: titleGlow 3s ease-in-out infinite alternate;
    background: linear-gradient(90deg, 
      var(--forest-green), 
      var(--olive-green), 
      var(--moss-green),
      var(--olive-green),
      var(--forest-green)
    );
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: subtleFloat 6s ease-in-out infinite;
    line-height: 1.3;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }

  .container h1::before, .container h1::after {
    content: '📚';
    color: var(--olive-green);
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: clamp(1.5rem, 3vw, 2rem);
    animation: gentlePulse 3s ease-in-out infinite;
    text-shadow: 0 0 10px rgba(110, 123, 91, 0.5);
  }

  .container h1::before {
    left: clamp(10px, 3vw, 20px);
    animation-delay: 0.5s;
  }

  .container h1::after {
    right: clamp(10px, 3vw, 20px);
    animation-delay: 1s;
  }

  /* ===== STORIES GRID ===== */
  .story-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: clamp(25px, 3vw, 35px);
    margin-top: clamp(20px, 3vw, 30px);
  }

  /* ===== STORY ITEM ===== */
  .story-item {
    background: linear-gradient(145deg, 
      rgba(245, 245, 240, 0.95) 0%,
      rgba(236, 236, 236, 0.9) 100%
    );
    border: 2px solid var(--olive-green);
    border-radius: var(--radius);
    padding: clamp(20px, 3vw, 30px);
    transition: var(--transition);
    box-shadow: 
      0 10px 30px rgba(110, 123, 91, 0.2),
      0 5px 15px rgba(110, 123, 91, 0.1),
      0 0 0 1px rgba(230, 214, 184, 0.2) inset;
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
    position: relative;
    overflow: hidden;
    z-index: 1;
    display: flex;
    flex-direction: column;
    height: 100%;
    break-inside: avoid;
  }

  /* Staggered animation delays */
  .story-item:nth-child(1) { animation-delay: 0.2s; }
  .story-item:nth-child(2) { animation-delay: 0.4s; }
  .story-item:nth-child(3) { animation-delay: 0.6s; }
  .story-item:nth-child(4) { animation-delay: 0.8s; }
  .story-item:nth-child(5) { animation-delay: 1s; }
  .story-item:nth-child(6) { animation-delay: 1.2s; }
  .story-item:nth-child(7) { animation-delay: 1.4s; }
  .story-item:nth-child(8) { animation-delay: 1.6s; }

  .story-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: clamp(3px, 0.5vw, 5px);
    background: linear-gradient(90deg, 
      var(--olive-green),
      var(--moss-green),
      var(--olive-green)
    );
    opacity: 0.8;
    z-index: 2;
  }

  .story-item::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg,
      transparent,
      rgba(194, 168, 109, 0.1),
      transparent
    );
    transition: left 0.6s ease;
    z-index: 0;
  }

  .story-item:hover::after {
    left: 100%;
  }

  .story-item:hover {
    transform: translateY(-15px) scale(1.02);
    border-color: var(--soft-gold);
    box-shadow: 
      0 15px 40px rgba(110, 123, 91, 0.3),
      0 10px 25px rgba(194, 168, 109, 0.2),
      0 0 30px rgba(110, 123, 91, 0.1),
      0 0 0 2px rgba(194, 168, 109, 0.1) inset;
  }

  /* Story Title */
  .story-item h2 {
    color: var(--forest-green);
    font-size: clamp(1.3rem, 2.5vw, 1.6rem);
    margin-bottom: clamp(12px, 2vw, 15px);
    font-family: 'Kavivanar', 'Noto Sans Tamil', serif;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 1;
    line-height: 1.4;
    word-wrap: break-word;
    overflow-wrap: break-word;
    flex: 1;
  }

  .story-item h2 a {
    color: var(--forest-green);
    text-decoration: none;
    transition: var(--transition);
    display: flex;
    align-items: flex-start;
    position: relative;
    z-index: 1;
  }

  .story-item h2 a::before {
    content: "📖";
    margin-right: 12px;
    font-size: clamp(1.1rem, 2vw, 1.3rem);
    color: var(--olive-green);
    transition: var(--transition);
    animation: gentlePulse 4s ease-in-out infinite;
    flex-shrink: 0;
    margin-top: 2px;
  }

  .story-item:hover h2 a {
    color: var(--faded-black);
    text-shadow: 0 0 10px rgba(194, 168, 109, 0.2);
  }

  .story-item:hover h2 a::before {
    transform: scale(1.2) rotate(5deg);
    color: var(--soft-gold);
    animation: none;
  }

  /* Story Description */
  .story-item p {
    color: var(--faded-black);
    font-size: clamp(1rem, 1.8vw, 1.1rem);
    line-height: 1.8;
    margin: 0;
    padding-top: clamp(12px, 2vw, 15px);
    border-top: 2px solid var(--olive-green);
    transition: var(--transition);
    position: relative;
    z-index: 1;
  }

  .story-item:hover p {
    color: var(--charcoal);
    border-top-color: var(--soft-gold);
  }

  /* ===== CMS STORIES ===== */
  .story-item.cms-story {
    border-left: clamp(4px, 1vw, 6px) solid var(--moss-green);
    background: linear-gradient(145deg, 
      rgba(245, 245, 240, 0.95) 0%,
      rgba(230, 214, 184, 0.9) 100%
    );
  }

  .story-item.cms-story::before {
    background: linear-gradient(90deg, 
      var(--moss-green),
      var(--olive-green),
      var(--moss-green)
    );
  }

  .story-item.cms-story h2 a::before {
    content: "🆕";
  }

  .story-item.cms-story::after {
    content: "CMS";
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, var(--olive-green), var(--moss-green));
    color: var(--off-white);
    font-size: clamp(0.6rem, 1vw, 0.7rem);
    padding: 4px 12px;
    border-radius: 15px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    box-shadow: 0 3px 10px rgba(110, 123, 91, 0.3);
    z-index: 2;
    animation: gentlePulse 5s ease-in-out infinite;
  }

  /* ===== RESPONSIVE DESIGN ===== */

  /* Tablets and small desktops */
  @media (max-width: 1024px) {
    .story-list {
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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
    
    .story-list {
      grid-template-columns: 1fr;
      gap: 20px;
    }
    
    .story-item {
      padding: 20px;
    }
    
    .story-item h2 {
      font-size: 1.4rem;
    }
    
    .story-item p {
      font-size: 1rem;
    }
    
    .tamil-word {
      font-size: 1.8rem !important;
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
    
    .story-list {
      gap: 15px;
      margin-top: 20px;
    }
    
    .story-item {
      padding: 18px;
    }
    
    .story-item h2 {
      font-size: 1.25rem;
    }
    
    .story-item h2 a::before {
      margin-right: 10px;
      font-size: 1.1rem;
    }
    
    .story-item p {
      font-size: 0.95rem;
      padding-top: 15px;
    }
    
    .tamil-word {
      font-size: 1.5rem !important;
    }
    
    .glow-orb {
      opacity: 0.5;
    }
    
    /* Simplify hover effects on touch devices */
    @media (hover: none) {
      .story-item:hover {
        transform: none;
      }
      
      .story-item:hover h2 a::before {
        transform: none;
        animation: gentlePulse 4s ease-in-out infinite;
      }
      
      .container:hover {
        transform: none;
        box-shadow: 
          0 0 40px rgba(110, 123, 91, 0.4),
          0 0 100px rgba(194, 168, 109, 0.1) inset,
          0 20px 50px rgba(0, 0, 0, 0.3),
          0 0 0 1px rgba(230, 214, 184, 0.3) inset;
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
    
    .story-list {
      gap: 12px;
    }
    
    .story-item {
      padding: 15px;
    }
    
    .story-item h2 {
      font-size: 1.125rem;
    }
    
    .story-item p {
      font-size: 0.875rem;
      padding: 12px 0 0 0;
    }
    
    .story-item.cms-story::after {
      top: 10px;
      right: 10px;
      padding: 3px 10px;
      font-size: 0.6rem;
    }
    
    .tamil-word {
      font-size: 1.2rem !important;
    }
  }

  /* Height-based adjustments for landscape mobile */
  @media (max-height: 600px) and (orientation: landscape) {
    .container {
      margin: 20px auto;
      padding: 20px;
    }
    
    .story-list {
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
    }
    
    .story-item {
      padding: 15px;
    }
    
    .story-item h2 {
      font-size: 1.1rem;
      margin-bottom: 10px;
    }
    
    .story-item p {
      font-size: 0.875rem;
      padding-top: 10px;
    }
  }

  /* High-resolution displays */
  @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .story-item::before {
      height: 2px;
    }
    
    .story-item p {
      border-top-width: 1px;
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
    .glow-orbs,
    .floating-leaves,
    .tamil-words-bg,
    .container::after {
      animation: none !important;
    }
    
    .story-item {
      animation: fadeIn 0.3s ease-out !important;
    }
    
    .story-item h2 a::before,
    .story-item.cms-story::after {
      animation: none !important;
    }
  }

  /* Print-friendly styles */
  @media print {
    body {
      background: white !important;
      animation: none !important;
      color: black !important;
    }
    
    body::before,
    .tamil-words-bg,
    .vintage-border,
    .glow-orbs,
    .floating-leaves {
      display: none;
    }
    
    .container {
      box-shadow: none;
      border: 2px solid var(--olive-green);
      background: white;
      width: 100% !important;
      max-width: 100% !important;
      margin: 0 !important;
      padding: 20px !important;
    }
    
    .container::after {
      animation: none;
      display: none;
    }
    
    .story-list {
      display: block;
    }
    
    .story-item {
      break-inside: avoid;
      box-shadow: none !important;
      border: 1px solid var(--olive-green) !important;
      background: white !important;
      transform: none !important;
      margin-bottom: 20px;
    }
    
    .story-item h2 a {
      color: black !important;
    }
    
    .story-item h2 a::before {
      content: "•";
      color: black;
      animation: none;
    }
    
    .story-item p {
      color: #333 !important;
      border-top: 1px solid #ddd;
    }
    
    .story-item.cms-story::after {
      display: none;
    }
  }
  </style>
</head>
<body>

<!-- Enhanced Background Elements -->
<div class="glow-orbs">
  <div class="glow-orb"></div>
  <div class="glow-orb"></div>
  <div class="glow-orb"></div>
</div>

<div class="floating-leaves" id="floatingLeaves"></div>

<!-- Tamil Words Background -->
<div class="tamil-words-bg" id="tamilWordsBg">
  <!-- Tamil words will be generated dynamically by JavaScript -->
</div>

<!-- Vintage border -->
<div class="vintage-border"></div>

<?php 
// Include header and navbar
include '../includes/header.php'; 
include '../includes/navbar.php'; 
?>

<div class="container">
  <h1>📚 கதைகள்</h1>

  <div class="story-list">
    <!-- ================= EXISTING STATIC STORIES ================= -->
    <article class="story-item" aria-label="பேரறிஞர் அண்ணாதுரை வாழ்க்கையும் நாவன்மையும்">
      <h2>
        <a href="story-anna.php">
          பேரறிஞர் அண்ணாதுரை – வாழ்க்கையும் நாவன்மையும்
        </a>
      </h2>
      <p>
        அறிஞர் அண்ணாவின் வாழ்க்கை, அரசியல், தமிழ்ப்பணி,
        பேச்சாற்றல் மற்றும் சிந்தனைகள்.
      </p>
    </article>

    <article class="story-item" aria-label="சான்றோர் பொன்மொழிகள்">
      <h2>
        <a href="story-ponmozhigal.php">
          சான்றோர் பொன்மொழிகள்
        </a>
      </h2>
      <p>
        கலாம், புத்தர், விவேகானந்தர் உள்ளிட்ட
        மகான்களின் அரிய பொன்மொழிகள்.
      </p>
    </article>

    <article class="story-item" aria-label="பொன் வாசகங்கள்">
      <h2>
        <a href="story-ponvasagam.php">
          வாய்மணக்க வாய்த்த பொன் வாசகங்கள்
        </a>
      </h2>
      <p>
        வாழ்க்கை தத்துவங்களை உணர்த்தும்
        ஆழமான சிந்தனை வாசகங்கள்.
      </p>
    </article>

    <article class="story-item" aria-label="இந்திய அஞ்சல் தலைகளில் தமிழர்கள்">
      <h2>
        <a href="story-stamps.php">
          இந்திய அஞ்சல் தலைகளில் தமிழர்கள்
        </a>
      </h2>
      <p>
        இந்திய அஞ்சல் தலைகளில் இடம்பெற்ற
        தமிழர்களின் வரலாறு.
      </p>
    </article>

    <article class="story-item" aria-label="நம்புங்கள்… நீங்கள் நம்பியே ஆகவேண்டும்">
      <h2>
        <a href="story-nambungal.php">
          நம்புங்கள்… நீங்கள் நம்பியே ஆகவேண்டும்!
        </a>
      </h2>
      <p>
        ஆச்சரியமான தகவல்கள், நம்ப முடியாத
        உண்மைகள் மற்றும் அறிவியல் குறிப்புகள்.
      </p>
    </article>

    <article class="story-item" aria-label="தமிழ்ச் சொற்களின் ஆழம்">
      <h2>
        <a href="story-tamil-words.php">
          தமிழ்ச் சொற்களின் ஆழம்
        </a>
      </h2>
      <p>
        சொற்களின் வேர்ச்சொல், பொருள்,
        பண்பாட்டு விளக்கங்கள்.
      </p>
    </article>

    <article class="story-item" aria-label="சிலேடை – தமிழின் மொழி அழகு">
      <h2>
        <a href="story-siledai.php">
          சிலேடை – தமிழின் மொழி அழகு
        </a>
      </h2>
      <p>
        ஒரே சொல்லில் பல பொருள் தரும்
        சிலேடை அணி பற்றிய விளக்கம்.
      </p>
    </article>

    <article class="story-item" aria-label="ஆய்த எழுத்து வரலாறும் பயன்பாடும்">
      <h2>
        <a href="story-aytham.php">
          ஆய்த எழுத்து ஃ – வரலாறும் பயன்பாடும்
        </a>
      </h2>
      <p>
        தமிழ் மொழியின் தனித்துவமான
        ஆய்த எழுத்தின் வரலாறு.
      </p>
    </article>

    <!-- ================= CMS STORIES ================= -->
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <article class="story-item cms-story" aria-label="<?php echo htmlspecialchars($row['title']); ?>">
          <h2>
            <a href="story.php?slug=<?php echo htmlspecialchars($row['slug']); ?>">
              <?php echo htmlspecialchars($row['title']); ?>
            </a>
          </h2>
          <p>
            <?php echo htmlspecialchars($row['summary']); ?>
          </p>
        </article>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
// Tamil words for animation
const tamilWords = [
  'கதை', 'இலக்கியம்', 'சிந்தனை', 'அனுபவம்', 'ஞானம்', 'பாரம்பரியம்',
  'கலாச்சாரம்', 'வரலாறு', 'அறிவு', 'மரபு', 'பண்பாடு', 'மொழி',
  'பொக்கிஷம்', 'கல்வி', 'அன்பு', 'உண்மை', 'நேர்மை', 'தியாகம்',
  'வீரம்', 'மதிப்பு', 'ஒற்றுமை', 'சுதந்திரம்', 'கொடை', 'தன்னம்பிக்கை',
  'அமைதி', 'சிரிப்பு', 'நம்பிக்கை', 'ஆசை', 'இலட்சியம்', 'வெற்றி',
  'முயற்சி', 'கனவு', 'விழிப்பு', 'சாதனை', 'புத்தி', 'உதவி',
  'நன்றி', 'மரியாதை', 'பொறுமை', 'விடாமுயற்சி', 'உழைப்பு', 'தமிழ்',
  'தாய்மொழி', 'எழுத்து', 'வாசகம்', 'புத்தகம்', 'அறிஞர்', 'கவிஞர்',
  'எழுத்தாளர்', 'படைப்பு', 'கற்பனை', 'யதார்த்தம்', 'உணர்ச்சி', 'அழகு',
  'இசை', 'கலை', 'சிற்பம்', 'ஓவியம்', 'நாடகம்', 'திரைப்படம்'
];

// Leaf characters with colors
const leaves = [
  { char: '❖', color: '#6E7B5B' }, // Olive Green
  { char: '✦', color: '#8A946E' }, // Moss Green
  { char: '❧', color: '#C2A86D' }, // Soft Gold
  { char: '♣', color: '#3F4A3C' }, // Forest Green
  { char: '✽', color: '#7A6A55' }, // Dusty Brown
  { char: '✤', color: '#E6D6B8' }  // Parchment
];

// Create floating Tamil words
function createTamilWords() {
  const container = document.getElementById('tamilWordsBg');
  
  // Adjust number of words based on screen size
  const wordCount = window.innerWidth < 768 ? 30 : 50;
  
  for (let i = 0; i < wordCount; i++) {
    const word = tamilWords[Math.floor(Math.random() * tamilWords.length)];
    const wordElement = document.createElement('div');
    wordElement.className = 'tamil-word';
    wordElement.textContent = word;
    wordElement.setAttribute('aria-hidden', 'true');
    
    // Random properties for each word
    const startX = Math.random() * 100;
    const endX = startX + (Math.random() * 30 - 15);
    const rotation = (Math.random() * 20 - 10);
    const duration = 20 + Math.random() * 25; // 20-45 seconds
    const delay = Math.random() * 30;
    const size = 1.5 + Math.random() * 2.5; // 1.5-4rem
    const opacity = 0.05 + Math.random() * 0.1; // 0.05-0.15
    
    wordElement.style.cssText = `
      --start-x: ${startX}%;
      --end-x: ${endX}%;
      --rotation: ${rotation}deg;
      --duration: ${duration}s;
      --delay: ${delay}s;
      --size: ${size}rem;
      --opacity: ${opacity};
      left: ${startX}%;
      top: ${100 + Math.random() * 20}%;
      color: rgba(${Math.floor(Math.random() * 50 + 100)}, ${Math.floor(Math.random() * 50 + 120)}, ${Math.floor(Math.random() * 50 + 80)}, ${opacity});
    `;
    
    container.appendChild(wordElement);
  }
}

// Create floating leaves
function createFloatingLeaves() {
  const container = document.getElementById('floatingLeaves');
  
  // Adjust number of leaves based on screen size
  const leafCount = window.innerWidth < 768 ? 20 : 30;
  
  for (let i = 0; i < leafCount; i++) {
    const leaf = leaves[Math.floor(Math.random() * leaves.length)];
    const leafElement = document.createElement('div');
    leafElement.className = 'leaf';
    leafElement.textContent = leaf.char;
    leafElement.setAttribute('aria-hidden', 'true');
    
    // Random properties for each leaf
    const startX = Math.random() * 100;
    const duration = 25 + Math.random() * 20; // 25-45 seconds
    const delay = Math.random() * 30;
    const size = 1 + Math.random() * 2; // 1-3rem
    const opacity = 0.1 + Math.random() * 0.2; // 0.1-0.3
    const scale = 0.7 + Math.random() * 0.6; // 0.7-1.3
    
    leafElement.style.cssText = `
      --leaf-x: ${startX}%;
      --leaf-duration: ${duration}s;
      --leaf-delay: ${delay}s;
      --leaf-size: ${size}rem;
      --leaf-opacity: ${opacity};
      --leaf-scale: ${scale};
      --leaf-color: ${leaf.color};
      left: ${startX}%;
      top: ${100 + Math.random() * 30}%;
    `;
    
    container.appendChild(leafElement);
  }
}

document.addEventListener('DOMContentLoaded', function() {
  // Console message
  console.log('%c📚 கதைகள் - Tamil Stories Collection', 'color: #4b2e1e; font-size: 14px; font-weight: bold;');
  console.log('%cExplore timeless Tamil stories and literature', 'color: #666;');
  
  // Create Tamil words animation
  createTamilWords();
  
  // Create floating leaves
  createFloatingLeaves();
  
  // Add scroll animations for story items
  const storyItems = document.querySelectorAll('.story-item');
  
  storyItems.forEach(item => {
    item.classList.add('fade-in');
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
        // Add a slight delay between each item for better visual effect
        const delay = Array.from(storyItems).indexOf(entry.target) * 100;
        setTimeout(() => {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }, delay);
      }
    });
  }, observerOptions);
  
  storyItems.forEach(item => {
    observer.observe(item);
  });
  
  // Enhanced hover effect to container
  const container = document.querySelector('.container');
  if (window.matchMedia("(hover: hover)").matches) {
    container.addEventListener('mouseenter', function() {
      this.style.boxShadow = 
        '0 0 50px rgba(110, 123, 91, 0.5), ' +
        '0 0 120px rgba(194, 168, 109, 0.2) inset, ' +
        '0 20px 60px rgba(0, 0, 0, 0.4), ' +
        '0 0 0 2px rgba(194, 168, 109, 0.2) inset';
      this.style.transform = 'translateY(-8px)';
    });
    
    container.addEventListener('mouseleave', function() {
      this.style.boxShadow = 
        '0 0 40px rgba(110, 123, 91, 0.4), ' +
        '0 0 100px rgba(194, 168, 109, 0.1) inset, ' +
        '0 20px 50px rgba(0, 0, 0, 0.3), ' +
        '0 0 0 1px rgba(230, 214, 184, 0.3) inset';
      this.style.transform = 'translateY(0)';
    });
  }
  
  // Page load animation
  document.body.style.opacity = 0;
  document.body.style.transform = 'translateY(20px)';
  window.requestAnimationFrame(() => {
    document.body.style.transition = 'all 1.5s ease';
    document.body.style.opacity = 1;
    document.body.style.transform = 'translateY(0)';
  });
  
  // Add subtle movement to Tamil words and leaves on scroll
  window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const tamilWords = document.querySelectorAll('.tamil-word');
    const floatingLeaves = document.querySelectorAll('.leaf');
    
    tamilWords.forEach((word, index) => {
      const speed = 0.2 + (index % 10) * 0.05;
      word.style.transform = `translateY(${scrolled * speed * -0.3}px)`;
    });
    
    floatingLeaves.forEach((leaf, index) => {
      const speed = 0.15 + (index % 8) * 0.04;
      leaf.style.transform = `translateY(${scrolled * speed * -0.2}px)`;
    });
  });
  
  // Periodically refresh some Tamil words and leaves for variety
  setInterval(() => {
    // Refresh random Tamil word
    const words = document.querySelectorAll('.tamil-word');
    if (words.length > 0) {
      const randomIndex = Math.floor(Math.random() * words.length);
      const word = words[randomIndex];
      
      const newWord = tamilWords[Math.floor(Math.random() * tamilWords.length)];
      word.textContent = newWord;
      word.style.color = `rgba(${Math.floor(Math.random() * 50 + 100)}, ${Math.floor(Math.random() * 50 + 120)}, ${Math.floor(Math.random() * 50 + 80)}, ${word.style.getPropertyValue('--opacity')})`;
    }
    
    // Refresh random leaf
    const leavesElements = document.querySelectorAll('.leaf');
    if (leavesElements.length > 0) {
      const randomLeafIndex = Math.floor(Math.random() * leavesElements.length);
      const leaf = leavesElements[randomLeafIndex];
      const newLeaf = leaves[Math.floor(Math.random() * leaves.length)];
      
      leaf.textContent = newLeaf.char;
      leaf.style.setProperty('--leaf-color', newLeaf.color);
    }
  }, 8000); // Change every 8 seconds
  
  // Add ripple effect to story items on click
  storyItems.forEach(item => {
    item.addEventListener('click', function(e) {
      const ripple = document.createElement('span');
      const rect = this.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height);
      const x = e.clientX - rect.left - size / 2;
      const y = e.clientY - rect.top - size / 2;
      
      ripple.style.cssText = `
        position: absolute;
        border-radius: 50%;
        background: rgba(110, 123, 91, 0.1);
        transform: scale(0);
        animation: ripple 0.6s linear;
        width: ${size}px;
        height: ${size}px;
        top: ${y}px;
        left: ${x}px;
        pointer-events: none;
        z-index: 0;
      `;
      
      this.appendChild(ripple);
      
      setTimeout(() => {
        ripple.remove();
      }, 600);
    });
    
    // Add keyboard navigation
    item.setAttribute('tabindex', '0');
    item.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        const link = this.querySelector('a');
        if (link) link.click();
      }
    });
  });
  
  // Add touch feedback for mobile
  storyItems.forEach(item => {
    item.addEventListener('touchstart', function() {
      this.style.transform = 'translateY(-8px) scale(0.98)';
    }, { passive: true });
    
    item.addEventListener('touchend', function() {
      this.style.transform = '';
    }, { passive: true });
  });
  
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
      
      // Clear and recreate background elements
      document.getElementById('tamilWordsBg').innerHTML = '';
      document.getElementById('floatingLeaves').innerHTML = '';
      createTamilWords();
      createFloatingLeaves();
    }, 250);
  });
  
  // Initialize container width
  const initContainer = document.querySelector('.container');
  if (window.innerWidth < 576) {
    initContainer.style.width = '95%';
  } else if (window.innerWidth < 768) {
    initContainer.style.width = '92%';
  }
  
  // Performance optimization: Reduce animations for users who prefer reduced motion
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