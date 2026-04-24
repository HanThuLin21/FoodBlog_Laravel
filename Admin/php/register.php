<?php 
    include "function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Register Page</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Admin Register</h2>
            <form class="register-form" action="function.php" method="POST">
                <div class="form-group">
                    <input type="text" id="username" name="username" required>
                    <label for="username">Username</label>
                </div>
                <div class="form-group">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="form-group">
                    <input type="password" id="confirm-password" name="conpassword" required>
                    <label for="confirm-password">Confirm Password</label>
                </div>
                <button type="submit" class="submit-btn" name="admin-register">Register</button>
            </form>
            <p class="register-link">You have account? <a href="../php/index.php">Login here</a></p>
        </div>
    </div>
</body>
</html>