<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
$username = htmlspecialchars($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Larry's Lair - Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="larry-dashboard">
    <div class="lair-header">
        <h1>👾 Welcome to Larry's,</h1>
        <p>In fact, Larry is just an ordinary cute cat. 
            Are you ready to face the monster inside you, <span class="larry-name"><?= $username; ?></span>?</p>
        <a href="logout.php" class="btn-logout">Leave the Lair</a>
    </div>

    <div class="monster-info">
        <alt="Larry The Monster">
        <p><strong>Larry</strong> is watching... Be brave.</p>
    </div>
</body>
</html>
