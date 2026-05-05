<?php
function tampilkanData($data) {
    echo "<div class='mt-6 overflow-x-auto'>";
    echo "<table class='w-full border border-gray-300 text-sm'>";
    foreach ($data as $key => $value) {
        echo "<tr class='border-b'>
                <th class='p-2 bg-gray-100 text-left'>$key</th>
                <td class='p-2'>$value</td>
              </tr>";
    }
    echo "</table></div>";
}

$pesan = "";
$hasil = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $id = $_POST['id'];
    $ttl = $_POST['ttl'];
    $email = $_POST['email'];
    $wa = $_POST['wa'];
    $framework = $_POST['framework'];
    $pengalaman = $_POST['pengalaman'];
    $tools = isset($_POST['tools']) ? $_POST['tools'] : [];
    $minat = $_POST['minat'];
    $skill = $_POST['skill'];

    // VALIDASI
    if (!str_contains($email, "@")) {
        $pesan = "Email harus menggunakan @";
    } elseif (strlen($wa) < 10 || !is_numeric($wa)) {
        $pesan = "Nomor WA harus angka dan minimal 10 digit";
    } elseif ($nama && $id && $ttl && $email && $wa && $framework && $pengalaman && $minat && $skill) {

        $frameworkArray = explode(",", $framework);

        if (count($frameworkArray) > 2) {
            $pesan = "Skill Anda cukup luas di bidang development!";
        }

        $hasil = [
            "Nama" => $nama,
            "ID Developer" => $id,
            "Kota/Tgl Lahir" => $ttl,
            "Email" => $email,
            "No WhatsApp" => $wa,
            "Framework" => implode(", ", $frameworkArray),
            "Tools" => implode(", ", $tools),
            "Minat" => $minat,
            "Skill Level" => $skill
        ];

    } else {
        $pesan = "Semua input wajib diisi!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.tailwindcss.com"></script>
<title>Profil Developer</title>
</head>

<body class="bg-gray-100 p-6">

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

<h2 class="text-2xl font-bold mb-4">Profil Interaktif Developer Pemula</h2>

<form method="POST" class="space-y-3">

<input required class="w-full border p-2 rounded" type="text" name="nama" placeholder="Nama">

<input required class="w-full border p-2 rounded" type="text" name="id" placeholder="ID Developer">

<input required class="w-full border p-2 rounded" type="text" name="ttl" placeholder="Kota/Tgl Lahir">

<input required class="w-full border p-2 rounded" 
type="email" name="email" placeholder="Email (harus ada @)">

<input required class="w-full border p-2 rounded" 
type="text" name="wa" placeholder="No WA (min 10 digit)" 
pattern="[0-9]{10,}" title="Nomor harus angka dan minimal 10 digit">

<input required class="w-full border p-2 rounded" type="text" name="framework" placeholder="Framework (pisahkan koma)">

<textarea required class="w-full border p-2 rounded" name="pengalaman" placeholder="Pengalaman"></textarea>

<div>
<p class="font-semibold">Tools:</p>
<label><input type="checkbox" name="tools[]" value="VS Code"> VS Code</label>
<label><input type="checkbox" name="tools[]" value="GitHub"> GitHub</label>
<label><input type="checkbox" name="tools[]" value="Figma"> Figma</label>
<label><input type="checkbox" name="tools[]" value="Postman"> Postman</label>
</div>

<div>
<p class="font-semibold">Minat:</p>
<label><input required type="radio" name="minat" value="Frontend"> Frontend</label>
<label><input type="radio" name="minat" value="Backend"> Backend</label>
<label><input type="radio" name="minat" value="Fullstack"> Fullstack</label>
</div>

<select required name="skill" class="w-full border p-2 rounded">
<option value="">Pilih Skill</option>
<option>Dasar</option>
<option>Cukup</option>
<option>Profesional</option>
</select>

<button class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
</form>

<?php
if ($pesan) echo "<p class='mt-4 text-red-500'>$pesan</p>";

if ($hasil) {
    tampilkanData($hasil);
    echo "<p class='mt-4'>$pengalaman</p>";
}
?>

<a href="timeline.php" class="inline-block mt-4 text-blue-500">Ke Timeline →</a>

</div>
</body>
</html>