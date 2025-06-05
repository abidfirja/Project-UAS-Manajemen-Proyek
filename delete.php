<?php
$conn = new mysqli("localhost", "root", "", "wisata alam");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$id = $_GET['id'] ?? 0;

// Ambil data gambar
$result = $conn->query("SELECT gambar FROM wisata WHERE id=$id");
$data = $result->fetch_assoc();

if ($data) {
    // Hapus gambar
    if (file_exists("uploads/" . $data['gambar'])) {
        unlink("uploads/" . $data['gambar']);
    }

    // Hapus dari database
    $conn->query("DELETE FROM wisata WHERE id=$id");
    echo "<script>alert('Data berhasil dihapus'); window.location='admin.php?page=hapus';</script>";
} else {
    echo "Data tidak ditemukan.";
}
