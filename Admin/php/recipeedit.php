<?php 
    include "function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Restaurant Post</title>
    <link rel="stylesheet" href="../css/recipeedit.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <h2>Edit Recipe Post</h2>
        <?php 
            $id = $_GET['recipeId'];
            $query = "SELECT * FROM recipe WHERE recipe_id = '$id'";
            $result = mysqli_query($db,$query);
            foreach($result as $row){
        ?>
        <form action="function.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['recipe_id'] ?>">
            <div class="form-group">
                <label for="recipe-name">Recipe Name</label>
                <input type="text" id="recipe-name" placeholder="Enter recipe name" name="name" value="<?php echo $row['recipe_name']?>">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category">
                <option value="Breakfast & Lunch" <?php echo ($row['recipe_category'] == "Breakfast & Lunch") ? "selected" : "" ?>>Breakfast & Lunch</option>
                <option value="Dinner" <?php echo ($row['recipe_category'] == "Dinner") ? "selected" : "" ?>>Dinner</option>
                <option value="Main Dishes" <?php echo ($row['recipe_category'] == "Main Dishes") ? "selected" : "" ?>>Main Dishes</option>
                <option value="Side Dishes" <?php echo ($row['recipe_category'] == "Side Dishes") ? "selected" : "" ?>>Side Dishes</option>
                <option value="Desserts" <?php echo ($row['recipe_category'] == "Desserts") ? "selected" : "" ?>>Desserts</option>
                <option value="Drink & Coffee" <?php echo ($row['recipe_category'] == "Drink & Coffee") ? "selected" : "" ?>>Drink & Coffee</option>
            </select>
            </div>
            <div class="form-group">
                <label for="foodtype">Food Type</label>
                <select id="foodtype" name="foodtype">
                    <option value="Burmese" <?php echo ($row['foodtype'] == "Burmese") ? "selected" : "" ?>>Burmese</option>
                    <option value="India" <?php echo ($row['foodtype'] == "India") ? "selected" : "" ?>>India</option>
                    <option value="Japanese" <?php echo ($row['foodtype'] == "Japanese") ? "selected" : "" ?>>Japanese</option>
                    <option value="Western" <?php echo ($row['foodtype'] == "Western") ? "selected" : "" ?>>Western</option>
                    <option value="Italian" <?php echo ($row['foodtype'] == "Italian") ? "selected" : "" ?>>Italian</option>
                    <option value="Chinese" <?php echo ($row['foodtype'] == "Chinese") ? "selected" : "" ?>>Chinese</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image-url">Image 1</label>
                <input type="text" name="image1" placeholder="Image 1 Url" value="<?php echo $row['image1']?>">
            </div>
            <div class="form-group">
                <label for="image-url">Image 2</label>
                <input type="text" name="image2" placeholder="Image 2 Url" value="<?php echo $row['image2']?>">
            </div>
            <div class="form-group">
                <label for="image-url">Image 3</label>
                <input type="text" name="image3" placeholder="Image 3 Url" value="<?php echo $row['image3']?>">
            </div>
            <div class="form-group">
                <label for="content">Recipe Content</label>
                <textarea id="content" placeholder="Recipe Content..." name="content"><?php echo $row['recipe_content']?></textarea>
            </div>
            <div class="form-group">
                <label for="prep_time">Preparation Time</label>
                <input type="text" name="preptime" placeholder="Prep Time" value="<?php echo $row['prep_time'] ?>">
            </div>
            <div class="form-group">
                <label for="cook_time">Cooking Time</label>
                <input type="text" name="cooktime" placeholder="Cooking Time" value="<?php echo $row['cook_time'] ?>">
            </div>
            <div class="form-group">
                <label for="servings">Servings</label>
                <select id="servings" name="servings">
                    <option value="1" <?php echo ($row['servings'] == "1") ? "selected" : "" ?>>1</option>
                    <option value="2" <?php echo ($row['servings'] == "2") ? "selected" : "" ?>>2</option>
                    <option value="3" <?php echo ($row['servings'] == "3") ? "selected" : "" ?>>3</option>
                    <option value="4" <?php echo ($row['servings'] == "4") ? "selected" : "" ?>>4</option>
                    <option value="5" <?php echo ($row['servings'] == "5") ? "selected" : "" ?>>5</option>
                    <option value="6" <?php echo ($row['servings'] == "6") ? "selected" : "" ?>>6</option>
                    <option value="7" <?php echo ($row['servings'] == "7") ? "selected" : "" ?>>7</option>
                </select>
            </div>
            <div class="form-group">
                <label for="instructions">Recipe Instructions</label>
                <textarea id="instructions" placeholder="List Recipe" name="instructions"><?php echo $row['instructions']?></textarea>
            </div>

            <div class="form-group">
                <button type="submit" name="edit-recipe">Edit Recipe</button>
            </div>
        </form>
        <?php 
            }
        ?>
    </div>
</body>
</html>
