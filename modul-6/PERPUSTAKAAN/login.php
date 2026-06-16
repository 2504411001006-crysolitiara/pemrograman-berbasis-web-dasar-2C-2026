<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0) {

        $data = $result->fetch_assoc();

        if(password_verify($password, $data['password'])) {

            $_SESSION['login'] = true;
            $_SESSION['id'] = $data['id'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['role'] = $data['role'];

            if($data['role'] == 'admin') {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard_user.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-600 to-blue-700 min-h-screen flex items-center justify-center">

<div class="bg-white w-[400px] p-8 rounded-2xl shadow-2xl">

<h1 class="text-3xl font-bold text-center text-indigo-700 mb-6">
    Library Login
</h1>

<form method="POST" class="space-y-4">

<input type="text" name="username" placeholder="Username"
class="w-full border p-3 rounded-lg" required>

<input type="password" name="password" placeholder="Password"
class="w-full border p-3 rounded-lg" required>

<button type="submit" name="login"
class="w-full bg-indigo-600 hover:bg-indigo-700 text-white p-3 rounded-lg font-semibold">
Login
</button>

<p class="text-center">
Belum punya akun?
<a href="register.php" class="text-indigo-600 font-semibold">Register</a>
</p>

</form>
</div>
</body>
</html>