<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = $conn->query("SELECT * FROM buku WHERE id='$id'");
$row = $data->fetch_assoc();

// hapus gambar dari folder
if(file_exists("img/" . $row['gambar'])) {
    unlink("img/" . $row['gambar']);
}

// hapus data database
$conn->query("DELETE FROM buku WHERE id='$id'");

echo "
<script>
    alert('Buku berhasil dihapus!');
    window.location='buku.php';
</script>
";
?>