<?php 
    include "../../Admin/php/function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes | Delicious Bites</title>
    <link rel="stylesheet" href="../css/Restaurentstyle.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
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

    <div class="hero">
        <div>
            <h3>Top Restaurant Recommendations</h3>
            <form action="../php/Restaurant.php" class="search-box" method="POST">
                <input type="text" name="search" placeholder="Search Restaurant">
                <button name="btn-search" type="submit">Search</button>
            </form>
        </div>
    </div>
    
    <div class="content">
        <h2>Recommended Restaurants</h2>
        <div class="restaurants">
            <?php
            if (isset($_POST['btn-search'])) {
                $searchTerm = mysqli_real_escape_string($db, $_POST['search']);
                $query = "SELECT * FROM restaurant WHERE
                          restaurant_name LIKE '%$searchTerm%' OR
                          restaurant_rating LIKE '%$searchTerm%' OR
                          foodtype LIKE '%$searchTerm%'";
            } else {
                $query = "SELECT * FROM restaurant";
            }
                
                $result = mysqli_query($db,$query);
                if(mysqli_num_rows($result) > 0 ){
                    foreach($result as $row){
            ?>
            <div class="restaurant-item">
                <img src="<?php echo $row['restaurant_image'] ?>" alt="Restaurant 1">
                <h3><?php echo $row['restaurant_name'] ?></h3>
                <p><?php echo substr($row['restaurant_content'],0,120); ?> ...</p>
                <div class="rating">
                    <?php 
                        $rating = $row['restaurant_rating'];
                        if($rating == 5){
                            echo "★★★★★";
                        }else if($rating == 4){
                            echo "★★★★☆";
                        }else if($rating == 3){
                            echo "★★★☆☆";
                        }else if($rating == 2){
                            echo "★★☆☆☆";
                        }else if($rating == 1){
                            echo "★☆☆☆☆";
                        }
                    ?>
                </div>
                <a href="../php/SeeViewRestaurant.php?viewrtId=<?php echo $row['restaurant_id'] ?>" class="view">View Restaurant</a>
            </div>
            <?php 
                    }
                }else {
                    echo "<p class='no-results'>No recipes found matching your search.</p>";
                }
            ?>
        </div>
    </div>

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
</body>
</html>