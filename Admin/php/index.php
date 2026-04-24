<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Admin Login</h2>
            <form class="login-form" action="function.php" method="POST">
                <div class="form-group">
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <button type="submit" class="submit-btn" name="admin-login">Login</button>
            </form>
            <p class="register-link">Don't have an account? <a href="../php/register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>