<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Restaurant Post</title>
    <link rel="stylesheet" href="../css/blogpostcreate.css">
</head>
<body>
    <div class="container">
        <h2>Create New Blog Post</h2>
        <form action="function.php" method="POST">
            <div class="form-group">
                <label for="post-name">Post Title</label>
                <input type="text" id="restaurant-name" placeholder="Enter post title" name="title">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
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
                <label for="description">Description</label>
                <textarea id="description" placeholder="Description..." name="desc"></textarea>
            </div>
            <div class="form-group">
                <label for="image-url">Featured Image 1</label>
                <input type="text" name="image" placeholder="Image Url">
            </div>
            <div class="form-group">
                <label for="image-url">Featured Image 2</label>
                <input type="text" name="image2" placeholder="Image Url">
            </div>
            <div class="form-group">
                <button type="submit" name="create-post">Create Post</button>
            </div>
        </form>
    </div>
</body>
</html>
