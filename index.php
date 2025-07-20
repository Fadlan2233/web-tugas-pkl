<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    $users = json_decode(file_get_contents('users.json'), true);
    if (!is_array($users)){
        $users = [];
    }


    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location:dashboard.php");
            exit;
        }
    }

        $error = "Username or password wrong!";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="larry-ontop">
    <h1><h1>Larry Can Eat You! Login Now!!</h1>
</h1>
</div>

<div class="container">
 <form method="POST">
  <h2>Larry Login</h2>
  <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>
  <input type="text" name="username" placeholder="Username" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <button type="submit">Login</button>
  <p>No have account? <a href="register.php">Register here!</a></p>
</form>
</div>

</body>
</html>
