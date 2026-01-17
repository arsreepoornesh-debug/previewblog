<?php
// pages/connect.php
include '../includes/header.php';
include '../includes/navbar.php';
?>

<!-- Background Elements -->
<div class="vintage-border"></div>
<div class="tamil-pattern"></div>

<!-- Floating Tamil decorative elements -->
<div class="floating-element floating-tamil-1">த</div>
<div class="floating-element floating-tamil-2">மி</div>
<div class="floating-element floating-tamil-3">ழ்</div>

<!-- Corner decorations -->
<div class="corner-decoration corner-top-left"></div>
<div class="corner-decoration corner-top-right"></div>
<div class="corner-decoration corner-bottom-left"></div>
<div class="corner-decoration corner-bottom-right"></div>

<div class="container">

  <h1>🤝 தொடர்பில் இருங்கள்</h1>

  <section class="story-content">

    <p class="intro-text">
      எண்ணங்களால், எழுத்துகளால்,
      மொழியால் நாம் நண்பர்களாகலாம்.
      உங்களுடன் இணைவதில் மகிழ்ச்சி.
    </p>

    <!-- Connection Grid -->
    <div class="connection-grid">
      
      <!-- Email -->
      <div class="connection-card email-card">
        <div class="card-icon">📧</div>
        <div class="card-content">
          <h3>மின்னஞ்சல்</h3>
          <p>Send your thoughts, feedback, or collaboration ideas</p>
          <a href="mailto:nsnarayanan57@gmail.com" class="card-link">
            nsnarayanan57@gmail.com
          </a>
        </div>
      </div>
      
      <!-- Facebook (Primary Connect) -->
      <div class="connection-card facebook-card highlight">
        <div class="card-icon">📘</div>
        <div class="card-content">
          <h3>முகநூல்</h3>
          <p>Connect with me on Facebook for updates and discussions</p>
          <a href="https://www.facebook.com/share/1AL7YmyVZy/" 
             target="_blank" 
             class="card-link">
            👉 நண்பராக இணைவோம்
          </a>
        </div>
      </div>
      
      <!-- YouTube -->
      <div class="connection-card youtube-card">
        <div class="card-icon">▶</div>
        <div class="card-content">
          <h3>காணொளி மேடை</h3>
          <p>Watch Tamil videos and subscribe for more content</p>
          <a href="https://youtube.com/@n.s.narayanan?si=XJdIa7EtDryfLwfI" 
             target="_blank" 
             class="card-link">
            👉 தமிழ் காணொளிகள்
          </a>
        </div>
      </div>
      
      <!-- Instagram -->
      <div class="connection-card instagram-card">
        <div class="card-icon">📸</div>
        <div class="card-content">
          <h3>படவரி</h3>
          <p>Follow for Tamil moments and visual stories</p>
          <a href="https://www.instagram.com/nsnofficial_1957?igsh=NWwzOHl5MXBtMmRt" 
             target="_blank" 
             class="card-link">
            👉 தருணங்களைப் பகிருங்கள்
          </a>
        </div>
      </div>
      
    </div>

    <div class="note">
      "நட்பு என்பது தொடர்ச்சியான உரையாடல்."
      <br>
      தமிழ் வழியாக தொடர்வோம்.
    </div>

  </section>

</div>

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
  --facebook-blue: #1877F2;
  --youtube-red: #FF0000;
  --instagram-purple: #E4405F;
  --email-orange: #EA4335;
  --shadow: rgba(0, 0, 0, 0.15);
  --shadow-lg: rgba(0, 0, 0, 0.25);
  --radius: 12px;
  --radius-sm: 8px;
  --radius-lg: 16px;
  --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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

@keyframes shimmer {
  0% { background-position: -1000px 0; }
  100% { background-position: 1000px 0; }
}

