<?php
include 'koneksi.php';

if(isset($_POST['simpan'])) {

    $judul     = htmlspecialchars($_POST['judul']);
    $penulis   = htmlspecialchars($_POST['penulis']);
    $penerbit  = htmlspecialchars($_POST['penerbit']);
    $tahun     = $_POST['tahun'];
    $stok      = $_POST['stok'];
    $kategori  = htmlspecialchars($_POST['kategori']);

    // =====================
    // Upload Gambar
    // =====================

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    // buat folder img otomatis jika belum ada
    if(!file_exists("img")) {
        mkdir("img");
    }

    move_uploaded_file($tmp, "img/" . $gambar);

    // =====================
    // Simpan Database
    // =====================

    $stmt = $conn->prepare("
        INSERT INTO buku
        (judul, penulis, penerbit, tahun_terbit, stok, kategori, gambar)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssisss",
        $judul,
        $penulis,
        $penerbit,
        $tahun,
        $stok,
        $kategori,
        $gambar
    );

    if($stmt->execute()) {

        echo "
        <script>
            alert('Buku berhasil ditambahkan!');
            window.location='buku.php';
        </script>
        ";

    } else {

        echo "
        <script>
            alert('Gagal menambahkan buku!');
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-8">

<div class="bg-white w-full max-w-2xl p-8 rounded-3xl shadow-2xl">

    <div class="text-center mb-8">

        <h1 class="text-4xl font-bold text-indigo-700">
            Tambah Buku
        </h1>

        <p class="text-gray-500 mt-2">
            Tambahkan data buku perpustakaan
        </p>

    </div>

    <form
        method="POST"
        enctype="multipart/form-data"
        class="space-y-5"
    >

        <!-- Judul -->
        <div>
            <label class="font-semibold text-gray-700">
                Judul Buku
            </label>

            <input
                type="text"
                name="judul"
                class="w-full mt-2 border border-gray-300 p-3 rounded-xl"
                required
            >
        </div>

        <!-- Penulis -->
        <div>
            <label class="font-semibold text-gray-700">
                Penulis
            </label>

            <input
                type="text"
                name="penulis"
                class="w-full mt-2 border border-gray-300 p-3 rounded-xl"
                required
            >
        </div>

        <!-- Penerbit -->
        <div>
            <label class="font-semibold text-gray-700">
                Penerbit
            </label>

            <input
                type="text"
                name="penerbit"
                class="w-full mt-2 border border-gray-300 p-3 rounded-xl"
                required
            >
        </div>

        <!-- Tahun -->
        <div>
            <label class="font-semibold text-gray-700">
                Tahun Terbit
            </label>

            <input
                type="number"
                name="tahun"
                class="w-full mt-2 border border-gray-300 p-3 rounded-xl"
                required
            >
        </div>

        <!-- Stok -->
        <div>
            <label class="font-semibold text-gray-700">
                Stok Buku
            </label>

            <input
                type="number"
                name="stok"
                class="w-full mt-2 border border-gray-300 p-3 rounded-xl"
                required
            >
        </div>

        <!-- Kategori -->
        <div>
            <label class="font-semibold text-gray-700">
                Kategori
            </label>

            <input
                type="text"
                name="kategori"
                class="w-full mt-2 border border-gray-300 p-3 rounded-xl"
                required
            >
        </div>

        <!-- Gambar -->
        <div>
            <label class="font-semibold text-gray-700">
                Cover Buku
            </label>

            <input
                type="file"
                name="gambar"
                class="w-full mt-2 border border-gray-300 p-3 rounded-xl bg-white"
                required
            >
        </div>

        <!-- Tombol -->
        <button
            type="submit"
            name="simpan"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl"
        >
            Simpan Buku
        </button>

    </form>

</div>

</body>
</html>