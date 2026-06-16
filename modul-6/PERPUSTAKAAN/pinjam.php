<?php
include 'koneksi.php';
session_start();

$user = $_SESSION['id'];
$buku = $_GET['id'];
$tanggal = date('Y-m-d');

$stmt = $conn->prepare("INSERT INTO peminjaman(user_id,buku_id,tanggal_pinjam)
VALUES(?,?,?)");

$stmt->bind_param("iis", $user, $buku, $tanggal);
$stmt->execute();

$conn->query("UPDATE buku SET stok = stok - 1 WHERE id='$buku'");

header("Location: riwayat.php");
?>