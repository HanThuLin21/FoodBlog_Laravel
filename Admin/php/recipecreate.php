<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Recipe Post</title>
    <link rel="stylesheet" href="../css/restaurantcreate.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<body>
    <div class="container">
        <h2>Create Recipe Post</h2>
        <form action="function.php" method="POST">
            <div class="form-group">
                <label for="post-name">Recipe Name</label>
                <input type="text" id="recipe-name" placeholder="Enter Recipe Name" name="name">
            </div>

            <div class="form-group">
                <label for="category">Recipe Category</label>
                <select id="category" name="category">
                    <option value="">Select category</option>
                    <option value="Breakfast & Lunch">Breakfast & Lunch</option>
                    <option value="Dinner">Dinner</option>
                    <option value="Main Dishes">Main Dishes</option>
                    <option value="Side Dishes">Side Dishes</option>
                    <option value="Desserts">Desserts</option>
                    <option value="Drink & Coffee">Drink & Coffee</option>
                </select>
            </div>
           
            <div class="form-group">
                <label for="foodtype">Food Type</label>
                <select id="foodtype" name="foodtype">
                    <option value="">Select food type</option>
                    <option value="Burmese">Burmese</option>
                    <option value="India">India</option>
                    <option value="Japanese">Japanese</option>
                    <option value="Western">Western</option>
                    <option value="Italian">Italian</option>
                    <option value="Chinese">Chinese</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image1">Image 1</label>
                <input type="text" name="image1" placeholder="Image 1 Url">
            </div>
            <div class="form-group">
                <label for="image2">Image 2</label>
                <input type="text" name="image2" placeholder="Image 2 Url">
            </div>
            <div class="form-group">
                <label for="image3">Image 3</label>
                <input type="text" name="image3" placeholder="Image 3 Url">
            </div>
            <div class="form-group">
                <label for="content">Recipe Content</label>
                <textarea name="content" id="content" placeholder="Recipe Content..."></textarea>
            </div>
            <div class="form-group">
                <label for="prep_time">Preparation Time</label>
                <input type="text" name="preptime" placeholder="Prep Time">
            </div>
            <div class="form-group">
                <label for="cook_time">Cooking Time</label>
                <input type="text" name="cooktime" placeholder="Cooking Time">
            </div>
            <div class="form-group">
                <label for="servings">Servings</label>
                <select id="servings" name="servings">
                    <option value="">Select Serve Person</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>
            </div>
            <div class="form-group">
                <label for="instructions">Recipe Instructions</label>
                <textarea name="instructions" id="instructions" placeholder="List Instructions"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="create-recipe">Create Recipe</button>
            </div>
        </form>
    </div>
</body>
</html>
