<?php
include 'cek.php';
include 'koneksi.php';

if($_SESSION['role'] != 'admin') {
    header("Location: login.php");
}

$totalBuku = $conn->query("SELECT * FROM buku")->num_rows;
$totalUser = $conn->query("SELECT * FROM users WHERE role='user'")->num_rows;
$totalPinjam = $conn->query("SELECT * FROM peminjaman")->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard Admin</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex">

<div class="w-64 bg-indigo-700 min-h-screen text-white p-5">
<h1 class="text-2xl font-bold mb-8">ADMIN PANEL</h1>

<ul class="space-y-4">
<li><a href="dashboard_admin.php">Dashboard</a></li>
<li><a href="buku.php">Kelola Buku</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</div>

<div class="flex-1 p-8">

<h1 class="text-3xl font-bold mb-8">Selamat Datang Admin</h1>

<div class="grid grid-cols-3 gap-6">

<div class="bg-white p-6 rounded-2xl shadow-lg">
<h2 class="text-xl font-semibold">Total Buku</h2>
<p class="text-4xl font-bold text-indigo-600 mt-4"><?php echo $totalBuku; ?></p>
</div>

<div class="bg-white p-6 rounded-2xl shadow-lg">
<h2 class="text-xl font-semibold">Total User</h2>
<p class="text-4xl font-bold text-green-600 mt-4"><?php echo $totalUser; ?></p>
</div>

<div class="bg-white p-6 rounded-2xl shadow-lg">
<h2 class="text-xl font-semibold">Peminjaman</h2>
<p class="text-4xl font-bold text-red-600 mt-4"><?php echo $totalPinjam; ?></p>
</div>

</div>
</div>
</div>
</body>
</html>