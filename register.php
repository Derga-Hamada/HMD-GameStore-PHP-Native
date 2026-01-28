<?php

session_start();      
require 'db.php';     

$message = '';        


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    
    if (!empty($username) && !empty($password)) {
        
      
        
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->rowCount() > 0) {
            $message = "The username is already taken";
        } else {
           
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([$username, $hashed_password])) {
               
                header("Location: index.php?registered=1");
                exit();
            } else {
                $message = "Technical error, try again.";
            }
        }
    } else {
        $message = "please fill all the fields.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h1>New user🎮</h1>
            
            <?php if($message): ?>
                <p style="color:red; text-align:center; font-weight:bold;"><?= $message ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label>username</label>
                    <input type="text" name="username" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label>password</label>
                    <input type="password" name="password" required autocomplete="new-password">
                </div>
                <div class="form-group">
                <button type="submit" id="signup" name="signup">Create Account</button>
                </div>
                <div class="form-group" style="text-align:center;">
                    <a href="index.php" style="text-decoration:none; color:#333;">Already have an accouny?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>