<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['username'])) {
  header("Location: /login/login.php");
  exit();
}

$username = $_SESSION['username'];

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Truy vấn SQL để lấy thông tin về những chuyến đi đã được book của người dùng hiện tại
$sql = "SELECT bd.*, pl.name AS placeName, u.name AS userName
        FROM bookdetail bd 
        INNER JOIN place pl ON bd.placeID = pl.placeID
        INNER JOIN users u ON bd.username = u.username
        WHERE u.username = '$username'"; // Chỉ lấy các chuyến đi của người dùng hiện tại

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booked Trips</title>
  <link rel="stylesheet" href="..\assets\css\style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">

  <style>
    body {
      min-height: 100vh;
      align-items: center;
      padding: 30px 0px 0px 0px;
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 15px;
    }

    .trip {
      background-color: #f9f9f9;
      padding: 20px;
      margin-bottom: 50px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .trip h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .trip p {
      margin-bottom: 5px;
    }

    .content-center {
      text-align: center;
      margin-top: 10%;
      margin-bottom: 5%;
      font-size: 50px;

    }

    article {
      min-height: 80vh;
    }
  </style>
</head>

<body id="top">
  <header class="header" data-header>

    <div class="overlay" data-overlay></div>

    <div class="header-top">
      <div class="container">

        <a href="tel:+01123456790" class="helpline-box">

          <div class="icon-box">
            <ion-icon name="call-outline"></ion-icon>
          </div>

          <div class="wrapper">
            <p class="helpline-title">For Further Inquires :</p>

            <p class="helpline-number">+01 (123) 4567 90</p>
          </div>

        </a>

        <a href="#" class="logo">
          <img src="..\assets\images\logo.svg" alt="logo">
        </a>

        <div class="header-btn-group">
          <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
            <ion-icon name="menu-outline"></ion-icon>
          </button>

        </div>

      </div>
    </div>

    <div class="header-bottom">
      <div class="container">

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

        <nav class="navbar" data-navbar>

          <div class="navbar-top">

            <a href="#" class="logo">
              <img src="..\assets\images\logo.svg" alt="logo">
            </a>

            <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </div>

          <ul class="navbar-list">

            <li>
              <a href="..\index.php" class="navbar-link" data-nav-link>home</a>
            </li>

            <li>
              <a href="#" class="navbar-link" data-nav-link>Booked</a>
            </li>

            <li>
              <a href="..\plan\showplan.php" class="navbar-link" data-nav-link>Planning</a>
            </li>

            <li>
              <a href="#package" class="navbar-link" data-nav-link>About Us</a>
            </li>

          </ul>

        </nav>

        <button class="btn btn-primary"><a href="..\logout.php">SIGN OUT</a></button>

      </div>
    </div>

  </header>


  <main>
    <article>
      <div class="container ">
        <h1 class="content-center">Booked Trips</h1>
        <?php
        // Kiểm tra xem có kết quả trả về không
        if ($result->num_rows > 0) {
          // Duyệt qua từng hàng kết quả
          while ($row = $result->fetch_assoc()) {
            echo "<div class='trip'>";
            echo "<h2>Place Name: " . $row["placeName"] . "</h2>";
            echo "<p>Name: " . $row["userName"] . "</p>";
            echo "<p>Price: $" . $row["price"] . "</p>";
            echo "<p>Check-in Date: " . $row["checkInDate"] . "</p>";
            echo "<p>Check-out Date: " . $row["checkOutDate"] . "</p>";
            echo "<p>Flight Brand: " . $row["flightBrand"] . "</p>";
            echo "<p>Ticket Type: " . $row["typeTicket"] . "</p>";
            echo "<p>Number of People: " . $row["numberPeople"] . "</p>";
            echo "</div>";
          }
        } else {
          echo "<p class = 'content-center' >No booked trips.</p>";
        }

        // Đóng kết nối
        $conn->close();
        ?>
      </div>


    </article>
  </main>

  <footer class="footer">

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand">

          <a href="#" class="logo">
            <img src="..\assets\images\logo.svg" alt="Tourly logo">
          </a>

          <p class="footer-text">
            Urna ratione ante harum provident, eleifend, vulputate molestiae proin fringilla, praesentium magna conubia
            at
            perferendis, pretium, aenean aut ultrices.
          </p>

        </div>

        <div class="footer-contact">

          <h4 class="contact-title">Contact Us</h4>

          <p class="contact-text">
            Feel free to contact and reach us !!
          </p>

          <ul>

            <li class="contact-item">
              <ion-icon name="call-outline"></ion-icon>

              <a href="tel:+01123456790" class="contact-link">+01 (123) 4567 90</a>
            </li>

            <li class="contact-item">
              <ion-icon name="mail-outline"></ion-icon>

              <a href="mailto:info.tourly.com" class="contact-link">info.tourly.com</a>
            </li>

            <li class="contact-item">
              <ion-icon name="location-outline"></ion-icon>

              <address>3146 Koontz, California</address>
            </li>

          </ul>

        </div>

        <div class="footer-form">

          <p class="form-text">
            Subscribe our newsletter for more update & news !!
          </p>

          <form action="" class="form-wrapper">
            <input type="email" name="email" class="input-field" placeholder="Enter Your Email" required>

            <button type="submit" class="btn btn-secondary">Subscribe</button>
          </form>

        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          &copy; 2022 <a href="">codewithsadee</a>. All rights reserved
        </p>

        <ul class="footer-bottom-list">

          <li>
            <a href="#" class="footer-bottom-link">Privacy Policy</a>
          </li>

          <li>
            <a href="#" class="footer-bottom-link">Term & Condition</a>
          </li>

          <li>
            <a href="#" class="footer-bottom-link">FAQ</a>
          </li>

        </ul>

      </div>
    </div>

  </footer>


  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up-outline"></ion-icon>
  </a>


  <script src="..\js\script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>