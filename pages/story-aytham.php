<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

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

<div class="container">
<h1>ஆய்த எழுத்து ஃ – வரலாறும் பயன்பாடும்</h1>

<div class="story-content">

<p>
ஆய்த எழுத்து ஃ கிமு காலங்களில்
இ, ஈ போன்ற வடிவங்களில் எழுதப்பட்டது.
</p>

<p>
பல காலங்களுக்கு ஃ எழுத்து
ஒலிச்சுவடிகளில் காணாமல் போய்விட்டது.
</p>

<p>
ஓலைச்சுவடிகள் மற்றும் கல்வெட்டுகளில்
எழுதுவதற்கும் வெட்டுவதற்கும் கடினமாக இருந்ததால்
இந்த எழுத்து பயன்பாடு குறைந்திருக்கலாம்.
</p>

<p>
ஆய்தம் (ஆயுதம் அல்ல) என்பது பெயர்ச்சொல்.
</p>

<p>
ஆய்தம் என்பது ஒலியை நுண்மையாக்கும் எழுத்து
என தொல்காப்பியம் குறிப்பிடுகிறது.
</p>

<p>
எஃகு, பஃது, பஃறி, கஃடு போன்ற சொற்களில்
ஆய்த எழுத்தின் பயன்பாடு காணப்படுகிறது.
</p>

<p>
வடமொழி சமஸ்கிருதச் சொற்களை
தமிழில் மென்மையாக உச்சரிக்க
ஆய்த எழுத்து பயன்படுத்தப்பட்டது.
</p>

<p>
ஃபேன், ஃபாதர் போன்ற
ஆங்கிலச் சொற்களையும்
தமிழில் எழுத உதவுகிறது.
</p>

<p>
ஆய்த எழுத்து மூன்று புள்ளிகளை
கொண்டதாகவும்
முப்புள்ளி எனவும் குறிப்பிடப்படுகிறது.
</p>

<p>
ஆய்தம் எழுத்து மட்டுமல்ல;
அது ஒலியின் நுணுக்கத்தை வெளிப்படுத்தும்
ஒரு மொழியியல் கருவியாகும்.
</p>

</div>
</div>

<style>
/* Added Vintage Tamil-inspired CSS with enhanced color palette and animations */
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

body {
  background: 
    linear-gradient(-45deg, var(--charcoal), var(--faded-black), var(--forest-green), var(--dusty-brown));
  background-size: 400% 400%;
  animation: gradientFlow 20s ease infinite;
  color: var(--off-white);
  font-family: 'Georgia', 'serif', 'Latha', 'Tamil Sangam MN';
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
  max-width: 900px;
  margin: 60px auto;
  background-color: var(--parchment);
  position: relative;
  box-shadow: 
    0 0 40px rgba(0, 0, 0, 0.5),
    0 0 100px rgba(194, 168, 109, 0.1) inset;
  border: 1px solid var(--dusty-brown);
  margin-top: 60px;
  margin-bottom: 30px;
  border-radius: 3px;
  padding: 40px;
  animation: fadeInUp 1.2s ease-out;
  z-index: 2;
  position: relative;
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
  font-size: 2.8rem;
  margin: 20px 0 30px;
  padding-bottom: 15px;
  border-bottom: 3px double var(--soft-gold);
  font-family: 'Kavivanar', 'Latha', 'Georgia', serif;
  position: relative;
  text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.1);
  animation: titleGlow 3s ease-in-out infinite alternate;
  background: linear-gradient(90deg, var(--forest-green), var(--olive-green), var(--forest-green));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
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

/* Special styling for the ஆய்த எழுத்து in title */
h1 span.ayutham {
  color: var(--tamil-red);
  font-size: 3.5rem;
  text-shadow: 0 0 10px rgba(179, 58, 58, 0.3);
  animation: ayuthamGlow 2s ease-in-out infinite alternate;
}

@keyframes ayuthamGlow {
  0% {
    text-shadow: 0 0 5px rgba(179, 58, 58, 0.3);
  }
  100% {
    text-shadow: 0 0 15px rgba(179, 58, 58, 0.5),
                 0 0 20px rgba(179, 58, 58, 0.2);
  }
}

