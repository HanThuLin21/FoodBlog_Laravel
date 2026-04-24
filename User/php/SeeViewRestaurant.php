<?php 
    include "../../Admin/php/function.php";

    // Initialize variables with default values
    $restaurant_name = "Restaurant Not Found";
    $restaurant_phone = "N/A";
    $foodtype = "N/A";
    $restaurant_location = "N/A";
    $restaurant_content = "The restaurant you are looking for does not exist.";
    $restaurant_image = "default_image.jpg";
    $restaurant_image2 = "default_image.jpg";
    $restaurant_image3 = "default_interior.jpg";
    $rating = 0;
    $opening_day = "N/A";
    $open_hour = "N/A";
    $close_hour = "N/A";

    if(isset($_GET['viewrtId'])){
        $restaurant_id = $_GET['viewrtId'];
        $query = "SELECT restaurant.*, recipe.*
                FROM restaurant
                INNER JOIN recipe ON recipe.foodtype = restaurant.foodtype
                WHERE restaurant.restaurant_id = '$restaurant_id'";
        $result = mysqli_query($db, $query);

        if($result && mysqli_num_rows($result) > 0){
            $rows = [];
            while($row = mysqli_fetch_assoc($result)){
                $rows[] = $row;
            }

            // Override default values with data from the database
            $restaurant_name = $rows[0]['restaurant_name'];
            $restaurant_phone = $rows[0]['restaurant_phone'];
            $foodtype = $rows[0]['foodtype'];
            $restaurant_location = $rows[0]['restaurant_location'];
            $restaurant_content = $rows[0]['restaurant_content'];
            $restaurant_image = $rows[0]['restaurant_image'];
            $restaurant_image2 = $rows[0]['restaurant_image2'];
            $restaurant_image3 = $rows[0]['restaurant_image3'];
            $rating = $rows[0]['restaurant_rating'];
            $opening_day = $rows[0]['opening_day'];
            $open_hour = $rows[0]['open_hour'];
            $close_hour = $rows[0]['close_hour'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Restaurant</title>
    <link rel="stylesheet" href="../css/SeeViewRestaurant.css?v=<?php echo time() ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="container">
        <h1 class="logo">Delicious Bites</h1>
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
    <img src="<?php echo $restaurant_image2; ?>" alt="Top Banner Image" class="top-image">
    
    <div class="restaurant-container">
        <h1><?php echo $restaurant_name; ?></h1>
        
        <section class="about">
            <h2>About Us</h2>
            <p><?php echo $restaurant_content; ?></p>
            <img src="<?php echo $restaurant_image3; ?>" alt="Restaurant Interior">
        </section>
        
        <section class="menu">
            <h2>Famous Menu</h2>
            <p>Explore our handcrafted dishes made from locally sourced ingredients.</p>
            <div class="menu-container">
            <?php 
                if(isset($rows) && !empty($rows)){
                    foreach($rows as $row){
            ?>
                <div class="menu-item">
                    <img src="<?php echo $row['image2']; ?>">
                    <h3><?php echo $row['recipe_name']; ?></h3>
                    <p><?php echo $row['recipe_content']; ?></p>
                </div>
            <?php 
                    }
                } else {
                    echo "<p>No menu items found.</p>";
                }
            ?>
            </div>
        </section>
        
        <section class="details">
            <div class="info">
                <h2>Visit Us</h2>
                <p><strong>Opening Days: </strong> <?php echo $opening_day; ?></p>
                <p><strong>Open Hour: </strong> <?php echo date("h:i A", strtotime($open_hour)); ?></p>
                <p><strong>Close Hour: </strong> <?php echo date("h:i A", strtotime($close_hour)); ?></p>
                <p><strong>Address: </strong><?php echo $restaurant_location; ?></a></p>
                <p><strong>Rating: </strong> 
                    <span class="stars">
                        <?php 
                            for($i = 1; $i <= 5; $i++){
                                if($i <= $rating){
                                    echo "&#9733;";
                                } else {
                                    echo "&#9734;";
                                }
                            }
                        ?>
                    </span> (<?php echo $rating; ?>/5)
                </p>
            </div>
        </section>
    </div>
    
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