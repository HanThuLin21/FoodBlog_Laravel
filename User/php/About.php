<?php 
    include "../../Admin/php/function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Delicious Bites</title>
    <link rel="stylesheet" href="../css/About.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="container">
        <h1 class="logo">Delicious Bites</h1>
        <nav>
            <ul class="nav-list">
                <li><a href="../php/index.php">Home</a></li>
                <li><a href="../php/BlogPost.php">Blogs</a></li>
                <li><a href="../php/Recipe.php">Recipes</a></li>
                <li><a href="../php/Restaurant.php">Restaurant</a></li>
                <li><a href="../php/About.php">About</a></li>
                <?php if(isset($_SESSION['user_name'])) { ?>
                    <li class="dropdown">
                        <div class="user_account">
                            <i class="fa-solid fa-user" style="font-size: 20px;"></i> <?php echo $_SESSION['user_name']; ?>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a href="../php/UserRegister.php">New Account</a></li>
                            <li><a href="../php/UserLogin.php">Log In</a></li>
                            <li><a href="../php/UserRegister.php">Logout</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="dropdown">
                        <a href="#" class="btn-signup">Account <i class="fa-solid fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="../php/UserLogin.php">Log in</a></li>
                            <li><a href="../php/UserRegister.php">Register</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</header>

<main>
    <section class="about-section">
        <div class="container">
            <h2>About Delicious Bites</h2>
            <p>Welcome to <strong>Delicious Bites</strong>, your ultimate destination for all things food! Whether you're a seasoned chef or a home cook, we’re here to inspire your culinary journey with mouthwatering recipes, restaurant reviews, and food-related stories.</p>
            <p>Our mission is to celebrate the joy of cooking and eating. From quick weekday meals to elaborate weekend feasts, we’ve got you covered with a wide range of recipes that cater to all tastes and dietary preferences. We also explore the best restaurants around the globe, bringing you honest reviews and hidden gems.</p>
            <p>At Delicious Bites, we believe that food is more than just sustenance—it’s a way to connect, create memories, and explore cultures. Join us as we share our passion for food and help you discover new flavors, techniques, and dining experiences.</p>
        </div>
    </section>

    <section class="team-section">
        <div class="container">
            <h2>Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsEJHmI0MlIGvH9CYkbsLEWQ5_ee8Qtl5V-Q&s" alt="Team Member 1">
                    <h3>John Doe</h3>
                    <p>Founder & Head Chef</p>
                </div>
                <div class="team-member">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSC-gxW7tUW_zWRnuZbcfV35ypZZvBoRbKZrA&s" alt="Team Member 2">
                    <h3>Jane Smith</h3>
                    <p>Food Blogger & Recipe Developer</p>
                </div>
                <div class="team-member">
                    <img src="https://www.creativefabrica.com/wp-content/uploads/2022/03/09/Woman-Icon-Teen-Profile-Graphics-26722130-1.jpg" alt="Team Member 3">
                    <h3>Emily Brown</h3>
                    <p>Restaurant Critic & Content Writer</p>
                </div>
            </div>
        </div>
    </section>
</main>

<footer>
    <section class="subscribe">
        <h2>Subscribe for Weekly Recipes!</h2>
        <form action="#" method="post">
            <input type="email" placeholder="Enter your email" required>
            <button type="submit">Subscribe</button>
        </form>
    </section>
    <div class="social-media">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-pinterest"></i></a>
    </div>
    <p>&copy; 2025 Delicious Bites | All Rights Reserved</p>
</footer>
</body>
</html>