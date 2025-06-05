<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Wisata</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            height: 100px;
        }
        input[type="submit"] {
            margin-top: 25px;
            background-color: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php
$conn = new mysqli("localhost", "root", "", "wisata alam");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$id = $_GET['id'] ?? 0;
$result = $conn->query("SELECT * FROM wisata WHERE id = $id");
$data = $result->fetch_assoc();

if (!$data) {
    echo "<div class='message' style='color:red;'>Data tidak ditemukan.</div>";
    exit;
}

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $budget = $_POST['budget'];
    $fasilitas = $_POST['fasilitas'];
    $lokasi = $_POST['lokasi'];

    if (!preg_match('/^(https?:\/\/)?(www\.)?(google\.com\/maps|goo\.gl\/maps|maps\.app\.goo\.gl)/', $lokasi)) {
        echo "<div class='message'><p style='color:red;'>Link lokasi harus dari Google Maps.</p></div>";
        exit;
    } else {
        if ($_FILES['gambar']['name']) {
            $gambar_name = time() . "_" . basename($_FILES["gambar"]["name"]);
            $target_file = "uploads/" . $gambar_name;
            move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

            if (file_exists("uploads/" . $data['gambar'])) {
                unlink("uploads/" . $data['gambar']);
            }

            $query = "UPDATE wisata SET nama=?, deskripsi=?, budget=?, fasilitas=?, lokasi=?, gambar=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssisssi", $nama, $deskripsi, $budget, $fasilitas, $lokasi, $gambar_name, $id);
        } else {
            $query = "UPDATE wisata SET nama=?, deskripsi=?, budget=?, fasilitas=?, lokasi=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssissi", $nama, $deskripsi, $budget, $fasilitas, $lokasi, $id);
        }

        if ($stmt->execute()) {
            echo "<div class='message' style='color:green;'>Data berhasil diupdate. <a href='admin.php?page=edit'>Kembali</a></div>";
        } else {
            echo "<div class='message' style='color:red;'>Gagal update data.</div>";
        }
        $stmt->close();
    }
}
?>

<div class="container">
    <h2>Edit Data Wisata</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama Wisata</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>

        <label>Perkiraan Budget</label>
        <input type="text" name="budget" value="<?= htmlspecialchars($data['budget']) ?>" required>

        <label>Fasilitas</label>
        <textarea name="fasilitas" required><?= htmlspecialchars($data['fasilitas']) ?></textarea>

        <label>Lokasi (Link Google Maps)</label>
        <input type="text" name="lokasi" value="<?= htmlspecialchars($data['lokasi']) ?>" required>

        <label>Ganti Gambar (kosongkan jika tidak diubah)</label>
        <input type="file" name="gambar" accept="image/*">

        <input type="submit" name="update" value="Update Data">
    </form>
</div>

</body>
</html>