@keyframes twinkle {
  0%, 100% { opacity: 0.1; }
  50% { opacity: 0.4; }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeInParagraph {
  to {
    opacity: 1;
    transform: translateY(0);
  }
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

@keyframes floatSlow {
  0% {
    transform: translate(0, 0) rotate(0deg) scale(1);
  }
  25% {
    transform: translate(20px, 30px) rotate(5deg) scale(1.1);
  }
  50% {
    transform: translate(0, 60px) rotate(0deg) scale(1);
  }
  75% {
    transform: translate(-20px, 30px) rotate(-5deg) scale(1.1);
  }
  100% {
    transform: translate(0, 0) rotate(0deg) scale(1);
  }
}

@keyframes floatSlowReverse {
  0% {
    transform: translate(0, 0) rotate(0deg) scale(1);
  }
  25% {
    transform: translate(-30px, 20px) rotate(-5deg) scale(1.1);
  }
  50% {
    transform: translate(0, 40px) rotate(0deg) scale(1);
  }
  75% {
    transform: translate(30px, 20px) rotate(5deg) scale(1.1);
  }
  100% {
    transform: translate(0, 0) rotate(0deg) scale(1);
  }
}

@keyframes cardHover {
  from {
    transform: translateY(0);
    box-shadow: 0 10px 20px var(--shadow);
  }
  to {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px var(--shadow-lg);
  }
}

/* ===== BASE STYLES ===== */
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
  font-family: 'Georgia', 'serif', 'Latha', 'Tamil Sangam MN', 'Noto Sans Tamil', sans-serif;
  line-height: 1.6;
  overflow-x: hidden;
  position: relative;
  min-height: 100vh;
  margin: 0;
  padding: 0;
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

/* ===== MAIN CONTAINER ===== */
.container {
  max-width: 1200px;
  margin: 0 auto;
  background-color: var(--parchment);
  position: relative;
  box-shadow: 
    0 0 40px rgba(0, 0, 0, 0.5),
    0 0 100px rgba(194, 168, 109, 0.1) inset;
  border: 1px solid var(--dusty-brown);
  margin-top: 60px;
  margin-bottom: 30px;
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

/* ===== HEADER ===== */
h1 {
  text-align: center;
  color: var(--forest-green);
  font-size: clamp(2rem, 5vw, 3rem);
  margin: clamp(20px, 3vw, 30px) 0;
  padding-bottom: clamp(15px, 2vw, 20px);
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

h1::before, h1::after {
  content: '✻';
  color: var(--soft-gold);
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  font-size: clamp(1.5rem, 3vw, 2rem);
  animation: twinkle 2s infinite;
}

h1::before {
  left: clamp(10px, 3vw, 20px);
  animation-delay: 0.5s;
}

h1::after {
  right: clamp(10px, 3vw, 20px);
  animation-delay: 1s;
}

/* ===== INTRO TEXT ===== */
.intro-text {
  text-align: center;
  color: #4a2c0a;
  line-height: 1.8;
  margin-bottom: clamp(30px, 4vw, 50px);
  padding: clamp(15px, 3vw, 25px);
  background: linear-gradient(to right, transparent, var(--light-cream), transparent);
  border-left: 3px solid var(--moss-green);
  border-right: 3px solid var(--moss-green);
  border-radius: var(--radius);
  animation: fadeInParagraph 1s ease-out forwards;
  opacity: 0;
  transform: translateY(15px);
  font-size: clamp(1rem, 2vw, 1.15rem);
}

/* ===== CONNECTION GRID ===== */
.connection-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: clamp(20px, 3vw, 30px);
  margin: clamp(30px, 4vw, 50px) 0;
}

/* Connection Cards */
.connection-card {
  background: linear-gradient(135deg, var(--light-cream) 0%, var(--parchment) 100%);
  border-radius: var(--radius);
  padding: clamp(20px, 3vw, 30px);
  box-shadow: 0 10px 20px var(--shadow);
  transition: var(--transition);
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(139, 69, 19, 0.1);
  animation: fadeInUp 0.8s ease-out forwards;
  opacity: 0;
  transform: translateY(20px);
  display: flex;
  flex-direction: column;
  height: 100%;
}

.connection-card:nth-child(1) { animation-delay: 0.2s; }
.connection-card:nth-child(2) { animation-delay: 0.4s; }
.connection-card:nth-child(3) { animation-delay: 0.6s; }
.connection-card:nth-child(4) { animation-delay: 0.8s; }

.connection-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--moss-green), var(--soft-gold));
}

.connection-card:hover {
  animation: cardHover 0.3s ease-out forwards;
  z-index: 10;
}

