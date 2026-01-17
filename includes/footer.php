<?php
// footer.php
?>

<footer class="site-footer">

  <div class="footer-container">

    <!-- About -->
    <div class="footer-section">
      <h3>திண்ணைப் பள்ளி</h3>
      <p>
        தமிழ் மொழி, இலக்கியம் மற்றும்
        பண்பாட்டை பாதுகாக்கும்
        ஒரு பண்பாட்டு மேடை.
      </p>
    </div>

    <!-- Links -->
    <div class="footer-section">
      <h3>வழிகள்</h3>
      <ul>
        <li><a href="/thinnai-palli/index.php">முகப்பு</a></li>
        <li><a href="/thinnai-palli/pages/stories.php">கதைகள்</a></li>
        <li><a href="/thinnai-palli/pages/old-cinema.php">பழைய சினிமா</a></li>
        <li><a href="/thinnai-palli/pages/tamil-words.php">தமிழ் சொற்கள்</a></li>
        <li><a href="/thinnai-palli/pages/connect.php">தொடர்பு</a></li>
      </ul>
    </div>

    <!-- Contact -->
    <div class="footer-section">
      <h3>தொடர்பு</h3>
      <p>
        📧 <a href="mailto:nsnarayanan57@gmail.com">
          nsnarayanan57@gmail.com
        </a>
      </p>
      <p>
        <a href="/thinnai-palli/pages/connect.php">
          சமூக ஊடக இணைப்புகள் →
        </a>
      </p>
    </div>

  </div>

  <div class="footer-bottom">
    © <?php echo date("Y"); ?> திண்ணைப் பள்ளி |
    அனைத்து உரிமைகளும் பாதுகாக்கப்பட்டவை.
  </div>

</footer>

<style>
.site-footer {
  background: #000;
  color: #E3D2AE; /* Updated to #E3D2AE */
  padding: 40px 0 20px;
  font-family: "Noto Serif Tamil", serif;
}

.footer-container {
  display: flex;
  max-width: 1100px;
  margin: auto;
  padding: 0 20px;
  justify-content: space-between;
  flex-wrap: wrap;
}

.footer-section {
  flex: 1;
  min-width: 220px;
  margin-bottom: 20px;
}

.footer-section h3 {
  color: #E3D2AE; /* Updated to #E3D2AE */
  font-size: 18px;
  margin-bottom: 12px;
}

.footer-section p,
.footer-section li {
  font-size: 14px;
  line-height: 1.6;
  color: #E3D2AE; /* Updated to #E3D2AE */
}

.footer-section ul {
  list-style: none;
  padding: 0;
}

.footer-section ul li {
  margin-bottom: 8px;
}

.footer-section a {
  color: #E3D2AE; /* Updated to #E3D2AE */
  text-decoration: none;
}

.footer-section a:hover {
  color: #ffffff;
}

.footer-bottom {
  text-align: center;
  font-size: 13px;
  color: #E3D2AE; /* Updated to #E3D2AE */
  border-top: 1px solid #222;
  padding-top: 12px;
  margin-top: 20px;
  background: #000;
}

@media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
    text-align: center;
  }
}
</style>