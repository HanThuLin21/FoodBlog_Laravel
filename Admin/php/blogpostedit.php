<?php 
    include "function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
    <link rel="stylesheet" href="../css/blogpostedit.css">
</head>
<body>
    <div class="container">
        <h2>Edit Blog Post</h2>
        <?php 
            $id = $_GET['ptId'];
            $query = "SELECT * FROM blogpost WHERE post_id = '$id' ";
            $result = mysqli_query($db,$query);
            foreach($result as $row){
        ?>


        <form action="function.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['post_id'] ?>">
            <div class="form-group">
                <label for="post-name">Post Title</label>
                <input type="text" id="restaurant-name" placeholder="Enter post title" name="title" value="<?php echo $row['post_title']?>">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
            <select id="category" name="category">
                <option value="Breakfast & Lunch" <?php echo ($row['post_category'] == "Breakfast & Lunch") ? "selected" : "" ?>>Breakfast & Lunch</option>
                <option value="Dinner" <?php echo ($row['post_category'] == "Dinner") ? "selected" : "" ?>>Dinner</option>
                <option value="Main Dishes" <?php echo ($row['post_category'] == "Main Dishes") ? "selected" : "" ?>>Main Dishes</option>
                <option value="Side Dishes" <?php echo ($row['post_category'] == "Side Dishes") ? "selected" : "" ?> >Side Dishes</option>
                <option value="Desserts" <?php echo ($row['post_category'] == "Desserts") ? "selected" : "" ?>>Desserts</option>
                <option value="Drink & Coffee" <?php echo ($row['post_category'] == "Drink & Coffee") ? "selected" : "" ?>>Drink & Coffee</option>
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
                    <option value="Italian" <?php echo ($row['foodtype'] == "Chinese") ? "selected" : "" ?>>Chinese</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" placeholder="Description..." name="desc"><?php echo $row['post_description']?></textarea>
            </div>
            <div class="form-group">
                <label for="image-url">Featured Image 1</label>
                <input type="text" name="image" placeholder="Image Url" value="<?php echo $row['post_image'] ?>">
            </div>
            <div class="form-group">
                <label for="image-url">Featured Image 2</label>
                <input type="text" name="image2" placeholder="Image Url" value="<?php echo $row['post_image2'] ?>">
            </div>
            <div class="form-group">
                <button type="submit" name="edit-post">Save Post</button>
            </div>
        </form>

        <?php 
            }
        ?>
    </div>
</body>
</html>
