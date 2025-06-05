<?php
$page = $_GET['page'] ?? 'tambah';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Destinasi Wisata</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #eef3f7;
        }

        nav {
            background-color: #2e8b57;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav h1 {
            color: white;
            font-size: 24px;
        }

        .navbar-menu a {
            margin-left: 20px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .navbar-menu a:hover {
            text-decoration: underline;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
            color: #2e8b57;
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
            max-width: 800px;
            background-color: #ffffff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .content1 img {
            width: 250px;
            height: 180px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .text-keterangan {
            padding: 15px 20px;
            flex-grow: 1;
        }

        .text-keterangan p {
            margin: 5px 0;
        }

        .icon-aksi {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            color: #2e8b57;
        }

        .icon-aksi.delete {
            color: red;
        }

        /* Form styling (sama seperti sebelumnya) */
        form {
            background-color: #fff;
            max-width: 600px;
            margin: 30px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        label, input, textarea {
            display: block;
            width: 100%;
            margin-bottom: 15px;
        }

        input, textarea {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #2e8b57;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        .message {
            text-align: center;
            margin: 20px auto;
        }
    </style>
</head>
<body>

<nav>
    <h1>Admin Wisata</h1>
    <div class="navbar-menu">
        <a href="?page=tambah">Tambah Data</a>
        <a href="?page=edit">Edit Data</a>
        <a href="?page=hapus">Hapus Data</a>
    </div>
</nav>

<?php if ($page == 'tambah'): ?>
    <h2>Tambah Data Wisata</h2>
    <form action="admin.php?page=tambah" method="POST" enctype="multipart/form-data">
        <label>Nama Wisata</label>
        <input type="text" name="nama" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="3" required></textarea>

        <label>Perkiraan Budget</label>
        <input type="text" name="budget" required>

        <label>Fasilitas</label>
        <textarea name="fasilitas" rows="3" required></textarea>

        <label>Lokasi (Link Google Maps)</label>
        <input type="text" name="lokasi" required>

        <label>Gambar</label>
        <input type="file" name="gambar" accept="image/*" required>

        <input type="submit" name="submit" value="Simpan">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $conn = new mysqli("localhost", "root", "", "wisata alam");
        if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $budget = $_POST['budget'];
        $fasilitas = $_POST['fasilitas'];
        $lokasi = $_POST['lokasi'];

        if (!preg_match('/^(https?:\/\/)?(www\.)?(google\.com\/maps|goo\.gl\/maps|maps\.app\.goo\.gl)/', $lokasi)) {
            echo "<div class='message'><p style='color:red;'>Link lokasi harus dari Google Maps.</p></div>";
            exit;
        }
        

        $gambar_name = time() . "_" . basename($_FILES["gambar"]["name"]);
        $target_file = "uploads/" . $gambar_name;

        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO wisata (nama, deskripsi, gambar, budget, fasilitas, lokasi) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $nama, $deskripsi, $gambar_name, $budget, $fasilitas, $lokasi);
            if ($stmt->execute()) {
                echo "<div class='message'><p style='color:green;'>Data berhasil disimpan!</p></div>";
            } else {
                echo "<div class='message'><p style='color:red;'>Gagal menyimpan data.</p></div>";
            }
            $stmt->close();
        } else {
            echo "<div class='message'><p style='color:red;'>Upload gambar gagal.</p></div>";
        }
        $conn->close();
    }
    ?>

<?php else: ?>
    <h2><?= ucfirst($page) ?> Data Wisata</h2>
    <div class="div-content">
        <?php
        $conn = new mysqli("localhost", "root", "", "wisata alam");
        $result = $conn->query("SELECT * FROM wisata");
        while ($row = $result->fetch_assoc()):
        ?>
            <div class="content1">
                <img src="uploads/<?= htmlspecialchars($row['gambar']) ?>">
                <div class="text-keterangan">
                    <p><strong><?= htmlspecialchars($row['nama']) ?></strong></p>
                    <p><?= htmlspecialchars($row['deskripsi']) ?></p>
                </div>
                <?php if ($page == 'edit'): ?>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="icon-aksi"><i class="fas fa-edit"></i></a>
                <?php elseif ($page == 'hapus'): ?>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="icon-aksi delete" onclick="return confirm('Yakin ingin menghapus?');"><i class="fas fa-trash-alt"></i></a>
                <?php endif; ?>
            </div>
        <?php endwhile; $conn->close(); ?>
    </div>
<?php endif; ?>

</body>
</html>
