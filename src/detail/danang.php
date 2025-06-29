<?php
session_start();

require_once '../config.php'; 

if (isset($_SESSION['username'])) {
  $loginButtonStyle = "none";
  $logoutButtonStyle = "block";
} else {
  $loginButtonStyle = "block";
  $logoutButtonStyle = "none";
}


$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$getPlaces = "SELECT * FROM travel1.place WHERE locationName = 'Da Nang'";
$result = $conn->query($getPlaces);
if ($result->num_rows > 0) {
  // Hiển thị kết quả
  while ($row = $result->fetch_assoc()) {
  }
} else {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Da Nang</title>
  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="..\assets\css\style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

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
          <img src="../assets/images/logo.svg" alt=" logo">
        </a>

        <div class="header-btn-group">

          <button class="search-btn" aria-label="Search">
            <ion-icon name="search"></ion-icon>
          </button>

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
              <img src=" ../assets/images/logo-blue.svg" alt="Tourly logo">
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
              <a href="..\booking\booked.php" class="navbar-link" data-nav-link>Booked</a>
            </li>

            <li>
              <a href="..\plan\showplan.php" class="navbar-link" data-nav-link>Planning</a>
            </li>

            <li>
              <a href="#package" class="navbar-link" data-nav-link>About Us</a>
            </li>

          </ul>

        </nav>

        <button style="display: <?php echo $loginButtonStyle; ?>" class="btn btn-primary"><a
            href=" ../login/login.php">LOGIN</a></button>

        <button style="display: <?php echo $logoutButtonStyle; ?>" class="btn btn-primary"><a
            href=" ../logout.php">SIGN OUT</a></button>

      </div>
    </div>
    <section class="hero" id="home">
      <div class="container">
        <h2 class="h1 hero-title">Available in DaNang</h2>

        <p class="hero-text">
        Đà Nẵng, a coastal city in central Vietnam, is renowned for its stunning beaches, picturesque landscapes, and vibrant culinary scene.
        </p>
    </section>

  </header>


  <main>
    <article>

      <!-- 
        - #HERO
      -->
      <div class="video">
        <video autoplay muted loop id="myVideo">
          <source src="..\assets\video\danang.mp4" type="video/mp4">
        </video>
      </div>

      </div>

      <!-- </section> -->
      <!-- 
        - #PACKAGE
      -->

      <section class="package" id="package">
        <div class="container">

          <p class="section-subtitle">Hotel</p>

          <h2 class="h2 section-title">Hotels In Da Nang</h2>

          <p class="section-text">
          Đà Nẵng, a coastal city in central Vietnam, is renowned for its stunning beaches, picturesque landscapes, and vibrant culinary scene.

          </p>

          <ul class="package-list">
                        <?php
                        if ($result->num_rows > 0) {
                            foreach ($result as $row) {
                                ?>
                                <li>
                                    <div class="package-card">
                                        <figure class="card-banner">
                                            <img src="../<?php echo $row["imgLink"]; ?>" alt="Hotel Image" loading="lazy">
                                        </figure>
                                        <div class="card-body">
                                            <h3 class="h3 card-title hotel-name"><?php echo $row["name"]; ?></h3>
                                            <p class="card-text location-name"><?php echo $row["locationName"]; ?></p>
                                            <p style="display: inline;" class="card-text mr-2 price"><?php echo $row["price"]; ?></p> 
                                            <p class="init-price"><?php echo $row["initPrice"]; ?></p>
                                            <p hidden class="placeID"><?php echo $row["placeID"]; ?></p> 
                                            <input type="hidden" class="placeID" value="<?php echo $row["placeID"]; ?>">
                                            <button id="myBtn" class="btn btn-info" data-placeid="<?php echo $row["placeID"]; ?>">Comments</button>
                                            <button type="button" class="btn btn-success booking-button" data-mdb-ripple-init>Book</button>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                        } else {
                            // Nếu không có kết quả, hiển thị thông báo không tìm thấy kết quả
                            echo "<li id='nors'>No results were found.</li>";
                        }
                        ?>
                    </ul>
        </div>
      </section>
      <!-- 
        - #CTA
      -->

      <section class="cta" id="contact">
        <div class="container">

          <div class="cta-content">
            <p class="section-subtitle">Call To Action</p>

            <h2 class="h2 section-title">Ready For Unforgatable Travel. Remember Us!</h2>

            <p class="section-text">
              Fusce hic augue velit wisi quibusdam pariatur, iusto primis, nec nemo, rutrum. Vestibulum cumque
              laudantium. Sit ornare
              mollitia tenetur, aptent.
            </p>
          </div>

          <button class="btn btn-secondary">Contact Us !</button>

        </div>
      </section>

    </article>
  </main>

  <!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand">

          <a href="#" class="logo">
            <img src=" ../assets/images/logo.svg" alt="Tourly logo">
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

  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up-outline"></ion-icon>
  </a>

  <!-- 
    - custom js link
  -->
  <script src="..\js\script.js"></script>


  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Reviews about this place</h2>
      <div class="comments">
        <!-- Hiển thị thông tin đánh giá -->
      </div>
      <h2 id="comment-title">Add your comment</h2>
      <form id="comment-form" class="comment-form">
        <div class="form-group">
          <label for="comment">Your Comment:</label>
          <textarea id="comment" class="comment-box" name="comment" rows="4" required></textarea>
        </div>
        <input type="hidden" id="placeID" name="placeID">
        <button type="submit" class="btn btn-primary comment-button">Comment</button>
      </form>
    </div>
  </div>

  <script>
    var btns = document.querySelectorAll(".btn-info");

    // Lấy phần span đóng modal
    var span = document.getElementsByClassName("close")[0];

    // Lặp qua mỗi nút "Comments" để gán sự kiện khi click
    btns.forEach(function (btn) {
      btn.onclick = function () {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
        var placeID = this.dataset.placeid;
        document.getElementById("placeID").value = placeID;
        // Lấy ID của địa điểm từ thuộc tính data-placeid
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.querySelector(".comments").innerHTML = this.responseText;
          }
        };
        xhttp.open("POST", " ../comment/get_comments.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("placeID=" + placeID); // Gửi ID của địa điểm trong yêu cầu AJAX
      }
    });

    // Khi người dùng click vào nút đóng (span), đóng modal
    span.onclick = function () {
      var modal = document.getElementById("myModal");
      modal.style.display = "none";
    }

    // Khi người dùng click bất kỳ đâu ngoài modal, đóng modal
    window.onclick = function (event) {
      var modal = document.getElementById("myModal");
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }


    //Them comment
    document.getElementById("comment-form").addEventListener("submit", function (event) {
      event.preventDefault(); // Ngăn chặn gửi form mặc định

      // Lấy dữ liệu từ form
      var comment = document.getElementById("comment").value;
      var placeID = document.getElementById("placeID").value; // Lấy giá trị placeID từ trường input ẩn

      // Tạo yêu cầu AJAX 
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          // Sau khi gửi thành công, làm mới phần hiển thị comment
          document.querySelector(".comments").innerHTML = this.responseText;
          // Xóa dữ liệu trong form
          document.getElementById("comment").value = "";
        }
      };
      xhttp.open("POST", " ../comment/add_comment.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      // Gửi dữ liệu form qua yêu cầu AJAX
      xhttp.send("&comment=" + comment + "&placeID=" + placeID);
    });
  </script>

</body>

</html>