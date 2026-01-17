<?php
// DB optional – future CMS use
// include 'includes/db.php';
?>

<?php include 'includes/header.php'; ?>

<style>
/* Updated Vintage Tamil-inspired CSS with enhanced color palette and animations */
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
}

/* Animated Gradient Background */
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

/* Base styles */
html {
  font-size: 100%;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
}

body {
  background: 
    linear-gradient(-45deg, var(--charcoal), var(--faded-black), var(--forest-green), var(--dusty-brown));
  background-size: 400% 400%;
  animation: gradientFlow 20s ease infinite;
  color: var(--off-white);
  font-family: 'Georgia', 'serif', 'Latha', 'Tamil Sangam MN', 'Noto Sans Tamil', 'Tiro Tamil', sans-serif;
  line-height: 1.6;
  overflow-x: hidden;
  position: relative;
  min-height: 100vh;
  width: 100%;
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

.container {
  max-width: 1000px;
  margin: 0 auto;
  background-color: var(--parchment);
  position: relative;
  box-shadow: 
    0 0 40px rgba(0, 0, 0, 0.5),
    0 0 100px rgba(194, 168, 109, 0.1) inset;
  border: 1px solid var(--dusty-brown);
  margin-top: 30px;
  margin-bottom: 30px;
  border-radius: 3px;
  padding: 30px;
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

/* Tamil-inspired header with enhanced styling */
h1 {
  text-align: center;
  color: var(--forest-green);
  font-size: 3.2rem;
  margin: 30px 0 40px;
  padding-bottom: 15px;
  border-bottom: 3px double var(--soft-gold);
  font-family: 'Kavivanar', 'Latha', 'Georgia', 'Noto Sans Tamil', 'Tiro Tamil', serif;
  position: relative;
  text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.1);
  animation: titleGlow 3s ease-in-out infinite alternate;
  background: linear-gradient(90deg, var(--forest-green), var(--olive-green), var(--forest-green));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  word-wrap: break-word;
  overflow-wrap: break-word;
  line-height: 1.3;
}

h1::before, h1::after {
  content: '✻';
  color: var(--soft-gold);
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  font-size: 2rem;
  animation: twinkle 2s infinite;
}

h1::before {
  left: 20px;
  animation-delay: 0.5s;
}

h1::after {
  right: 20px;
  animation-delay: 1s;
}

/* Story content styling */
.story-content {
  position: relative;
  font-size: 1.15rem;
  text-align: justify;
  color: var(--faded-black);
  hyphens: auto;
  -webkit-hyphens: auto;
  -ms-hyphens: auto;
  word-wrap: break-word;
  overflow-wrap: break-word;
}

.story-content p {
  margin-bottom: 25px;
  padding: 15px;
  animation: fadeInParagraph 1s ease-out forwards;
  opacity: 0;
  transform: translateY(15px);
  background: linear-gradient(to right, transparent, var(--light-cream), transparent);
  border-left: 3px solid var(--moss-green);
  border-radius: 0 5px 5px 0;
  transition: all 0.3s ease;
  line-height: 1.7;
}

.story-content p:hover {
  background: linear-gradient(to right, transparent, var(--muted-beige), transparent);
  transform: translateX(5px);
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

/* Stagger the paragraph animations */
.story-content p:nth-child(1) { animation-delay: 0.3s; }
.story-content p:nth-child(2) { animation-delay: 0.5s; }
.story-content p:nth-child(3) { animation-delay: 0.7s; }
.story-content p:nth-child(4) { animation-delay: 0.9s; }
.story-content p:nth-child(5) { animation-delay: 1.1s; }
.story-content p:nth-child(6) { animation-delay: 1.3s; }
.story-content p:nth-child(7) { animation-delay: 1.5s; }
.story-content p:nth-child(8) { animation-delay: 1.7s; }
.story-content p:nth-child(9) { animation-delay: 1.9s; }
.story-content p:nth-child(10) { animation-delay: 2.1s; }
.story-content p:nth-child(11) { animation-delay: 2.3s; }
.story-content p:nth-child(12) { animation-delay: 2.5s; }
.story-content p:nth-child(13) { animation-delay: 2.7s; }
.story-content p:nth-child(14) { animation-delay: 2.9s; }
.story-content p:nth-child(15) { animation-delay: 3.1s; }
.story-content p:nth-child(16) { animation-delay: 3.3s; }
.story-content p:nth-child(17) { animation-delay: 3.5s; }
.story-content p:nth-child(18) { animation-delay: 3.7s; }

/* Enhanced decorative elements */
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

/* Enhanced Tamil pattern overlay */
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

/* Enhanced corner decorations */
.corner-decoration {
  position: absolute;
  width: 80px;
  height: 80px;
  z-index: 3;
  opacity: 0.8;
}

.corner-top-left {
  top: -5px;
  left: -5px;
  border-top: 3px solid var(--soft-gold);
  border-left: 3px solid var(--soft-gold);
  border-top-left-radius: 10px;
}

.corner-top-right {
  top: -5px;
  right: -5px;
  border-top: 3px solid var(--soft-gold);
  border-right: 3px solid var(--soft-gold);
  border-top-right-radius: 10px;
}

.corner-bottom-left {
  bottom: -5px;
  left: -5px;
  border-bottom: 3px solid var(--soft-gold);
  border-left: 3px solid var(--soft-gold);
  border-bottom-left-radius: 10px;
}

.corner-bottom-right {
  bottom: -5px;
  right: -5px;
  border-bottom: 3px solid var(--soft-gold);
  border-right: 3px solid var(--soft-gold);
  border-bottom-right-radius: 10px;
}

/* Enhanced floating elements */
.floating-element {
  position: fixed;
  opacity: 0.08;
  z-index: 0;
  font-size: 8rem;
  color: var(--olive-green);
  font-family: 'Kavivanar', 'Noto Sans Tamil', 'Tiro Tamil', serif;
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

/* Animations */
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

/* Scroll animation for paragraphs */
.fade-in {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.8s ease, transform 0.8s ease, background 0.3s ease;
}

.fade-in.visible {
  opacity: 1;
  transform: translateY(0);
}

/* ====================
   RESPONSIVE DESIGN
   ==================== */

/* Large desktops and laptops */
@media (min-width: 1201px) {
  .container {
    max-width: 1000px;
  }
}

/* Tablets landscape and small desktops */
@media (max-width: 1200px) and (min-width: 993px) {
  .container {
    max-width: 900px;
    margin: 25px auto;
    padding: 25px;
  }
  
  h1 {
    font-size: 2.8rem;
    margin: 25px 0 35px;
  }
  
  .floating-element {
    font-size: 6rem;
  }
}

/* Tablets portrait */
@media (max-width: 992px) and (min-width: 769px) {
  .container {
    max-width: 90%;
    margin: 20px auto;
    padding: 25px;
  }
  
  h1 {
    font-size: 2.5rem;
    margin: 20px 0 30px;
    padding-bottom: 12px;
  }
  
  h1::before, h1::after {
    font-size: 1.5rem;
  }
  
  .story-content {
    font-size: 1.1rem;
  }
  
  .story-content p {
    padding: 12px;
    margin-bottom: 20px;
  }
  
  .floating-element {
    font-size: 5rem;
  }
  
  .corner-decoration {
    width: 60px;
    height: 60px;
  }
}

/* Large smartphones */
@media (max-width: 768px) and (min-width: 577px) {
  .container {
    width: 92%;
    margin: 15px auto;
    padding: 20px;
    border-width: 2px;
  }
  
  h1 {
    font-size: 2.2rem;
    margin: 15px 0 25px;
    padding-bottom: 10px;
  }
  
  h1::before, h1::after {
    font-size: 1.2rem;
    top: 45%;
  }
  
  .story-content {
    font-size: 1.05rem;
    text-align: left;
  }
  
  .story-content p {
    padding: 10px;
    margin-bottom: 15px;
    line-height: 1.6;
  }
  
  .floating-element {
    font-size: 4rem;
  }
  
  .corner-decoration {
    width: 40px;
    height: 40px;
  }
  
  /* Adjust floating elements for tablets */
  .floating-tamil-1 {
    left: 2%;
  }
  
  .floating-tamil-2 {
    right: 3%;
  }
  
  .floating-tamil-3 {
    left: 5%;
  }
}

/* Small smartphones */
@media (max-width: 576px) {
  body {
    background-size: 300% 300%;
    animation: gradientFlow 15s ease infinite;
  }
  
  .container {
    width: 95%;
    margin: 10px auto;
    padding: 15px;
    border-width: 1px;
    box-shadow: 
      0 0 20px rgba(0, 0, 0, 0.3),
      0 0 60px rgba(194, 168, 109, 0.05) inset;
  }
  
  h1 {
    font-size: 1.8rem;
    margin: 10px 0 20px;
    padding-bottom: 8px;
    line-height: 1.2;
    -webkit-text-fill-color: var(--forest-green);
    background: none;
  }
  
  h1::before, h1::after {
    display: none; /* Hide decorative elements on very small screens */
  }
  
  .story-content {
    font-size: 1rem;
    text-align: left;
    line-height: 1.5;
  }
  
  .story-content p {
    padding: 8px;
    margin-bottom: 12px;
    line-height: 1.5;
    border-left-width: 2px;
  }
  
  .floating-element {
    font-size: 2.5rem;
    opacity: 0.05;
  }
  
  .corner-decoration {
    width: 30px;
    height: 30px;
    border-width: 2px;
  }
  
  /* Adjust floating elements for mobile */
  .floating-tamil-1 {
    top: 10%;
    left: 1%;
  }
  
  .floating-tamil-2 {
    top: 70%;
    right: 2%;
  }
  
  .floating-tamil-3 {
    bottom: 10%;
    left: 3%;
  }
  
  /* Reduce animation intensity on mobile */
  body::before {
    opacity: 0.08;
  }
  
  .tamil-pattern {
    opacity: 0.15;
  }
  
  /* Simplify hover effects on touch devices */
  @media (hover: none) {
    .story-content p:hover {
      transform: none;
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
    padding: 12px;
  }
  
  h1 {
    font-size: 1.5rem;
    margin: 8px 0 15px;
  }
  
  .story-content {
    font-size: 0.95rem;
  }
  
  .story-content p {
    padding: 6px;
    margin-bottom: 10px;
  }
  
  .floating-element {
    font-size: 2rem;
  }
}

/* Height-based adjustments for landscape mobile */
@media (max-height: 500px) and (orientation: landscape) {
  .container {
    margin: 10px auto;
    padding: 15px;
  }
  
  h1 {
    font-size: 1.8rem;
    margin: 10px 0 15px;
  }
  
  .story-content p {
    padding: 8px;
    margin-bottom: 10px;
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
  
  .story-content p:hover {
    transform: none !important;
    box-shadow: none !important;
  }
  
  h1 {
    color: black !important;
    -webkit-text-fill-color: black !important;
    background: none !important;
  }
  
  .story-content {
    color: black !important;
  }
}

/* High-resolution displays */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .story-content p {
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
  
  body {
    animation: none !important;
  }
  
  body::before,
  .container::after,
  .vintage-border::before,
  .vintage-border::after,
  .tamil-pattern {
    animation: none !important;
  }
  
  .floating-particle,
  .floating-element {
    animation: none !important;
    opacity: 0.1;
  }
}
</style>

<!-- Animated Background Elements -->
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

<?php include 'includes/navbar.php'; ?>

<div class="container">

  <h1>திண்ணைப் பள்ளி</h1>

  <section class="story-content">

    <p>
      அன்பிற்கினியோரே,<br>
      முதற்கண் வணக்கம்.
    </p>

    <p>
      எம் பெயர் என்.எஸ்.நாராயணன்.  
      கடல்கடந்த சீமைத் தீவான சிங்கப்பூரின் குடிமகனான இவன்,  
      தம் ஆரம்பக்கால இளந்தளிர்க் கல்விச் சீர்தனை,  
      வெற்றியூர் என்னும் சிற்றூர் திண்ணைப் பள்ளியில் பெற்றான்.
    </p>

    <p>
      இவன் பெற்றது, கல்விச்செல்வம்!  
      அது விலைமதிப்பற்ற இறைக் கொடை!  
      முதன் முதலில், அரிசியில் எழுதிப் பயின்ற  
      "அ" "ஆ" என்னும் எழுத்துகள்தாம்,  
      அம்மா, அன்பு, அறிவு, அன்னம், ஆலயம், ஆண்டவன்  
      எனப் பிறவிப் பயனாய்ப் பெற்றவற்றை ஈன்று தந்தன.
    </p>

    <p>
      ஈராண்டு திண்ணைப் பள்ளி மாணவனாயிருந்து,  
      ஆரம்பப் பள்ளியின் முதலாம் தொடக்க நிலையில் சேர்ந்து பயில,  
      பிறந்த ஊருக்கே இவன் திரும்பினான்.
    </p>

    <p>
      தமிழ்மொழியின் தேன்சுவை ருசி கண்டவன்,  
      அதை அள்ளிப் பருகியதன் கிறக்கத்திலேயே கிடக்கத்,  
      தொடர்ந்து தமிழ் நூல்களைப் படிக்கத் தொடங்கினான்.  
      அது, அவன் பதினெட்டாம் வயது வரை தொடர்ந்தது.
    </p>

    <p>
      நான்கு அதிகாரத்துவ மொழிகள் கொண்ட சிங்கப்பூரில்,  
      ஆங்கிலமும் தமிழும் கட்டாயப் பாட மொழிகள்.  
      அதனுடன், தேசிய மொழியாக அனுசரிக்கப்பட்ட  
      மலாய் மொழியையும் கற்றான்.
    </p>

    <p>
      தமிழ்மொழியைப் பன்னெடுங்காலம் கற்றுணர்ந்ததால்,  
      அந்த மொழி மீது இவனுக்கு ஏற்பட்ட பேராவல்,  
      கட்டுக்கடங்காது வளரத் தொடங்கிற்று.
    </p>

    <p>
      அதன் வெளிப்பாடாக,  
      பதினைந்தாவது வயது முதலே  
      சிங்கப்பூர் தமிழ் நாளேடான  
      "தமிழ் முரசு"வில்  
      "பிருந்தாவனம்" எனும் புனைபெயரில்  
      சிறுகதைகள் எழுதத் தொடங்கினான்.
    </p>

    <p>
      பின்னர்,  
      சிங்கப்பூர் வானொலிச் சேவையின்  
      தமிழ்ப் பிரிவான ஒலிவழி நான்கில்,  
      படைப்பாளராகப் பணியாற்றும் வாய்ப்பு கிடைத்தது.
    </p>

    <p>
      நூற்றுக்கணக்கான விண்ணப்பதாரர்கள் கலந்துகொண்ட  
      குரல் தேர்வில் தேர்ச்சி பெற்று,  
      பல தேர்வுத் தாள்கள் எழுதி,  
      கடைசியில் தனி ஒருவனாக  
      வானொலி நிலைய அறிவிப்பாளனாக  
      பணியமர்த்தப்பட்டான்.
    </p>

    <p>
      வானொலி நிலையம்,  
      கற்பனைக்கும் மொழி நுட்பத்திற்கும்  
      பிறப்பிடமாக விளங்கியது.  
      அறிவிப்பு, நாடகம், விளம்பரம்,  
      செய்தி வாசித்தல்,  
      சமூக நாடகத் தயாரிப்பு  
      எனப் பல துறைகளில்  
      அனுபவம் பெற்றான்.
    </p>

    <p>
      அந்தக் காலகட்டத்தில்,  
      வானொலித் தமிழ்ப் புழக்கம்  
      அப்பழுக்கற்ற,  
      தூய நற்றமிழாகவே விளங்கியது.
    </p>

    <p>
      மாணவப் பருவத்திலிருந்து  
      சுமார் இருபது ஆண்டுகள்,  
      நற்றமிழிலேயே பேச,  
      எழுத, சிந்திக்கக் கற்றான்.
    </p>

    <p>
      அதனைத் தொடர்ந்து,  
      "தமிழ் முரசு" நாளேட்டில்  
      ஐந்தாண்டுகள் பணியாற்றி,  
      செய்தியாளராகவும்  
      எழுத்தாளராகவும்  
      தமிழ்மொழிக்குப் பட்டைத் தீட்டினான்.
    </p>

    <p>
      அந்தத் தமிழ்மொழிக் காதல்  
      இன்றளவும் இருப்பதால்தான்,  
      இணையத் தளத்தில்  
      தமிழ்ச் சேவையைத் தொடரும் எண்ணம்  
      செயல்படுத்தப்பட்டுள்ளது.
    </p>

    <p>
      வேற்றுமொழிக் கலப்பின்றி,  
      அறிவுச் செழுமை மிகு தகவல்களை  
      நற்றமிழில் எழுதும் படைப்புகளை  
      இத்தலத்தில் இடம்பெறச் செய்ய  
      ஆவலுடன் இருக்கிறோம்.
    </p>

    <p>
      2004ஆம் ஆண்டு  
      இந்தியாவின் முதல் செம்மொழி எனும்  
      பெருமை பெற்ற தமிழ்மொழி,  
      இன்னும் பல நூறாண்டுகள்  
      மாண்புடன் வாழ வேண்டும்.
    </p>

    <p>
      அதை நினைவில் நிறுத்தி,  
      தமிழ் ஆர்வமுடையோர் அனைவரும்  
      இந்தத் தலத்திற்கு ஆதரவு தருமாறு  
      அன்புடன் வேண்டுகிறேன்.
    </p>

  </section>

</div>

<?php include 'includes/footer.php'; ?>

<script>
// Add scroll animations for paragraphs
document.addEventListener('DOMContentLoaded', function() {
  // Add fade-in class to paragraphs for scroll animation
  const paragraphs = document.querySelectorAll('.story-content p');
  paragraphs.forEach(p => {
    p.classList.add('fade-in');
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
  
  paragraphs.forEach(p => {
    observer.observe(p);
  });
  
  // Enhanced hover effect to container (only on non-touch devices)
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
});
</script>
</body>
</html>