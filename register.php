<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $users = json_decode(file_get_contents('users.json'), true) ?? [];

    // Validasi username minimal 5 huruf
    if (strlen($username) < 5) {
        $error = "❌ Username harus minimal 5 huruf!";
    }
    // Validasi password kombinasi
    elseif (strlen($password) < 8 || 
        !preg_match('/[A-Za-z]/', $password) || 
        !preg_match('/[0-9]/', $password) || 
        !preg_match('/[\W]/', $password)) {
        $error = "❌ Password harus minimal 8 karakter, mengandung huruf, angka, dan karakter unik!";
    }
    // Cek apakah username sudah ada
    else {
        foreach ($users as $user) {
            if ($user['username'] === $username) {
                $error = "❌ Username sudah terdaftar!";
                break;
            }
        }
    }

    // Simpan jika lolos semua validasi
    if (!isset($error)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $users[] = ['username' => $username, 'password' => $hashedPassword];
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
        $success = "✅ Registrasi berhasil! Silakan login.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Larry the Rawrr Monster</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="larry-regis">
    <h1>Who is Larry? The Nightmare Monster? Register here to find out!</h1>
</div>

<div class="container-reg">
    <form method="POST">
  <h2>Register</h2>
  <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>
  <input type="text" name="username" placeholder="Username" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <button type="submit">Register</button>
  <p>Have an account? <a href="index.php">Login here!</a></p>
</form>
</div>

</body>
</html>
