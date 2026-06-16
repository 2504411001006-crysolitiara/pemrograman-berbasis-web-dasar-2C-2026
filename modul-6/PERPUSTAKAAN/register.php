<?php
include 'koneksi.php';

if(isset($_POST['register'])) { // Cek apakah tombol register ditekan

    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // cek username sudah ada atau belum
    $cek = $conn->prepare("SELECT * FROM users WHERE username=?");
    $cek->bind_param("s", $username);
    $cek->execute();

    $result = $cek->get_result();

    if($result->num_rows > 0) {

        echo "
        <script>
            alert('Username sudah digunakan!');
        </script>
        ";

    } else {

        $stmt = $conn->prepare("
            INSERT INTO users(nama, username, password, role)
            VALUES(?,?,?,?)
        ");

        $stmt->bind_param(
            "ssss",
            $nama,
            $username,
            $password,
            $role
        );

        if($stmt->execute()) {

            echo "
            <script>
                alert('Registrasi berhasil!');
                window.location='login.php';
            </script>
            ";

        } else {

            echo "
            <script>
                alert('Registrasi gagal!');
            </script>
            ";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-600 to-blue-700 min-h-screen flex items-center justify-center">

<div class="bg-white w-[420px] p-8 rounded-3xl shadow-2xl">

    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-indigo-700">
            Register
        </h1>

        <p class="text-gray-500 mt-2">
            Sistem Perpustakaan Digital
        </p>
    </div>

    <form method="POST" class="space-y-5">

        <div>
            <label class="font-semibold text-gray-700">
                Nama Lengkap
            </label>

            <input
                type="text"
                name="nama"
                placeholder="Masukkan nama"
                class="w-full mt-2 border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                required
            >
        </div>

        <div>
            <label class="font-semibold text-gray-700">
                Username
            </label>

            <input
                type="text"
                name="username"
                placeholder="Masukkan username"
                class="w-full mt-2 border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                required
            >
        </div>

        <div>
            <label class="font-semibold text-gray-700">
                Password
            </label>

            <input
                type="password"
                name="password"
                placeholder="Masukkan password"
                class="w-full mt-2 border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                required
            >
        </div>

        <div>
            <label class="font-semibold text-gray-700">
                Role Akun
            </label>

            <select
                name="role"
                class="w-full mt-2 border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                required
            >
                <option value="">-- Pilih Role --</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button
            type="submit"
            name="register"
            class="w-full bg-indigo-600 hover:bg-indigo-700 transition duration-300 text-white font-bold py-3 rounded-xl"
        >
            Register
        </button>

        <p class="text-center text-gray-600">
            Sudah punya akun?
            <a href="login.php" class="text-indigo-600 font-semibold hover:underline">
                Login
            </a>
        </p>

    </form>
</div>

</body>
</html>