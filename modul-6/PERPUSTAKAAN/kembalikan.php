<?php
include 'koneksi.php';

$id = $_GET['id'];
$tanggal = date('Y-m-d');

$data = $conn->query("SELECT * FROM peminjaman WHERE id='$id'")->fetch_assoc();
$buku = $data['buku_id'];

$conn->query("UPDATE peminjaman
SET status='dikembalikan', tanggal_kembali='$tanggal'
WHERE id='$id'");

$conn->query("UPDATE buku SET stok = stok + 1 WHERE id='$buku'");

header("Location: riwayat.php");
?>