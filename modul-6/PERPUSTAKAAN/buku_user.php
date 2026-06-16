<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$data = $conn->query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

<!-- Navbar -->
<nav class="bg-indigo-700 text-white px-8 py-4 flex justify-between items-center shadow-lg">

    <h1 class="text-3xl font-bold">
        📚 Perpustakaan Digital
    </h1>

    <div class="space-x-5">

        <a href="dashboard_user.php" class="hover:text-yellow-300">
            Dashboard
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

    <div class="mb-8">

        <h1 class="text-4xl font-bold text-indigo-700 mb-2">
            Daftar Buku
        </h1>

        <p class="text-gray-500">
            Pilih buku yang ingin dipinjam
        </p>

    </div>

    <!-- Grid Buku -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <?php while($row = $data->fetch_assoc()) : ?>

        <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:scale-105 transition duration-300">

            <!-- Gambar Buku -->
            <img
            src="img/<?= $row['gambar']; ?>"
            class="w-full h-72 object-cover"
            alt="Cover Buku">

            <!-- Isi Card -->
            <div class="p-6">

                <h2 class="text-2xl font-bold text-indigo-700 mb-3">
                    <?= htmlspecialchars($row['judul']); ?>
                </h2>

                <div class="space-y-2 text-gray-700">

                    <p>
                        <span class="font-semibold">
                            Penulis:
                        </span>

                        <?= htmlspecialchars($row['penulis']); ?>
                    </p>

                    <p>
                        <span class="font-semibold">
                            Penerbit:
                        </span>

                        <?= htmlspecialchars($row['penerbit']); ?>
                    </p>

                    <p>
                        <span class="font-semibold">
                            Tahun:
                        </span>

                        <?= $row['tahun_terbit']; ?>
                    </p>

                    <p>
                        <span class="font-semibold">
                            Kategori:
                        </span>

                        <?= htmlspecialchars($row['kategori']); ?>
                    </p>

                    <p>
                        <span class="font-semibold">
                            Stok:
                        </span>

                        <?php if($row['stok'] > 0) : ?>

                            <span class="text-green-600 font-bold">
                                <?= $row['stok']; ?> tersedia
                            </span>

                        <?php else : ?>

                            <span class="text-red-600 font-bold">
                                Habis
                            </span>

                        <?php endif; ?>
                    </p>

                </div>

                <!-- Tombol Pinjam -->
                <?php if($row['stok'] > 0) : ?>

                <a
                href="pinjam.php?id=<?= $row['id']; ?>"
                class="block mt-6 bg-indigo-600 hover:bg-indigo-700 text-white text-center py-3 rounded-2xl font-bold transition duration-300">
                    Pinjam Buku
                </a>

                <?php else : ?>

                <button
                class="w-full mt-6 bg-gray-400 text-white py-3 rounded-2xl font-bold cursor-not-allowed"
                disabled>
                    Stok Habis
                </button>

                <?php endif; ?>

            </div>

        </div>

        <?php endwhile; ?>

    </div>

</div>

</body>
</html>