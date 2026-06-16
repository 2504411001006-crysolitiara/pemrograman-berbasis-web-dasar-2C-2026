<?php
include 'cek.php';
include 'koneksi.php';

$data = $conn->query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Buku</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="bg-white p-8 rounded-2xl shadow-lg">

<div class="flex justify-between items-center mb-6">
<h1 class="text-3xl font-bold">Data Buku</h1>

<a href="tambah_buku.php"
class="bg-indigo-600 text-white px-5 py-3 rounded-lg">
Tambah Buku
</a>
</div>

<table class="w-full border-collapse">
<tr class="bg-indigo-600 text-white">
<th class="p-3">No</th>
<th>Judul</th>
<th>Penulis</th>
<th>Penerbit</th>
<th>Tahun</th>
<th>Stok</th>
<th>Aksi</th>
</tr>

<?php $no=1; while($row = $data->fetch_assoc()) : ?>
<tr class="border-b text-center hover:bg-gray-100">
<td class="p-3"><?= $no++; ?></td>
<td><?= htmlspecialchars($row['judul']); ?></td>
<td><?= htmlspecialchars($row['penulis']); ?></td>
<td><?= htmlspecialchars($row['penerbit']); ?></td>
<td><?= $row['tahun_terbit']; ?></td>
<td><?= $row['stok']; ?></td>
<td>
<a href="edit_buku.php?id=<?= $row['id']; ?>"
class="bg-yellow-400 px-3 py-1 rounded text-white">Edit</a>

<a href="hapus_buku.php?id=<?= $row['id']; ?>"
class="bg-red-500 px-3 py-1 rounded text-white"
onclick="return confirm('Hapus data?')">Hapus</a>
</td>
</tr>
<?php endwhile; ?>

</table>
</div>
</body>
</html>