/* Story content styling */
.story-content {
  position: relative;
  font-size: 1.2rem;
  text-align: justify;
  color: var(--faded-black);
}

.story-content p {
  margin-bottom: 25px;
  padding: 20px;
  animation: fadeInParagraph 1s ease-out forwards;
  opacity: 0;
  transform: translateY(15px);
  background: linear-gradient(to right, transparent, var(--light-cream), transparent);
  border-left: 3px solid var(--moss-green);
  border-radius: 0 5px 5px 0;
  transition: all 0.3s ease;
  line-height: 1.8;
}

.story-content p:hover {
  background: linear-gradient(to right, transparent, var(--muted-beige), transparent);
  transform: translateX(5px);
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

/* Special styling for ஆய்த எழுத்து in content */
.story-content .ayutham-word {
  font-weight: bold;
  color: var(--tamil-red);
  font-size: 1.3rem;
  padding: 2px 5px;
  border-radius: 3px;
  background: rgba(179, 58, 58, 0.1);
  margin: 0 2px;
  transition: all 0.3s ease;
}

.story-content .ayutham-word:hover {
  background: rgba(179, 58, 58, 0.2);
  transform: scale(1.05);
}

/* Stagger the paragraph animations */
.story-content p:nth-child(1) { animation-delay: 0.2s; }
.story-content p:nth-child(2) { animation-delay: 0.3s; }
.story-content p:nth-child(3) { animation-delay: 0.4s; }
.story-content p:nth-child(4) { animation-delay: 0.5s; }
.story-content p:nth-child(5) { animation-delay: 0.6s; }
.story-content p:nth-child(6) { animation-delay: 0.7s; }
.story-content p:nth-child(7) { animation-delay: 0.8s; }
.story-content p:nth-child(8) { animation-delay: 0.9s; }
.story-content p:nth-child(9) { animation-delay: 1.0s; }
.story-content p:nth-child(10) { animation-delay: 1.1s; }
.story-content p:nth-child(11) { animation-delay: 1.2s; }

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
  font-family: 'Kavivanar', serif;
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

/* Floating ஆய்த எழுத்து elements */
.floating-ayutham {
  position: fixed;
  opacity: 0.05;
  z-index: 0;
  font-size: 10rem;
  color: var(--tamil-red);
  font-family: 'Kavivanar', serif;
  pointer-events: none;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
  animation: floatSlow 40s infinite linear;
}

.floating-ayutham-1 {
  top: 25%;
  left: 15%;
  animation-delay: 0s;
}

.floating-ayutham-2 {
  top: 70%;
  right: 15%;
  animation-delay: 10s;
}

.floating-ayutham-3 {
  bottom: 30%;
  left: 20%;
  animation-delay: 20s;
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

/* ==========================================================================
   Enhanced Responsive Styles - Added to existing code
   ========================================================================== */

/* Base responsive adjustments */
@media (max-width: 1200px) {
  .container {
    max-width: 95%;
    margin: 50px auto;
    padding: 35px;
  }
  
  h1 {
    font-size: 2.5rem;
  }
  
  .floating-element {
    font-size: 7rem;
  }
  
  .floating-ayutham {
    font-size: 8rem;
  }
}

/* Tablet and large mobile devices */
@media (max-width: 992px) {
  .container {
    margin: 40px 20px;
    padding: 30px;
  }
  
  h1 {
    font-size: 2.2rem;
    padding: 0 40px 15px;
  }
  
  h1::before, 
  h1::after {
    font-size: 1.5rem;
  }
  
  .story-content {
    font-size: 1.15rem;
  }
  
  .story-content p {
    padding: 18px;
    margin-bottom: 20px;
  }
  
  .floating-element {
    font-size: 6rem;
  }
  
  .floating-ayutham {
    font-size: 7rem;
  }
  
  .corner-decoration {
    width: 60px;
    height: 60px;
  }
  
  /* Adjust floating element positions for tablet */
  .floating-tamil-1 {
    left: 2%;
    top: 10%;
  }
  
  .floating-tamil-2 {
    right: 2%;
    top: 70%;
  }
  
  .floating-tamil-3 {
    left: 5%;
    bottom: 15%;
  }
  
  .floating-ayutham-1 {
    left: 10%;
    top: 20%;
  }
  
  .floating-ayutham-2 {
    right: 10%;
    top: 75%;
  }
  
  .floating-ayutham-3 {
    left: 15%;
    bottom: 25%;
  }
}

/* Medium mobile devices */
@media (max-width: 768px) {
  body {
    overflow-x: hidden;
  }
  
  .container {
    margin: 30px 15px;
    padding: 25px;
    border-width: 2px;
  }
  
  h1 {
    font-size: 1.8rem;
    padding: 0 35px 12px;
    line-height: 1.4;
  }
  
  h1 span.ayutham {
    font-size: 2.2rem;
  }
  
  h1::before, 
  h1::after {
    font-size: 1.2rem;
  }
  
  h1::before {
    left: 10px;
  }
  
  h1::after {
    right: 10px;
  }
  
  .story-content {
    font-size: 1.1rem;
    line-height: 1.7;
  }
  
  .story-content p {
    padding: 15px;
    margin-bottom: 18px;
    border-left-width: 2px;
    text-align: left;
  }
  
  .story-content .ayutham-word {
    font-size: 1.15rem;
    padding: 1px 4px;
  }
  
  .floating-element {
    font-size: 5rem;
    opacity: 0.06;
  }
  
  .floating-ayutham {
    font-size: 6rem;
    opacity: 0.04;
  }
  
  /* Adjust floating element positions for medium mobile */
  .floating-tamil-1 {
    left: 1%;
    top: 8%;
  }
  
  .floating-tamil-2 {
    right: 1%;
    top: 75%;
  }
  
  .floating-tamil-3 {
    left: 3%;
    bottom: 10%;
  }
  
  .floating-ayutham-1 {
    left: 5%;
    top: 15%;
  }
  
  .floating-ayutham-2 {
    right: 5%;
    top: 80%;
  }
  
  .floating-ayutham-3 {
    left: 8%;
    bottom: 20%;
  }
  
  .corner-decoration {
    width: 40px;
    height: 40px;
  }
  
  /* Reduce animation complexity on mobile for performance */
  .floating-element,
  .floating-ayutham {
    animation-duration: 40s;
  }
}

/* Small mobile devices */
@media (max-width: 576px) {
  .container {
    margin: 20px 10px;
    padding: 20px;
    margin-top: 50px;
  }
  
  h1 {
    font-size: 1.5rem;
    padding: 0 30px 10px;
    margin: 10px 0 20px;
  }
  
  h1 span.ayutham {
    font-size: 1.8rem;
  }
  
  h1::before, 
  h1::after {
    font-size: 1rem;
  }
  
  h1::before {
    left: 5px;
  }
  
  h1::after {
    right: 5px;
  }
  
  .story-content {
    font-size: 1rem;
    line-height: 1.6;
  }
  
  .story-content p {
    padding: 12px;
    margin-bottom: 15px;
    line-height: 1.6;
  }
  
  .story-content .ayutham-word {
    font-size: 1.05rem;
    padding: 1px 3px;
  }
  
  .floating-element {
    font-size: 4rem;
  }
  
  .floating-ayutham {
    font-size: 5rem;
  }
  
  /* Hide some floating elements on very small screens */
  .floating-tamil-2,
  .floating-ayutham-3 {
    display: none;
  }
  
  /* Adjust remaining floating elements */
  .floating-tamil-1 {
    left: 2%;
    top: 5%;
    font-size: 3.5rem;
  }
  
  .floating-tamil-3 {
    left: 2%;
    bottom: 5%;
    font-size: 3.5rem;
  }
  
  .floating-ayutham-1 {
    left: 5%;
    top: 10%;
    font-size: 4rem;
  }
  
  .floating-ayutham-2 {
    right: 5%;
    top: 85%;
    font-size: 4rem;
  }
  
  .corner-decoration {
    width: 30px;
    height: 30px;
  }
  
  /* Simplify background animation on small devices for performance */
  body {
    animation: gradientFlow 40s ease infinite;
  }
  
  /* Reduce number of floating particles */
  .floating-particle {
    width: 2px;
    height: 2px;
  }
}

/* Extra small devices (phones in portrait) */
@media (max-width: 400px) {
  .container {
    margin: 15px 8px;
    padding: 15px;
  }
  
  h1 {
    font-size: 1.3rem;
    padding: 0 25px 8px;
  }
  
  h1 span.ayutham {
    font-size: 1.5rem;
  }
  
  .story-content p {
    padding: 10px;
    margin-bottom: 12px;
  }
  
  .floating-element {
    font-size: 3rem;
  }
  
  .floating-ayutham {
    font-size: 3.5rem;
  }
  
  /* Hide more decorative elements for very small screens */
  .floating-tamil-3 {
    display: none;
  }
  
  /* Adjust remaining elements */
  .floating-tamil-1 {
    font-size: 2.5rem;
    top: 3%;
  }
  
  .floating-ayutham-1 {
    font-size: 3rem;
    top: 8%;
  }
  
  .floating-ayutham-2 {
    font-size: 3rem;
    top: 90%;
  }
  
  .corner-decoration {
    width: 20px;
    height: 20px;
  }
  
  /* Simplify border decorations */
  .vintage-border::before,
  .vintage-border::after {
    height: 10px;
  }
}

/* Landscape orientation adjustments */
@media (max-height: 500px) and (orientation: landscape) {
  .container {
    margin: 20px auto;
    padding: 20px;
    max-width: 90%;
  }
  
  h1 {
    font-size: 1.8rem;
    margin: 10px 0 20px;
  }
  
  .story-content p {
    padding: 12px;
    margin-bottom: 15px;
  }
  
  /* Adjust floating elements for landscape */
  .floating-element {
    font-size: 4rem;
  }
  
  .floating-ayutham {
    font-size: 5rem;
  }
  
  /* Reposition floating elements for landscape */
  .floating-tamil-1 {
    top: 5%;
    left: 5%;
  }
  
  .floating-tamil-2 {
    top: 5%;
    right: 5%;
  }
  
  .floating-tamil-3 {
    bottom: 5%;
    left: 10%;
  }
  
  .floating-ayutham-1 {
    top: 15%;
    left: 15%;
  }
  
  .floating-ayutham-2 {
    bottom: 15%;
    right: 15%;
  }
  
  .floating-ayutham-3 {
    bottom: 5%;
    right: 10%;
  }
}

/* High-resolution devices (Retina) */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .tamil-pattern {
    opacity: 0.2;
  }
  
  .floating-element,
  .floating-ayutham {
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
  }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
  :root {
    --parchment: #1a1a1a;
    --muted-beige: #2a2a2a;
    --light-cream: #2d2d2d;
    --off-white: #e0e0e0;
    --faded-black: #cccccc;
    --charcoal: #e8e8e8;
  }
  
  .container {
    background-color: var(--parchment);
  }
  
  .story-content {
    color: var(--off-white);
  }
  
  h1 {
    background: linear-gradient(90deg, #8ba88b, #a8b5a8, #8ba88b);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
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
  
  .floating-element,
  .floating-ayutham,
  .floating-particle {
    animation: none !important;
  }
  
  .container::after {
    animation: none !important;
  }
  
  h1 {
    animation: none !important;
  }
  
  .story-content p {
    animation: none !important;
    opacity: 1;
    transform: none;
  }
  
  /* Simplify decorative elements */
  .tamil-pattern {
    opacity: 0.1;
  }
}

/* Touch device optimizations */
@media (hover: none) and (pointer: coarse) {
  .story-content p:hover {
    transform: none;
    box-shadow: none;
  }
  
  .container:hover {
    box-shadow: 
      0 0 40px rgba(0, 0, 0, 0.5),
      0 0 100px rgba(194, 168, 109, 0.1) inset;
  }
  
  .story-content .ayutham-word:hover {
    transform: none;
  }
}

/* Foldable devices and very tall screens */
@media (max-height: 700px) and (min-width: 768px) {
  .container {
    margin-top: 40px;
    margin-bottom: 20px;
  }
  
  h1 {
    margin: 10px 0 20px;
  }
  
  .story-content p {
    padding: 15px;
    margin-bottom: 18px;
  }
  
  /* Adjust floating elements for shorter screens */
  .floating-tamil-1 {
    top: 10%;
  }
  
  .floating-tamil-2 {
    top: 70%;
  }
  
  .floating-tamil-3 {
    bottom: 10%;
  }
  
  .floating-ayutham-1 {
    top: 20%;
  }
  
  .floating-ayutham-2 {
    top: 80%;
  }
  
  .floating-ayutham-3 {
    bottom: 15%;
  }
}

/* Existing responsive adjustments */
@media (max-width: 768px) {
  .container {
    margin: 15px;
    padding: 20px;
  }
  
  h1 {
    font-size: 2rem;
  }
  
  h1 span.ayutham {
    font-size: 2.5rem;
  }
  
  .floating-element {
    font-size: 5rem;
  }
  
  .floating-ayutham {
    font-size: 6rem;
  }
  
  .corner-decoration {
    width: 50px;
    height: 50px;
  }
  
  .story-content p {
    padding: 15px;
    margin-bottom: 15px;
    text-align: left;
  }
  
  .story-content {
    font-size: 1.1rem;
    text-align: left;
  }
}

/* Print-friendly styles */
@media print {
  .vintage-border, 
  .tamil-pattern, 
  .floating-element, 
  .floating-ayutham,
  .corner-decoration,
  .floating-particle {
    display: none;
  }
  
  body {
    background: white !important;
    animation: none !important;
  }
  
  body::before {
    display: none;
  }
  
  .container {
    box-shadow: none;
    border: 1px solid #ddd;
    animation: none;
  }
  
  .container::after {
    animation: none;
    display: none;
  }
  
  .story-content p:hover {
    transform: none;
    box-shadow: none;
  }
  
  h1 {
    background: none;
    -webkit-text-fill-color: var(--forest-green);
    color: var(--forest-green);
  }
  
  .story-content .ayutham-word {
    background: none;
    color: black;
  }
}
</style>

<!-- Additional floating ஆய்த எழுத்து elements -->
<div class="floating-ayutham floating-ayutham-1">ஃ</div>
<div class="floating-ayutham floating-ayutham-2">ஃ</div>
<div class="floating-ayutham floating-ayutham-3">ஃ</div>

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
  
  // Enhanced hover effect to container
  const container = document.querySelector('.container');
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
  
  // Create floating particles
  function createFloatingParticles() {
    const particleCount = 15;
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
  
  // Add subtle parallax effect to floating elements
  window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const rate = scrolled * -0.5;
    
    // Tamil floating elements
    const floatingElements = document.querySelectorAll('.floating-element');
    floatingElements.forEach((el, index) => {
      const speed = index === 0 ? 0.5 : index === 1 ? 0.3 : 0.7;
      el.style.transform = `translateY(${rate * speed}px)`;
    });
    
    // ஆய்த எழுத்து floating elements
    const ayuthamElements = document.querySelectorAll('.floating-ayutham');
    ayuthamElements.forEach((el, index) => {
      const speed = index === 0 ? 0.4 : index === 1 ? 0.2 : 0.6;
      el.style.transform = `translateY(${rate * speed}px)`;
    });
  });
  
  // Highlight ஆய்த எழுத்து words in the content
  const ayuthamWords = [
    'ஃ', 'ஆய்தம்', 'எஃகு', 'பஃது', 'பஃறி', 'கஃடு', 
    'ஃபேன்', 'ஃபாதர்', 'முப்புள்ளி'
  ];
  
  // Find and highlight ஆய்த எழுத்து related words
  const paragraphsContent = document.querySelectorAll('.story-content p');
  paragraphsContent.forEach(p => {
    let html = p.innerHTML;
    ayuthamWords.forEach(word => {
      const regex = new RegExp(`(${word})`, 'gi');
      html = html.replace(regex, '<span class="ayutham-word">$1</span>');
    });
    p.innerHTML = html;
  });
  
  // Add highlighting to ஆய்த எழுத்து in title
  const title = document.querySelector('h1');
  let titleHtml = title.innerHTML;
  titleHtml = titleHtml.replace('ஃ', '<span class="ayutham">ஃ</span>');
  title.innerHTML = titleHtml;
});
</script>

<?php include '../includes/footer.php'; ?>