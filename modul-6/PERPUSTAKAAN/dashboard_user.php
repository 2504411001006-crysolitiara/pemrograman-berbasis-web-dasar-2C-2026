<?php
session_start();

if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if($_SESSION['role'] != 'user') {
    header("Location: dashboard_admin.php");
    exit;
}

include 'koneksi.php';

$id = $_SESSION['id'];

$totalPinjam = $conn->query("
    SELECT * FROM peminjaman
    WHERE user_id='$id'
")->num_rows;

$totalBuku = $conn->query("
    SELECT * FROM buku
")->num_rows;

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<!-- Navbar -->
<nav class="bg-indigo-700 text-white px-8 py-4 flex justify-between items-center shadow-lg">

    <h1 class="text-3xl font-bold">
        📚 Perpustakaan Digital
    </h1>

    <div class="space-x-6 text-lg">

        <a href="dashboard_user.php" class="hover:text-yellow-300">
            Dashboard
        </a>

        <a href="buku_user.php" class="hover:text-yellow-300">
            Daftar Buku
        </a>

        <a href="riwayat.php" class="hover:text-yellow-300">
            Riwayat
        </a>

        <a href="logout.php" class="hover:text-red-300">
            Logout
        </a>

    </div>

</nav>

<!-- Content -->
<div class="p-8">

    <!-- Welcome -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white p-8 rounded-3xl shadow-xl">

        <h1 class="text-4xl font-bold mb-2">
            Halo, <?= $_SESSION['nama']; ?> 👋
        </h1>

        <p class="text-lg text-indigo-100">
            Selamat datang di sistem peminjaman buku perpustakaan.
        </p>

    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">

        <!-- Buku -->
        <div class="bg-white p-8 rounded-3xl shadow-lg hover:scale-105 transition duration-300">

            <h2 class="text-2xl font-bold text-indigo-700 mb-3">
                📖 Total Buku
            </h2>

            <p class="text-5xl font-bold text-gray-800">
                <?= $totalBuku; ?>
            </p>

        </div>

        <!-- Pinjaman -->
        <div class="bg-white p-8 rounded-3xl shadow-lg hover:scale-105 transition duration-300">

            <h2 class="text-2xl font-bold text-green-600 mb-3">
                📚 Buku Dipinjam
            </h2>

            <p class="text-5xl font-bold text-gray-800">
                <?= $totalPinjam; ?>
            </p>

        </div>

    </div>

    <!-- Tombol Cepat -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">

        <a href="buku_user.php"
        class="bg-indigo-600 hover:bg-indigo-700 text-white p-8 rounded-3xl shadow-lg text-center transition duration-300">

            <h1 class="text-3xl font-bold mb-3">
                📚 Lihat Buku
            </h1>

            <p>
                Jelajahi koleksi buku perpustakaan
            </p>

        </a>

        <a href="riwayat.php"
        class="bg-green-600 hover:bg-green-700 text-white p-8 rounded-3xl shadow-lg text-center transition duration-300">

            <h1 class="text-3xl font-bold mb-3">
                🕒 Riwayat
            </h1>

            <p>
                Lihat riwayat peminjaman buku
            </p>

        </a>

    </div>

</div>

</body>
</html>