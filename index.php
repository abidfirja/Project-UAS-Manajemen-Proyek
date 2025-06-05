<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Destinasi Wisata Alam Kota Jayapura</title>
</head>
<style>

    .body-class {
        margin: 0;
        padding: 0;
        /*background: linear-gradient(135deg, #713871 0%, #342c75 100%);*/
    }

    .head {
        background-image: url('pemandangan.jpg');
        background-size: cover;
        background-position: center;
        height: 100vh;
        position: relative;
    }

    .nav-header {
        position: sticky;
        top: 0;
        z-index: 1000;

        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .ul-navbar {
        display: flex;
        gap: 20px;
        margin: 0;
        padding: 0;
        padding-right: 500px;
    }

    .li-navbar {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 30px;
    }

    .li-navbar a {
        color: #fff;
        text-decoration: none;
        font-size: 18px;
        font-family: "Arial";
        font-weight: bold;
    }

    .h1-nav {
        color: #fff;
        font-family: "Comic Sans MS";
        font-size: 30px;
        padding-left: 50px;
    }

    .center-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 25px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        text-align: center;
        font-family: "Comic Sans Ms";
        font-weight: bold;
    }

    .div-content {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: center;
        padding: 20px;
    }

    .content1 {
        display: flex;
        width: 90%;
        max-width: 1000px;
        background-color: #ffffff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .content1 img {
        width: 250px;
        height: 180px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .text-keterangan {
        padding: 15px 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .text-keterangan p {
        margin: 5px 0;
        color: #333;
        font-family: Arial, sans-serif;
    }

    .text-keterangan a {
        color: #ff4949;
        text-decoration: none;
        font-weight: bold;
    }


    .footer {
        background-color: #0c0c1d;
        color: white;
        font-family: 'Arial', sans-serif;
    }

    .footer-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        max-width: 1200px;
        margin: auto;
    }

    .footer-section {
        flex: 1;
        margin: 10px;
        min-width: 250px;
    }

    .footer-section h3 {
        margin-bottom: 15px;
        font-weight: bold;
    }

    .footer-section p {
        margin: 10px 0;
    }

    .pay-icon {
        height: 30px;
        margin-right: 10px;
        vertical-align: middle;
    }

    .social-icons a {
        color: white;
        margin-right: 10px;
        font-size: 18px;
        text-decoration: none;
    }

    .social-icons a:hover {
        color: #ffa500;
    }

    /* Responsive */
    @media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        text-align: center;
    }

    .social-icons {
        justify-content: center;
    }
    }


</style>
<body class="body-class">
   <header class="head" data-aos="fade-down">
    <div class="background-layer" data-aos="zoom-in"></div>
        <nav class="nav-header" data-aos="fade-down">
            <h1 class="h1-nav">
                <span style="color: #ffffff;">Destinasi</span>
                <span style="color: #ff4949;">Wisata</span>
                <span style="color: #ffffff;">Alam</span>
            </h1>
            <ul class="ul-navbar">
                <li class="li-navbar"><a href="">Bukit</a></li>
                <li class="li-navbar"><a href="">Pantai</a></li>
                <li class="li-navbar"><a href="">Semua</a></li>
            </ul>
        </nav>

        <div class="center-text">
            <h2>Jelajahi Keindahan Alam</h2>
            <h2 style="color: #ff4949;">Kota Jayapura</h2>
            <p style="font-size: small;">Kota Jayapura memikat dengan perpaduan laut biru, perbukitan hijau, dan panorama kota yang menawan. Suasananya tenang, alami, dan cocok untuk melepas penat.</p>
        </div>
   </header>

   <h1 style="text-align: center;" data-aos="zoom-in">Semua</h1>

   <div class="div-content">
        <?php
        // Koneksi ke database
        $conn = new mysqli("localhost", "root", "", "wisata alam");
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query data wisata
        $sql = "SELECT * FROM wisata";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '
                <div class="content1" data-aos="flip-left">
                    <img src="uploads/' . htmlspecialchars($row['gambar']) . '"  data-aos="zoom-in">
                    <div class="text-keterangan">
                        <p style="font-size: 20px; font-weight: bold;">' . htmlspecialchars($row['nama']) . '</p>
                        <p>' . htmlspecialchars($row['lokasi']) . '</p>
                        <a href="detail.php?id=' . htmlspecialchars($row['id']) . '">Selengkapnya</a>
                    </div>
                </div>';
            }
        } else {
            echo "<p>Tidak ada data wisata.</p>";
        }

        $conn->close();
        ?>
    </div>

    

    <footer class="footer" data-aos="fade-up">
        <div class="footer-container" data-aos="zoom-in">
          <!-- Kolom 1: Payment -->
      
          <!-- Kolom 2: Kontak -->
          <div class="footer-section" data-aos="zoom-in">
            <p><i class="fas fa-map-marker-alt"></i> Indonesia<br><strong>Jayapura, Papua</strong></p>
            <p><i class="fas fa-phone-alt"></i> +62 812-4746-5787</p>
            <p><i class="fas fa-envelope"></i> support@email.com</p>
          </div>
      
          <!-- Kolom 3: About -->
          <div class="footer-section" data-aos="zoom-in">
            <h3>About</h3>
            <p>Kami berbagi informasi tentang destinasi alam dan keindahan Indonesia. Ikuti kami untuk update terbaru!</p>
            <div class="social-icons">
              <a href="#"><i class="fab fa-youtube"></i></a>
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>
      </footer>
      
      <!-- Font Awesome CDN -->
      <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
      
    
    <script>
        AOS.init({
            duration:1500
        });
    </script>
</body>
</html>