<?php
include 'cek.php';
include 'koneksi.php';

$id = $_SESSION['id'];

$query = "SELECT peminjaman.*, buku.judul
FROM peminjaman
JOIN buku ON peminjaman.buku_id = buku.id
WHERE peminjaman.user_id='$id'";

$data = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Riwayat</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

<div class="bg-white p-8 rounded-2xl shadow-xl">
<h1 class="text-3xl font-bold mb-6">Riwayat Peminjaman</h1>

<table class="w-full">
<tr class="bg-indigo-600 text-white">
<th class="p-3">No</th>
<th>Judul Buku</th>
<th>Tanggal Pinjam</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php $no=1; while($row = $data->fetch_assoc()) : ?>
<tr class="text-center border-b">
<td class="p-3"><?= $no++; ?></td>
<td><?= htmlspecialchars($row['judul']); ?></td>
<td><?= $row['tanggal_pinjam']; ?></td>
<td><?= $row['status']; ?></td>
<td>
<?php if($row['status'] == 'dipinjam') : ?>
<a href="kembalikan.php?id=<?= $row['id']; ?>"
class="bg-green-500 text-white px-4 py-2 rounded-lg">
Kembalikan
</a>
<?php endif; ?>
</td>
</tr>
<?php endwhile; ?>

</table>
</div>
</body>
</html>