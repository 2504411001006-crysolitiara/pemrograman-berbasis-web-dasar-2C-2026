<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = $conn->query("SELECT * FROM buku WHERE id='$id'");
$row = $data->fetch_assoc();

if(isset($_POST['update'])) {

    $judul     = htmlspecialchars($_POST['judul']);
    $penulis   = htmlspecialchars($_POST['penulis']);
    $penerbit  = htmlspecialchars($_POST['penerbit']);
    $tahun     = $_POST['tahun'];
    $stok      = $_POST['stok'];
    $kategori  = htmlspecialchars($_POST['kategori']);

    // cek apakah upload gambar baru
    if($_FILES['gambar']['name'] != "") {

        $gambar = $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];

        move_uploaded_file($tmp, "img/" . $gambar);

    } else {

        $gambar = $row['gambar'];
    }

    $stmt = $conn->prepare("
        UPDATE buku
        SET
        judul=?,
        penulis=?,
        penerbit=?,
        tahun_terbit=?,
        stok=?,
        kategori=?,
        gambar=?
        WHERE id=?
    ");

    $stmt->bind_param(
        "sssisssi",
        $judul,
        $penulis,
        $penerbit,
        $tahun,
        $stok,
        $kategori,
        $gambar,
        $id
    );

    if($stmt->execute()) {

        echo "
        <script>
            alert('Data buku berhasil diupdate!');
            window.location='buku.php';
        </script>
        ";

    }
}
?>

<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <title>Edit Buku</title>

    <script src='https://cdn.tailwindcss.com'></script>
</head>

<body class='bg-gray-100 min-h-screen flex items-center justify-center p-8'>

<div class='bg-white w-full max-w-2xl p-8 rounded-3xl shadow-2xl'>

    <h1 class='text-4xl font-bold text-indigo-700 text-center mb-8'>
        Edit Buku
    </h1>

    <form method='POST' enctype='multipart/form-data' class='space-y-5'>

        <input
        type='text'
        name='judul'
        value='<?= $row['judul']; ?>'
        class='w-full border p-3 rounded-xl'
        required>

        <input
        type='text'
        name='penulis'
        value='<?= $row['penulis']; ?>'
        class='w-full border p-3 rounded-xl'
        required>

        <input
        type='text'
        name='penerbit'
        value='<?= $row['penerbit']; ?>'
        class='w-full border p-3 rounded-xl'
        required>

        <input
        type='number'
        name='tahun'
        value='<?= $row['tahun_terbit']; ?>'
        class='w-full border p-3 rounded-xl'
        required>

        <input
        type='number'
        name='stok'
        value='<?= $row['stok']; ?>'
        class='w-full border p-3 rounded-xl'
        required>

        <input
        type='text'
        name='kategori'
        value='<?= $row['kategori']; ?>'
        class='w-full border p-3 rounded-xl'
        required>

        <div>
            <img
            src='img/<?= $row['gambar']; ?>'
            class='w-40 rounded-xl mb-3'>
        </div>

        <input
        type='file'
        name='gambar'
        class='w-full border p-3 rounded-xl bg-white'>

        <button
        type='submit'
        name='update'
        class='w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl'>
            Update Buku
        </button>

    </form>

</div>

</body>
</html>