<?php 
    include "function.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Restaurant Post</title>
    <link rel="stylesheet" href="../css/restaurantedit.css">
</head>
<body>
    <div class="container">
        <h2>Edit Restaruant Post</h2>
        <?php 
            $id = $_GET['rtId'];
            $query = "SELECT * FROM restaurant WHERE restaurant_id = '$id' ";
            $result = mysqli_query($db,$query);
            foreach($result as $row){
        ?>
        <form action="function.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['restaurant_id'] ?>">
            <div class="form-group">
                <label for="restaurant-name">Restaruant Name</label>
                <input type="text" id="restaurant-name" placeholder="Enter restaurant name" name="name" value="<?php echo $row['restaurant_name']?>">
            </div>
            <div class="form-group">
                <label for="phone">Restaurant Phone</label>
                <input type="text" id="restaurant-phone" placeholder="Enter restaurant phone" name="phone" value="<?php echo $row['restaurant_phone']?>">
            </div>
            <div class="form-group">
                <label for="foodtype">Restaruant Type</label>
                <select id="foodtype" name="type">
                    <option value="Burmese" <?php echo ($row['foodtype'] == "Burmese") ? "selected" : "" ?>>Burmese</option>
                    <option value="Chinese" <?php echo ($row['foodtype'] == "Chinese") ? "selected" : "" ?>>Chinese</option>
                    <option value="India" <?php echo ($row['foodtype'] == "India") ? "selected" : "" ?>>India</option>
                    <option value="Japanese" <?php echo ($row['foodtype'] == "Japanese") ? "selected" : "" ?>>Japanese</option>
                    <option value="Western" <?php echo ($row['foodtype'] == "Western") ? "selected" : "" ?>>Western</option>
                    <option value="Italian" <?php echo ($row['foodtype'] == "Italian") ? "selected" : "" ?>>Italian</option>
                </select>
            </div>
            <div class="form-group">
                <label for="location">Restaurant location</label>
                <textarea id="location" placeholder="Location..." name="location"><?php echo $row['restaurant_location']?></textarea>
            </div>
            <div class="form-group">
                <label for="content">Restaurant Content</label>
                <textarea id="content" placeholder="Restaurant Content..." name="content"><?php echo $row['restaurant_content']?></textarea>
            </div>
            <div class="form-group">
                <label for="image-url">Logo Image</label>
                <input type="text" name="image" placeholder="Image Url" value="<?php echo $row['restaurant_image']?>">
            </div>
            <div class="form-group">
                <label for="image-url">Restaruant Image 1</label>
                <input type="text" name="image2" placeholder="Image Url" value="<?php echo $row['restaurant_image2']?>">
            </div>
            <div class="form-group">
                <label for="image-url">Restaruant Image 2</label>
                <input type="text" name="image3" placeholder="Image Url" value="<?php echo $row['restaurant_image3']?>">
            </div>
            <div class="form-group">
                <label for="rating">Restaruant Rating</label>
                <select id="rating" name="rating">
                    <option value="1" <?php echo ($row['restaurant_rating'] == "1") ? "selected" : "" ?>>★</option>
                    <option value="2" <?php echo ($row['restaurant_rating'] == "2") ? "selected" : "" ?>>★★</option>
                    <option value="3" <?php echo ($row['restaurant_rating'] == "3") ? "selected" : "" ?>>★★★</option>
                    <option value="4" <?php echo ($row['restaurant_rating'] == "4") ? "selected" : "" ?>>★★★★</option>
                    <option value="5" <?php echo ($row['restaurant_rating'] == "5") ? "selected" : "" ?>>★★★★★</option>
                </select>
            </div>
            <div class="form-group">
                <label for="day">Select Opeing Day</label>
                <select id="day" name="day">
                    <option value="monday to friday" <?php echo ($row['opening_day'] == "monday to friday") ? "selected" : "" ?>>Monday to Friday</option>
                    <option value="sat & sun"  <?php echo ($row['opening_day'] == "sat & sun") ? "selected" : "" ?>>Sat & Sun</option>
                    <option value="everyday" <?php echo ($row['opening_day'] == "everyday") ? "selected" : "" ?>>Everyday</option>
                </select>
            </div>
            <div class="form-group">
                <label for="hour">Opening Hour</label>
                <input type="time" name="opentime" placeholder="Time" value="<?php echo !empty($row['open_hour']) ? $row['open_hour'] : '00:00'; ?>">
                <input type="time" name="closetime" placeholder="Time" value="<?php echo !empty($row['close_hour']) ? $row['close_hour'] : '23:59'; ?>">
            </div>
            <div class="form-group">
                <button type="submit" name="edit-restaurant">Edit Post</button>
            </div>
        </form>

        <?php 
            }
        ?>
    </div>
</body>
</html>
