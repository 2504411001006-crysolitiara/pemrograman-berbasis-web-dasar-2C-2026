<?php
$timeline = [
    ["tahun"=>"2021","kegiatan"=>"Masuk kuliah"],
    ["tahun"=>"2022","kegiatan"=>"Belajar HTML"],
    ["tahun"=>"2023","kegiatan"=>"Belajar CSS & JS"],
    ["tahun"=>"2024","kegiatan"=>"Project pertama"],
    ["tahun"=>"2025","kegiatan"=>"Belajar PHP"]
];

function highlight($tahun) {
    return $tahun == "2023" ? "text-red-500 font-bold" : "";
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
<title>Timeline</title>
</head>

<body class="bg-gradient-to-br from-blue-200 via-purple-200 to-pink-200 min-h-screen p-6">

<div class="max-w-2xl mx-auto bg-white/80 backdrop-blur-md p-8 rounded-2xl shadow-2xl border border-white">

<h2 class="text-3xl font-extrabold mb-4 text-center text-blue-700">📅 Timeline Belajar Coding</h2>

<!-- Teks cerita -->
<p class="text-gray-600 text-sm mb-2 text-center">
Perjalanan saya ini dimulai sejak pertama kali masuk kuliah pada tahun 2021.
Dari yang awalnya tidak tahu apa-apa soal coding, pelan-pelan mulai mengenal dunia web.
</p>

<p class="text-gray-600 text-sm mb-6 text-center">
Setiap semester membawa tantangan dan pelajaran baru — dari tugas codingan pertama yang berantakan,
hingga akhirnya berhasil menyelesaikan project nyata dan belajar PHP.
Masih panjang jalannya, tapi setiap langkah adalah bagian dari proses.
</p>

<div class="relative border-l-4 border-blue-500 pl-6 space-y-6">
<?php foreach ($timeline as $data) { ?>
    <div class="relative <?php echo highlight($data['tahun']); ?>">
        
        <!-- Titik timeline -->
        <span class="absolute -left-3 top-1 w-5 h-5 bg-blue-500 rounded-full border-4 border-white"></span>
        
        <!-- Card -->
        <div class="bg-white p-3 rounded-lg shadow hover:shadow-lg transition duration-300">
            <p class="text-sm text-gray-500"><?php echo $data['tahun']; ?></p>
            <p class="font-semibold"><?php echo $data['kegiatan']; ?></p>
        </div>

    </div>
<?php } ?>
</div>

<div class="mt-8 flex justify-between">
<a href="index.php" class="px-4 py-2 bg-blue-500 text-white rounded-full shadow hover:bg-blue-700 transition duration-300">
← Kembali
</a>

<a href="blog.php" class="px-4 py-2 bg-green-500 text-white rounded-full shadow hover:bg-green-700 transition duration-300">
Ke Blog →
</a>
</div>

</div>
</body>
</html>