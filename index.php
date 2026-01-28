<?php

session_start();     
require 'db.php';     


if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

$error_message = '';
$success_message = '';


if (isset($_GET['registered'])) {
    $success_message = "Account created successfully! Please login.";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        
       
       
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        
        
        if ($user && password_verify($password, $user['password'])) {
            
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            
            header("Location: home.php");
            exit();
            
        } else {
            
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Please fill in all fields.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Portal - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h1>Welcome Back 🎮</h1>
            
            <?php if($success_message): ?>
                <p style="color: green; text-align: center; font-weight: bold;"><?= $success_message ?></p>
            <?php endif; ?>

            <?php if($error_message): ?>
                <p style="color: red; text-align: center; font-weight: bold;"><?= $error_message ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required autocomplete="username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required autocomplete="current-password">
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
                <div class="form-group" style="text-align: center;">
                    <a href="register.php" style="text-decoration: none; color: #333;">New here? Create an Account</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>