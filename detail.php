<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Detail Wisata</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #dff6f0, #e4f1ff);
      min-height: 100vh;
    }

    nav {
      background-color: #2e8b57;
      color: white;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 999;
    }

    .nav-left {
      flex: 1;
    }

    .nav-center {
      flex: 1;
      text-align: center;
      font-size: 20px;
      font-weight: 600;
    }

    .nav-back {
      background: none;
      border: none;
      color: white;
      font-size: 20px;
      cursor: pointer;
    }

    .container {
      max-width: 1000px;
      margin: 30px auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h1 {
      text-align: center;
      color: #2e8b57;
      font-size: 2.5em;
      margin-bottom: 25px;
    }

    .main-content {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
    }

    .image-wrapper {
      flex: 1 1 300px;
      max-width: 400px;
    }

    .image-wrapper img {
      width: 100%;
      height: auto;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }

    .info {
      flex: 2 1 400px;
      font-size: 18px;
      color: #333;
      line-height: 1.6;
    }

    .info p {
      margin-bottom: 15px;
    }

    .info strong {
      color: #2e8b57;
      display: inline-block;
      width: 160px;
    }

    .description {
      margin-top: 30px;
      font-size: 18px;
      line-height: 1.7;
      color: #333;
    }

    .description strong {
      color: #2e8b57;
      display: block;
      margin-bottom: 10px;
    }

    @media (max-width: 768px) {
      .main-content {
        flex-direction: column;
        align-items: center;
      }

      .info strong {
        width: auto;
        display: block;
        margin-bottom: 5px;
      }

      .nav-center {
        font-size: 18px;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav>
  <div class="nav-left">
    <button class="nav-back" onclick="window.history.back();">←</button>
  </div>
  <div class="nav-center">Wisata Alam Jayapura</div>
  <div class="nav-left"><!-- spacer untuk rata tengah --></div>
</nav>

<?php
$conn = new mysqli("localhost", "root", "", "wisata alam");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM wisata WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '
    <div class="container">
        <h1>' . htmlspecialchars($row['nama']) . '</h1>
        <div class="main-content">
            <div class="image-wrapper">
                <img src="uploads/' . htmlspecialchars($row['gambar']) . '" alt="' . htmlspecialchars($row['nama']) . '">
            </div>
            <div class="info">
                <p><strong>Perkiraan Budget:</strong> Rp ' . htmlspecialchars($row['budget']) . '</p>
                <p><strong>Fasilitas:</strong> ' . htmlspecialchars($row['fasilitas']) . '</p>
                <p><strong>Lokasi:</strong> <a href="' . htmlspecialchars($row['lokasi']) . '" target="_blank" style="color:#0077cc; text-decoration:underline;">Lihat di Google Maps</a></p>
            </div>
        </div>
        <div class="description">
            <strong>Deskripsi:</strong>
            <p>' . nl2br(htmlspecialchars($row['deskripsi'])) . '</p>
        </div>
    </div>';
} else {
    echo "<div class='container'><p>Objek wisata tidak ditemukan.</p></div>";
}

$conn->close();
?>

</body>
</html>
