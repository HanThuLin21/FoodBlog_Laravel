<?php 
    include "function.php";
    if (isset($_GET['recipeId'])) {
        $recipeId = mysqli_real_escape_string($db, $_GET['recipeId']);
        $query = "SELECT recipe.*,restaurant.restaurant_name
                 FROM recipe 
                 INNER JOIN restaurant ON recipe.foodtype = restaurant.foodtype
                 WHERE recipe_id = '$recipeId'";
        $result = mysqli_query($db, $query);
    
        if (mysqli_num_rows($result) > 0) {
            $recipe = mysqli_fetch_assoc($result);
        } else {
            echo "Recipe not found.";
            exit;
        }
    } else {
        echo "No recipe ID provided.";
        exit;
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe['recipe_name']); ?> - Recipe Details</title>
    <link rel="stylesheet" href="../css/recipeview.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($recipe['recipe_name']); ?></h1>
        <a href="../php/dashboard.php" style="text-decoration: none;"><i class="fa-solid fa-house" style="font-size: 26px; color:#000;"></i></a>

        <div class="recipe-details">
            <div class="images">
                <img src="<?php echo htmlspecialchars($recipe['image1']); ?>" alt="<?php echo htmlspecialchars($recipe['recipe_name']); ?>">
                <img src="<?php echo htmlspecialchars($recipe['image2']); ?>" alt="<?php echo htmlspecialchars($recipe['recipe_name']); ?>">
                <img src="<?php echo htmlspecialchars($recipe['image3']); ?>" alt="<?php echo htmlspecialchars($recipe['recipe_name']); ?>">
            </div>

            <div class="info">
                <p><strong>Category:</strong> <?php echo htmlspecialchars($recipe['recipe_category']); ?></p>
                <p><strong>Food Type:</strong> <?php echo htmlspecialchars($recipe['foodtype']); ?></p>
                <p><strong>Available Restaurant:</strong> <?php echo htmlspecialchars($recipe['restaurant_name']); ?></p>
                <p><strong>Preparation Time:</strong> <?php echo htmlspecialchars($recipe['prep_time']); ?></p>
                <p><strong>Cooking Time:</strong> <?php echo htmlspecialchars($recipe['cook_time']); ?></p>
                <p><strong>Servings:</strong> <?php echo htmlspecialchars($recipe['servings']); ?></p>
            </div>

            <div class="content">
                <h3>Recipe Content</h3>
                <p><?php echo htmlspecialchars($recipe['recipe_content']); ?></p>
            </div>

            <div class="instructions">
                <h3>Instructions</h3>
                <p><?php echo htmlspecialchars($recipe['instructions']); ?></p>
            </div>
        </div>

        <div class="actions">
            <button class="edit"><a href="../php/recipeedit.php?recipeId=<?php echo htmlspecialchars($recipe['recipe_id']); ?>">Edit</a></button>
            <button class="delete"><a href="../php/recipemgmt.php?recipeid=<?php echo htmlspecialchars($recipe['recipe_id']); ?>">Delete</a></button>
        </div>
    </div>
</body>
</html>