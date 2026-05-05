<?php
$artikel = [
    ["judul"=>"Belajar HTML Pertama Kali","tanggal"=>"2022","isi"=>"Belajar HTML seru","gambar"=>"https://storage.googleapis.com/storage-ajaib-prd-platform-wp-artifact/2020/09/Belajar-Coding.jpg"],
    ["judul"=>"Error Pertama","tanggal"=>"2023","isi"=>"Error jadi pengalaman","gambar"=>"https://cdn.prod.website-files.com/6100d0111a4ed76bc1b9fd54/66a74c948980a5b1fbce2ac4_62a0314f6b81ed970ac67253_coding%2520vs%2520programmiing.jpeg"]
];

$quotes = [
    "Jangan menyerah!",
    "Terus belajar!",
    "Error adalah guru terbaik!",
    "Practice makes perfect!"
];

$randomQuote = $quotes[array_rand($quotes)];
$id = isset($_GET['id']) ? $_GET['id'] : 0;
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
<title>Blog</title>
</head>

<body class="bg-gradient-to-br from-blue-200 via-purple-200 to-pink-200 min-h-screen p-6">

<div class="max-w-3xl mx-auto bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white">

<h2 class="text-3xl font-extrabold mb-6 text-center text-purple-700"> Blog Developer </h2>

<ul class="space-y-2">
<?php foreach ($artikel as $i => $a) { ?>
<li>
<a class="block px-4 py-2 rounded-lg bg-blue-100 hover:bg-blue-300 hover:text-white transition duration-300 font-medium"
href="?id=<?php echo $i; ?>">
 <?php echo $a['judul']; ?>
</a>
</li>
<?php } ?>
</ul>

<hr class="my-6 border-purple-300">

<div class="text-center">
<h3 class="text-2xl font-bold text-purple-800"><?php echo $artikel[$id]['judul']; ?></h3>
<p class="text-gray-500"><?php echo $artikel[$id]['tanggal']; ?></p>
</div>

<p class="mt-4 text-gray-700 text-lg leading-relaxed text-center">
<?php echo $artikel[$id]['isi']; ?>
</p>

<div class="flex justify-center">
<img class="mt-6 rounded-xl shadow-lg hover:scale-105 transition duration-300"
src="<?php echo $artikel[$id]['gambar']; ?>" width="300">
</div>

<div class="mt-6 p-4 bg-gradient-to-r from-yellow-200 to-pink-200 rounded-xl shadow text-center">
<p class="font-semibold text-purple-700"> Motivasi</p>
<p class="italic text-gray-800"><?php echo $randomQuote; ?></p>
</div>

<div class="text-center">
<a href="index.php"
class="inline-block mt-6 px-6 py-2 bg-purple-500 text-white rounded-full shadow hover:bg-purple-700 transition duration-300">
← Kembali
</a>
</div>

</div>
</body>
</html>