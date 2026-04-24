<?php 
    include "../../Admin/php/function.php";

    $restaurant_query = "SELECT * FROM restaurant WHERE foodtype = '$foodtype'";
    $restaurant_result = mysqli_query($db, $restaurant_query);
    $restaurants = [];
    while ($restaurant_row = mysqli_fetch_assoc($restaurant_result)) {
        $restaurants[] = $restaurant_row;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/ViewRecipe.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title><?php echo $recipe_name; ?> - Delicious Recipe</title>
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
                                <li><a href="#">Profile</a></li>
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
    <div class="recipe-container">
    <h1 class="title"><?php echo $recipe_name; ?></h1>
    <div class="recipe-info">
        <p><strong>Description:</strong> <?php echo $content; ?></p>
        <p><strong>Preparation Time:</strong> <?php echo $prep_time; ?></p>
        <p><strong>Cooking Time:</strong> <?php echo $cook_time; ?></p>
        <p><strong>Servings:</strong> <?php echo $servings; ?></p>
    </div>

    <div class="image-grid">
        <img src="<?php echo $image2; ?>" alt="Strawberry Custard 1">
        <img src="<?php echo $image3; ?>" alt="Strawberry Custard 2">
    </div>

    <div class="instructions">
        <h2>Instructions</h2>
        <ol>
            <?php echo nl2br($instructions); ?>
        </ol>
    </div>

    <div class="where-to-buy">
        <h2>Where to Buy <?php echo $recipe_name; ?></h2>
        <p>These restaurants serve <?php echo $recipe_name; ?>:</p>
        <ul>
            <?php if (!empty($restaurants)) { ?>
                <?php foreach ($restaurants as $restaurant) { ?>
                    <li>
                        <strong><?php echo $restaurant['restaurant_name']; ?></strong><br>
                        Phone: <?php echo $restaurant['restaurant_phone']; ?><br>
                        Location: <?php echo $restaurant['restaurant_location']; ?>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <li>No restaurants found for this recipe.</li>
            <?php } ?>
        </ul>
    </div>
</div>

    <footer class="footer">
        <div class="social-media">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-pinterest"></i></a>
        </div>
        <p>© 2025 Delicious Recipe | All Rights Reserved</p>
    </footer>
</body>
</html>