/* Highlighted Card */
.connection-card.highlight {
  background: linear-gradient(135deg, #f3e2c7 0%, #e8d4b5 100%);
  border: 2px solid var(--olive-green);
  box-shadow: 0 15px 30px rgba(110, 123, 91, 0.2);
}

.connection-card.highlight::before {
  height: 6px;
  background: linear-gradient(90deg, var(--olive-green), var(--forest-green));
}

/* Platform-specific colors */
.email-card::before { background: linear-gradient(90deg, var(--email-orange), #FF6B6B); }
.facebook-card::before { background: linear-gradient(90deg, var(--facebook-blue), #4267B2); }
.youtube-card::before { background: linear-gradient(90deg, var(--youtube-red), #FF3333); }
.instagram-card::before { background: linear-gradient(90deg, var(--instagram-purple), #C13584); }

/* Card Icon */
.card-icon {
  font-size: clamp(2.5rem, 5vw, 3.5rem);
  margin-bottom: clamp(15px, 2vw, 20px);
  text-align: center;
  transition: var(--transition);
}

.connection-card:hover .card-icon {
  transform: scale(1.2) rotate(5deg);
}

/* Card Content */
.card-content {
  flex: 1;
}

.card-content h3 {
  color: var(--forest-green);
  font-size: clamp(1.25rem, 3vw, 1.5rem);
  margin: 0 0 clamp(10px, 1.5vw, 15px) 0;
  font-weight: 700;
  font-family: 'Kavivanar', 'Noto Sans Tamil', serif;
}

.card-content p {
  color: #666;
  font-size: clamp(0.875rem, 1.5vw, 1rem);
  line-height: 1.5;
  margin: 0 0 clamp(15px, 2vw, 20px) 0;
  opacity: 0.9;
}

/* Card Link */
.card-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  color: var(--olive-green);
  text-decoration: none;
  font-weight: 600;
  font-size: clamp(0.875rem, 1.5vw, 1rem);
  padding: clamp(10px, 1.5vw, 14px) clamp(15px, 2vw, 20px);
  background: rgba(139, 69, 19, 0.1);
  border-radius: var(--radius-sm);
  transition: var(--transition);
  border: 1px solid rgba(139, 69, 19, 0.2);
  width: 100%;
  text-align: center;
  margin-top: auto;
}

.card-link:hover {
  background: rgba(139, 69, 19, 0.2);
  color: var(--forest-green);
  transform: translateY(-3px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  text-decoration: none;
}

/* Platform-specific link colors */
.email-card .card-link { background: rgba(234, 67, 53, 0.1); border-color: rgba(234, 67, 53, 0.2); }
.facebook-card .card-link { background: rgba(24, 119, 242, 0.1); border-color: rgba(24, 119, 242, 0.2); }
.youtube-card .card-link { background: rgba(255, 0, 0, 0.1); border-color: rgba(255, 0, 0, 0.2); }
.instagram-card .card-link { background: rgba(228, 64, 95, 0.1); border-color: rgba(228, 64, 95, 0.2); }

/* ===== FOOTNOTE ===== */
.note {
  margin-top: clamp(40px, 5vw, 60px);
  text-align: center;
  font-size: clamp(1rem, 2vw, 1.2rem);
  color: var(--dusty-brown);
  padding: clamp(20px, 3vw, 30px);
  font-style: italic;
  border-top: 1px dashed var(--soft-gold);
  animation: fadeInParagraph 1s ease-out forwards;
  opacity: 0;
  transform: translateY(15px);
  animation-delay: 1s;
  background: linear-gradient(to right, transparent, rgba(212, 167, 98, 0.05), transparent);
  border-radius: var(--radius);
}

/* ===== DECORATIVE ELEMENTS ===== */
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
  height: clamp(15px, 3vw, 20px);
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
  height: clamp(15px, 3vw, 20px);
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

/* Tamil pattern overlay */
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

/* Floating elements */
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

/* ===== RESPONSIVE DESIGN ===== */

/* Tablets and small desktops */
@media (max-width: 1024px) {
  .connection-grid {
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
    margin-top: 50px;
  }
  
  h1::before, h1::after {
    display: none;
  }
  
  .connection-grid {
    grid-template-columns: 1fr;
    gap: 20px;
  }
  
  .floating-element {
    font-size: clamp(3rem, 8vw, 5rem);
  }
  
  .corner-decoration {
    width: 40px;
    height: 40px;
  }
  
  .connection-card {
    padding: 20px;
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
  
  h1 {
    font-size: 1.75rem;
    margin: 15px 0 20px;
    padding-bottom: 12px;
    -webkit-text-fill-color: var(--forest-green);
    background: none;
  }
  
  .intro-text {
    padding: 15px;
    margin-bottom: 25px;
    font-size: 0.95rem;
  }
  
  .connection-grid {
    gap: 15px;
  }
  
  .connection-card {
    padding: 18px;
  }
  
  .card-icon {
    font-size: 2.5rem;
    margin-bottom: 15px;
  }
  
  .card-content h3 {
    font-size: 1.25rem;
  }
  
  .card-content p {
    font-size: 0.875rem;
  }
  
  .card-link {
    padding: 12px 16px;
    font-size: 0.875rem;
  }
  
  .note {
    padding: 20px;
    font-size: 1rem;
    margin-top: 40px;
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
    .connection-card:hover {
      transform: none;
      animation: none;
    }
    
    .card-link:hover {
      transform: none;
      box-shadow: none;
    }
    
    .container:hover {
      box-shadow: 
        0 0 40px rgba(0, 0, 0, 0.5),
        0 0 100px rgba(194, 168, 109, 0.1) inset;
    }
  }
}

/* Extra small devices (phones in portrait) */
@media (max-width: 400px) {
  .container {
    padding: 15px;
    width: 98%;
  }
  
  h1 {
    font-size: 1.5rem;
  }
  
  .intro-text {
    font-size: 0.875rem;
    padding: 12px;
  }
  
  .connection-card {
    padding: 15px;
  }
  
  .card-icon {
    font-size: 2rem;
  }
  
  .card-content h3 {
    font-size: 1.125rem;
  }
  
  .card-link {
    padding: 10px 14px;
    font-size: 0.8125rem;
  }
  
  .floating-element {
    font-size: 2rem;
  }
}

/* Height-based adjustments for landscape mobile */
@media (max-height: 500px) and (orientation: landscape) {
  .container {
    margin: 20px auto;
    padding: 20px;
  }
  
  .connection-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
  }
  
  .connection-card {
    padding: 15px;
  }
}

/* High-resolution displays */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .connection-card::before {
    height: 3px;
  }
  
  .card-link {
    border-width: 1px;
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
  .container::after {
    animation: none !important;
  }
  
  .floating-particle {
    animation: none !important;
    opacity: 0.1;
  }
  
  .connection-card {
    animation: fadeIn 0.3s ease-out !important;
  }
}

/* Print-friendly styles */
@media print {
  .vintage-border, 
  .tamil-pattern, 
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
  
  h1 {
    color: black !important;
    -webkit-text-fill-color: black !important;
    background: none !important;
    border-bottom: 2px solid #333;
  }
  
  .intro-text {
    color: black !important;
    background: none !important;
    border: 1px solid #ddd;
  }
  
  .connection-card {
    box-shadow: none !important;
    border: 1px solid #ddd !important;
    break-inside: avoid;
  }
  
  .connection-card:hover,
  .card-link:hover {
    transform: none !important;
    box-shadow: none !important;
  }
  
  .card-link {
    background: none !important;
    border: 1px solid #333 !important;
    color: black !important;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Add fade-in class to cards
  const cards = document.querySelectorAll('.connection-card');
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
      }
    });
  }, observerOptions);
  
  cards.forEach(card => {
    observer.observe(card);
  });
  
  // Add intro text animation
  const introText = document.querySelector('.intro-text');
  const noteText = document.querySelector('.note');
  
  if (introText) introText.classList.add('fade-in');
  if (noteText) noteText.classList.add('fade-in');
  
  observer.observe(introText);
  observer.observe(noteText);
  
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
    const particleCount = window.innerWidth < 768 ? 10 : 20;
    const colors = ['#C2A86D', '#6E7B5B', '#8A946E'];
    
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
      const rate = scrolled * -0.5;
      const floatingElements = document.querySelectorAll('.floating-element');
      
      floatingElements.forEach((el, index) => {
        const speed = index === 0 ? 0.5 : index === 1 ? 0.3 : 0.7;
        el.style.transform = `translateY(${rate * speed}px)`;
      });
    });
  }
  
  // Add ripple effect to card links
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
  
  // Apply ripple effect to all card links
  document.querySelectorAll('.card-link').forEach(addRippleEffect);
  
  // Add CSS for ripple effect
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
      transform: translateY(20px);
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
  
  // Console message
  console.log('%c🤝 தொடர்பில் இருங்கள்', 'color: #4b2e1e; font-size: 14px; font-weight: bold;');
  console.log('%cConnect with us through various platforms', 'color: #666;');
});
</script>

<?php
include '../includes/footer.php';
?>