<?php 
    include "../../Admin/php/function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delicious Bites | Food Blog</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="container">
        <h1 class="logo">Delicious Bites</h1>
        <!-- Hamburger Menu Icon -->
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav id="nav-menu">
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
                            <li><a href="../php/Logout.php">Logout</a></li>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Delicious Recipes & Food Stories to Savor!</h1>
            <p>Discover mouth-watering recipes, travel food guides, and culinary tips.</p>
            <a href="../php/Recipe.php" class="btn">Explore Recipes</a>
        </div>
    </section>

    <!-- Featured Recipes Section -->
    <section class="featured">
        <h2>Featured Recipes</h2>
        <div class="recipes">
            <?php 
                $query = "SELECT * FROM recipe LIMIT 5";
                $result = mysqli_query($db, $query);
                foreach($result as $row) {
            ?>
            <div class="recipe">
                <img src="<?php echo $row['image1']; ?>" alt="<?php echo $row['recipe_name']; ?>">
                <h3><?php echo $row['recipe_name']; ?></h3>
                <a href="../php/ViewRecipe.php?recipeId=<?php echo $row['recipe_id'];?>" class="btn-recipe">View Recipe</a>
            </div>
            <?php } ?>
        </div>
    </section>

    <!-- Blog Posts Section -->
    <section class="blog">
        <h2>Latest Posts</h2>
        <div class="posts">
            <?php 
                $query = "SELECT * FROM `blogpost` ORDER BY `post_date` DESC LIMIT 5";
                $result = mysqli_query($db, $query);
                foreach($result as $row) {
            ?>
            <div class="post">
                <div class="post-img">
                    <img src="<?php echo $row['post_image']; ?>" alt="<?php echo $row['post_title']; ?>">
                </div>
                <div class="post-context">
                    <span><?php echo date('F j, Y', strtotime($row['post_date'])); ?></span>
                    <h3><?php echo $row['post_title']; ?></h3>
                    <p><?php echo substr($row['post_description'], 0, 150) . '...'; ?></p>
                    <a href="../php/DetailedBlogPost.php?detailpostId=<?php echo $row['post_id'] ?>" class="btn-read">Continue Reading</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>

    <!-- Footer -->
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

    <script>
    // Hamburger Menu Toggle
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-menu');

    hamburger.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });

    // Close the menu when a link is clicked (optional)
    const navLinks = document.querySelectorAll('.nav-list a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('active');
        });
    });
</script>
</body>
</html>