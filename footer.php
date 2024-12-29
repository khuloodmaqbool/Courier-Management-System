<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Footer Example</title>
  <!-- CSS Links -->
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <link rel="stylesheet" href="plugins/scrollmenu/scrollmenu.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    /* Footer Styling */
    footer {
      background-color: #222;
      color: #bbb;
      padding-top: 20px;
      padding-bottom: 10px;
    }

    footer a , p , li , li i {
      color: #bbb;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    footer a:hover {
      color: #fff; /* White color on hover */
    }

    footer a.active {
      color: #696cff; /* Purple theme color */
    }

    footer .social-media-icons a {
      font-size: 1.2rem;
      margin-right: 10px;
      transition: color 0.3s ease;
    }

    footer .social-media-icons a:hover {
      color: #fff; /* White color on hover */
    }

    .footer-logo img {
      width: 200px;
      margin-bottom: 15px;
    }

    .footer-quick-links ul {
      list-style: none;
      padding: 0;
    }

    .footer-quick-links ul li {
      margin-bottom: 10px;
    }

    .footer-quick-links ul li a {
      font-size: 1rem;
    }

    .footer-contact ul {
      list-style: none;
      padding: 0;
    }

    .footer-contact ul li {
      margin-bottom: 10px;
      font-size: 0.9rem;
    }
  </style>
</head>

<body>

<footer class="section-sm bg-dark text-white pt-5 pb-3">
  <div class="container">
    <div class="row">
      <!-- Logo and Description -->
      <div class="col-md-3 footer-logo">
        <a href="index.php">
          <img loading="preload" decoding="async" src="images/logo1.png" alt="Wallet">
        </a>
        <p>
          Welcome to ShipSmart Courier Services. Founded in 2015, we ensure parcels are delivered safely and promptly,
          building trust and satisfaction.
        </p>
      </div>

      <!-- Quick Links -->
      <div class="col-md-3 footer-quick-links">
        <h5  class="text-white text-uppercase mb-4">Quick Links</h5>
        <ul>
          <li><a href="index.php" style="color:<?php echo $currentPage == 'index.php' ? '#6A6CFF' : ''; ?> ">Home</a></li>
          <li><a href="about.php" style="color: <?php echo $currentPage == 'about.php' ? '#6A6CFF' : ''; ?>">About</a></li>
          <li><a href="how-it-works.php"style="color: <?php echo $currentPage == 'how-it-works.php' ? '#6A6CFF' : ''; ?>">How It Works</a></li>
          <li><a href="services.php" style="color: <?php echo $currentPage == 'services.php' ? '#6A6CFF' : ''; ?>">Services</a></li>
          <li><a href="contact.php" style="color: <?php echo $currentPage == 'contact.php' ? '#6A6CFF' : ''; ?>">Contact</a></li>
          <li><a href="faq.php" style="color: <?php echo $currentPage == 'faq.php' ? '#6A6CFF' : ''; ?>">FAQ's</a></li>
        </ul>
      </div>

      <!-- Contact Section -->
      <div class="col-md-3 footer-contact">
        <h5  class="text-white text-uppercase mb-4">Contact Us</h5>
        <ul>
          <li><i class="fas fa-map-marker-alt me-2"></i> 123 Courier Lane, Business City</li>
          <li><i class="fas fa-phone-alt me-2"></i> +1 (234) 567-8901</li>
          <li><i class="fas fa-envelope me-2"></i> <a href="mailto:support@shipsmart.com">support@shipsmart.com</a></li>
        </ul>
        <div class="social-media-icons">
          <a href="https://facebook.com/" target="_blank" style="color:#4267B2;"><i class="fab fa-facebook-f"></i></a>
          <a href="https://twitter.com/" target="_blank" style="color:#1DA1F2;"><i class="fab fa-twitter"></i></a>
          <a href="https://instagram.com/" target="_blank" style="color:#E4405F;"><i class="fab fa-instagram"></i></a>
        </div>
      </div>

      <!-- Footer Image -->
      <div class="col-md-3 text-center">
        <img src="images/footer.png" alt="Courier Services" class="img-fluid">
      </div>
    </div>

    <!-- Footer Bottom -->
    <hr class="my-4">
    <div class="row">
      <div class="col-md-12 text-center">
        <p class="mb-0">© 2024 ShipSmart Courier Services. All Rights Reserved.</p>
      </div>
    </div>
  </div>
</footer>

<!-- JS Plugins -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/scrollmenu/scrollmenu.min.js"></script>
<script src="js/script.js"></script>













</body>

</html>
